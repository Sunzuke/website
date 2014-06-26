<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//==================================================================================================================
$debug = 1;
$hostname = $_SERVER['REMOTE_ADDR'];
//==================================================================================================================
//SSH
$ssh = 1;
if(empty($GET_connection) || $GET_connection != "true") $ssh = 0;
$ssh_ip = $_SERVER['SERVER_ADDR'];
$ssh_user = "webserver";
$ssh_pass = "5suhnbao";
//==================================================================================================================
//SQL
$sql = 1;
$sql_ip = $_SERVER['SERVER_ADDR'];
$sql_user = "webserver";
$sql_pass = "5suhnbao";
$sql_db = array(
	'pascal',
	'ragnarok'
);
//==================================================================================================================
//Payments
$paypal = 1;
//1)	login with your PayPal business account on PayPal.com
//2)	Click the My Account tab. 
//3)	Click Profile at the top of the page.
//4)	On the right under Selling Preferences click on Website Payment Preferences.
//5)	Under Auto Return for Website Payments click "on" 
//6)	You can set your website URL there
//		OR in your PayPal post form: <input type='hidden' name='return' value='WEBSITE URL HERE'>
//7)	Under Payment Data Transfer (Optional) click "on"
//8)	Scroll to the bottom of the page and click Save.
//9)	Copy & paste the Identity Token (everything after the word "Token:" */
$paypal_identity_token = str_replace(array('Token', 'token', ' ', ':'), '',
	"Token: Ie-MIhohCiAk_MhboYHtgxDxhl1D72ZbwN6pqcPTIcsiuME543I2sIdFWuO"
);
//==================================================================================================================
?>