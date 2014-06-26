<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

if(empty($COOKIE_JavaScriptError) || $COOKIE_JavaScriptError != "hide") {
echo "	<noscript>
			<html>
				<div ID='JavaScriptEr'
					style='
						z-index: 100;
						position: fixed;
						width: 100%;
						height: 100%;
						background-color: #FFFFFF;
						color: #000000;
						padding: 20px;
					'
				>
					<h1>JavaScript Error</h1><br>
					Couldn't start the application <b>JavaScript</b>. Change your ".$browser['name']." Settings to avoid this error.<br>
					<br>
					Almost all of our applications are running per JavaScript, however you can disable this error message 
					and keep on surfing by visiting: <a href='/?JavaScriptError=hide'><i><b>HIDE ERROR MESSAGE</b></i></a><br>
					<b>Warning:</b> This will not change your JavaScript settings! It will only remove the error display!<br>
					<b>Warning:</b> Some other Error checks, such as a <b>Cookie check</b> are running via JavaScript.
					Please make sure that <b>Cookies</b> are enabled!
					If you keep on getting this message although you hide it once, cookies are disabled!
					<br>
				</div>
			</html>
		</noscript>";
}

echo "	<div ID='CookieEr'
			style='
				z-index: 100;
				position: fixed;
				width: 100%;
				height: 100%;
				background-color: #FFFFFF;
				color: #000000;
				padding: 20px;
				display: none;
			'
		>
				<h1>Cookie Error</h1><br>
				Couldn't set Cookies. Please allow us to set <b>Cookies</b>.
				Change your ".$browser['name']." Settings to avoid this error.<br>
				<br>
				Almost all of our applications are using Cookies. This page can't work without Cookies.<br>
				Cookies are used to store Website information on your local machine, i.e.: your last form filler<br>
				<br>
				You can <a onclick=\"document.getElementById('CookieEr').style.display = 'none';\" style='cursor: pointer;'>
					<b><i>HIDE THIS ERROR MESSAGE</i></b>
				</a>, but this is just a temporary hide, because cookie setting is disabled.
		</div>";

?>