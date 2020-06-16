<?php

namespace FP\ElasticApmBundle\Utils;

class StringHelper
{
    public static function match($haystack, $needle, $dash = '*')
    {
        $haystack = (string)$haystack;
        $needle = (string)$needle;

        if (strlen($haystack) !== strlen($needle)) {
            return false;
        }

        for ($i = 0, $iMax = strlen($haystack); $i < $iMax; $i++) {
            if ($haystack[$i] != $dash) {
                if ($haystack[$i] !== $needle[$i]) {
                    return false;
                }
            }
        }

        return true;
    }
}
