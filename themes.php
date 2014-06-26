<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//========================================================
$title = "Untitled";
$theme = "theme";
//========================================================
$themepath = "".$theme."";
if(!is_dir("".$index."/".$themepath."")) {
	if(is_dir("".$index."/themes/".$themepath."")) {
		$themepath = "themes/$themepath";
	} else {
		$theme = "theme";
		$themepath = "themes/$theme";
	}
}
$themedir = "".$index."/".$themepath."";
//========================================================

?>