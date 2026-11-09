<?php
/**
 * Base class for the DemandDrive sniff tests.
 *
 * @package DemandDrive\Tests
 */

namespace DemandDrive\Tests;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Points the PHPCS sniff test framework at this repository.
 *
 * PHPCS expects its own suite runner to register the standard and test directories per class. Setting the paths here
 * lets PHPUnit discover the tests directly, so `phpunit` is the only command needed.
 */
abstract class AbstractSniffTest extends AbstractSniffUnitTest
{
	/**
	 * Sets the standard and fixture directories for the test class.
	 *
	 * @before
	 *
	 * @return void
	 */
	protected function setUpPrerequisites()
	{
		$this->standardsDir = dirname( __DIR__ ) . '/src/Standards/DemandDrive';
		$this->testsDir     = __DIR__ . DIRECTORY_SEPARATOR;
	}

	/**
	 * Counts the fixture comparison as an assertion.
	 *
	 * The PHPCS framework reports mismatches by calling fail() and makes no assertion when a fixture matches, so a
	 * passing run would be flagged as risky.
	 *
	 * @after
	 *
	 * @return void
	 */
	protected function countFixtureComparison()
	{
		$this->addToAssertionCount( 1 );
	}
}
