/**
 * Conventional Commits — https://www.conventionalcommits.org
 *
 * Enforced by the commit-msg git hook (husky) and the `commits` CI workflow.
 * The changelog is generated from these messages by git-cliff (cliff.toml),
 * so the type also decides which section an entry lands in.
 */
module.exports = {
  extends: ['@commitlint/config-conventional'],
  rules: {
    'type-enum': [
      2,
      'always',
      ['feat', 'fix', 'perf', 'refactor', 'docs', 'chore', 'ci', 'build', 'test', 'style', 'revert'],
    ],
    // Keep the first line readable in `git log --oneline` and in the changelog.
    'header-max-length': [2, 'always', 100],
    // Scopes double as a quick filter, so they stay uniform: (docker), (deps),
    // (docker/nginx).
    'scope-case': [2, 'always', 'lower-case'],
    // Sentences in this repository start with a lowercase identifier often
    // enough (`LINK_ASSETS`, `DB_CHARSET`, `docker compose`) that the default
    // casing rules are noise.
    'subject-case': [0],
    'body-max-line-length': [0],
  },
};
