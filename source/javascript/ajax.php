<?php if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	} ?>
<script>

function hiddenreload(target, site) {
	var ajaxRequest;
	try {	ajaxRequest = new XMLHttpRequest();	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {	ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");	}
			catch (e) {
				alert("Your browser broke!");
				return false;
			}
		}
	}
	ajaxRequest.onreadystatechange = function() {
		if(ajaxRequest.readyState == 4) {
			var ajaxDisplay = document.getElementById(""+target+"");
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "/"+site+"", true);
	ajaxRequest.send(null);
}

function reload(target, site) {
	var ajaxRequest;
	try {	ajaxRequest = new XMLHttpRequest();	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {	ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");	}
			catch (e) {
				alert("Your browser broke!");
				return false;
			}
		}
	}
	ajaxRequest.onreadystatechange = function() {
		//0: request not initialized 
		//1: server connection established
		//2: request received 
		//3: processing request 
		//4: request finished and response is ready
		if(ajaxRequest.readyState == 1) {
			setCookie('loads', parseInt(getCookie('loads'))+1, 1);
			if(parseInt(getCookie('loads')) == 1) {
				if(!isFunction(jQuery)) {
					document.getElementById("loading").style.display = 'block';
				} else {
					$('#loading').fadeIn();
				}
			}
		}
		if(ajaxRequest.readyState == 2) {
			if(parseInt(getCookie('loads')) == 1) setTimeout(function(){loadbar(50);}, 50);
		}
		if(ajaxRequest.readyState == 3) {
			if(parseInt(getCookie('loads')) == 1) setTimeout(function(){loadbar(70);}, 150);
		}
		if(ajaxRequest.readyState == 4) {
			setCookie('loads', parseInt(getCookie('loads'))-1, 1);
			if(parseInt(getCookie('loads')) == 0) setTimeout(function(){loadbar(100);}, 300);
			var ajaxDisplay = document.getElementById(""+target+"");
			setTimeout(function(){
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
				document.body.style.cursor = "default";
				window.scrollTo(0,0);
			}, 400);
			if(parseInt(getCookie('loads')) == 0) setTimeout(function(){loadbar(101);}, 400);
		}
	}
	ajaxRequest.open("GET", "/"+site+"", true);
	ajaxRequest.send(null);
}

function loadbar(percent) {
	if(percent > 100) {
		if(!isFunction(jQuery)) {
			document.getElementById("loading").style.display = 'none';
		} else {
			$('#loading').fadeOut();
		}
		setTimeout(function(){document.getElementById('loaded').style.width = '0%';}, 300);
	} else if(percent > 0) {
		document.body.style.cursor = "wait";
		var percent = ""+percent+"%";
		if(!isFunction(jQuery)) {
			document.getElementById("loaded").style.width = '0%';		
		} else {
			$("#loaded").animate({width: ""+percent+""}, 100);
		}
	}
}

function reloadinput(target, site, thisvalue) {
	hiddenreload(""+target+"", ""+site+"/"+thisvalue+"");
}

function reloadloop(target, site, looptime) {
	reload(""+target+"", ""+site+"");
	window.setTimeout("reloadloop('"+target+"', '"+site+"', '"+looptime+"');",looptime);
}

function link(site, title) {
	var webfolder = "";
	reload("SITE", ""+webfolder+"ajax/"+site+"");
	setCookie('webfolder', webfolder, 1);
	if(title && title != "") document.title = ""+title+"";
	if(site.length > 1 && window.history.pushState) window.history.pushState('localStorage', ""+title+"", "/"+webfolder+""+site+"/");
	if(site == "" || !site) site = "index";
	AllowPost();
}
function url(site, title) {	link(""+site+"", ""+title+""); }

function AllowPost() {	hiddenreload('InvisibleUpdate', 'ajax/post'); AllowPost = UselessFunction; }

</script>