<?php

if($paypal && !empty($GET_tx) && ctype_alnum(str_replace(array('-', '_'), '', $GET_tx)) && strlen($GET_tx) > 8) {

?>