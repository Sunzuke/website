<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

include "".$file."/body/css/index.php";
include "".$file."/body/html/watermark.php";
if(empty($popup)) $popup = 0;
if(empty($ajax)) {
	$ajax = 0;
	include "".$index."/frames/error/invisible.php";
	include "".$file."/body/objects/loading.php";
	include "".$file."/body/objects/contextmenu.php";
	if(empty($popup)) {
		echo "	<DIV ID='InvisibleUpdate' style='display: none; width: 0px; height: 0px;'></DIV>
				<BODY
					style=\"
						overflow-y: scroll;
						overflow-x: hidden;
					\"
					OnLoad=\"
						link('".substr($url, 1)."');
						OnLoadEvent();
					\"
					OnKeyDown=\"OnKeyDownEvent(GetKey());\"
					OnKeyPress=\"OnKeyPressEvent(GetKey());\"
					OnKeyUp=\"OnKeyUpEvent(GetKey());\"
				>";
	echo "			<TABLE ID='THEME' WIDTH='100%' HEIGHT='100%'
						STYLE=\"
							border-right: 1px solid #d9d9d9;
							BACKGROUND-COLOR: #ffffff;
						\"
						OnMouseDown=\"
							if(document.getElementById('ContextMenu').style.display == 'block') {
								document.getElementById('ContextMenu').style.display = 'none';
								document.getElementById('ContextMenu').innerHTML == '';
							}
						\"
					>
						<TR>
							<TD>
								<DIV ID='WEBSITE' style=\"WIDTH: 100%; HEIGHT: 100%;\">
									<TABLE width='100%' height='100%'>
										<TR valign='top'>
											<TD align='left'>";
												if(is_file("".$themedir."/index.php") && $popup == 0) {
													include "".$themedir."/index.php";
												} else {
													include "".$file."/body/html/sites.php";
												}
	echo "									</TD>
										</TR>
									</TABLE>
								</DIV>
							</TD>
						</TR>
					</TABLE>
				</BODY>";
	} else {
		include "".$file."/body/html/sites.php";
	}
} else {
	include "".$file."/body/html/sites.php";
}

?>