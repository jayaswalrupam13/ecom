<?php
class checkoutAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		global $HOSTNAME_URL,$WEBSITE_NAME,$INS_PAYMENT_REDIRECT_URL,$INS_PAYMENT_PATH,$USER_TPL_PATH;
		
		if(empty($_SESSION['cart'])){
			header("Location:$HOSTNAME_URL");
			die();
		}		
		$submit = $request->getParameter("submit");
		if(isset($submit)){			
			$return = $proObj->processCheckout($request,$pdoObj);
	
			if($return['payment_type'] == 'payu'){
				$con           = mysqli_connect("localhost","rupam","rupam","ecom");
				$MERCHANT_KEY  = "gtKFFx"; 
				$SALT          = "eCwWELxi";
				$hash_string   = '';
				$PAYU_BASE_URL = "https://test.payu.in";
				$action        = '';
				$posted        = array();
				if(!empty($_POST)) {
				  foreach($_POST as $key => $value) {    
					$posted[$key] = $value; 
				  }
				}//edited 33 order_id, user_id=15 rishi
				$user_id               = $_SESSION['USER_ID'];
				$userArr               = mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));
				//$return['txnid']     = '0f53a238a6334af1a40d6ee6b8d8f630';
				$return['total_price'] = '80';
				$formError             = 0;
				$posted['txnid']       = $return['txnid'];
				$posted['amount']      = $return['total_price'];
				$posted['firstname']   = $userArr['name'];
				$posted['email']       = $userArr['email'];
				$posted['phone']       = $userArr['mobile'];
				$posted['productinfo'] = "productinfo";
				$posted['key']         = $MERCHANT_KEY ;
				$hash                  = '';
				$hashSequence          = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
				if(empty($posted['hash']) && sizeof($posted) > 0){
					if(
						  empty($posted['key'])
						  || empty($posted['txnid'])
						  || empty($posted['amount'])
						  || empty($posted['firstname'])
						  || empty($posted['email'])
						  || empty($posted['phone'])
						  || empty($posted['productinfo'])
						 
				    ){  
						$formError = 1;
					} 
					else{    
						$hashVarsSeq = explode('|', $hashSequence);
						foreach($hashVarsSeq as $hash_var) {
							$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
							$hash_string .= '|';
						}
						$hash_string .= $SALT;
						$hash         = strtolower(hash('sha512', $hash_string));
						$action       = $PAYU_BASE_URL . '/_payment';
				    }
				} 
				elseif(!empty($posted['hash'])) {
					$hash   = $posted['hash'];
					$action = $PAYU_BASE_URL . '/_payment';
				}
				$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="'.SITE_PATH.'payu /><input type="hidden" name="furl" value="'.SITE_PATH.'payu"/><input type="submit" id="submit" style="display:none;"/></form>';
				echo $formHtml;				
				echo '<script>alert(document.getElementById("payuForm").name);document.getElementById("payuForm").submit();</script>'; //sleep(3);
			}
			elseif($return['payment_type'] == 'instamojo'){
				$payload = Array(
								'purpose'				  => 'Buy items from '.$WEBSITE_NAME,
								'amount'				  => $return['total_price'],
								'phone'					  => $return['user_info']['mobile'],
								'buyer_name'			  => $_SESSION['USER_NAME'],
								'redirect_url' 			  => $INS_PAYMENT_REDIRECT_URL,
								'send_email' 		      => false,
								'send_sms' 				  => false,
								'customer_id' 			  => $_SESSION['USER_ID'],
								'email' 				  => $return['user_info']['email'],
								'allow_repeated_payments' => false
							);
				include $INS_PAYMENT_PATH."/instamojo.class.php";
				$instamojoObj = new instamojo();				
				$response     = $instamojoObj->createRequest($payload);
				
				if( isset($response['success']) &&  ($response['success']== 1) ){
					$paymentURL      = $response['payment_request']['longurl'];
					$_SESSION['TID'] = $response['payment_request']['id'];
					$proObj->editUserOrderTxnID($pdoObj,$_SESSION['TID'],$return['order_id']);					
					header("Location:$paymentURL");die();
				}
				elseif( !empty($response['technical_error']) ){
					return $response['technical_error'];
				}
				else{
					return $response['message'];
				}				
			}
			else{
				$return['info'] = $proObj->getMyOrderDtls($pdoObj,$return['order_id'],$_SESSION['USER_ID']);
				
				$proObj->sendInvoiceEmail($return['user_info']['email'],$return,$return['order_id'],$pdoObj,'Checkout_COD');
				header("Location:thankyou?status=complete");
				die();
				
				
				/*$path   = $HOSTNAME_URL."/invoicemail?id=".$return['order_id']."&userid=".$_SESSION['USER_ID']."&from=checkout";				
				$body   = file_get_contents($path);
				$sub    = $WEBSITE_NAME." Invoice - Order ID No - ". $return['order_id'];	
				$result = $proObj->sendEmailYahoo($userInfo['email'],$sub,$body,$pdoObj,'Checkout_COD');
				header("Location:thankyou?status=2");
				die();*/
			}
		}			
	}
}
?>