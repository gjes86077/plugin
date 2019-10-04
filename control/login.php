<?php

header("Content-type:application/json");
require_once '../system/config.php';
//取出資料
$post = CheckAll($_POST, array("ac", "pw"));
// $post=$_GET;
$account  = addslashes($post["ac"]);
$password = addslashes($post["pw"]);

//移除sql注入
$account  = checkSqlInjection($account);
$password = checkSqlInjection($password);

//移除hmtl標籤
$account  = checkHtmlPhpTag($account);
$password = checkHtmlPhpTag($password);
//登入

$result = CheckLogin($link, $account, $password);
echo json_encode($result);
