<?php
	/*
	 * $keyArray 範例
	 * ["key"]					key值	
	 * ["type"]					型別
	 * ["maxlenght"]			最大長度
	 * ["minlenght"]			最小長度
	 * ["isemptystring"]		空字串允許 0不可 1可
	 */
// 	$test		= array("a"=>"123'123","b"=>"");
// 	$test2	= array(array("key"=>"a","isemptystring"=>1),array("key"=>"b","isemptystring"=>0));
// 	$s = checkConvey($test,$test2);
function CheckAll($post,$keyArray){
	//移除無定義的key值
	$post = checkKey($post, $keyArray);
	//移除sql注入
	$post = checkSqlInjection($post);
	//移除HTML標籤
	$post = checkHtmlPhpTag($post);
	return $post;
}
function CheckTime($val) {
	date_default_timezone_set("Asia/Taipei");
    $diff = time() - strtotime($val);
        if ($diff < 0) {
            return 'in future';
        } elseif ($diff < 60) {
            return $diff . 'second';
        } elseif ($diff < 3600) {
            return floor($diff/60) . ' 分鐘以前';
        } elseif ($diff < 86400) {
            return floor($diff/3600) . ' 小時以前';
        } elseif ($diff < 604800) {
            return floor($diff/86400) . ' 天以前';
        } else {
            return floor($diff/604800) . ' 週以前';
        }
}
// 登出
	function LogOutAdmin(){
		session_start();
		session_destroy(); //清空session
		return true;
	}
//密碼處理
function password_salt($ac,$pw){
 $pwd=sha1($ac.sha1($pw).sha1($ac));
 //$pwd=password_hash($pwd, PASSWORD_DEFAULT);
 return $pwd;
}
//確認登入狀況
function CheckLogin($link,$account,$password){
 session_start() ;
	$password=password_salt($account,$password);
  //確認帳號是否存在
  $query = "SELECT * FROM `user` WHERE account='$account' ";
  $result   = mysqli_query($link, $query);
  $checkAccount = mysqli_num_rows($result);  //資料筆數
	$check   = mysqli_fetch_assoc($result);  
  if($checkAccount != 1){  
	 //帳號不存在   
		 return 10 ;          
  }  
  elseif($check["is_open"] != 0 ){
   //帳號已經鎖."<br>"
   return 11;   
  }
  elseif(!($password==$check["password"])){
	 return 12; 
  } 
  else{
   $_SESSION['is_user']= true;
   $_SESSION["u_id"] = $check["account"] ;
   $_SESSION["u_name"] = $check["name"]  ;
   $_SESSION["u_rank"] = $check["rank"]  ;
   return 0 ;            
  }
 }
	//登出 FOR 後台
	function loginOutAdmin(){
		session_start();
		session_destroy(); //清空session
		return true;
	}
	//送資訊的 key 是否存在
	function checkConvey($dataArray,$keyArray){
		if(!empty($keyArray)){
			if(!$dataArray){return false;}
			foreach($keyArray as $row){
				if(!isset($dataArray[$row])){ return false;}
			}
		}
		return true;
	}
	
	//移除不該傳入 key
	function checkKey($dataArray,$keyArray){
		if(!empty($keyArray)){
			$dataArray2 = array();
			foreach ($keyArray as $row){
				$dataArray2[$row] = $dataArray[$row];
			}
			$dataArray = $dataArray2;
		}
		return $dataArray ;
	}
	
	//移除sql注入
	function checkSqlInjection($dataArray){
		if(is_array($dataArray)){
			foreach ($dataArray as $key=>$val){
				$dataArray[$key] =  str_replace("'", "\'", str_replace(";", "\;", str_replace("\*", "", str_replace("--", "", $val))));
			}
		}else{
			$dataArray = str_replace("'", "\'", str_replace(";", "\;", str_replace("\*", "", str_replace("--", "", $dataArray))));
		}
		return $dataArray ;
	}
	
	//移除hmtl標籤,script
	function checkHtmlPhpTag($dataArray,$exceptionString = false){
		if(is_array($dataArray)){
			if($exceptionString){
				$exceptionArray = explode(",",$exceptionString);
				foreach($dataArray as $key=>$val){
					if(!in_array($key, $exceptionArray)){
						$val	= preg_replace('/<([^<>]*)>/', '&lt;\1&gt;', $val);
						$val	= preg_replace('/[Jj][Aa][Vv][Aa][Ss][Cc][Rr][Ii][Pp][Tt]/', "", $val);
						$dataArray[$key]	= $val ;
					}
				}
			}else{
				foreach($dataArray as $key=>$val){
					$val	= preg_replace('/<([^<>]*)>/', '&lt;\1&gt;', $val);
					$val	= preg_replace('/[Jj][Aa][Vv][Aa][Ss][Cc][Rr][Ii][Pp][Tt]/', "", $val);
					$dataArray[$key]	= $val ;
				}
			}
		}else{
			$dataArray	= preg_replace('/<([^<>]*)>/', '&lt;\1&gt;', $dataArray);
			$dataArray	= preg_replace('/[Jj][Aa][Vv][Aa][Ss][Cc][Rr][Ii][Pp][Tt]/', "", $dataArray);
		}
// 		$val = preg_replace('/<([^<>]*)>/', '&lt;\1&gt;', $val);
		return $dataArray ;
	}
	
	function changeScript($data){
		return preg_replace('/<[Ss][Cc][Rr][Ii][Pp][Tt]|<\/[Ss][Cc][Rr][Ii][Pp][Tt]|<\/[Hh][Tt][Mm][Ll]|<\/[Bb][Oo][Dd][Yy]|<\?|\?>|<%|%>|<!--|-->/', "", $data);
		
	}
	
	//判斷email格式
	function checkEmail($data){
		return (preg_match("|^[-_.0-9a-z]+@([-_0-9a-z][-_0-9a-z]+\.)+[a-z]{2,3}$|i",$data));
	}
	
	//檢查後台管理者
	function checkAdmin(){
		session_start();
		if(isset($_SESSION['is_user'])){
			return true;
		}else{
			return false;
		}
	}
	
	//檢查權限
	function checkRank($rank,$check_rank){
		if(preg_match("/$rank/i", $check_rank)) {
			return true;
		}else{
			return false;
		}
	}
	
	function checkIsMobile(){
		$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
		$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
		$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
		$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
		$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220|iPad";
		$regex_match.=")/i";
		return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
	}
	
	
	//會員需登入  (cookie)
	function memberIn(){
		if(!isset($_COOKIE[MEMBER_KEY])){
			header("Location:http://".$_SERVER["HTTP_HOST"]."/".BACK_URL);
			exit();
		}
	}
	
	//會員不可登入 (cookie)
	function memberOut(){
		if(isset($_COOKIE[MEMBER_KEY])){
			header("Location:http://".$_SERVER["HTTP_HOST"]."/".BACK_URL);
			exit();
		}
	}
	
	//手機格式驗證
	function checkNotMobile($phone){
		return  ( !preg_match("/09[0-9]{2}[0-9]{6}/", $phone) || strlen($phone) != 10 ) ;
		//!preg_match("/^[0][1-9]{1,3}[-][0-9]{6,8}$/", $phone) ||
	}
	
/*
 * 導頁function(暫放)================================================
 */
	//回上一頁
	function backPrevPage(){
		$url = $_SERVER["HTTP_REFERER"];
		$url = preg_replace('/<([^<>]*)>/', '&lt;\1&gt;', $url);
		header("location:$url");
		exit();
	}
?>