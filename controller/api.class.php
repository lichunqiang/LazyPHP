<?php
if (!defined('IN')) {
    die('bad request');
}

include_once AROOT . 'controller' . DS . 'app.class.php';

class apiController extends appController
{
    /**
     * 保存地址
     * @return [type] [description]
     */
    public function savelink()
    {
       return save_website_link();
    }
    /**
     * 保存新闻
     * @return [type] [description]
     */
    public function savenews()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 2, 'errmsg' => '需要登录'));
        }
        return save_news();
    }
    /**
     * 经验交流
     * @return [type] [description]
     */
    public function saveskill()
    {
        if (!User::isLogin()){
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }
        return save_kill_article();
    }
    /**
     * 上传作者
     * @return [type] [description]
     */
    public function upload_author()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_author();
    }
    /**
     * 上传人物
     * @return [type] [description]
     */
    public function upload_person()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_person();
    }
    /**
     * 上传人物作者
     * @return [type] [description]
     */
    public function upload_person_author()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_person_author();
    }
    /**
     * 上传同人图
     * @return [type] [description]
     */
    public function upload_figure()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_figure();
    }
    /**
     * 删除同人图
     * @return [type] [description]
     */
    public function del_figure()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return del_figure_by_id(v('pk'));
    }
    /**
     * 上传场景、血条以及界面
     * @return [type] [description]
     */
    public function upload_scenario()
    {
        if (!User::isLogin()) {
            return render_ajax(array('errcode' => 1, 'errmsg' => '需要登录'));
        }

        return save_scenario();
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
