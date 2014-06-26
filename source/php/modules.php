<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//==================================================================================================================================
$modules = array();
$extensions = get_loaded_extensions();
$api = php_sapi_name();
if(strpos($api, 'apache') !== false) {
	$api = "APACHE";
	$modules = apache_get_modules();
} else if (substr($api, 0, 3) == 'cgi') {
	$api = "CGI PHP";
	$modules = $extensions;
}
//==================================================================================================================================
//Geo IP Adress
$GeoIP = 0;
if(function_exists("geoip_record_by_name")) {
	$GeoIP = 1;
	$location = geoip_record_by_name($ip);
	if(!is_array($location)) $GeoIP = 0;
}
//==================================================================================================================================
//SQL
if(function_exists("mysql_connect")) {
	if($sql) {
		if($sql_ip) {
			//========================================================
			//SQL Connection
			$sql = mysql_connect($sql_ip, $sql_user, $sql_pass);
			if(!$sql) die("<br>Failed to connect to <b>".$sql_ip."</b> SQL Server.");
			//SQLi Connection
			$sqli = new mysqli($sql_ip, $sql_user, $sql_pass, $sql_db[0]);
			if($sqli->connect_errno) die("<br>Failed to connect to <b>".$sql_ip."</b> SQLi Server.<br>".$sqli->connect_error."");
			//========================================================
			//Getting Database using the old SQL way (Not recommended)
			$query = mysql_query("SHOW DATABASES");
			$dbss = array();
			$db = array();
			while($row = mysql_fetch_array($query)) $dbss[] = "".$row[0]."";
			foreach($sql_db as $dbs) {
				if(!in_array($dbs, $dbss)) die("Database $dbs has not been found on the server.<br>");
				$query = mysql_query("SHOW TABLES FROM `$dbs`");
				while($row = mysql_fetch_array($query)) $db[$row[0]] = $dbs;
			}
		} else {
			die("No SQL Connection selected but setted as online in config.php");
		}
	}
} else {
	$sql = 0;
}
//==================================================================================================================================
//SSH
if(function_exists("ssh2_connect")) {
	if($ssh) {
		if($ssh_ip) {
			$ssh = ssh2_connect($ssh_ip,22);
			if(!$ssh) die("Failed to connect to SSH.<br>");
			if(!ssh2_auth_password($ssh, $ssh_user, $ssh_pass)) {
				ssh2_exec($ssh, 'exit');
				unset($ssh);
				die("Failed to login at SSH.<br>");
			} else {
				ssh2_exec($ssh, "epsv4 off");
			}
		} else {
			die("No SSH Connection selected, but setted as online in config.php.");
		}
	}
} else {
	$ssh = 0;
}
//==================================================================================================================================
?>