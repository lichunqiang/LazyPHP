<?php
if (!defined('IN')) {
    die('bad request');
}

include_once AROOT . 'controller' . DS . 'app.class.php';

class defaultController extends appController
{
    public function index()
    {
        $data['title'] = $data['top_title'] = '首页';
        $data['news_list'] = get_news(1, 4);
        $data['ai_skills'] = get_skill_article_list(1, 5);
        render($data);
    }

    public function login()
    {
        if (User::isLogin()) {
            return info_page('您已登录');
        }
        $data['title'] = $data['top_title'] = '登录';
        $data['js'] = ['jquery.form.min.js', 'jquery.validate.min.js', 'login.js'];

        if (v('redirect')) {
            User::setReturnUrl(v('redirect'));
        }

        if (is_ajax_request()) {

            return user_ajax_login();
        }
        render($data);
    }

    public function register()
    {
        if (User::isLogin()) {
            return info_page('您已登录');
        }

        if (is_ajax_request()) {

            return user_ajax_register();
        }
        $data['title'] = $data['top_title'] = '用户注册';
        $data['js'] = ['jquery.form.min.js', 'jquery.validate.min.js', 'register.js'];
        render($data);
    }

    public function tool()
    {
        $data['title'] = $data['top_title'] = '短网址转换工具';
        $data['js'] = ['ZeroClipboard.min.js', 'shorturl.js'];
        $data['css'] = ['shorturl.css'];
        render($data);
    }

    public function news()
    {
        $data['title'] = $data['top_title'] = '最新消息';
        $data['js'] = ['jquery.form.min.js', 'jquery.validate.min.js', 'news.js'];

        $data['news_count'] = get_news_count();
        $data['news_list'] = get_news(v('page_idx', 1));
        render($data);
    }

    public function messages()
    {
        $data['title'] = $data['top_title'] = '留言板';
        render($data);
    }

    public function websites()
    {
        $data['title'] = $data['top_title'] = '相关站点';
        $data['js'] = ['jquery.form.min.js', 'jquery.validate.min.js', 'websites.js'];

        $data['list_1'] = get_website_by_cate(1);
        $data['list_2'] = get_website_by_cate(2);
        $data['list_3'] = get_website_by_cate(3);
        render($data);
    }

    public function portal()
    {
        $data['title'] = $data['top_title'] = '入门知识';
        render($data);
    }

    public function skills()
    {
        $data['title'] = $data['top_title'] = 'AI技术交流';
        $data['js'] = ['jquery.form.min.js', 'jquery.validate.min.js',
            'ueditor/ueditor.config.js', 'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js', 'skills.js'];

        $data['article_count'] = get_skill_article_count();
        $data['article_list'] = get_skill_article_list();

        render($data);
    }


    public function logout()
    {
        User::logout();
        forward('/');
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function ajax_test()
    {
        return ajax_echo('1234');
    }

    public function rest()
    {
        $data = array();
        if (intval(v('o')) == 1) {
            $data['code'] = 123;
            $data['message'] = 'RPWT';
        } else {
            $data['code'] = 0;
            $data['data'] = array('2', '4', '6', '8');
        }

        return render($data, 'rest');
    }

    public function mobile()
    {
        $data['title'] = $data['top_title'] = 'JQMobi';
        return render($data, 'mobile');
    }

    public function ajax_load()
    {
        return ajax_echo('Hello ' . date("Y-m-d H:i:s"));
    }

    public function about()
    {
        return info_page("ftqq.com 荣誉出品", "About");
    }

    public function contact()
    {
        return info_page("Sina Weibo - <a href='http://weibo.com/easy' target='_blank'>@Easy</a> |  Twitter - @Easychen", "Follow Me");
    }

    public function test()
    {
        $data['title'] = $data['top_title'] = '自动测试页';
        $data['info'] = '根据访问来源自动切换Layout';

        return render($data);
    }

    public function sql()
    {
        $result = get_user_by_account('light');

        var_dump($result);
    }

    public function binding
    (
        $c1 = ':is_mail|请输入正确的email地址',
        $b1 = ':not_empty|B1不能为空',
        $a1 = ':intval|setback'
    ) {
        echo $c1 . '-' . $b1 . "-" . $a1;
    }

}
