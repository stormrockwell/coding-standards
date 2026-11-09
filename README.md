# DigitalImpulse Coding Standards

Shared coding standards for DemandDrive projects: PHP (PHPCS), TypeScript/JavaScript (ESLint), CSS/SCSS (Stylelint), Prettier, TypeScript compiler, and EditorConfig.

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

### Creating new sniffs

1. Create a sniff class in `src/Standards/DemandDrive/Sniffs/Category/SniffNameSniff.php`
2. Implement the `Sniff` interface
3. Add the rule to `src/Standards/DemandDrive/ruleset.xml`
4. Add a fixture `tests/Category/SniffNameUnitTest.inc` and a test class `tests/Category/SniffNameUnitTest.php` that extends `DemandDrive\Tests\AbstractSniffTest`
5. If the sniff has a fixer, add the expected result as `tests/Category/SniffNameUnitTest.inc.fixed`

The test class lists the lines where the fixture must produce errors and warnings in `getErrorList()` and `getWarningList()`. A line that is not listed must be clean, so each fixture holds both flagged and unflagged code.

### Running the sniff tests

```bash
composer install
composer test
```

The tests use the sniff test framework that ships with PHP_CodeSniffer, which runs each sniff against its `.inc` fixture and fails when the reported lines differ from the expected lists.

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

Peer dependencies (`eslint`, `stylelint`, `prettier`, `typescript`, plugins) must be installed by the consuming project — see `peerDependencies` in `package.json` for the full list.

### ESLint

`.eslintrc`:

```json
{
  "root": true,
  "extends": ["./node_modules/@digitalimpulse/coding-standards/eslint"],
  "settings": {
    "import/resolver": {
      "typescript": {
        "project": "./tsconfig.json"
      }
    }
  }
}
```

### Stylelint

`.stylelintrc.cjs`:

```js
module.exports = {
  extends: '@digitalimpulse/coding-standards/stylelint',
  // Project-specific additions, e.g. custom-property validation:
  plugins: ['stylelint-value-no-unknown-custom-properties'],
  rules: {
    'csstools/value-no-unknown-custom-properties': [true, {
      importFrom: ['css-variables.json']
    }]
  }
};
```

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

### EditorConfig

Copy `editorconfig/.editorconfig` into the consuming project root — EditorConfig doesn't support extending from packages.
