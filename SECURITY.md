# Security Policy

## Supported versions

| Version | Supported |
|---|---|
| 5.0.x | :white_check_mark: |
| < 5.0 | :x: |

Only the latest 5.x release receives security fixes. Older branches are
expected to be migrated; see [`docs/upgrade-5.0.md`](docs/upgrade-5.0.md).

## Reporting a vulnerability

Please **do not** open a public issue for a security problem.

Use GitHub's private reporting form instead:

<https://github.com/yii2-starter-kit/yii2-starter-kit/security/advisories/new>

That opens a private advisory visible only to the maintainers, where a fix can
be prepared and a CVE requested before anything becomes public.

Please include:

- the affected version and how it was installed (Docker, Composer, archive),
- the PHP version,
- steps to reproduce, or a proof of concept,
- the impact you believe it has.

Expect an acknowledgement within a few days. Once a fix is ready it is released
as a patch version, and you are credited in the advisory unless you prefer
otherwise.

## Scope

This project is an application template. Vulnerabilities in the code of this
repository are in scope. Security issues in the framework and its libraries
should be reported upstream, though a note here is welcome if this template
needs to change its defaults or pin a fixed version.

## Code of conduct

Reports about how people behave in the project, rather than about the code, follow the
[code of conduct](CODE_OF_CONDUCT.md).

## Dependency updates

Dependency advisories are monitored through Dependabot
(`.github/dependabot.yml`), and CI fails on `composer audit` and
`npm audit --audit-level=high`.
