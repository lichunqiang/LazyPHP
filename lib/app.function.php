<?php
/**
 * 显示分页
 * @param  int  $count 总数
 * @param  string  $url   当前页面的地址
 * @param  integer $index 当前页数
 * @param  integer $size  每页个数
 * @return string
 */
function pagination($count, $url, $index = 1, $size = 10)
{

    $fpage = 0;
    //总的页数
    $num = $count > 0 ? (intval(($count - 1) / $size) + 1) : 1;
    if (strpos($url, '?') === false) {
        $url .= '?page_idx=';
    } else {
        $url .= '&page_idx=';
    }
    $nindex = $index;
    if ($index > $num) {
        $index = $num;
    }
    if ($index > 1) {
        $fpage = $index - 1; //上一页
    } else {
        $fpage = $index;
    }
    if ($index >= $num) {
        $npage = $num;
    } else {
        $npage = $index + 1; //下一页
    }
    $pageStyle = '<ul class="pagination pull-right">';

    if ($index > 1) {
        $pageStyle .= "<li><a href='" . ($url . 1) . "'>首页</a></li>";
        $pageStyle .= "<li><a href ='" . $url . $fpage . "'>上一页</a></li>";
    } else {
        $pageStyle .= "<li class='disabled'><span>首页</span></li>";
        $pageStyle .= "<li class='disabled'><span>上一页</span></li>";
    }
    if ($index - 3 > 0) {
        $a = $index - 3;
        $pageStyle .= "<li><a href ='" . $url . $a . "'>$a</a></li>";
    }
    if ($index - 2 > 0) {
        $a = $index - 2;
        $pageStyle .= "<li><a href ='" . $url . $a . "'>$a</a></li>";
    }
    if ($index - 1 > 0) {
        $a = $index - 1;
        $pageStyle .= "<li><a href ='" . $url . $a . "'>$a</a></li>";
    }
    if ($num > 1) {
        $pageStyle .= "<li class='active'><span>" . $index . "</span></li>";
    }
    if ($index + 1 < $num) {
        $a = $index + 1;
        $pageStyle .= "<li><a href ='" . $url . $a . "'>$a</a></li>";
    }
    if ($index + 2 < $num) {
        $a = $index + 2;
        $pageStyle .= "<li><a href ='" . $url . $a . "'>$a</a></li>";
    }
    if ($num > 5 && $index != $num) {
        $pageStyle .= "<li><a href ='#'>...</a></li>";
    }
    if ($index != $num && $num > 1) {
        $pageStyle .= "<li><a href ='" . $url . $num . "'>$num</a></li>";
    }
    if ($npage > 1) {
        if ($nindex < $num) {
            $pageStyle .= "<li><a href ='" . $url . $npage . "'>下一页</a></li>";
            $pageStyle .= "<li><a href='" . ($url . $num) . "'>最后一页</a></li>";
        } else {
            $pageStyle .= "<li class='disabled'><span>下一页</span></li>";
            $pageStyle .= "<li class='disabled'><span>最后一页</span></li>";
        }
    }
    $pageStyle .= '</ul>';
    return $pageStyle;
}
/**
 * 获取当前请求的URL地址
 * @return string
 */
function getActionUrl()
{
    $action_script = $_SERVER['SCRIPT_NAME'];
    $admin_url = strtolower(SYS_URL);
    if ($admin_url{strlen($admin_url) - 1} == "/") {
        $admin_url = substr($admin_url, 0, strlen($admin_url) - 1);
    }

    $http_pos = strpos($admin_url, 'http://');

    if ($http_pos !== false) {
        $admin_url_no_http = substr($admin_url, 7);
    } else {
        $admin_url_no_http = $admin_url;
    }
    $slash = 0;
    $slash = strpos($admin_url_no_http, '/');

    if ($slash) {
        $sub_dir = substr($admin_url_no_http, $slash);
        $action_url = substr($action_script, strlen($sub_dir));
    } else {
        $action_url = $action_script;
    }
    return $action_url;
}
/**
 * 获取客户端的IP地址
 * @return string 解析后的IP地址
 */
function getUserClientIp()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
        $ip = getenv("REMOTE_ADDR");
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = "127.0.0.1";
    }
    return $ip;
}
