<?php

namespace Src\Utils;

trait Helper
{
    // the middle argument is not require
    // set second in three if not bath three
    // and set defult in second
    protected function middleNotRequire($defaultTow, &$tow = '', &$three = null)
    {
        if (!$three) {
            $three = $tow;
            $tow = $defaultTow;
        }
    }
    protected function toBindWord($array, $isStr = 's', $isInt = 'i', $isFloat = 'd', $isBool = 'b'): string
    {
        $str = '';
        foreach ($array as $value) {
            if (is_string($value)) {
                $str .= $isStr;
            } elseif (is_int($value)) {
                $str .= $isInt;
            } elseif (is_float($value)) {
                $str .= $isFloat;
            } elseif (is_bool($value)) {
                $str .= $isBool;
            }
        }
        return $str;
    }
}
