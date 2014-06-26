<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

include "$file/javascript/javascript.php";
include "$file/javascript/ajax.php";
include "$file/javascript/jQuery.php";
if(empty($COOKIE_width)) $COOKIE_width = 1000;
if(empty($COOKIE_height)) $COOKIE_height = 500;
echo "
	<script>
		CheckDocSize($COOKIE_width, $COOKIE_height);
		$(window).resize(function() {
			CheckDocSize($COOKIE_width, $COOKIE_height);
		});
	</script>
";

?>
