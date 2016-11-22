<?php
/*
 * This file is part of the PayBreak/basket package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PayBreak\Luhn;

/**
 * Luhn
 *
 * PayBreak implementation of Luhn algorithm
 *
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 * @author WN
 * @package PayBreak\Luhn
 */
class Luhn
{
    /**
     * @author WN
     * @param int $number
     * @return bool
     */
    public static function validateNumber($number)
    {
        return (bool) !self::checksum($number, true);
    }

    /**
     * @author WN
     * @param int $number
     * @return int
     */
    public static function generateNumber($number)
    {
        return (int) ($number . self::checksum($number));
    }

    /**
     * @param $number
     * @return string
     */
    public static function generateString($number)
    {
        return ($number . self::checksum($number));
    }

    /**
     * @author WN
     * @param int|string $number
     * @param bool $check Set to true if you are calculating checksum for validation
     * @return int
     */
    private static function checksum($number, $check = false)
    {
        $data = str_split(strrev($number));

        $sum = 0;

        foreach($data as $k => $v) {

            $tmp = $v + $v * (int)(($k % 2) xor !$check);

            if ($tmp > 9) {
                $tmp -= 9;
            }

            $sum += $tmp;
        }

        $sum %= 10;

        return (int) $sum == 0?0:10-$sum;
    }
}
