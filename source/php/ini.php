<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

set_time_limit(3);
ini_set('allow_url_include', '0');
ini_set('register_globals', '0');
ini_set('session.use_only_cookies', '1');
if($debug) {
	ini_set('display_errors', '1');
	ini_set('error_reporting', E_ALL);
	ini_set('display_startup_errors', '1');
	ini_set('log_errors', '0');
	ini_set('ignore_repeated_errors', '1');
	ini_set('report_memleaks', '1');
	ini_set('track_errors', '0');
	ini_set('html_errors', '1');
	//ini_set('error_log', NULL);
} else {
	ini_set('display_errors', '0');
	ini_set('error_reporting', '0');
	ini_set('display_startup_errors', '0');
	ini_set('log_errors', '0');
	ini_set('ignore_repeated_errors', '1');
	ini_set('report_memleaks', '0');
	ini_set('track_errors', '0');
	ini_set('html_errors', '0');
	ini_set('error_log', NULL);
}


?>