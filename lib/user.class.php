<?php

class User
{
    public static function isLogin()
    {
        return static::getUser() !== null;
    }

    public static function getUser()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
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
