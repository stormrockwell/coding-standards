<?php
/**
 * Unit test class for ConditionalAlternateSyntaxSniff.
 *
 * @package DemandDrive\Tests
 */

namespace DemandDrive\Tests\Conditionals;

use DemandDrive\Tests\AbstractSniffTest;

/**
 * Unit test class for the ConditionalAlternateSyntaxSniff sniff.
 */
class ConditionalAlternateSyntaxUnitTest extends AbstractSniffTest
{
	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int>
	 */
	protected function getErrorList()
	{
		return array(
			3  => 1,
			7  => 1,
			11 => 1,
			15 => 1,
			17 => 1,
			23 => 1,
			66 => 1,
		);
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array<int, int>
	 */
	protected function getWarningList()
	{
		return array();
	}
}
