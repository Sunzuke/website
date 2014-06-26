<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//==================================================================================================================================
$post = array();
$get = array();
$cookie = array();
foreach ($_GET as $k=>$v) {
	$_GET[$k] = utf8_decode(str_replace("%", "", strip_tags(addslashes(htmlentities($_GET[$k])))));
	$get[$k] = $v;
}
if(!isset($_SESSION)) session_start();
foreach ($_COOKIE as $k=>$v) {
	$_COOKIE[$k] = utf8_decode(str_replace("%", "", strip_tags(addslashes(htmlentities($_COOKIE[$k])))));
	$cookie[$k] = $v;
}
extract($_COOKIE, EXTR_PREFIX_ALL, "COOKIE");
foreach ($_POST as $k=>$v) {
	$trypost = 1;
	$_POST[$k] = utf8_decode(str_replace("%", "", strip_tags(addslashes(htmlentities($_POST[$k])))));
	if($k == "login" || $k == "password") $_POST[$k] = md5($_POST[$k]);
	setcookie ("$k", $_POST[$k], time()+(60*60*24*31), '/', $_SERVER['HTTP_HOST']);
	$val = "COOKIE_".$k."";
	$$val = $_POST[$k];
	$post[$k] = $v;
}
if(empty($COOKIE_PHPSESSID)) $COOKIE_PHPSESSID = "";
//==================================================================================================================================
extract($_GET, EXTR_PREFIX_ALL, "GET");
//==================================================================================================================================
if(!empty($GET_JavaScriptError)) {
	setcookie ("JavaScriptError", $GET_JavaScriptError, time()+(60*60*24*4), '/', $_SERVER['HTTP_HOST']);
	$COOKIE_JavaScriptError = $GET_JavaScriptError;
}
//==================================================================================================================================
$url = utf8_decode(urldecode($_SERVER['REQUEST_URI']));
$ip = str_replace("%", "", strip_tags(addslashes(getenv("REMOTE_ADDR"))));
$browser = getBrowser();
if(!empty($trypost)) {
	$trypost = 0;
	$newcontent = "";
	if(is_file("".$file."/php/allow_post.txt")) {
		$content = explode('<br />', str_replace(array("\r\n", "\r", "\n"), "", nl2br(file_get_contents("".$file."/php/allow_post.txt"))));
		foreach ($content as $line) {
			$line2 = str_replace('<br />', '', $line);
			if(strpos($line, "[".$browser['name']."][".$ip."][".$COOKIE_PHPSESSID."]") !== false) {
				$trypost = 1;
			} else if(!empty($line2)) {
				$newcontent += "".$line."\n";
			}
		}
		file_put_contents("".$file."/php/allow_post.txt", $newcontent);
	}
	if($trypost == 0) foreach ($_POST as $k=>$v) unset($_POST[$k]);
}
extract($_POST, EXTR_PREFIX_ALL, "POST");
//==================================================================================================================================
date_default_timezone_set('Europe/Berlin');
setLocale(LC_CTYPE, 'FR_fr.ISO-8859-15');
header('Content-Type: text/html; charset=ISO-8859-15');
$timestamp = time();
//==================================================================================================================================
$status = "offline";
$online = 0;
$id = 0;
//==================================================================================================================================
?>