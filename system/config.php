<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$local = ['localhost.original', '127.0.0.1', 'localhost'];
$demo  = ['forestwebsdemo.com.tw'];
if (in_array($_SERVER['SERVER_NAME'], $local)) {
    //本機端測試
    define('HOST', 'localhost');
    define('DB_NAME', 'DBNAME');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
} else {
    //正式機
    define('HOST', 'localhost');
    define('DB_NAME', 'nwp');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
}
date_default_timezone_set('Asia/Taipei');
header('Content-Type:text/html; charset=utf-8');
// Check if SSL
if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || $_SERVER['SERVER_PORT'] == 443) {
    $protocol = 'https://';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}
//網域名稱
define('DOMAIN_NAME', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/');
// 後台路徑
define('BASE_URL', str_replace('\\', '/', realpath(dirname(__FILE__) . '/')) . '/');
//上傳檔案路徑設定
define('UPLOAD_URL', BASE_URL . '/upload/');
//網頁圖片路徑
define('SRC_URL', '/upload/');
//非法讀取畫面返回
define('BACK_URL', 'index.php');
//載入funciton工具
require_once BASE_URL . 'BaseFunction.php';
require_once BASE_URL . 'lang.php';
//載入語系工具
if (isset($_GET['admin_lang'])) {
    $lang = $_GET['admin_lang'];
    unset($_SESSION['admin_lang']);
} elseif (isset($_SESSION['admin_lang'])) {
    $lang = $_SESSION['admin_lang'];
} else {
    $lang = 'zh-tw';
}
$_SESSION['admin_lang'] = $lang;
setcookie('admin_lang', $lang, time() + 60 * 60 * 24 * 30);
define('ADMIN_LANG', (string) $lang);
switch (ADMIN_LANG) {
    case 'zh-tw':
        $language = '繁體中文';
        break;
    case 'en-us':
        $language = '英文';
        break;
}
//require_once "../block/lang.php";
$profile = SelectNCondition($cn, 'inf');
$info    = $profile[0];
define('WEB_TITLE', $info['title']);
ini_set('memory_limit', '256M');
