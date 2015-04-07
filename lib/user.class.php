<?php
/**
 * 权限说明
 *
 * 1. 非注册用户，只可以下载资源，无权限修改和上传
 * 2. 注册用户，可以添加人物参与的杯赛；可以上传新闻、交流贴、留言、同人图、场景、血条及界面、作者；
 *    可以修改作者、同人图、场景、血条及界面相关信息；
 *    不可以修改人物的上传地址，其余信息可以修改；
 *    不得删除该人物已有作者信息；不能上传人物
 * 3. 高级用户，可以修改、删除、上传任何资源，其他功能包含下级
 * 4. 管理员，可以在后台对用户进行删除、权限修改，其他功能包含下级
 *
 */
class User
{
    public $_authority = array(
        1 => '普通用户',
        8 => '高级用户',
        9 => '管理员',
    );

    public static function isLogin()
    {
        return static::getUser() !== null;
    }

    public static function getUser()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function getUserId()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['id'];
        }
        return null;
    }

    public static function login($user)
    {
        $_SESSION['user'] = $user;
        return true;
    }

    public static function logout()
    {
        @session_unset();
        @session_destroy();
    }


    public static function setReturnUrl($url)
    {
        $_SESSION['_redirct'] = $url;
    }

    public static function getReturnUrl($default = '/')
    {
        return isset($_SESSION['_redirct']) ? $_SESSION['_redirct'] : $default;
    }
}
