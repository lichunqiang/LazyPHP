<?php
if (!defined('IN')) {
    die('bad request');
}

include_once AROOT . 'controller' . DS . 'app.class.php';

class defaultController extends appController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $data['top_title'] = '首页';
        render($data);
    }

    public function login()
    {
        $data['title'] = $data['top_title'] = '登录';
        render($data);
    }

    public function register()
    {
        $data['title'] = $data['top_title'] = '用户注册';
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
        render($data);
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
        db();
        echo $sql = prepare("SELECT * FROM `user` WHERE `name` = ?s AND `uid` = ?i AND `level` = ?s LIMIT 1", array("Easy'", '-1', '9.56'));
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
