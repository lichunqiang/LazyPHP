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

    if(!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }
    $sql = prepare('INSERT INTO `news` (`title`, `address`, `content`, `date`, `checked`) VALUES (?s, ?s, ?s, ?s, ?i);',
                    array($title, $address, $content, $date, $checked));

    if (run_sql($sql)) {
        return render_ajax(array('errcode' => 0, 'errmsg' => '提交成功'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('content' => '保存失败')));
}
