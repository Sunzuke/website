<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//--------------------------------------
if(strpos(file_get_contents("".$file."/php/allow_post.txt"), "[".$browser['name']."][".$ip."][".$COOKIE_PHPSESSID."]") === false) {
	$handle = fopen("".$file."/php/allow_post.txt","a");
	$content = "".file_get_contents("".$file."/php/allow_post.txt")."";
	if(empty($content)) {
		fwrite($handle, "[".date('Y-m-d H:i:s')."][".$browser['name']."][".$ip."][".$COOKIE_PHPSESSID."]");
	} else {
		fwrite($handle, "\n[".date('Y-m-d H:i:s')."][".$browser['name']."][".$ip."][".$COOKIE_PHPSESSID."]");
	}
	fclose($handle);
}

?>