<?php
  
	header("Content-type:application/json");
	require_once '../system/config.php';
	//取出資料
	$post=CheckAll($_POST,array("ac","pw"));
	// $post=$_GET;
	$account	= addslashes($post["ac"]);
	$password	= addslashes($post["pw"]);
	
	//移除sql注入
	$account	= checkSqlInjection($account);
	$password	= checkSqlInjection($password);
	
	//移除hmtl標籤
	$account	= checkHtmlPhpTag($account);
	$password	= checkHtmlPhpTag($password);
	//登入
	// echo $account."\r\n";
	// echo $password."\r\n";
	$result = CheckLogin($link, $account, $password);
	echo json_encode($result);
	// if($result == 10){
	// 	echo 10;
	// }else if($result == 11){
	// 	echo 11;
	// }else if($result == 12){
	// 	echo 12;
	// }elseif($result ==0){
	// 	echo 0;
	// }
	
?>