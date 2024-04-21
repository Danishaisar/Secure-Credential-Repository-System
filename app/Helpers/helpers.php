<?php

/**
 * Convert a number to its ordinal representation.
 *
 * @param int $number
 * @return string
 */
if (!function_exists('ordinal')) {
    function ordinal($number) {
        if (!is_numeric($number)) {
            return $number; // Ensure the input is numeric, otherwise return it unchanged
        }

        $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        $lastDigit = $number % 10;
        $lastTwoDigits = $number % 100;

        // Special cases for numbers ending in 11-13: they use 'th'
        if ($lastTwoDigits >= 11 && $lastTwoDigits <= 13) {
            return $number . 'th';
        }

        // Otherwise, use the corresponding suffix
        return $number . $suffixes[$lastDigit];
    }
}
