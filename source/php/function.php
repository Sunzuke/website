<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

function getOpen($fpath, $furl, $ffile) {
	global $online;
	//=========================================================================
	if(!is_dir("".$fpath."/".$furl."") || $furl == "flaw") {
		$open = "flaw";
		return $open;
	}
	//=========================================================================
	//$s[2].php -> online.txt/php -> index.txt/php -> offline.txt/php -> Any
	if(is_file("".$fpath."/".$furl."/".$ffile.".php")) {
		$open = "".$ffile.".php";
	} else if(is_file("".$fpath."/".$furl."/online.txt") && $online) {
		$open = "online.txt";
	} else if(is_file("".$fpath."/".$furl."/online.php") && $online) {
		$open = "online.php";
	} else if(is_file("".$fpath."/".$furl."/index.txt")) {
		$open = "index.txt";
	} else if(is_file("".$fpath."/".$furl."/index.php")) {
		$open = "index.php";
	} else if(is_file("".$fpath."/".$furl."/offline.txt")) {
		$open = "offline.txt";
	} else if(is_file("".$fpath."/".$furl."/offline.php")) {
		$open = "offline.php";
	} else {
		//Any File
		if($handle = opendir("".$fpath."/".$furl."")) {
			while (false !== ($dir = readdir($handle))) {
				if($dir != ".." && $dir != "." && (substr($dir, -4) == ".txt" || substr($dir, -5) == ".html" || substr($dir, -4) == ".php")) {
					if(strpos($dir, 'online') === false || $online) {
						$open = $dir;
					}
				}
			}
		}
	}
	//=========================================================================
	//Error Not Found
	if(empty($open)) {
		$open = "error.php";
		$s[1] = "";
	}
	//=========================================================================
	return $open;
}

function getBrowser() { 
	$u_agent = $_SERVER['HTTP_USER_AGENT']; 
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} else if(preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} else if(preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
		$bname = 'Internet Explorer'; 
		$ub = "MSIE"; 
	} else if(preg_match('/Firefox/i',$u_agent)) { 
		$bname = 'Mozilla Firefox'; 
		$ub = "Firefox"; 
	} else if(preg_match('/Chrome/i',$u_agent)) { 
		$bname = 'Google Chrome'; 
		$ub = "Chrome"; 
	} else if(preg_match('/Safari/i',$u_agent)) { 
		$bname = 'Apple Safari'; 
		$ub = "Safari"; 
	} else if(preg_match('/Opera/i',$u_agent)) { 
		$bname = 'Opera'; 
		$ub = "Opera"; 
	} else if(preg_match('/Netscape/i',$u_agent)) { 
		$bname = 'Netscape'; 
		$ub = "Netscape"; 
	} else {
		$bname = 'Internet Explorer'; 
		$ub = "MSIE"; 
	}
	
	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if(strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		} else {
			if(!empty($matches['version'][1])) {
				$version= $matches['version'][1];
			} else {
				$version = "Unknown";
			}
		}
	} else {
		$version= $matches['version'][0];
	}
	
	// check if we have a number
	if ($version==null || $version=="") $version="?";

	return array(
		'userAgent' => $u_agent,
		'name'	  => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'	=> $pattern
	);
}

function get_url() {
	$ps = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
	$protocol = substr($sp, 0, strpos($sp, "/")) . $ps;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	$return = "".$protocol."://".$_SERVER['SERVER_NAME']."".$port."".$_SERVER['REQUEST_URI']."";
	return addslashes(utf8_decode(strip_tags(htmlentities(urldecode($return)))));
}

?>