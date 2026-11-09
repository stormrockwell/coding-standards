<?php
/**
 * Unit test class for ConditionalIndentationSniff.
 *
 * @package DemandDrive\Tests
 */

namespace DemandDrive\Tests\Conditionals;

use DemandDrive\Tests\AbstractSniffTest;

/**
 * Unit test class for the ConditionalIndentationSniff sniff.
 */
class ConditionalIndentationUnitTest extends AbstractSniffTest
{
	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int>
	 */
	protected function getErrorList()
	{
		return array(
			57 => 1,
			58 => 1,
			65 => 1,
			66 => 1,
			74 => 1,
			80 => 1,
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
