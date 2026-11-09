const wordpress = require('@wordpress/eslint-plugin');
const base = require('./base');

module.exports = [
	...base,
	...wordpress.configs.recommended,
	{
		settings: {
			'import/resolver': {
				typescript: {
					alwaysTryTypes: true,
				},
			},
		},
		rules: {
			'max-len': 'off',
			'camelcase': ['error', { allow: ['WP_*'] }],
			'react-hooks/exhaustive-deps': 'off',
		},
	},
];
