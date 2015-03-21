<?php
/**
 * 根据用的账号获取用户信息
 * @param  string $account 登录账号
 * @return array|boolean   结果为空时返回false
 */
function get_user_by_account($account)
{

    // db();
    echo $sql = prepare("SELECT * FROM `user` WHERE `username` = ?s;", array($account));
	return get_line($sql);
}
/**
 * 用户登录
 * @return ajax
 */
function user_ajax_login()
{
    $account = t(v('account'));
    $password = v('password');

    if (!$account || !$password) {
        return render_ajax(array(
            'errcode' => 1,
            'errmsg' => '用户名或密码不能为空',
            'errinfo' => array(
                'password' => '用户名或密码不能为空'
            )
        ));
    }
    $sql = prepare("SELECT * FROM `user` WHERE `username` = ?s AND `password` = ?s;", array($account, md5($password)));

    $user = get_line($sql);

    if ($user) {
        User::login($user);
        return render_ajax(array(
            'errcode' => 0,
            'errmsg' => '登录成功',
            'redirct' => User::getReturnUrl()
        ));
    } else {
        return render_ajax(array(
            'errcode' => 1,
            'errmsg' => '用户名或者密码错误',
            'errinfo' => array('password' => '用户名或者密码错误')
        ));
    }
}
/**
 * 用户注册
 * @return ajax
 */
function user_ajax_register($authority = 1)
{
    $username = t(v('account'));
    $password = t(v('password'));
    $confirm_password = t(v('password'));
    $email = t(v('email', ''));
    $errinfo = array();

    do {
        if (empty($username)) {
            $errinfo['account'] = '用户名不能为空';
            break;
        }
        if (empty($password) || empty($confirm_password)) {
            $errinfo['password'] = '密码不能为空';
            break;
        }
        if ($password !== $confirm_password) {
            $errinfo['password'] = '两次密码输入不一致';
            break;
        }
        if ($email && !is_email($email)) {
            $errinfo['email'] = '电子邮件地址不合法';
            break;
        }

        //校验账号是否存在
        $sql = prepare('SELECT `id` FROM `user` WHERE `username` = ?s;', array($username));
        $result = get_line($sql);
        if ($result) {
            $errinfo['account'] = '用户名已被注册';
            break;
        }

    } while(false);

    if (!empty($errinfo)) {
        return render_ajax(array('errcode' => 1, 'errmsg' => 'error', 'errinfo' => $errinfo));
    }

    $sql = prepare("INSERT INTO `user` (`username`, `password`, `email`) VALUES (?s, ?s, ?s, ?i);",
                    array($username, md5($password), $email, $authority));

    $result = run_sql($sql);
    if ($result) {
        $id = last_id();
        $user = compact('id', 'username', 'email', 'authority');
        User::login($user);
        return render_ajax(array('errcode' => 0, 'errmsg' => 'success'));
    }
    return render_ajax(array('errcode' => 1, 'errmsg' => db_error(), 'errinfo' => array('account' => '注册失败')));
}

/**
 * 根据分类获取相关站点列表
 * @param  integer $cate    站点分类
 * @param  integer $checked 是否通过
 * @return array|boolean     获取失败返回false
 */
function get_website_by_cate($cate = 1, $checked = 1)
{
    $sql = prepare('SELECT * FROM `mna_links` WHERE `cate` = ?i AND `checked` = ?i;', array($cate, $checked));

    return get_data($sql);
}
/**
 * 获取新闻总数
 * @return int 记录个数
 */
function get_news_count($checked = 1)
{
    if ($checked === false) {
        $sql = 'SELECT COUNT(*) `total` FROM `news`;';
    } else {
        $sql = prepare('SELECT COUNT(*) `total` FROM `news` WHERE `checked` = ?i;', array($checked));
    }
    return (int) get_var($sql);
}
/**
 * 获取最新消息「新闻」列表
 * @param  integer $checked 是否通过
 * @return array|boolean
 */
function get_news($page_idx = 1, $page_size = 10 ,$checked = 1)
{
    $page_offset = ($page_idx - 1) * $page_size;
    if ($checked === false) {
        $sql = prepare('SELECT * FROM `news` ORDER BY `date` DESC LIMIT ?i OFFSET ?i;', array($page_size, $page_offset));
    } else {
        $sql = prepare('SELECT * FROM `news` WHERE `checked` = ?i  ORDER BY `date` DESC LIMIT ?i OFFSET ?i;',
                         array($checked, $page_size, $page_offset));
    }

    return get_data($sql);
}
/**
 * 获取AI经验交流文章总数
 * @param  integer|boolean $status 文章状态 0.禁用 1.正常  false 不以status为过滤条件
 * @return int
 */
function get_skill_article_count($status = 1)
{
    if ($status === false) {
        $sql = 'SELECT COUNT(*) `total` FROM `skill_article`;';
    } else {
        $sql = prepare('SELECT COUNT(*) `total` FROM `skill_article` WHERE `status` = ?i;', array($status));
    }
    return (int) get_var($sql);
}
/**
 * 获取AI检验交流文章列表
 * @param  integer $page_idx  当前页数
 * @param  integer $page_size 每个个数
 * @param  integer|boolean $status 文章状态 0.禁用 1.正常  false 不以status为过滤条件
 * @return int
 */
function get_skill_article_list($page_idx = 1, $page_size = 10, $status = 1)
{
    $page_offset = ($page_idx - 1) * $page_size;
    if ($status === false) {
        $sql = prepare('SELECT * FROM `skill_article` ORDER BY `created_at` DESC LIMIT ?i OFFSET ?i;', array($page_size, $page_offset));
    } else {
        $sql = prepare('SELECT * FROM `skill_article` WHERE `status` = ?i  ORDER BY `created_at` DESC LIMIT ?i OFFSET ?i;',
                         array($status, $page_size, $page_offset));
    }

    return get_data($sql);
}
