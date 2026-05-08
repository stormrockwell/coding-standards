const { propertyOrdering } = require('stylelint-semantic-groups');

const contentProperty = {
	emptyLineBefore: 'never',
	noEmptyLineBetween: true,
	groupName: 'content',
	properties: ['content'],
};

const customPropertyOrdering = propertyOrdering.map((groups) => {
	return groups.map((group) => {
		if (group.properties.includes('content')) {
			group.properties.splice(group.properties.indexOf('content'), 1);
		}
		return {
			...group,
			emptyLineBefore: 'never',
		};
	});
});

customPropertyOrdering[0] = [contentProperty, ...customPropertyOrdering[0]];

module.exports = {
	extends: '@wordpress/stylelint-config/scss',
	plugins: ['stylelint-order'],
	rules: {
		'at-rule-empty-line-before': [
			'always',
			{
				except: ['first-nested', 'blockless-after-same-name-blockless'],
				ignore: ['after-comment'],
				ignoreAtRules: ['else'],
			},
		],
		'rule-empty-line-before': [
			'always',
			{
				except: ['first-nested', 'after-single-line-comment'],
			},
		],
		'no-invalid-position-at-import-rule': null,
		'selector-max-empty-lines': 0,
		'no-descending-specificity': null,
		'selector-class-pattern': null,
		'function-url-quotes': 'always',
		'scss/selector-no-redundant-nesting-selector': null,
		'no-duplicate-selectors': null,
		'max-line-length': 135,
		'order/order': [
			'custom-properties',
			'dollar-variables',
			{
				type: 'at-rule',
				name: 'include',
				hasBlock: false,
			},
			'declarations',
			{
				type: 'at-rule',
				name: 'include',
				parameter: 'media-breakpoint-down',
			},
			{
				type: 'at-rule',
				name: 'include',
				parameter: 'media-breakpoint-up',
			},
		],
		'order/properties-order': customPropertyOrdering,
	},
};
