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
