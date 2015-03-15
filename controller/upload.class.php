<?php
if (!defined('IN')) {
    die('bad request');
}

include_once AROOT . 'controller' . DS . 'app.class.php';

class uploadController extends appController
{

    public function index()
    {
        $data['title'] = $data['top_title'] = '人物搜索';
        render($data);
    }

    public function person()
    {
       $data['title'] = $data['top_title'] = '人物搜索';
       render($data);
    }

    public function author()
    {
       $data['title'] = $data['top_title'] = '作者搜索';
       render($data);
    }
    public function scenario()
    {
       $data['title'] = $data['top_title'] = '场景及其他';
       render($data);
    }
    public function figure()
    {
       $data['title'] = $data['top_title'] = '同人图';
       render($data);
    }

    public function __construct()
    {
        parent::__construct();
        if (!User::isLogin()) {
            info_page('需要登录');
            exit;
        }
    }
}
