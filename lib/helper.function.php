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
