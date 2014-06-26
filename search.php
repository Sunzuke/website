<?php
function readdirec($direc, $search) {
	if ($handle = opendir($direc)) {
		while (false !== ($file = readdir($handle))) {
			if($file != "." && $file != "..") {
				if(is_dir("$direc/$file")) {
					readdirec("$direc/$file", $search);
				} else {
					if(strpos(file_get_contents("$direc/$file"), $search) !== false) {
						echo "$direc/$file<br>";
					}
				}
			}
		}
	}
}

$realpath = realpath(dirname(__FILE__));
$index = "".str_replace('\\', '/', $realpath)."";
readdirec($index, 'InvisibleUpdate');


?>