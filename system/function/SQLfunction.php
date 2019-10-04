<?
//SQL Select * 無條件
function SelectCustom($link,$sql,$i=0){
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectLastID($link,$i=0){
	$sql="SELECT LAST_INSERT_ID() as id";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray[0]['id'];
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectNConditionOrderLimit($link,$table,$order=array('order'=>'desc'),$page,$amount,$i=0){
	$data	= "";
	foreach($order as $key => $val){
		$comma = "`";	//逗點
		if($data != "")
			$comma = ",`";
		$data.=$comma.$key."`  ".$val;
	}
	$page--;
	$num=$page*$amount;
	$sql="SELECT * FROM `".$table."` ORDER BY $data limit $num,$amount";
	$sql2="SELECT count(id) as count FROM `".$table."`";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		$result = mysqli_query($link, $sql2);
		$row = mysqli_fetch_assoc($result);
		if ($row['count']>=1) {
			$dataArray[0]['total_count']=$row['count'] ;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectConditionOrderLimit($link,$table,$column,$condition,$order=array('order'=>'desc'),$page,$amount,$i=0){
	$data	= "";
	foreach($order as $key => $val){
		$comma = "`";	//逗點
		if($data != "")
			$comma = ",`";
		$data.=$comma.$key."`  ".$val;
	}
	$page--;
	$num=$page*$amount;
	$sql="SELECT * FROM `".$table."` WHERE $column = '$condition' ORDER BY $data limit $num,$amount";
	$sql2="SELECT count(id) as count FROM `".$table."` WHERE $column = '$condition'";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		$n=0;
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
			$n++;
		}
		$result = mysqli_query($link, $sql2);
		$row = mysqli_fetch_assoc($result);
		if ($row['count']>=1) {
			$dataArray[0]['total_count']=$row['count'] ;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectNCondition($link,$table,$i=0){
	$sql="SELECT * FROM `".$table."`";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectUnread($link,$i=0){
	$sql="SELECT * FROM `contact` where `read`=0";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function MessageCount($link,$i=0){
	$sql="SELECT count(`id`) as count FROM `contact` WHERE `read` = 0";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray[0]['count'];
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectNConditionOrder($link,$table,$sort=array('sort'=>'desc'),$i=0){
	$data	= "";
	foreach($sort as $key => $val){
		$comma = "`";	//逗點
		if($data != "")
			$comma = ",`";
		$data.=$comma.$key."`  ".$val;
	}
	$sql="SELECT * FROM `".$table."` ORDER BY $data ";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectCondition($link,$table,$column_condition,$i=0){
	foreach ($column_condition as $key => $val) {
		$comma = "`"; //逗點
		if ($Cdata != "") {
			$comma = " and `";
		}
		$Cdata .= "{$comma}{$key}`='$val'";
	}
	$sql="SELECT * FROM `".$table."` WHERE $Cdata";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function SelectConditionOrder($link,$table,$column_condition,$sort=array('sort'=>'desc'),$i=0){
	$data	= "";
	foreach($sort as $key => $val){
		$comma = "`";	//逗點
		if($data != "")
		$comma = ",`";
		$data.=$comma.$key."`  ".$val;
	}
	$Cdata	= "";
	foreach($column_condition as $key => $val){
		$comma = "`";	//逗點
		if($Cdata != "")
			$comma = " and `";
		$Cdata.="{$comma}{$key}`='$val'";
	}
	$sql="SELECT * FROM `".$table."` WHERE $Cdata ORDER BY $data ";
	if ($i ==0) {
		$result = mysqli_query($link, $sql);
		$dataArray =array();
		while ($row = mysqli_fetch_assoc($result)){
			$dataArray[] = $row;
		}
		return $dataArray;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
//---修改---//
function UpdateRead($link,$i=0){
	$sql = "UPDATE  `contact` SET `read`=1 WHERE `read`=0";
	if ($i == 0) {
		$result = @mysqli_query($link, $sql);
		return $result;
		// mysqli_insert_id always return 0
		if($result){
			return (mysqli_insert_id($link));
		}
		else{
			return false;
		}
	}
	else
	{
		echo "$sql\n";
		exit();
	}
}
function UpdateById($link,$table,$column_list,$id,$i=0){
	$data	= "";
	foreach($column_list as $key => $val){
		$comma = "`";	//逗點
		if($data != ""){
			$comma = ",`";
		}
		$data.=$comma.$key."` = '".$val."'";
	}
	$sql = "UPDATE  `$table` SET $data WHERE `id`='".$id."'";
	if ($i == 0) {
		$result = @mysqli_query($link, $sql);
		return $result;
		// mysqli_insert_id always return 0
		if($result){
			return (mysqli_insert_id($link));
		}
		else{
			return false;
		}
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function UpdateByCustom($link,$table,$column_list,$column_condition,$i=0){
	$data	= "";
	foreach($column_list as $key => $val){
		$comma = "`";	//逗點
		if($data != ""){
			$comma = ",`";
		}
		$data.=$comma.$key."` = '".$val."'";
	}
	foreach ($column_condition as $key => $val) {
		$comma = "`"; //逗點
		if ($Cdata != "") {
			$comma = " and `";
		}
		$Cdata .= "{$comma}{$key}`='$val'";
	}
	$sql = "UPDATE  `$table` SET $data WHERE $Cdata";
	if ($i == 0) {
		$result = @mysqli_query($link, $sql);
		return $result;
		// mysqli_insert_id always return 0
		if($result){
			return (mysqli_insert_id($link));
		}
		else{
			return false;
		}
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
function UpdateCustom($link,$sql,$i=0){
	if ($i == 0) {
		$result = @mysqli_query($link, $sql);
		return $result;
		// mysqli_insert_id always return 0
		if($result){
			return (mysqli_insert_id($link));
		}
		else{
			return false;
		}
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
//---刪除---//
function DeleteById($link, $table, $column='id', $condition,$i=0) {
	$sql="DELETE FROM `".$table."` WHERE $column = '$condition'";
	if ($i == 0) {
		$result = mysqli_query($link, $sql);
		return $result;
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
//---新增---//
function InsertOne($link,$table,$column_list,$i=0){
	$fields	= "";
	$data	= "";
	foreach($column_list as $key => $val){
		$comma = "";	//逗點
		if($fields != ""){
			$comma = ",";
		}
		if($val == "NOW()" || $val=="now()"){
			$fields	.= " $comma`$key` " ;
			$data		.= " $comma$val ";
			continue;
		}
		$fields	.= " $comma`$key` " ;
		$data		.= " $comma'$val' ";
	}
	$sql = "INSERT INTO `$table` ($fields) VALUES ($data) ";
	if ($i == 0) {
		$result = @mysqli_query($link, $sql);
		return $result;
		// mysqli_insert_id always return 0
		if($result){
			return (mysqli_insert_id($link));
		}
		else{
			return false;
		}
	}
	else
	{
		echo "$sql \n";
		exit();
	}
}
?>
