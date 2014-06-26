<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//--------------------------------------
$alphas = array_merge(range('A', 'Z'), range('a', 'z'));
$allowed_dbs = array();
if(!empty($s[1]) && in_array($s[1], $allowed_dbs)) {
	if(empty($s[3])) $s[3] = "ID";
	$column = str_replace($alphas, '', $s[3]);
	if(!empty($s[2]) && $column == "") {
		$column = str_replace($alphas, '', $s[2]);
		if(is_numeric($s[2]) || $column == "") {
			$table = $s[1];
			$value = $s[2];
			$colum = $s[3];
			$query = "SELECT * FROM $db[$table].`".$table."` WHERE `".$colum."` LIKE '".$value."'";
			$resource = $sqli->query($query);
			$resource->data_seek(0);
			while($row = $resource->fetch_assoc()) {
				foreach($row as $key => $value) {
					echo "$key=$value;";
				}
				echo "<br>";
			}
		}
	}
}
?>