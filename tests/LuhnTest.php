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
        $this->assertInternalType('int', \PayBreak\Luhn\Luhn::generateNumber(12345.00));
        $this->assertGreaterThan(123, \PayBreak\Luhn\Luhn::generateNumber(123));

        $this->assertInternalType('int', \PayBreak\Luhn\Luhn::generateNumber(12345E+12));
        $this->assertSame(12302, \PayBreak\Luhn\Luhn::generateNumber(1.23E+3));
    }

    public function testGenerateNumberFailParam()
    {
        $this->setExpectedException(PayBreak\Luhn\Exception::class, 'Given value is out of bounds');
        \PayBreak\Luhn\Luhn::generateNumber(PHP_INT_MAX * 2);
    }

    public function testGenerateNumberFailNegative()
    {
        $this->setExpectedException(PayBreak\Luhn\Exception::class, 'Given value is out of bounds');
        \PayBreak\Luhn\Luhn::generateNumber(-2);
    }

    public function testGenerateNumberFailResult()
    {
        $this->setExpectedException(PayBreak\Luhn\Exception::class, 'Result is out of bounds for integer type');
        \PayBreak\Luhn\Luhn::generateNumber(PHP_INT_MAX - 4);
    }

    public function testValidateNumber()
    {
        $this->assertTrue(\PayBreak\Luhn\Luhn::validateNumber(123455));
        $this->assertTrue(\PayBreak\Luhn\Luhn::validateNumber(16416612));
        $this->assertFalse(\PayBreak\Luhn\Luhn::validateNumber(16416610));
    }

    public function testGenerateString()
    {
        $this->assertInternalType('string', \PayBreak\Luhn\Luhn::generateString('35145120840121'));
        $this->assertSame('351451208401216', \PayBreak\Luhn\Luhn::generateString('35145120840121'));
        $this->assertSame(
            '35145120843454656553423455674565301212',
            \PayBreak\Luhn\Luhn::generateString('3514512084345465655342345567456530121')
        );
    }

    public function testGenerateStringFailResult()
    {
        $this->setExpectedException(PayBreak\Luhn\Exception::class, 'Given value is not integer representation');
        \PayBreak\Luhn\Luhn::generateString('234.67');
    }
}
