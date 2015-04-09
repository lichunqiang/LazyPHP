<?php

function match_ftg($search)
{
    $map = require AROOT . '/config/ftg.map.php';

    $mathed = [];

    foreach ($map as $item) {
        if (in_array($search, $item['keywords'])) {
            $mathed[] = $item['id'];
        }
    }
    return $mathed;
}

function pure_with_en_comma($string)
{
    if (strpos($string, '，')){
        return str_replace('，', ',', $string);
    }
    return $string;
}


function get_default($arr, $key, $default = null)
{
    return isset($arr[$key]) ? $arr[$key] : $default;
}
