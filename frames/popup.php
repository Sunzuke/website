<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
$popup = 1;
$frame = "popup";
//--------------------------------------
$url = str_replace($folder, '', $url);
for($i = 0; $i < sizeof($s); $i++) if(!empty($s[$i+1])) $s[$i] = $s[$i+1];
unset($s[round(sizeof($s)-1)]);
$url = substr($url, 5);
//--------------------------------------
include "".$file."/body/index.php";
//--------------------------------------
?>