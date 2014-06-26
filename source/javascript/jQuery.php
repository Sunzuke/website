<?php
	if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
	echo "<script src='".$base."/".$source."/javascript/jquery-2.0.3.js'></script>";
?>
<script>
	if(!isFunction(jQuery)) {
		alert("Error: jQuery library has not been found!\nPlease check out /javascript/jQuery.php line 2");
	} else {
		$(document).ready(
			function() {
				$("input[type=text]:first", document.forms[0]).focus();
				$("input[type=text]").blur(
					function() {
						reload('InvisibleUpdate', 'ajax/post');
					}
				);
			}
		);
		$(document).mousemove(function(event) {
			var MouseX = event.pageX;
			var MouseY = event.pageY;
			if(document.getElementById("ContextMenu").style.display != "block") {
				var ContextMenuWidth = parseInt(document.getElementById("ContextMenu").style.width);
				var ContextMenuHeight = parseInt(document.getElementById("ContextMenu").style.height);
				if(MouseX+ContextMenuWidth+50 < parseInt(window.innerWidth)) {
					document.getElementById("ContextMenu").style.left = ""+MouseX+"px";
				}
				if(MouseY+ContextMenuHeight+50 < parseInt(window.innerHeight)) {
					document.getElementById("ContextMenu").style.top = ""+MouseY+"px";
				}
			}
		});
	}
</script>