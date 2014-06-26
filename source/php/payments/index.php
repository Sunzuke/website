<?phpif(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

if($paypal && !empty($GET_tx) && ctype_alnum(str_replace(array('-', '_'), '', $GET_tx)) && strlen($GET_tx) > 8) {	include "$file/php/payments/paypal.php";}

?>