<?php

function get_author_count($query, $checked = 1)
{
    $prepare_data = array();
    if ($checked === false) {
        $sql = 'SELECT COUNT(*) `total` FROM `mugenauthors` WHERE 1';
    } else {
        $sql = 'SELECT COUNT(*) `total` FROM `mugenauthors` WHERE `checked`= ?i';
        $prepare_data[] = $checked;
    }
    if ($query) {
        $sql .= ' AND (`name` LIKE ?s OR `remark` LIKE ?s)';
        $prepare_data = array_pad($prepare_data, 3, '%' . $query . '%');
    }
    $sql = prepare($sql, $prepare_data);

    return (int) get_var($sql);
}

function get_author_list($query, $page_idx = 1, $page_size = 10, $checked = 1)
{
    $page_offset = ($page_idx - 1) * $page_size;
    $prepare_data = array();

    if ($checked === false) {
        $sql = 'SELECT * FROM `mugenauthors` WHERE 1';
    } else {
        $sql = 'SELECT * FROM `mugenauthors` WHERE `checked` = ?i';
        $prepare_data[] = $checked;
    }

    if ($query) {
        $sql .= ' AND (`name` LIKE ?s OR `remark` LIKE ?s)';
        $prepare_data = array_pad($prepare_data, 3, '%' . $query . '%');
    }
    $sql .= '  ORDER BY `update_time` DESC LIMIT ?i OFFSET ?i;';
    $prepare_data[] = $page_size;
    $prepare_data[] = $page_offset;

    $sql = prepare($sql, $prepare_data);

    return get_data($sql);
}
