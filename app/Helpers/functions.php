<?php

if (!function_exists('englishToBengali')) {
    /**
     * Convert English (ASCII) digits in a string to Bengali digits.
     * Accepts int, float, or string.
     */
    function englishToBengali(string|int|float $value): string
    {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengali = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return strtr((string) $value, array_combine($english, $bengali));
    }
}

if (!function_exists('banglaToEnglish')) {
    /**
     * Convert Bengali digits in a string back to English (ASCII) digits.
     */
    function banglaToEnglish(string $value): string
    {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengali = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return strtr($value, array_combine($bengali, $english));
    }
}
