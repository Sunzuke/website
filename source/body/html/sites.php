<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//==============================================================================================================
if($ajax) {
	$frame = "ajax";
} else if($popup) {
	$frame = "popup";
} else {
	$frame = "frame";
}
//==============================================================================================================
if($ajax) {
	$open = getOpen($site, $s[1], $s[2]);
	if($open != "flaw") {
		if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
			echo nl2br(file_get_contents("".$site."/".$s[1]."/".$open.""));
		} else {
			include "".$site."/".$s[1]."/".$open."";
		}
	} else {
		$open = getOpen($ajaxes, $s[1], $s[2]);
		if($open != "flaw") {
			if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
				echo nl2br(file_get_contents("".$ajaxes."/".$s[1]."/".$open.""));
			} else {
				include "".$ajaxes."/".$s[1]."/".$open."";
			}
		} else {
			$open = getOpen($popups, $s[1], $s[2]);
			if($open != "flaw") {
				if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
					echo nl2br(file_get_contents("".$popups."/".$s[1]."/".$open.""));
				} else {
					include "".$popups."/".$s[1]."/".$open."";
				}
			}
		}
	}
//==============================================================================================================
} else if($popup) {
	echo "<DIV ID='SITE'>";
		$open = getOpen($popups, $s[1], $s[2]);
		if($open != "flaw") {
			if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
				echo nl2br(file_get_contents("".$popups."/".$s[1]."/".$open.""));
			} else {
				include "".$popups."/".$s[1]."/".$open."";
			}
		} else {
			$open = getOpen($site, $s[1], $s[2]);
			if($open != "flaw") {
				if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
					echo nl2br(file_get_contents("".$site."/".$s[1]."/".$open.""));
				} else {
					include "".$site."/".$s[1]."/".$open."";
				}
			} else {
				$open = getOpen($ajaxes, $s[1], $s[2]);
				if($open != "flaw") {
					if(substr($open, -4) == ".txt" || substr($open, -5) == ".html") {
						echo nl2br(file_get_contents("".$ajaxes."/".$s[1]."/".$open.""));
					} else {
						include "".$ajaxes."/".$s[1]."/".$open."";
					}
				}
			}
		}
	echo "</DIV>";
//==============================================================================================================
} else {
	echo "<DIV ID='SITE' style='width: 100%; height: 100%;'></DIV>";
	$open = "loading...";
}
//==============================================================================================================
if($open == "flaw") {
	$s[2] = "404";
	include "$frames/error/visible.php";
}

?>