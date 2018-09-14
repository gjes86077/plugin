<?
	$DIR='../system/config.php';
	include_once $DIR ;
	$key = array('title' ,  'address' ,'youtube_channel', 'location' , 'service' , 'keyword' , 'desc' , 'ga'  );
	$p = CheckAll($_POST,$key);
	if (isset($_POST['update_profile'])) {
		$str = htmlspecialchars($p['ga'],ENT_QUOTES);
		$profile=UpdateById($link, 'inf', 
			array(
				"title" => $p['title'],
				"keyword" => $p['keyword'],
				"desc" => $p['desc'],
				"ga" => $str)
		,0);
		$loc=split(",",$p['location']);
		$new=UpdateById($link, 'inf',array(
				"youtube_channel" => $p['youtube_channel'],
				"paramount_tel" => $p['paramount_tel'],
				"paramount_mail" => $p['paramount_mail'],
				"pacific_tel" => $p['pacific_tel'],
				"pacific_mail" => $p['pacific_mail'],
				"address" => $p['address'],
				"service" => $p['service'],
				"lat" => $loc[0],
				"lng" => $loc[1],
				),0);
	if ($profile && $new) {
		backPrevPage();
		exit();
	} else {
		echo "ERROR:資料未更新";
		exit();
	}
}	
?>