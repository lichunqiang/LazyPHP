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
/**
 * 获取人物总数
 * @return int
 */
function get_person_count()
{
    $query = t(v('query'));
    $magic = (int) v('magic');
    $author = t(v('author'));
    $progress = v('progress');
    $source = t(v('source'));
    $strength_highest = v('strength_highest');
    $strength_lowest = v('strength_lowest');
    $version = v('version');

    $prepare_data = array();
    $where = array(' WHERE 1 ');
    if ($query) {
        $prepare_data[] = $query;
        $prepare_data[] = $query;
        $prepare_data[] = $query;
        $where[] = "a.`name` LIKE '%\s%' OR a.`name_roman` LIKE '%\s%' OR a.`keywords` LIKE '%\s%'";
    }

    if ($magic == 1) {
        $prepare_data[] = $magic;
        $where[] = 'a.`magic_chaged`=?i';
    }

    if ($progress !== false)  {
        $prepare_data[] = $progress;
        $where[] = 'a.`completion_status`=?i';
    }

    $sql = prepare('SELECT * FROM `characters` a LEFT JOIN `characters_author` b
        ON a.`id`=b.`characters_id`');
}
/**
 * 获取人物列表
 * @param  int $page_idx
 * @param  int $page_size
 * @return array
 */
function get_person_list($page_idx, $page_size)
{
    $query = t(v('query'));
    $magic = (int) v('magic');
    $author = t(v('author'));
    $progress = v('progress');
    $source = t(v('source'));
    $strength_highest = v('strength_highest');
    $strength_lowest = v('strength_lowest');
    $version = v('version');

    $sql = prepare('SELECT * FROM `characers` a LEFT JOIN `characers_author`');
}
