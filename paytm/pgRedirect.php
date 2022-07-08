<?php
//header("Pragma: no-cache");
//header("Cache-Control: no-cache");
//header("Expires: 0");
//session_start();

require_once $PAYTM_PAYMENT_PATH."/lib/config_paytm.php";
require_once $PAYTM_PAYMENT_PATH."/lib/encdec_paytm.php";

$return           = $proObj->processCheckout($request,$pdoObj);	
$checkSum         = "";
$paramList        = array();
$ORDER_ID 		  = $return['order_id'];
$CUST_ID 		  = $_SESSION['USER_ID'];
$INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
$CHANNEL_ID       = CHANNEL_ID;
$TXN_AMOUNT 	  = $return['total_price'];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] 			   = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] 		   = $ORDER_ID;
$paramList["CUST_ID"] 		   = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] 	   = $CHANNEL_ID; //WEB,WAP
$paramList["TXN_AMOUNT"] 	   = $TXN_AMOUNT;
$paramList["WEBSITE"] 		   = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"]     = $PAYTM_PAYMENT_REDIRECT_URL;

$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY); 

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>