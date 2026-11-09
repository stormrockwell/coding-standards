# DigitalImpulse Coding Standards

Shared coding standards for DemandDrive projects: PHP (PHPCS), TypeScript/JavaScript (ESLint), CSS/SCSS (Stylelint), Prettier, TypeScript compiler, and EditorConfig.

## Layers

Each linter ships in two layers. The base layer has no WordPress dependency, so a Node site can use it alone. The WordPress layer builds on the base layer and adds the WordPress presets. The existing entry points resolve to the WordPress layer, so current consumers keep their rules.

| Tool | Base layer | WordPress layer | Existing entry point |
| --- | --- | --- | --- |
| PHPCS | `DemandDriveBase` | `DemandDrive` | `DemandDrive` (WordPress layer) |
| ESLint | `@digitalimpulse/coding-standards/eslint/base` | `@digitalimpulse/coding-standards/eslint/wordpress` | `@digitalimpulse/coding-standards/eslint` (WordPress layer) |
| Stylelint | `@digitalimpulse/coding-standards/stylelint/base` | `@digitalimpulse/coding-standards/stylelint/wordpress` | `@digitalimpulse/coding-standards/stylelint` (WordPress layer) |

## PHP (PHPCS)

Install via Composer:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/digitalimpulse/coding-standards"
    }
  ],
  "require": {
    "digitalimpulse/php-coding-standards": "v0.1.1"
  }
}
```

Then create a `phpcs.xml` or `phpcs.xml.dist` in your project root:

```xml
<?xml version="1.0"?>
<ruleset name="My Project Standards">
	<rule ref="DemandDrive"/>

	<file>.</file>
	<exclude-pattern>*/vendor/*</exclude-pattern>
	<exclude-pattern>*/node_modules/*</exclude-pattern>

	<rule ref="WordPress.WP.I18n">
		<properties>
			<property name="text_domain" type="array">
				<element value="my-textdomain"/>
			</property>
		</properties>
	</rule>
</ruleset>
```

To use the base layer without WordPress, reference `DemandDriveBase` instead:

```xml
<ruleset name="My Project Standards">
	<rule ref="DemandDriveBase"/>
</ruleset>
```

The custom sniffs live in the `DemandDrive` standard for both layers, so their codes, such as `DemandDrive.BEM.ClassNaming`, are the same whichever layer a project uses.

### Creating new sniffs

1. Create a sniff class in `src/Standards/DemandDrive/Sniffs/Category/SniffNameSniff.php`
2. Implement the `Sniff` interface
3. Add the rule to `src/Standards/DemandDrive/ruleset.xml`
4. Add tests in `tests/Category/SniffNameSniffTest.php`

## JS/TS/CSS (npm)

Install from the GitHub repo, pinned to a tag:

```bash
npm i -D git+ssh://git@github.com/digitalimpulse/coding-standards.git#v1.0.0
```

Or in `package.json`:

```json
{
  "devDependencies": {
    "@digitalimpulse/coding-standards": "git+ssh://git@github.com/digitalimpulse/coding-standards.git#v1.0.0"
  }
}
```

Peer dependencies must be installed by the consuming project, see `peerDependencies` in `package.json` for the full list. The WordPress presets (`@wordpress/eslint-plugin`, `@wordpress/stylelint-config`) and `eslint-import-resolver-typescript` are optional peers, so a project on the base layer does not need them.

### ESLint

ESLint 9 or later is required, because the configs use the flat format. Create `eslint.config.mjs` in the project root.

Base layer, for projects without WordPress:

```js
import base from '@digitalimpulse/coding-standards/eslint/base';

export default base;
```

WordPress layer, which is also what `@digitalimpulse/coding-standards/eslint` resolves to:

```js
import wordpress from '@digitalimpulse/coding-standards/eslint/wordpress';

export default [
  ...wordpress,
  {
    settings: {
      'import/resolver': {
        typescript: {
          project: './tsconfig.json',
        },
      },
    },
  },
];
```

Projects still on a `.eslintrc` file must stay on the previous tag until they move to flat config.

### Stylelint

`.stylelintrc.cjs`, base layer:

```js
module.exports = {
  extends: '@digitalimpulse/coding-standards/stylelint/base',
};
```

`.stylelintrc.cjs`, WordPress layer, which is also what `@digitalimpulse/coding-standards/stylelint` resolves to:

```js
module.exports = {
  extends: '@digitalimpulse/coding-standards/stylelint/wordpress',
  // Project-specific additions, e.g. custom-property validation:
  plugins: ['stylelint-value-no-unknown-custom-properties'],
  rules: {
    'csstools/value-no-unknown-custom-properties': [true, {
      importFrom: ['css-variables.json']
    }]
  }
};
```

The Stylelint layers use rule names from Stylelint 14 and 15, so they do not run on Stylelint 16 or later yet.

### Prettier

`.prettierrc.cjs`:

```js
module.exports = require('@digitalimpulse/coding-standards/prettier');
```

### TypeScript

`tsconfig.json`:

```json
{
  "extends": "@digitalimpulse/coding-standards/tsconfig/base.json",
  "compilerOptions": {
    "baseUrl": "./",
    "paths": {
      "@globals/*": ["src/js/globals/*"]
    }
  },
  "include": ["src", "acf-blocks", "components"]
}
```

### Fixture projects

`fixtures/node-site` lints clean from the base layer and `fixtures/wordpress-plugin` lints clean from the WordPress layer. Run them with:

```bash
npm install
npm run lint:fixtures
composer install
composer lint:fixtures
```

### EditorConfig

Copy `editorconfig/.editorconfig` into the consuming project root — EditorConfig doesn't support extending from packages.
