<?php
/*	Please set the following paths / variables:
		$folder and $base in php/index.php
		webfolder in javascript/ajax.php
		paths in body/css			*/
	define('Pascal Salesch', true);
	$filelist = array(__FILE__);
	$realpath = realpath(dirname(__FILE__));
	$index = "".str_replace('\\', '/', $realpath)."";
	$source = "source";
	if(!is_file("$index/$source/php/index.php")) {
		echo "	Failed to open <i>$index/$source/php/index.php</i><br>
				Please update \$index in index.php						";
	} else {
		include "$index/$source/php/index.php";
		if($s[1] == "heartbeat") {
			// - loaded every second in an hidden div element
			include "$heart/index.php";
		} else if($s[1] == "ajax") {
			// - loaded on special calls
			// - does not support javascript/ajax/jQuery
			// - does not load themedir/heartbeat
			// - Variables: $ajax, $ajaxes
			include "$frames/ajax.php";
		} else if($s[1] == "popup") {
			// - loaded on special calls
			// - does not load themedir/heartbeat
			// - Variables: $popup, $popups
			include "$file/javascript/index.php";
			include "$frames/popup.php";
		} else {
			include "$file/javascript/index.php";
			include "$file/body/index.php";
			include "$heart/beat.php";
		}
		if(!empty($ssh) && $ssh) {		ssh2_exec($ssh, 'exit');	unset($ssh);		}
		if(!empty($sql) && $sql) {		mysql_close($sql);			unset($sql);		}
	}
?>