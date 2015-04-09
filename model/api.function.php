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
    $belong_ftg = t(v('belong_ftg'));
    $belong_anime = t(v('belong_anime'));
    $keywords = t(v('keywords'));
    $thumbnail = t(v('thumbnail'));
    $completion_status = (int) v('completion_status');
    $date = date('Y-m-d');
    $user_id = User::getUserId();

    $belong_ftg_map = implode(',', match_ftg($belong_ftg));

    if ($primary_key && is_numeric($primary_key)) {
        $sql = prepare('UPDATE `characters` SET `name`=?s, `name_roman`= ?s, `belong_ftg`=?s, `belong_ftg_map`=?s, `belong_anime`=?s,
            `keywords`=?s, `thumbnail`=?s, `completion_status`=?i, `created_at`=?s, `created_by`=?i, `updated_at`=?s,
            `updated_by`=?i WHERE `id`=?i', array($name, $name_roman, $belong_ftg, $belong_ftg_map,
            $belong_anime, $keywords, $thumbnail, $completion_status, $date, $user_id, $date, $user_id, $primary_key));
    } else {

        $sql = prepare('INSERT INTO `characters` (`name`, `name_roman`, `belong_ftg`, `belong_ftg_map`, `belong_anime`,
            `keywords`, `thumbnail`, `completion_status`, `created_at`, `created_by`, `updated_at`, `updated_by`)
            VALUES (?s, ?s, ?s, ?s, ?s, ?s, ?s, ?i, ?s, ?i, ?s,?i)', array($name, $name_roman, $belong_ftg, $belong_ftg_map,
            $belong_anime, $keywords, $thumbnail, $completion_status, $date, $user_id, $date, $user_id));
    }

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功', 'key' => $primary_key ? $primary_key : last_id()));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('name' => '保存失败')));
}
/**
 * 保存人物作者
 * @return ajax
 */
function save_person_author()
{
    $character_id = v('character');
    $author = t(v('author'));
    $version = v('version');
    $address = v('address');
    $opts = v('opts');
    $strength_highest = v('strength_highest');
    $strength_lowest = v('strength_lowest');
    $remark = t(v('remark'));
    is_array($opts) and ($opts = implode(',', $opts));
    $user_id = User::getUserId();
    $now = date('Y-m-d');

    $errinfo = array();
    if (empty($character_id) || !is_numeric($character_id)) {
        $errinfo['remark'] = '请先上传人物';
    }
    if (empty($address)) {
        $errinfo['address'] = '下载地址不能为空';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    $sql = prepare('INSERT INTO `characters_author` (`characters_id`, `name`, `created_by`, `created_at`, `updated_at`,`mugen_version`,
        `opts`, `download_url`, `strength_highest`, `strength_lowest`, `remark`) VALUES (?s, ?s, ?s, ?s, ?s, ?i, ?s, ?s,?i,?i,?s)',
        array($character_id, $author, $user_id, $now, $now, $version, $opts, $address, $strength_highest, $strength_lowest, $remark));

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功', 'pk' => last_id()));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('remark' => '保存失败')));
}

/**
 * 保存同人图数据
 * @return [type] [description]
 */
function save_figure()
{
    $primary_key = v('primary');
    $figures = pure_with_en_comma(t(v('figures')));
    $author = t(v('author'));
    $keywords = pure_with_en_comma(t(v('keywords')));
    $thumbnail = v('thumbnail');
    $user_id = User::getUserId();
    $now = $_SERVER['REQUEST_TIME'];

    $errinfo = array();

    if (empty($figures)) {
        $errinfo['figures'] = '包含人物不能为空';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    if ($primary_key && is_numeric($primary_key)) {
        $sql = prepare('UPDATE `same_figures` SET `figures`=?s,`author`=?s, `keywords`=?s, `thumbnail`=?s,
                        `updated_by`=?s,`updated_at`=?s WHERE `id`=?s;',
            array($figures, $author, $keywords, $thumbnail, $user_id, $now, $primary_key));
    } else {
        $sql = prepare('INSERT INTO `same_figures` (`figures`, `author`, `keywords`, `thumbnail`, `created_at`, `created_by`)
                    VALUES (?s, ?s, ?s, ?s, ?s, ?s)', array($figures, $author, $keywords, $thumbnail, $now, $user_id));
    }

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('name' => '保存失败')));
}
/**
 * 根据ID删除同人图
 * @param  int $id
 * @return ajax
 */
function del_figure_by_id($id)
{
    $sql = prepare('DELETE FROM `same_figures` WHERE `id`=?s;', array($id));

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '删除成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => '删除失败'));
}

/**
 * 保存场景血条界面数据
 * @return ajax
 */
function save_scenario()
{
    $primary_key = v('key');
    $origin_download_url = v('origin_download_url');
    $name = t(v('name'));
    $category = v('category');
    $belong_ftg = t(v('belong_ftg'));
    $belong_anime = t(v('belong_anime'));
    $author = t(v('author'));
    $keywords = t(v('keywords'));
    $thumbnail = v('thumbnail');
    $version = v('version');
    $download_url = v('download_url');
    $remark = v('remark');

    $belong_ftg_map = match_ftg($belong_ftg);
    $belong_ftg_map = implode(',', $belong_ftg_map);

    $user_id = User::getUserId();
    $now = $_SERVER['REQUEST_TIME'];

    $errinfo = array();

    if (empty($name)) {
        $errinfo['name'] = '场景名不能为空';
    }
    if (empty($belong_ftg)) {
        $errinfo['belong_ftg'] = '所属格斗游戏不能为空';
    }
    if (empty($belong_anime)) {
        $errinfo['belong_anime'] = '所属动漫不能为空';
    }
    if (empty($download_url)) {
        $errinfo['download_url'] = '下载地址不能为空';
    }

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    if ($primary_key) {
        $sql = 'UPDATE `resource_list` SET `name`=?s, `category`=?i, `belong_ftg`=?s, `belong_ftg_map`=?s,
                `belong_anime`=?s, author=?s, keywords=?s, `thumbnail`=?s, `version`=?i, `remark`=?s, `updated_by`=?s';
        $prepare_data = array($name, $category, $belong_ftg, $belong_ftg_map,
            $belong_anime, $author, $keywords, $thumbnail, $version, $remark, $user_id);
        if ($download_url != $origin_download_url) {
            $prepare_data[] = $now;
            $prepare_data[] = $download_url;
            $sql .= ' , `updated_at`=?s, `download_url`=?s ';
        }
        $prepare_data[] = $primary_key;
        $sql .= ' WHERE `id`=?s;';

        $sql = prepare($sql, $prepare_data);
    } else {

        $sql = prepare('INSERT INTO `resource_list` (`name`, `category`, `belong_ftg`, `belong_ftg_map`, `belong_anime`, `author`,
                `keywords`, `thumbnail`, `version`, `download_url`, `remark`, `created_by`, `created_at`)
                VALUES (?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s)', array($name, $category, $belong_ftg, $belong_ftg_map,
            $belong_anime, $author, $keywords, $thumbnail, $version, $download_url, $remark, $user_id, $now));
    }

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '保存成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => '保存失败', 'errinfo' => array('remark' => db_error())));
}
