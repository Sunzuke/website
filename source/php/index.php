<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//==================================================================================================================================
$start = microtime(true);
//Path to files beggining from Website Path
//Don't forget to change webfolder in ajax.php
$folder = "";
//Image and Backgrounds URL Path
$base = "http://host-z.no-ip.org".$folder."";
//Website Path inside the Root
$file = "".$index."/".$source."";
//==================================================================================================================================
//Where is the heart?
$heart = "".$index."/heart";
//Folder for Website Content
$frames = "".$index."/frames";
//Folder where site frames are
$site = "".$frames."/site";
//Folder where popup frames are
$popups = "".$frames."/popup";
//Folder where ajax elements are
$ajaxes = "".$frames."/ajax";
//==================================================================================================================================
include "$file/php/config.php.inc";
include "$file/php/ini.php";
include "$file/php/modules.php";
include "$file/php/function.php";
include "$file/php/variables.php";
include "$file/php/url.php";
if($sql) {
	include "$index/login.php";
	include "$file/php/payments/index.php";
}
include "$index/themes.php";
//==================================================================================================================================
if(is_file("".$file."/php/allow_post.txt")) {
	if(filemtime("".$file."/php/allow_post.txt") < round($timestamp-(60*60*4))) file_put_contents("".$file."/php/allow_post.txt", "");
}
//==================================================================================================================================
?>