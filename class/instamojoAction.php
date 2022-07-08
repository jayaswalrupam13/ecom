<?php
class instamojoAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		$action = $request->getParameter('action');
		$return = [];
		
		if($action == 'view'){
			global $INS_PAYMENT_PATH;
			include $INS_PAYMENT_PATH."/instamojo.class.php";
			
			$instamojoObj                 = new instamojo();	
			$return['orderid']            = $request->getParameter('orderid');
			$return['payment_request_id'] = $proObj->getTxnIDFromOrderID($pdoObj,$return['orderid'],$_SESSION['USER_ID']);
			
			if($return['payment_request_id'] != ''){
				$return['response'] = $instamojoObj->getPaymentRequestDetails($return['payment_request_id']);		
				if(!isset($return['response']['technical_error'])){
					if($return['response']['success'] == '1'){
						if( !empty($return['response']['payment_request']['payments']) ){
							$return['paymentArr'] = $return['response']['payment_request']['payments'];
						}
						else{
							$return['response']['technical_error'] = 'No payment info retreived from API call, though trxn ID is valid';
						}
					}
					else{//error in retrieving data from api call, and not status = failure. TO check, set wrong API key
						$return['response']['technical_error'] = $return['response']['message'];
					}
				}
			}
			else{//trxn id(payment_request_id) not +nt in db,prob at our end so no api call made as payment_request_id is passed as param
				$return['response']['technical_error'] = 'No Data for ORDER ID - '.$return['orderid'].' . Internal Trxn ID not found in our DBase';
			}
			return $return;
		}
		elseif($action == 'callback'){
			global $HOSTNAME_URL, $WEBSITE_NAME;		
			echo '<b>Transaction in progress, please do not reload!!</b>';
			
			$return['payment_id']         = $request->getParameter('payment_id');
			$return['payment_status']     = $request->getParameter('payment_status');
			$return['payment_request_id'] = $request->getParameter('payment_request_id');
			
			if( isset($return['payment_id']) && isset($return['payment_status']) && isset($return['payment_request_id']) ){
				$details 			    = $proObj->getDtlsFromTxnID($pdoObj,$return['payment_request_id']);
				$orderID                = $details['id'];
				$_SESSION['USER_LOGIN'] = 'yes';
				$_SESSION['USER_ID']    = $details['user_id'];
				$_SESSION['USER_NAME']  = $details['name'];
			}
			if($return['payment_status'] == 'Credit'){
				$return['pstatus'] = 'complete';
				$userInfo            = $proObj->getUserInfoFromID($pdoObj,$_SESSION['USER_ID']);	
				$return['info']      = $proObj->getMyOrderDtls($pdoObj,$orderID,$_SESSION['USER_ID']);
				$return['user_info'] = $proObj->getUserSingleOrder($pdoObj,$_SESSION['USER_ID'],$orderID);
				if(empty($return['user_info'])){
					header("Location:$HOSTNAME_URL");
					die();
				}
				//$proObj->sendInvoiceEmail($userInfo['email'],$return,$orderID,$pdoObj,'Instamojo_Callback');*/
				
				$path   = $HOSTNAME_URL."/invoicemail?id=".$orderID."&userid=".$_SESSION['USER_ID']."&from=checkout";				
				$body   = file_get_contents($path);
				$sub    = $WEBSITE_NAME." Invoice - Order ID No - ". $orderID;	
				$result = $proObj->sendEmailYahoo($userInfo['email'],$sub,$body,$pdoObj,'Instamojo_Callback');			
			}
			elseif($return['payment_status'] == 'Failed'){
				$return['pstatus'] = 'fail';				
			}
			$proObj->editUserOrderGatewayPAYID($pdoObj,$return['payment_request_id'],$return['pstatus'],$return['payment_id']);
			header("Location:".$HOSTNAME_URL."/thankyou?type=instamojo&status=".$return['pstatus']);
			die();
		}			
	}
}
?>