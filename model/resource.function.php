<?php
/**
 * 获取作者总数
 * @param  string  $query   查询条件：作者名称或者备注信息
 * @param  integer $checked 是否显示
 * @return int 作者总数
 */
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
/**
 * 获取作者列表
 * @param  string  $query     查询条件：作者名称或者备注信息
 * @param  integer $page_idx  页数
 * @param  integer $page_size 每页数量
 * @param  integer $checked   是否显示
 * @return array|boolean 成功返回列表，失败返回false
 */
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

    return get_data($sql) ?: array();
}
