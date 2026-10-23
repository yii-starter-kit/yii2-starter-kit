# Contributing

Thanks for taking the time to improve the starter kit. Bug reports, documentation fixes and pull
requests are all useful, and nothing here is gated beyond the checks listed below.

## Ways to contribute

- Report a bug or request a feature using the issue templates on GitHub.
- Correct or extend the documentation. Most pages describe the code, so a fix is usually a small
  edit.
- Fix a bug or add a feature. Open an issue first for anything larger than a small change, so the
  approach is agreed before you write code.
- Translate. Messages live in `common/messages`, and the backend has a translation manager.

## Before you start

You need PHP 8.4, Node.js 24, Composer and, for the full stack, Docker with Compose v2. The
requirements table in [README.md](README.md#requirements) has the details.

## Local setup

```bash
git clone https://github.com/yii-starter-kit/yii2-starter-kit.git
cd yii2-starter-kit
make install     # .env, composer install, npm ci and the git hooks
make build       # start the Docker stack, migrate, build assets
```

`make help` lists every target. If you use [taskctl](https://github.com/taskctl/taskctl) instead,
the pipelines in `taskctl.yaml` do the same work.

## Checks a pull request must pass

| Command | What it runs |
| --- | --- |
| `make lint` | `composer validate --strict`, `composer audit`, `npm audit` and `commitlint` over the commits since the last release |
| `make test` | Codeception against MySQL, inside Docker. Start the acceptance server first, see [testing](docs/testing.md) |
| `make verify` | `lint` and `test` together |

Run `make verify` before you push. CI runs the same commands, so a green run locally means a green
pull request in practice.

No PHP formatter or static analyser is configured in this repository. Match the surrounding code
and follow PSR-12 and the Yii 2 conventions. `.editorconfig` defines the whitespace rules, and most
editors apply it automatically.

## Your first pull request

1. Branch from `main`:

    ```bash
    git switch main && git pull
    git switch -c fix/cart-quantity
    ```

2. Commit in [Conventional Commits](https://www.conventionalcommits.org) format. `commitlint` runs
   in the `commit-msg` hook and in CI, so a malformed message fails before it reaches the remote.

3. Sign your commits. `main` requires verified signatures; `git commit -S` signs explicitly.

4. Open the pull request and fill in the template. Keep the branch focused, because the changelog is
   generated from the commit subjects.

Branch prefixes: `feat/`, `fix/`, `chore/`, `docs/` and `ci/`. The allowed commit types, scopes and
changelog sections are in [development-workflow.md](docs/development-workflow.md). That page also
documents the release flow, which only maintainers run.

## Reporting bugs and requesting features

Use the templates in `.github/ISSUE_TEMPLATE`. Include the PHP, MySQL and Node versions, the steps
to reproduce and the result you expected. A failing test is the most useful bug report you can
write.

## Security reports

Do not open a public issue for a vulnerability. Follow [SECURITY.md](SECURITY.md) and use GitHub's
private advisory form.

## Writing documentation

- One `H1` per file, sentence case headings.
- No em dashes: use a comma, a colon, parentheses or a new sentence.
- Fenced code blocks always carry a language.
- Relative links inside the repository, absolute `https://` links outside it.
- Describe what the code does today. When a page and the code disagree, the page changes.
- No emojis, with one exception: the Ukrainian flag in the README's "Stand with Ukraine" heading.

## Where to read more

- [Installation](docs/installation.md) and [configuration](docs/configuration.md)
- [Components](docs/components.md) and [console commands](docs/console.md)
- [Testing](docs/testing.md) and [FAQ](docs/faq.md)
- [Support](.github/SUPPORT.md) and [security policy](SECURITY.md)
