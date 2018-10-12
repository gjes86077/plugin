<? 
require_once realpath(dirname(__FILE__) . '/../') . '/system/config.php';
	
	function getId($link,$type=''){
		//設定檢查傳入KEY值
		$keyArray = array("id");
		//接收POST值
		$post = $_GET;
		//檢查
		if(!checkConvey($post, $keyArray)){
			echo "error = 10";
			exit();
		}		
		//取出資料
		$id = $post["id"];
		//移除sql注入
		$id = checkSqlInjection($id);
		//移除HTML標籤
		$id = checkHtmlPhpTag($id);
		
		$tableName		= "contact";
		$result = Select1Condition($link, $tableName, 'id',$id);
		echo json_encode($result);
	}
	function delete($link){
		//設定檢查傳入KEY值
		$keyArray = array("id");
		//接收POST值
		$post = $_POST;
		//檢查
		if(!checkConvey($post, $keyArray)){
			echo "ERROR:無法找到索引值";
			exit();
		}
		//取出資料
		$id = $post["id"];
		//移除sql注入
		$id = checkSqlInjection($id);
		//移除HTML標籤
		$id = checkHtmlPhpTag($id);
		
		$result = DeletById($link, 'contact', 'id', $id);
		if ($result) {
			backPrevPage();
			exit();
		} else {
			echo "刪除失敗";
		}
	}
	function send($link){
		//設定檢查傳入KEY值
		$keyArray = array("id");
		//接收POST值
		$post = $_POST;
		
		if($post['send_to']!='' & isset($post['send_to'])){
		    $subject = WEB_TITLE."回覆訊息 ".date("Y-m-d H:i"); //信件標題
		    
		    //信件內容
		    $Headers = "Content-type: text/html; charset=utf-8\r\n"."From: ".WEB_TITLE."<no-reply@turking.idv.tw>\r\n";
		    $send=mail($post['send_to'], "$subject", $post['content'],$Headers);
		    if ($send) {
		    	 echo "<script>alert('成功寄出')</script>";
		    	 backPrevPage();
				exit();
		    }
		    else{
		    	echo "<script>alert('寄出失敗')</script>";
		    	backPrevPage();
				exit();
		    }
		  }
		  else
		  	echo "<script>alert('寄出失敗')</script>";
	}
	if (isset($_GET["action"]) && function_exists($_GET["action"])) {
		$action = $_GET["action"];
		$type=$_POST["type"];
		$action($link,$type);
	} else {
		echo "NO!NO!NO!";
		exit();
	}
?>