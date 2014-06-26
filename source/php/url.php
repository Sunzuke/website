<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//===============================================================================================================================================================
if(empty($url)) $url = utf8_decode(urldecode(str_replace($folder, '', $_SERVER['REQUEST_URI'])));
$forbitten_tags = array('%', '>', '"', ';', '</script>');
$url = str_replace($forbitten_tags, "", $url);
$url = strip_tags(addslashes($url));
if(substr($url, -1) == "/") $url = substr($url, 0, -1);
if(empty($url) || $url == "") $url = "/";
$s = explode('/', str_replace("".$base."/", '', $url));
for ($i = 0; $i <= 10; $i++) if(empty($s[$i])) $s[$i] = "";
if(empty($s[1]) || $s[1] == "" || substr($s[1], 0, 1) == "?" || substr($s[1], 0, 1) == "#") $s[1] = "index";
if(empty($s[2]) || $s[2] == "") $s[2] = "index";
//===============================================================================================================================================================
$d = explode('.', $_SERVER['HTTP_HOST']);
$blanksite = "".$d[count($d)-2].".".$d[count($d)-1]."";
if(!empty($d[count($d)-3])) {
	$subdomain = $d[count($d)-3];
} else {
	echo "<meta http-equiv='refresh' content='0; URL=http://www.".$blanksite."".$url."'>";
	exit;
}
$coresite = "www.".$blanksite."";
$website = "".$subdomain.".".$blanksite."";
?>
