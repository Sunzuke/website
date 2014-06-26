<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

echo "<link rel='stylesheet' type='text/css' href='".$base."/".$source."/body/css/default.css'></link>";

if(strpos(strtolower($browser['userAgent']), 'webkit') !== false) {
	echo "<link rel='stylesheet' type='text/css' href='".$base."/".$source."/body/css/webkit.css'></link>";
}

if(is_file("".$file."/body/css/".$theme.".css")) {
	echo "<link rel='stylesheet' type='text/css' href='".$base."/".$source."/body/css/".$theme.".css'></link>";
}

?>