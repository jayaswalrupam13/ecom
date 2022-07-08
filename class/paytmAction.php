<?php
class paytmAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		global  $PAYTM_PAYMENT_PATH;
		require_once $PAYTM_PAYMENT_PATH."/lib/config_paytm.php";
		require_once $PAYTM_PAYMENT_PATH."/lib/encdec_paytm.php";

		$action = $request->getParameter('action');
		$return = [];
		
		if($action == 'view'){			
			include $PAYTM_PAYMENT_PATH."/paytm.class.php";			
			$paytmObj          = new paytm();	
			$return['orderid'] = $request->getParameter('orderid');
			$return['txnid']   = $proObj->getTxnIDFromOrderID($pdoObj,$return['orderid'],$_SESSION['USER_ID']);
			if($return['txnid'] != ''){
				$return['response'] = $paytmObj->getOrderDetails($return['orderid']);			
			}
			else{
				$return['response']['technical_error'] = 'No Data Found for this ORDER ID - '.$return['orderid'];
			}
			return $return;
		}
		elseif($action == 'callback'){
			global $HOSTNAME_URL, $WEBSITE_NAME;		
			echo '<b>Transaction in progress, please do not reload!!</b>';	
			$details = $proObj->getUserOrderDtlsByAdmin($pdoObj,$_POST["ORDERID"]);	
			
			$proObj->editUserOrderTxnID($pdoObj,$_POST['TXNID'],$_POST["ORDERID"]);
			$_SESSION['USER_LOGIN'] = 'yes';
			$_SESSION['USER_ID']    = $details[0]['user_id'];
			$_SESSION['USER_NAME']  = $details[0]['user_name'];				
			$checkSum               = "";
			$paramList              = array();
			$return['checksum']     = "FALSE";
			$paramList              = $_POST;
			$checkSum               = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

			//Verify all params rxd from Paytm pg to ur app. Eg MID rxd from paytm pg = ur app’s MID, TXN_AMOUNT, ORDER_ID are same as what was sent by you to Paytm PG for initiating txn etc //will return TRUE or FALSE string.
			$return['checksum'] = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $checkSum);
			
			if($_POST['STATUS'] == 'TXN_SUCCESS'){
				$return['pstatus'] = 'complete';
			}
			else{
				$return['pstatus'] = 'fail';
				$return['msg']     = $_POST['RESPMSG'];
			}
			$url = $HOSTNAME_URL."/thankyou?type=paytm&status=".$return['pstatus'];
			if($return['pstatus'] == 'fail'){
				$url .= '&msg='.urlencode($return['msg']);
			}
			$proObj->editUserOrderGatewayPAYID($pdoObj,$_POST['TXNID'],$return['pstatus'],'0');
			header("Location:".$url);
			die();
		}			
	}
}
?>