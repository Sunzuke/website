<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
	//============================================================================
	$sqli->query("
		CREATE TABLE IF NOT EXISTS ".$sql_db[0].".`user` (
		  `ID` int(255) NOT NULL AUTO_INCREMENT,
		  `login` varchar(255) NOT NULL DEFAULT '',
		  `password` varchar(255) NOT NULL DEFAULT '',
		  `online` int(11) NOT NULL DEFAULT '0',
		  `lastlogin` varchar(255) NOT NULL DEFAULT '',
		  `lastip` varchar(255) NOT NULL DEFAULT '',
		  PRIMARY KEY (`ID`),
		  UNIQUE KEY `ID` (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
	");
	$sqli->query("
		CREATE TABLE IF NOT EXISTS ".$sql_db[0].".`guest` (
		  `ID` int(11) NOT NULL AUTO_INCREMENT,
		  `session` varchar(255) NOT NULL DEFAULT '',
		  `ip` varchar(255) NOT NULL DEFAULT '',
		  `online` int(11) NOT NULL DEFAULT '0',
		  `lastlogin` varchar(255) NOT NULL DEFAULT '',
		  PRIMARY KEY (`ID`),
		  UNIQUE KEY `ID` (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
	");
	$sqli->query("
		CREATE TABLE IF NOT EXISTS ".$sql_db[0].".`log` (
		  `ID` int(11) NOT NULL,
		  `type` varchar(255) NOT NULL,
		  `time` varchar(255) NOT NULL,
		  `event` varchar(255) NOT NULL,
		  `value` varchar(255) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	//============================================================================
	$htime = $timestamp-60*60;//1 user expected in $htime seconds
	$ttime = $timestamp-5; //tolerance time
	//============================================================================
	//Logout
	if($s[1] == "logout") {
		setcookie('login', "", time()-1, '/', $_SERVER['HTTP_HOST']);
		setcookie('password', "", time()-1, '/', $_SERVER['HTTP_HOST']);
		$COOKIE_login = "";
		$COOKIE_password = "";
		$s[1] = "index";
		$url = "/index";
		//echo "<meta http-equiv='refresh' content='0; URL=".$base."'>";
		//exit;
	}
	//============================================================================
	//User Logout Log
	$query = "
		SELECT * FROM $db[user].`user`
		WHERE `lastlogin` < '".date('Y-m-d H:i:s', $ttime)."'
		AND `online` LIKE '1'
		LIMIT 0,10
	";
	$resource = $sqli->query($query);
	$resource->data_seek(0);
	while($row = $resource->fetch_assoc()) {
		$query2 = "
			INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
			VALUES ('".$row['ID']."', 'user', '".$row['lastlogin']."', 'logout', '".$row['ip']."');
		";
		$resource2 = $sqli->query($query2);
		$query3 = "UPDATE $db[user].`user` SET `online`='0' WHERE `ID` LIKE '".$row['ID']."'";
		$resource3 = $sqli->query($query3);
	}
	//============================================================================
	//Guest Logout Log
	$query = "
		SELECT * FROM $db[guest].`guest`
		WHERE `lastlogin` < '".date('Y-m-d H:i:s', $ttime)."'
		AND `online` LIKE '1'
		LIMIT 0,10
	";
	$resource = $sqli->query($query);
	$resource->data_seek(0);
	while($row = $resource->fetch_assoc()) {
		$query2 = "
			INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
			VALUES ('".$row['ID']."', 'guest', '".$row['lastlogin']."', 'logout', '".$row['ip']."');
		";
		$resource2 = $sqli->query($query2);
		$query3 = "UPDATE $db[guest].`guest` SET `online`='0' WHERE `ID` LIKE '".$row['ID']."'";
		$resource3 = $sqli->query($query3);
	}
	//============================================================================
	//User Login
	if(!empty($COOKIE_login) && !empty($COOKIE_password)) {
		$query = "
			SELECT * FROM $db[user].`user`
			WHERE `login` LIKE '".$COOKIE_login."'
			AND `password` LIKE '".$COOKIE_password."'
		";
		$resource = $sqli->query($query);
		if($resource && $resource->num_rows > 0) {
			$online = 1;
			$resource->data_seek(0);
			$row = $resource->fetch_assoc();
			foreach($row as $key => $value) $$key = $value;
			$query = "
				UPDATE $db[user].`user`
				SET	`lastlogin`='".date('Y-m-d H:i:s')."', `online`='1'
				WHERE `ID` LIKE '".$ID."'";
			$sqli->query($query);
		}
	}
	//============================================================================
	//Guest Login
	if(!$online) {
		$query = "SELECT * FROM $db[guest].`guest` WHERE `session` LIKE '".$COOKIE_PHPSESSID."'";
		$resource = $sqli->query($query);
		if(!$resource || $resource->num_rows == 0) {
			$query = "
				INSERT INTO $db[guest].`guest` (`session`, `ip`, `lastlogin`)
				VALUES ('$COOKIE_PHPSESSID', '$ip', '".date('Y-m-d H:i:s')."');
			";
			$resource = $sqli->query($query);
			$query = "SELECT * FROM $db[guest].`guest` WHERE `session` LIKE '".$COOKIE_PHPSESSID."'";
			$resource = $sqli->query($query);
		}
		$resource->data_seek(0);
		$row = $resource->fetch_assoc();
		foreach($row as $key => $value) $$key = $value;
		$online = 0;
		$query = "
			UPDATE $db[guest].`guest`
			SET `lastlogin`='".date('Y-m-d H:i:s')."',`online`='1'
			WHERE `ID` LIKE '".$ID."'
		";
		$sqli->query($query);
	}
	$UserID = $ID;
	if($online) { $type = "user"; } else { $type = "guest"; }
	//============================================================================
	//IP Log
	if($online) {
		$query = "
			SELECT * FROM $db[log].`log`
			WHERE `ID` LIKE '".$UserID."'
			AND `type` LIKE '$type'
			AND `event` LIKE 'ip'
			AND `value` LIKE '$ip'
		";
		$resource = $sqli->query($query);
		if(!$resource || $resource->num_rows == 0) {
			$query = "
				INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
				VALUES ('$UserID', '$type', '".date('Y-m-d H:i:s')."', 'ip', '$ip');
			";
			$resource = $sqli->query($query);
		}
	}
	//============================================================================
	//Login Log
	$query = "
		SELECT * FROM $db[log].`log`
		WHERE `ID` LIKE '".$UserID."'
		AND `type` LIKE '$type'
		AND `event` LIKE 'login'
		ORDER BY `time` DESC
		LIMIT 0,1
	";
	$sqli->query($query);
	$resource = $sqli->query($query);
	if(!$resource || $resource->num_rows == 0) {
		$query = "
			INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
			VALUES ('$UserID', '$type', '".date('Y-m-d H:i:s')."', 'login', '$ip');
		";
		$resource = $sqli->query($query);
	} else {
		$row = $resource->fetch_assoc();
		foreach($row as $key => $value) $$key = $value;
		$query = "
			SELECT * FROM $db[log].`log`
			WHERE `ID` LIKE '".$UserID."'
			AND `type` LIKE '$type'
			AND `event` LIKE 'logout'
			AND `time` > '$time'
		";
		$sqli->query($query);
		$resource = $sqli->query($query);
		if($resource && $resource->num_rows > 0) {
			$query = "
				INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
				VALUES ('$UserID', '$type', '".date('Y-m-d H:i:s')."', 'login', '$ip');
			";
			$resource = $sqli->query($query);
		}
	}
	//============================================================================
	//Status Check
	function getStatus($ID) {
		global $sqli;
		global $db;
		global $ttime;
		$query = "
			SELECT * FROM $db[user].`user`
			WHERE `ID` LIKE '".$ID."'
		";
		$resource = $sqli->query($query);
		if($resource && $resource->num_rows > 0) {
			$row=mysqli_fetch_assoc($result);
			if($row['lastlogin'] > $ttime) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	//============================================================================
?>