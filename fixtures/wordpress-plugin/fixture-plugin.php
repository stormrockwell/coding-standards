<?php
/**
 * Plugin Name: Fixture Plugin
 * Description: Minimal plugin that the WordPress layer must lint clean.
 * Version: 0.0.0
 *
 * @package FixturePlugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Prints a greeting in the admin footer.
 *
 * @return void
 */
function fixture_plugin_admin_footer() {
	$name = get_option( 'fixture_plugin_name', 'World' );

	echo '<p class="fixture-plugin__title">' . esc_html( $name ) . '</p>';
}
add_action( 'admin_footer', 'fixture_plugin_admin_footer' );
