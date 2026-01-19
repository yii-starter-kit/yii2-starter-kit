# Makefile for Yii2 Starter Kit
# Equivalent to taskctl.yaml configuration

# Shell configuration
SHELL := /bin/bash
.SHELLFLAGS := -eu -o pipefail -c

# Colors for output
RED := \033[0;31m
GREEN := \033[0;32m
YELLOW := \033[1;33m
BLUE := \033[0;34m
NC := \033[0m # No Color

# Project configuration
PROJECT_NAME := yii2-starter-kit
COMPOSE_FILE := docker-compose.yml

# Validation
REQUIRED_BINS := docker composer npm
$(foreach bin,$(REQUIRED_BINS),\
    $(if $(shell command -v $(bin) 2> /dev/null),,$(error Please install `$(bin)`)))

.PHONY: help install install-php install-node build-env heroku-compile local-build docker-build docker-tests-run docker-tests-server docker-start docker-stop docker-restart docker-cleanup docker-logs docker-status docker-wait-for-services banner start docker-tests rebuild check-env

# Default target
.DEFAULT_GOAL := help

help: ## Show this help message
	@echo -e "$(BLUE)Yii2 Starter Kit - Available Commands$(NC)"
	@echo ""
	@echo -e "$(YELLOW)Setup & Installation:$(NC)"
	@awk 'BEGIN {FS = ":.*##"; printf ""} /^[a-zA-Z_-]+:.*?##/ { if ($$1 ~ /^(install|build-env|check-env)/) printf "  $(GREEN)%-20s$(NC) %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""
	@echo -e "$(YELLOW)Development:$(NC)"
	@awk 'BEGIN {FS = ":.*##"; printf ""} /^[a-zA-Z_-]+:.*?##/ { if ($$1 ~ /^(start|local-build)/) printf "  $(GREEN)%-20s$(NC) %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""
	@echo -e "$(YELLOW)Docker Operations:$(NC)"
	@awk 'BEGIN {FS = ":.*##"; printf ""} /^[a-zA-Z_-]+:.*?##/ { if ($$1 ~ /^docker-/) printf "  $(GREEN)%-20s$(NC) %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""
	@echo -e "$(YELLOW)Deployment:$(NC)"
	@awk 'BEGIN {FS = ":.*##"; printf ""} /^[a-zA-Z_-]+:.*?##/ { if ($$1 ~ /^(heroku-compile|rebuild)/) printf "  $(GREEN)%-20s$(NC) %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""
	@echo -e "$(BLUE)Usage examples:$(NC)"
	@echo -e "  make start          # Complete setup and start"
	@echo -e "  make docker-logs    # View container logs"
	@echo -e "  make docker-tests   # Run test suite"

# Setup & Installation
check-env: ## Check if required environment files exist
	@echo -e "$(BLUE)Checking environment...$(NC)"
	@test -f .env.dist || (echo -e "$(RED)Error: .env.dist not found$(NC)" && exit 1)
	@test -f composer.json || (echo -e "$(RED)Error: composer.json not found$(NC)" && exit 1)
	@test -f package.json || (echo -e "$(RED)Error: package.json not found$(NC)" && exit 1)
	@test -f $(COMPOSE_FILE) || (echo -e "$(RED)Error: $(COMPOSE_FILE) not found$(NC)" && exit 1)
	@echo -e "$(GREEN)Environment check passed!$(NC)"

install-php: check-env ## Install PHP dependencies via composer
	@echo -e "$(BLUE)Installing PHP dependencies...$(NC)"
	composer install --no-interaction
	@echo -e "$(GREEN)PHP dependencies installed!$(NC)"

install-node: install-php ## Install Node.js dependencies via npm
	@echo -e "$(BLUE)Installing Node.js dependencies...$(NC)"
	npm install
	@echo -e "$(GREEN)Node.js dependencies installed!$(NC)"

build-env: check-env ## Copy .env.dist to .env
	@if [ ! -f .env ]; then \
		echo -e "$(BLUE)Creating .env file...$(NC)"; \
		cp .env.dist .env; \
		echo -e "$(GREEN).env file created!$(NC)"; \
	else \
		echo -e "$(YELLOW).env file already exists, skipping...$(NC)"; \
	fi

install: install-php install-node ## Install all dependencies (PHP + Node.js)

# Development
local-build: install ## Build locally (non-Docker)
	@echo -e "$(BLUE)Building project locally...$(NC)"
	php console/yii app/setup
	npm run build
	@echo -e "$(GREEN)Local build completed!$(NC)"

# Deployment
heroku-compile: ## Prepare for Heroku deployment
	@echo -e "$(BLUE)Preparing for Heroku deployment...$(NC)"
	cp deploy/heroku/.env .env
	YII_ENV=heroku php console/yii migrate/fresh
	YII_ENV=heroku php console/yii app/setup --interactive=0
	@echo -e "$(GREEN)Heroku deployment prepared!$(NC)"

# Docker Operations
docker-build: build-env ## Build Docker containers with comprehensive setup
	@echo -e "$(BLUE)🚀 Starting comprehensive Docker build workflow...$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 1/8: Building and starting containers...$(NC)"
	docker compose build
	docker compose up --build -d
	@echo -e "$(GREEN)✓ Containers built and started$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 2/8: Waiting for services to be ready...$(NC)"
	@$(MAKE) docker-wait-for-services
	@echo ""

	@echo -e "$(YELLOW)Step 3/8: Installing PHP dependencies...$(NC)"
	docker compose exec -T console git config --global --add safe.directory /app
	mkdir -p vendor
	docker compose exec -T console composer install --prefer-dist -o
	@echo -e "$(GREEN)✓ PHP dependencies installed$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 4/8: Installing Node.js dependencies...$(NC)"
	mkdir -p node_modules
	docker compose run -T --rm --user $(UID):$(GID) node npm install
	@echo -e "$(GREEN)✓ Node.js dependencies installed$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 5/8: Building frontend assets...$(NC)"
	docker compose run -T --rm node npm run build
	@echo -e "$(GREEN)✓ Frontend assets built$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 6/8: Setting up application...$(NC)"
	docker compose exec -T console php console/yii app/setup --interactive=0
	@echo -e "$(GREEN)✓ Application setup completed$(NC)"
	@echo ""

	@echo -e "$(YELLOW)Step 7/8: Verifying services status...$(NC)"
	@$(MAKE) docker-status
	@echo ""

	@echo -e "$(YELLOW)Step 8/8: Announcing available domains...$(NC)"
	@echo -e "$(GREEN)🌐 Application is ready! Available domains:$(NC)"
	@echo -e "  $(BLUE)Frontend:$(NC)     http://yii2-starter-kit.localhost"
	@echo -e "  $(BLUE)Backend:$(NC)      http://backend.yii2-starter-kit.localhost"
	@echo -e "  $(BLUE)API:$(NC)          http://api.yii2-starter-kit.localhost"
	@echo -e "  $(BLUE)Storage:$(NC)      http://storage.yii2-starter-kit.localhost"
	@echo -e "  $(BLUE)Mail Catcher:$(NC) http://localhost:1080"
	@echo ""
	@echo -e "$(GREEN)🎉 Docker build workflow completed successfully!$(NC)"

docker-start: ## Start Docker containers
	@echo -e "$(BLUE)Starting Docker containers...$(NC)"
	docker compose up -d
	@echo -e "$(GREEN)Docker containers started!$(NC)"
	@echo -e "$(YELLOW)Note: Services may take a moment to be fully ready$(NC)"

docker-stop: ## Stop Docker containers
	@echo -e "$(BLUE)Stopping Docker containers...$(NC)"
	docker compose stop
	@echo -e "$(GREEN)Docker containers stopped!$(NC)"

docker-restart: docker-stop docker-start ## Restart Docker containers

docker-status: ## Show Docker containers status
	@echo -e "$(BLUE)Docker containers status:$(NC)"
	docker compose ps

docker-logs: ## Show Docker containers logs
	@echo -e "$(BLUE)Docker containers logs:$(NC)"
	docker compose logs -f

docker-cleanup: ## Clean up Docker containers and volumes
	@echo -e "$(BLUE)Cleaning up Docker containers...$(NC)"
	docker compose down -v --remove-orphans
	docker compose rm -fsv
	@echo -e "$(GREEN)Docker cleanup completed!$(NC)"

# Testing
docker-wait-for-services: ## Wait for Docker services to be ready
	@echo -e "$(BLUE)Waiting for services to be ready...$(NC)"
	@echo -e "$(YELLOW)Checking if containers are running...$(NC)"
	@if ! docker compose ps --filter "status=running" | grep -q "mariadb"; then \
		echo -e "$(RED)Database container is not running. Starting it...$(NC)"; \
		docker compose up mariadb -d; \
		sleep 5; \
	fi
	@echo -e "$(YELLOW)Waiting for database to accept connections...$(NC)"
	@timeout=60; \
	while [ $$timeout -gt 0 ]; do \
		if docker compose exec -T mariadb mariadb-admin ping -uroot -proot --silent 2>/dev/null; then \
			echo -e "$(GREEN)Database is ready!$(NC)"; \
			break; \
		fi; \
		if ! docker compose ps --filter "status=running" | grep -q "mariadb"; then \
			echo -e "$(RED)Database container stopped unexpectedly. Checking logs...$(NC)"; \
			docker compose logs --tail=10 mariadb; \
			exit 1; \
		fi; \
		echo -e "$(YELLOW)Database not ready, waiting... ($$timeout seconds left)$(NC)"; \
		sleep 2; \
		timeout=$$((timeout-2)); \
	done; \
	if [ $$timeout -le 0 ]; then \
		echo -e "$(RED)Timeout waiting for database to be ready$(NC)"; \
		echo -e "$(YELLOW)Database container logs:$(NC)"; \
		docker compose logs --tail=20 mariadb; \
		exit 1; \
	fi

docker-tests-server: docker-start docker-wait-for-services ## Start test server
	@echo -e "$(BLUE)Starting test server...$(NC)"
	docker compose exec -T console php -S localhost:8080 -t /app

docker-tests-run: docker-start docker-wait-for-services ## Run test suite
	@echo -e "$(BLUE)Running tests...$(NC)"
	@echo -e "$(BLUE)Creating test database...$(NC)"
	docker compose exec -T mariadb mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`yii2-starter-kit-test\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null || true
	@echo -e "$(BLUE)Building test suite...$(NC)"
	docker compose exec -T console ./vendor/bin/codecept build
	@echo -e "$(BLUE)Setting up test environment...$(NC)"
	docker compose exec -T console php tests/bin/yii app/setup --interactive=0
	@echo -e "$(BLUE)Running tests...$(NC)"
	docker compose exec -T console vendor/bin/codecept run
	@echo -e "$(GREEN)Tests completed!$(NC)"

docker-tests: docker-start docker-wait-for-services docker-tests-run ## Run complete Docker test pipeline

# Utility
banner: ## Show startup banner
	@echo -e "$(GREEN)🚀 Started! Visit http://yii2-starter-kit.localhost$(NC)"

rebuild: docker-cleanup install docker-build docker-start banner ## Complete rebuild (cleanup + install + build + start)

# Pipeline targets
start: install build-env docker-build docker-start banner ## Complete startup pipeline (install + build + start)
