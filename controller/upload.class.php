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
       $data['title'] = $data['top_title'] = '上传人物';
       $data['js'] = ['jquery.validate.min.js', 'jquery.form.min.js',
                        'gallery/webuploader.min.js', 'upload/characters.js'];
       render($data);
    }

    public function author()
    {
       $data['title'] = $data['top_title'] = '新建作者';
       $data['js'] = ['jquery.validate.min.js', 'jquery.form.min.js', 'upload/author.js'];
       render($data);
    }

    public function authorup()
    {
        $id = v('id');
        $author = get_author_by_id($id);
        if (!$author) {
            return info_page('作者不存在');
        }
        $data['title'] = $data['top_title'] = '编辑作者';
        $data['js'] = ['jquery.validate.min.js', 'jquery.form.min.js', 'upload/author.js'];
        $data['author'] = $author;
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
