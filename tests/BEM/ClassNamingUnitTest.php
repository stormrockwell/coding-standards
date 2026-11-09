<?php
/**
 * Unit test class for ClassNamingSniff.
 *
 * @package DemandDrive\Tests
 */

namespace DemandDrive\Tests\BEM;

use DemandDrive\Tests\AbstractSniffTest;

/**
 * Unit test class for the ClassNamingSniff sniff.
 */
class ClassNamingUnitTest extends AbstractSniffTest
{
	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int>
	 */
	protected function getErrorList()
	{
		return array();
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array<int, int>
	 */
	protected function getWarningList()
	{
		return array(
			22 => 1,
			24 => 1,
			26 => 3,
			28 => 1,
			30 => 1,
			39 => 1,
		);
	}
}
