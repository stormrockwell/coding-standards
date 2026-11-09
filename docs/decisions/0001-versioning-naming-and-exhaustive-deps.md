# 0001: Versioning, package names and react-hooks/exhaustive-deps

Status: proposed, for the maintainers to decide. Nothing in this document is applied. No package is renamed and no tag is moved.

## Context

The repository ships two packages from one Git history. Composer reads `composer.json` and installs `digitalimpulse/php-coding-standards`, and npm reads `package.json` and installs `@digitalimpulse/coding-standards`. Both are installed straight from Git tags, with no registry.

The tags today are `v0.1`, `v0.1.1` and `v1.0.0`. The README pins Composer to `v0.1.1` and npm to `v1.0.0`, so one tag namespace carries two version streams. Composer treats every tag that parses as a version as a release, so it also sees `v1.0.0` as a PHP release, even though that tag only added the JavaScript and CSS configs. A reader cannot tell from a tag which tool changed.

The names disagree. The repository is `demanddrive/coding-standards`, while the package names, the `repository` URLs, the README install URLs and the README title still say `digitalimpulse`.

## Decision 1: one version scheme

Recommendation: use one SemVer stream for the whole repository, with unprefixed `vX.Y.Z` tags, and continue upward from `v1.0.0`.

- Composer cannot use prefixed tags. A tag such as `php-v0.1.1` does not parse as a version, so Composer ignores it and the PHP package loses its releases. Prefixed tags would work only if the PHP and JavaScript packages moved to separate repositories.
- `v1.0.0` already exists and is the highest tag, so a single stream needs no retag and no deleted tag. Consumers pinned to `v0.1.1` or `v1.0.0` keep working.
- `composer.json` must not gain a `version` field, because Composer takes the version from the tag. `package.json` keeps its `version`, and a CI check on tag pushes should fail when that field differs from the tag.
- A release that changes either package bumps the one version. A consumer of only one tool sees releases that do not touch its tool, which costs a changelog line and nothing else.
- The next release should be `v2.0.0`. Moving ESLint to flat config requires ESLint 9 and a new config file, which breaks consumers, and a rename (Decision 2) belongs in the same major release so consumers migrate once.

Rejected: keeping two streams on shared tags (the current ambiguity), and prefixed tags (breaks Composer).

## Decision 2: package names

Recommendation: rename both packages to the `demanddrive` namespace, in the same `v2.0.0` release.

| Item | Now | After |
| --- | --- | --- |
| Composer package | `digitalimpulse/php-coding-standards` | `demanddrive/php-coding-standards` |
| npm package | `@digitalimpulse/coding-standards` | `@demanddrive/coding-standards` |
| Repository URLs in `composer.json`, `package.json` and the README | `digitalimpulse/coding-standards` | `demanddrive/coding-standards` |
| README title | DigitalImpulse Coding Standards | DemandDrive Coding Standards |

- The PHPCS standard names `DemandDrive` and `DemandDriveBase` already use the target name, so rulesets and sniff codes do not change.
- Each consumer must change one dependency key and every config string that contains `@digitalimpulse/coding-standards`. Count the consumers before the release, because that count is the cost of this decision.
- Because the packages install from Git and not from a registry, the `@demanddrive` scope needs no registry setup.
- If a consumer cannot migrate yet, it stays on its current tag. Tags are immutable, so nothing breaks until it chooses to move.

Rejected: renaming the repository back to `digitalimpulse`, because the organization that owns the repository is `demanddrive`, and leaving the names as they are, because every new project would copy the mismatch.

## Decision 3: react-hooks/exhaustive-deps

Current state: the rule is `off` in the ESLint config (`eslint/index.js` on `main`, `eslint/wordpress.js` once the layers merge). It was not flipped as part of this work.

Recommendation: remove the override so the rule returns to the `@wordpress/eslint-plugin` default, which is `warn` with `useSelect` and `useSuspenseSelect` registered as hook-like functions.

- The rule finds stale closures, where an effect, callback or memo reads a value that is missing from its dependency array. These bugs show wrong data without throwing, so tests and review miss them.
- `off` also removes the `useSelect` coverage that WordPress supplies, so block editor code loses a check that the WordPress project itself runs.
- `warn` does not fail a build, so adopting it does not block any consumer. Teams can then fix warnings in the files they touch and decide on `error` later.
- The repository holds no record of why the rule was disabled. A likely reason is warning volume on existing code. If that is the reason, the evidence to collect before deciding is the number of warnings in each consumer, taken by running the lint with the override removed. A small count favors `warn` now, and a large count favors keeping `off` until the existing warnings are fixed.
- Whatever is chosen, add a one-line comment above the rule that states the reason, so the next reader does not have to ask.

Rejected: `error` as a first step, because it would fail every consumer that has existing violations at the moment of upgrade.
