<?php

//include "C:/xampp/htdocs/idiscuss/FORUM1-WEB-INF/config.inc.php";

//instamojo
$HTDOCS_PATH                = "C:/xampp/htdocs";
$HTDOCS_URL                 = "http://localhost";
$INS_PAYMENT_PATH           = $HTDOCS_PATH."/instamojo";
$INS_PRIVATE_API_KEY        = "";
$INS_PRIVATE_AUTH_TOKEN     = "";
$INS_PRIVATE_SALT           = "";
$INS_PAYMENT_SITE_URL       = "test.instamojo.com";
$INS_PAYMENT_REDIRECT_URL   = $HTDOCS_URL."/instamojo/success.php";

include $INS_PAYMENT_PATH."/instamojo.class.php";


$payload = Array(
			'purpose' => 'Books',
			'amount' => '10',
			'phone' => "9930317525",
			'buyer_name' => "Deepak",
			'redirect_url' => "$INS_PAYMENT_REDIRECT_URL",
			'send_email' => true,
			'send_sms' => false,
			'customer_id' => 'Roll No2',
			'email' => "rupam.jaiswal@gmail.com",
			'allow_repeated_payments' => false
		);

$instamojoObj = new instamojo();
//echo "INS_PAYMENT_REDIRECT_URL $INS_PAYMENT_REDIRECT_URL <pre>";print_r($payload);
$instamojoObj->createRequest($payload);                 //creating a request
?>