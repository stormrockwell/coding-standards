const js = require('@eslint/js');
const globals = require('globals');
const typescript = require('@typescript-eslint/eslint-plugin');

module.exports = [
	{
		ignores: [
			'dist/**/*.js',
			'tasks/**/*.js',
			'vendor/**/*.js',
		],
	},
	{
		// ESLint 9 only lints .js, .cjs and .mjs unless a config names other extensions.
		files: ['**/*.{js,jsx,mjs,cjs,ts,tsx,mts,cts}'],
	},
	js.configs.recommended,
	...typescript.configs['flat/recommended'],
	{
		// A CommonJS file has no other way to import, and tool configs such as .prettierrc.cjs are written that way.
		files: ['**/*.cjs'],
		rules: {
			'@typescript-eslint/no-require-imports': 'off',
		},
	},
	{
		languageOptions: {
			globals: {
				...globals.browser,
				...globals.node,
				...globals.es2021,
				...globals.jest,
			},
		},
		rules: {
			'max-len': 'off',
			'camelcase': 'error',
		},
	},
];
