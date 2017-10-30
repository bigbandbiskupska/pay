<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

$message = $_GET['message'] ? $_GET['message'] : "";
$amount = $_GET['amount'];
header('Content-Type: image/png');
echo file_get_contents(
	sprintf(
		"https://api.paylibo.com/paylibo/generator/czech/image?" . 
		"compress=false" .
		"&size=250" .
		"&accountNumber=%s" .
		"&bankCode=%s" .
		"&amount=%s" .
		"&currency=CZK" .
		"&branding=false" .
		"&message=%s",
		ACCOUNT_NUMBER,
		BANK_CODE,
		$amount,
		$message
	)
);