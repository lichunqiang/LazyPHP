<?php
/**
 * 保存相关站点信息
 * @return  ajax
 */
function save_website_link()
{
    $title = t(v('title'));
    $address = t(v('address'));
    $cate = v('cate', 1);
    $checked = 0;

    $errinfo = array();

    if (empty($title)) {
        $errinfo['title'] = '链接标题不能为空';
    }

    if (empty($address)) {
        $errinfo['address'] = '链接地址不能为空';
    }

    if (!in_array($cate, array(1, 2, 3))) {
        $errinfo['address'] = '未知的资源类型';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    $sql = prepare('INSERT INTO `mna_links` (`title`, `address`, `cate`, `checked`) VALUES (?s, ?s, ?i, ?i)', array($title, $address, $cate, $checked));

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '添加成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('address' => '保存失败')));
}
/**
 * 保存最新消息
 * @return ajax
 */
function save_news($checked = 0)
{
    $title = t(v('title'));
    $address = t(v('address'));
    $content = t(v('content'));
    $date = date('Y-m-d');

    $errinfo = array();

    if (empty($title)) {
        $errinfo['title'] = '标题不能为空';
    }
    if (empty($address)) {
        $errinfo['address'] = '消息地址不能为空';
    }
    if (empty($content)) {
        $errinfo['content'] = '内容不能为空';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }
    $sql = prepare('INSERT INTO `news` (`title`, `address`, `content`, `date`, `checked`) VALUES (?s, ?s, ?s, ?s, ?i);',
        array($title, $address, $content, $date, $checked));

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('content' => '保存失败')));
}
/**
 * 保存AI经验交流文章
 * @return  ajax
 */
function save_kill_article()
{
    $title = t(v('title'));
    $content = t(v('content'));
    $user_id = User::getUserId();
    $date = date('Y-m-d');

    $errinfo = array();

    if (empty($title)) {
        $errinfo['title'] = '标题不能为空';
    }

    if (empty($content)) {
        $errinfo['content'] = '内容不能为空';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    $sql = prepare('INSERT INTO `skill_article` (`title`, `created_at`, `created_by`, `content`) VALUES (?s, ?s, ?s, ?s);',
        array($title, $date, $user_id, $content));
    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('content' => '保存失败')));
}
/**
 * 保存作者信息
 * @return ajax
 */
function save_author()
{
    $author_id = v('author_id');

    $name = t(v('name'));
    $address = t(v('address'));
    $invalid = (int) v('invalid');
    $remark = t(v('remark'));
    $update_time = $_SERVER['REQUEST_TIME'];
    $checked = 0; //默认不通过

    $errinfo = array();

    if (empty($name)) {
        $errinfo['title'] = '作者名称不能为空';
    }

    if (empty($address)) {
        $errinfo['address'] = '请输入链接地址';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }
    if ($author_id) {
        $sql = prepare('UPDATE `mugenauthors` SET `name`=?s, `address`=?s, `address_status`=?i, `remark`=?s,
                        `update_time`=?s WHERE `id`=?s', array($name, $address, $invalid, $remark, $update_time, $author_id));
    } else {
        $sql = prepare('INSERT INTO `mugenauthors` (`name`, `address`, `address_status`, `remark`, `update_time`, `checked`) VALUES
                (?s, ?s, ?i, ?s, ?s, ?i)', array($name, $address, $invalid, $remark, $update_time, $checked));
    }

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('content' => '保存失败')));
}
/**
 * 保存人物
 * @return ajax
 */
function save_person()
{
    $primary_key = v('primary_key');
    $name = t(v('name'));
    $name_roman = t(v('name_roman'));
    $belong_game = t(v('belong_game'));
    $belong_anime = t(v('belong_anime'));
    $keywords = t(v('keywords'));
    $thumbnail = t(v('thumbnail'));
    $completion_status = (int) v('completion_status');
    $date = date('Y-m-d');
    $user_id = User::getUserId();

    $belong_ftg = match_ftg($belong_game);
    empty($belong_ftg) or ($belong_ftg = implode(',', $belong_ftg));

    if ($primary_key && is_numeric($primary_key)) {
        $sql = prepare('UPDATE `characters` SET `name`=?s, `name_roman`= ?s, `belong_game`=?s, `belong_ftg`=?s, `belong_anime`=?s,
            `keywords`=?s, `thumbnail`=?s, `completion_status`=?i, `created_at`=?s, `created_by`=?i, `updated_at`=?s,
            `updated_by`=?i WHERE `id`=?i', array($name, $name_roman, $belong_game, $belong_ftg,
            $belong_anime, $keywords, $thumbnail, $completion_status, $date, $user_id, $date, $user_id, $primary_key));
    } else {

        $sql = prepare('INSERT INTO `characters` (`name`, `name_roman`, `belong_game`, `belong_ftg`, `belong_anime`,
            `keywords`, `thumbnail`, `completion_status`, `created_at`, `created_by`, `updated_at`, `updated_by`)
            VALUES (?s, ?s, ?s, ?s, ?s, ?s, ?s, ?i, ?s, ?i, ?s,?i)', array($name, $name_roman, $belong_game, $belong_ftg,
            $belong_anime, $keywords, $thumbnail, $completion_status, $date, $user_id, $date, $user_id));
    }

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功', 'key' => $primary_key ? $primary_key : last_id()));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('name' => '保存失败')));
}
