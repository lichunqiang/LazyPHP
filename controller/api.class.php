<?php
if (!defined('IN')) {
    die('bad request');
}

include_once AROOT . 'controller' . DS . 'app.class.php';

class apiController extends appController
{
    public function savelink()
    {
       return save_website_link();
    }

    public function savenews()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 2, 'errmsg' => '需要登录'));
        }
        return save_news();
    }

    public function saveskill()
    {
        if (!User::isLogin()){
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }
        return save_kill_article();
    }

    public function upload_author()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_author();
    }

    public function __construct()
    {
        parent::__construct();
        if (!is_ajax_request()) {
            info_page('非法请求');
            exit;
        }
    }
}
