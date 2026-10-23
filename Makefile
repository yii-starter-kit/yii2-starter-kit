# Yii 2 Starter Kit — developer shortcuts.
#
#   make              list every target
#   make verify       everything a pull request must pass
#   make release      write the changelog for the next version
#
# Override a variable on the command line, e.g. `make release VERSION=5.1.0`.

SHELL := /bin/bash
.DEFAULT_GOAL := help
.PHONY: help hooks install env up down logs build test test-local lint verify changelog release tag

COMPOSE := docker compose
PHP ?= php
VERSION ?=

# Newest release tag. Only plain `X.Y.Z` tags count; `v3.0.2` is legacy.
CURRENT_VERSION := $(shell git tag --list --sort=-v:refname | grep -E '^[0-9]+\.[0-9]+\.[0-9]+$$' | head -n1)

help: ## Show this help
	@grep -hE '^[a-zA-Z0-9_-]+:.*?## ' $(MAKEFILE_LIST) \
		| sort \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'

## Setup

hooks: ## Install the git hooks (commit-msg -> commitlint)
	npx --no -- husky

env: ## Create .env from .env.dist when it is missing
	@test -f .env || cp .env.dist .env

install: env ## Install PHP and Node dependencies and the git hooks
	composer install
	npm ci
	npx --no -- husky

## Docker

up: env ## Start the Docker stack
	$(COMPOSE) up -d --build

down: ## Stop the Docker stack
	$(COMPOSE) down

logs: ## Follow the container logs
	$(COMPOSE) logs -f

build: up ## Install dependencies and build assets inside Docker
	$(COMPOSE) exec -T console composer install --prefer-dist -o
	$(COMPOSE) exec -T console $(PHP) console/yii app/setup --interactive=0
	$(COMPOSE) run -T --rm node npm ci
	$(COMPOSE) run -T --rm node npm run build

## Tests

test: ## Run the Codeception suite in Docker
	$(COMPOSE) exec -T db mysql -uroot -proot -e 'CREATE DATABASE IF NOT EXISTS `yii2-starter-kit-test` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
	$(COMPOSE) exec -T console ./vendor/bin/codecept build
	$(COMPOSE) exec -T console $(PHP) tests/bin/yii app/setup --interactive=0
	$(COMPOSE) exec -T console vendor/bin/codecept run

test-local: ## Run the Codeception suite against a local MySQL
	vendor/bin/codecept build
	$(PHP) tests/bin/yii app/setup --interactive=0
	vendor/bin/codecept run

## Quality

lint: ## Run the checks CI runs: composer, npm and commit messages
	composer validate --strict
	composer audit --locked --abandoned=report
	npm audit --audit-level=high
	npx --no -- commitlint --from "$(CURRENT_VERSION)" --to HEAD

verify: lint test ## Everything a pull request has to pass

## Release

changelog: ## Preview the unreleased changelog section
	npx --no -- git-cliff --unreleased --strip header

release: ## Write the changelog section and commit it (VERSION defaults to the next semantic version)
	@target="$(VERSION)"; \
	if [ -z "$$target" ]; then \
		target=$$(npx --no -- git-cliff --bumped-version 2>/dev/null | tail -n1); \
	fi; \
	if [ -z "$$target" ]; then \
		echo "Could not determine a version. Pass VERSION=x.y.z."; exit 1; \
	fi; \
	if [ "$$target" = "$(CURRENT_VERSION)" ]; then \
		echo "Nothing to release: no feat or fix commits since $(CURRENT_VERSION)."; exit 1; \
	fi; \
	echo "Writing $$target to CHANGELOG.md"; \
	npx --no -- git-cliff --unreleased --tag "$$target" --prepend CHANGELOG.md || exit 1; \
	git add CHANGELOG.md; \
	git commit -S -m "chore(release): $$target"; \
	echo "Next: open the release pull request, merge it, then run 'make tag' from main."

tag: ## Tag the release commit and push it, which publishes the release
	@target="$(VERSION)"; \
	target=$${target:-$$(grep -m1 -oE '^## \[[0-9]+\.[0-9]+\.[0-9]+\]' CHANGELOG.md | tr -d '#[] ')}; \
	test -n "$$target" || { echo "Pass VERSION=x.y.z."; exit 1; }; \
	documented=$$(grep -m1 -oE '^## \[[0-9]+\.[0-9]+\.[0-9]+\]' CHANGELOG.md | tr -d '#[] '); \
	test "$$target" = "$$documented" || { echo "CHANGELOG.md documents $$documented, not $$target. Merge the release pull request first."; exit 1; }; \
	test "$$(git rev-parse --abbrev-ref HEAD)" = "main" || { echo "Tags are created on main."; exit 1; }; \
	test -z "$$(git tag --list "$$target")" || { echo "Tag $$target already exists."; exit 1; }; \
	git fetch --quiet origin main; \
	test "$$(git rev-parse HEAD)" = "$$(git rev-parse origin/main)" || { echo "HEAD is not origin/main. Pull or push first."; exit 1; }; \
	git tag -s "$$target" -m "$$target: release" && git push origin "$$target"
