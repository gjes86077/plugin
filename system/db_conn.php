<?php
//正式
 	$host			= HOST;	//資料庫主機位置
 	$database		= DB_NAME;	//資料庫名稱
	$user			= DB_USER;	//資料庫的使用者帳號
 	$password		= DB_PASSWORD;	//資料庫的使用者密碼
	$link = @mysqli_connect($host, $user, $password, $database);
	
	if(!$link){
		echo "資料庫連線錯誤！<br>請更改資料庫連線資訊 " . BASE_URL . "config.php";
		exit();
	}
	
	mysqli_query($link, "SET NAMES UTF8");
?>