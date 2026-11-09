/**
 * Adds a confirmation message to the plugin settings form.
 */
const { __ } = window.wp.i18n;

/**
 * Builds the text shown after the settings are saved.
 *
 * @param {string} name Plugin name.
 * @return {string} The confirmation message.
 */
export function getSavedMessage(name) {
	return __('Settings saved for', 'fixture-plugin') + ' ' + name;
}
