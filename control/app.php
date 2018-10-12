<?
	header("Content-type:application/json");
	require_once '../system/config.php';
  $p=CheckAll($_POST,array('ac','pw'));
  echo json_encode(password_salt($p['ac'],$p['pw']));

?>
