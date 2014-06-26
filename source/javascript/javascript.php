<?php
	if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
	echo "<script src='".$base."/".$source."/javascript/peer.js'></script>";
?>
<script>
//======================================================
function OnLoadEvent() {
	var CHECKCOOKIE=getCookie("CHECKCOOKIE");
	if(CHECKCOOKIE == null || CHECKCOOKIE == "") document.getElementById("CookieEr").style.display = "block";
	//if(isFunction(OnThemeLoaded)) OnThemeLoaded();
}
//======================================================
setCookie('CHECKCOOKIE', 'TRUE', 1);
setCookie('loads', 0, 1);
setCookie('width', getDocWidth(), 1);
setCookie('height', getDocHeight(), 1);
setCookie('WEBSITE', 'http://host-z.no-ip.org', 1);
function setCookie(c_name,value,exdays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value+ ";path=/";
}
function getCookie(c_name) {
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1) {
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1) {
		c_value = null;
	} else {
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1) {
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}
//======================================================
function UselessFunction() {

}

function isFunction(possibleFunction) {
	return (typeof(possibleFunction) == typeof(Function));
}

function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function strpos(haystack, needle, offset) {
	var i = (haystack + '')
		.indexOf(needle, (offset || 0));
	return i === -1 ? false : i;
}

function getDocHeight() {
		return window.innerHeight;
}

function getDocWidth() {
		return window.innerWidth;
}

function CheckDocSize(CookieWidth, CookieHeight) {
	var DocWidth = getDocWidth();
	var DocHeight = getDocHeight();
	if(CookieWidth != DocWidth || CookieHeight != DocHeight) {
		var CHECKCOOKIE=getCookie("CHECKCOOKIE");
		if(CHECKCOOKIE == null || CHECKCOOKIE == "") {
			alert("Timeout:\n "+CookieWidth+" != "+DocWidth+" \n "+CookieHeight+" != "+DocHeight+" \n Please refresh!");
		} else {
			window.location.href = window.location.href;
		}
	}
}
//======================================================
function GetKey() {
	var x;
	// IE8 and earlier
	if(window.event) {
		x=event.keyCode;
	// IE9/Firefox/Chrome/Opera/Safari
	} else if(event.which) {
		x=event.which;
	}
	return x;
}
function OnKeyDownEvent(key) {
	//if(isFunction(OnThemeKeyDownEvent)) OnThemeKeyDownEvent(key);
}
function OnKeyPressEvent(key) {
	//if(isFunction(OnThemeKeyPressEvent)) OnThemeKeyPressEvent(key);
}
function OnKeyUpEvent(key) {
	if(key == 27) link('index', 'Index');//ESC
	//if(isFunction(OnThemeKeyUpEvent)) OnThemeKeyUpEvent(key);
}
//======================================================
function click (e) {
	if (!e) e = window.event;
	if ((e.type && e.type == "contextmenu") || (e.button && e.button == 2) || (e.which && e.which == 3)) {
		if(document.getElementById("ContextMenu").style.display == "block") {
			document.getElementById("ContextMenu").style.display = "none";
			document.getElementById("ContextMenu").innerHTML == '';
		} else {
			if(document.getElementById("ContextMenu").innerHTML != "") {
				document.getElementById("ContextMenu").style.display = "block";
				return false;
			}
		}
	}
}
if (document.layers) document.captureEvents(Event.MOUSEDOWN);
document.oncontextmenu = click;
//======================================================
</script> 