<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include "C:/xampp/htdocs/idiscuss/FORUM1-WEB-INF/config.inc.php";

$paytmChecksum   = "";
$paramList       = array();
$isValidChecksum = "FALSE";

$paramList       = $_POST;
$paytmChecksum   = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
//echo "<pre>";print_r($_POST);//die();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo $BOOTSTRAP_CSS_URL?>" rel="stylesheet">
    <title>Payment Details</title>
  </head>
  <body>    
    <script type="text/javascript" src="<?php echo $BOOTSTRAP_JS_URL ?>" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
	<div class="jumbotron" style="background-color: #76D7C4;"><h1 align="center">Payment Details</h1><br/>	
	<?php if($isValidChecksum == "TRUE") { ?>
		<div class="container" align="center">Checksum matched and following are the transaction details:<br/>Transaction status is success</div>
		<?php   if ($_POST["STATUS"] == "TXN_SUCCESS") { ?>			
			<table class="table  table-borderless table-success table-striped">
			  <thead>
				<tr>
				  <th scope="col">Date</th>
				  <th scope="col">ORDERID</th>
				  <th scope="col">MID</th>
				  <th scope="col">TXNID</th>
				  <th scope="col">P_MODE</th>      
				  <th scope="col">Amount</th>
				  <th scope="col">Currency</th>
				  <th scope="col">GATEWAY</th>
				  <th scope="col">Status</th>      
				  <th scope="col">BANKTXNID</th>      
				  <th scope="col">BANK</th>      
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td><?php echo substr($_POST['TXNDATE'],0,-2)?></td>
				  <td><?php echo $_POST['ORDERID']?></td>
				  <td><?php echo $_POST['MID']?></td>
				  <td><?php echo $_POST['TXNID']?></td>
				  <td><?php echo $_POST['PAYMENTMODE']?></td>      
				  <td><?php echo $_POST['TXNAMOUNT']?></td>
				  <td><?php echo $_POST['CURRENCY']?></td>
				  <td><?php echo $_POST['GATEWAYNAME']?></td>
				  <td><?php echo $_POST['STATUS']?></td>
				  <td><?php echo $_POST['BANKTXNID']?></td>    
				  <td><?php echo $_POST['BANKNAME']?></td>    
			    </tr>
				<?php }
				else { ?>
					<table class="table  table-borderless table-success table-striped"><h3 align="center">Transaction status is failure.</h3>
				<?php }  ?>
	<?php }else {  ?>
		<table class="table  table-borderless table-success table-striped"><h3 align="center">Technical Error Encountered - Checksum mismatched.</h3>
	<?php }  ?>	
	</table>
  </body>
</html>