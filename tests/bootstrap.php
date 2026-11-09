<?php
/**
 * PHPUnit bootstrap for the DemandDrive sniff tests.
 *
 * @package DemandDrive\Tests
 */

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Tests\ConfigDouble;

$root = dirname( __DIR__ );

// The sniff test framework ships inside PHP_CodeSniffer and sets up its own autoloader and globals.
require_once $root . '/vendor/squizlabs/php_codesniffer/tests/bootstrap.php';
require_once $root . '/vendor/autoload.php';

// The abstract test class reads and writes these globals, and PHPCS only initialises them in its own suite runner.
$GLOBALS['PHP_CODESNIFFER_SNIFF_CODES']      = array();
$GLOBALS['PHP_CODESNIFFER_FIXABLE_CODES']    = array();
$GLOBALS['PHP_CODESNIFFER_SNIFF_CASE_FILES'] = array();

/*
 * The test config ignores CodeSniffer.conf, so the standards that the DemandDrive ruleset builds on are not found
 * unless the installed paths are set here. The paths mirror what the Composer installer plugin writes.
 */
$config        = new ConfigDouble();
$config->cache = false;

Config::setConfigData(
	'installed_paths',
	implode(
		',',
		array(
			$root . '/src/Standards',
			$root . '/vendor/phpcsstandards/phpcsextra',
			$root . '/vendor/phpcsstandards/phpcsutils',
			$root . '/vendor/wp-coding-standards/wpcs',
		)
	),
	true
);

$GLOBALS['PHP_CODESNIFFER_CONFIG'] = $config;
