<?php
/*
 * This file is part of the PayBreak/basket package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Luhn Test
 *
 * @author WN
 */
class LuhnTest extends PHPUnit_Framework_TestCase
{
    public function testGenerateNumber()
    {
        $this->assertInternalType('int', \PayBreak\Luhn\Luhn::generateNumber(12345));
        $this->assertGreaterThan(123, \PayBreak\Luhn\Luhn::generateNumber(123));
    }

    public function testValidateNumber()
    {
        $this->assertTrue(\PayBreak\Luhn\Luhn::validateNumber(123455));
        $this->assertTrue(\PayBreak\Luhn\Luhn::validateNumber(16416612));
        $this->assertFalse(\PayBreak\Luhn\Luhn::validateNumber(16416610));
    }
}
