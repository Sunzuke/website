<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

$url = "http://www.paypal.com/cgi-bin/webscr";
$post_vars = "cmd=_notify-synch&tx=".$GET_tx."&at=".$paypal_identity_token."";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		//Return variable not site
curl_setopt($ch, CURLOPT_POST, true);				//Going to send POST variables
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vars);	//Sending POST variables
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);		//Allow URL Change
curl_setopt($ch, CURLOPT_TIMEOUT, 15);				//Time Out Timer
curl_setopt($ch, CURLOPT_HEADER, false);			//Do not return header
curl_setopt($ch, CURLOPT_USERAGENT, 'cURL/PHP');	//sending cURL/PHP as header
$fetched = curl_exec($ch);

$lines = explode("\n", $fetched);
$keyarray = array();
if(strcmp ($lines[0], "SUCCESS") == 0) {
	for ($i=1; $i<count($lines); $i++) {
		list($key,$val) = explode("=", $lines[$i]);
		$keyarray[urldecode($key)] = urldecode($val);
	}
	//Return values:
	$firstname = $keyarray['first_name'];
	$lastname = $keyarray['last_name'];
	$itemname = $keyarray['num_cart_items'];
	$amount = $keyarray['mc_gross'];
	//Create success file:
	$handle = "".$file."/php/payments/success/".$GET_tx.".txt";
	while(is_file($handle)) $handle = "".substr($handle, 0, -4)."_.txt";
	$handle = fopen($handle, 'x+');
	fwrite($handle,$fetched);
	fclose($handle);
} else if (strcmp ($lines[0], "FAIL") == 0) {
	//Create fail file:
	$handle = "".$file."/php/payments/fail/".$GET_tx.".txt";
	if(is_file($handle)) unlink($handle);
	$handle = fopen($handle, 'x+');
	fwrite($handle,$fetched);
	fclose($handle);	
}

?>