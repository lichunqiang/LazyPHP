<?php
/**
 * 根据作者ID获取详情
 * @param  int  $author_id 作者ID
 * @param  integer $checked   是否显示
 * @return array|boolean
 */
function get_author_by_id($author_id, $checked = 1)
{
    $sql = prepare('SELECT * FROM `mugenauthors` WHERE `id`=?s AND `checked`=?i;',
                    array($author_id, $checked));

    return get_line($sql);
}
/**
 * 获取同人图详情
 * @param  int  $id
 * @param  integer $status
 * @return array|null
 */
function get_figure_by_id($id, $status = 1)
{
    $sql = prepare('SELECT * FROM `same_figures` WHERE id=?s AND `status`=?i;',
            array($id, $status));

    return get_line($sql);
}
/**
 * 获取场景、血条、界面详情
 * @param  int  $id
 * @param  integer $status
 * @return array|null
 */
function get_source_by_id($id, $status = 1)
{
    $sql = prepare('SELECT * FROM `resource_list` WHERE id=?s AND `status`=?i;',
            array($id, $status));

    return get_line($sql);
}

/**
 * 获取人物信息
 * @param  int  $id
 * @param  integer $status
 * @return array|null
 */
function get_person_by_id($id, $status = 1)
{
    $sql = prepare('SELECT * FROM `characters` WHERE id=?s AND `status`=?i;',
            array($id, $status));

    return get_line($sql);
}
