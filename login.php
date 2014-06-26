<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

	$htime = $timestamp-60*60;//1 user expected in $htime seconds
	$ttime = $timestamp-10; //tolerance time
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
		AND `lastlogin` > '".date('Y-m-d H:i:s', $htime)."'
	";
	$resource = $sqli->query($query);
	$resource->data_seek(0);
	while($row = $resource->fetch_assoc()) {
		$query2 = "
			SELECT * FROM $db[log].`log`
			WHERE `ID` LIKE '".$row['ID']."'
			AND `type` LIKE 'user'
			AND `event` LIKE 'logout'
			AND `time` >= '".$row['lastlogin']."'
		";
		$resource2 = $sqli->query($query2);
		if(!$resource2 || $resource2->num_rows == 0) {
			$logouttime = strtotime($row['lastlogin']);
			$query3 = "
				INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
				VALUES ('".$row['ID']."', 'user', '".date('Y-m-d H:i:s', $logouttime)."', 'logout', '".$row['ip']."');
			";
			$resource3 = $sqli->query($query3);
			$logouttime = "";
		}
	}
	//============================================================================
	//Guest Logout Log
	$query = "
		SELECT * FROM $db[guest].`guest`
		WHERE `lastlogin` < '".date('Y-m-d H:i:s', $ttime)."'
		AND `lastlogin` > '".date('Y-m-d H:i:s', $htime)."'
	";
	$resource = $sqli->query($query);
	$resource->data_seek(0);
	while($row = $resource->fetch_assoc()) {
		$query2 = "
			SELECT * FROM $db[log].`log`
			WHERE `ID` LIKE '".$row['ID']."'
			AND `type` LIKE 'guest'
			AND `event` LIKE 'logout'
			AND `time` >= '".$row['lastlogin']."'
		";
		$resource2 = $sqli->query($query2);
		if(!$resource2 || $resource2->num_rows == 0) {
			$logouttime = strtotime($row['lastlogin']);
			$query3 = "
				INSERT INTO $db[log].`log` (`ID`, `type`, `time`, `event`, `value`)
				VALUES ('".$row['ID']."', 'guest', '".date('Y-m-d H:i:s', $logouttime)."', 'logout', '".$row['ip']."');
			";
			$resource3 = $sqli->query($query3);
			$logouttime = "";
		}
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
			$query = "UPDATE $db[user].`user` SET `lastlogin`='".date('Y-m-d H:i:s')."' WHERE `ID` LIKE '".$ID."'";
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
		$query = "UPDATE $db[guest].`guest` SET `lastlogin`='".date('Y-m-d H:i:s')."' WHERE `ID` LIKE '".$ID."'";
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

?>