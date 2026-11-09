const path = require('path');
const base = require('./base.cjs');

module.exports = {
	// The WordPress preset comes after the base so it wins over the recommended rules, then the base rules are applied again below.
	extends: [path.join(__dirname, 'base.cjs'), '@wordpress/stylelint-config/scss'],
	plugins: base.plugins,
	rules: base.rules,
};
