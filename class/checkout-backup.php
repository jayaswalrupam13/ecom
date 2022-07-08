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
		if(isset($submit)){echo "checkoutAction <pre>";print_r($_REQUEST);echo ' REQUEST_METHOD '.$_SERVER['REQUEST_METHOD'];die();
			$total = 0;
			foreach($_SESSION['cart'] as $id=>$val) {
				$prodInfo = $proObj->getProductFromID($pdoObj,$id);
				$total   += $val['qty']*$prodInfo['price'];
			}
			
			$return 				  = [];
			$return['address']   	  = $request->getParameter("address");
			$return['city'] 		  = $request->getParameter("city");
			$return['pincode'] 		  = $request->getParameter("pincode");
			$return['payment_type']   = $request->getParameter("payment_type");
			$return['payment_status'] = ($return['payment_type'] == 'COD') ? 'success' : 'pending';			
			$return['user_id'] 		  = $_SESSION['USER_ID'];			
			$return['order_status']   = '1';
			$return['txnid']		  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			
			if(isset($_SESSION['COUPON_ID'])){
				$return['coupon_id']      = $_SESSION['COUPON_ID']; 
				$return['coupon_code']    = $_SESSION['COUPON_CODE']; 
				$return['coupon_value']   = $_SESSION['COUPON_VALUE'];
				$return['total_price']    = $total - $_SESSION['COUPON_VALUE'];
				unset($_SESSION['COUPON_ID']);
				unset($_SESSION['COUPON_CODE']);
				unset($_SESSION['COUPON_VALUE']);
			}
			else{
				$return['total_price']    = $total;
				$return['coupon_id']      = ''; 
				$return['coupon_code']    = ''; 
				$return['coupon_value']   = '';
			}
			
			$orderID = $proObj->addUserOrder($pdoObj,$return);			
			$product = [];
			foreach($_SESSION['cart'] as $id=>$val) {
				$prodInfo              = $proObj->getProductFromID($pdoObj,$id);
				$product['order_id']   = $orderID;
				$product['price']      = $prodInfo['price'];
				$product['qty']        = $val['qty'];
				$product['product_id'] = $id;
				$proObj->addOrderDetail($pdoObj,$product);
			}
			unset($_SESSION['cart']);
			$userInfo   = $proObj->getUserInfoFromID($pdoObj,$_SESSION['USER_ID']);	
	
			if($return['payment_type']=='payu'){
				$con=mysqli_connect("localhost","rupam","rupam","ecom");
				$MERCHANT_KEY = "gtKFFx"; 
				$SALT = "eCwWELxi";
				$hash_string = '';
				//$PAYU_BASE_URL = "https://secure.payu.in";
				$PAYU_BASE_URL = "https://test.payu.in";
				$action = '';
				$posted = array();
				if(!empty($_POST)) {
				  foreach($_POST as $key => $value) {    
					$posted[$key] = $value; 
				  }
				}//edited 33 order_id, user_id=15 rishi
				$user_id=$_SESSION['USER_ID'];
				$userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));
				$return['txnid'] = '0f53a238a6334af1a40d6ee6b8d8f630';
				$return['total_price'] = '80';
				$formError = 0;
				$posted['txnid']=$return['txnid'];
				$posted['amount']=$return['total_price'];
				$posted['firstname']=$userArr['name'];
				$posted['email']=$userArr['email'];
				$posted['phone']=$userArr['mobile'];
				$posted['productinfo']="productinfo";
				$posted['key']=$MERCHANT_KEY ;
				$hash = '';
				$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
				if(empty($posted['hash']) && sizeof($posted) > 0) {
				  if(
						  empty($posted['key'])
						  || empty($posted['txnid'])
						  || empty($posted['amount'])
						  || empty($posted['firstname'])
						  || empty($posted['email'])
						  || empty($posted['phone'])
						  || empty($posted['productinfo'])
						 
				  ) {
					$formError = 1;
				  } else {    
					$hashVarsSeq = explode('|', $hashSequence);
					foreach($hashVarsSeq as $hash_var) {
					  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					  $hash_string .= '|';
					}
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
				  }
				} elseif(!empty($posted['hash'])) {
				  $hash = $posted['hash'];
				  $action = $PAYU_BASE_URL . '/_payment';
				}
				echo "$hash";die();
				$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="'.SITE_PATH.'payu /><input type="hidden" name="furl" value="'.SITE_PATH.'payu"/><input type="submit" id="submit" style="display:none;"/></form>';
				//echo $formHtml;echo "ccc  formHtml ".$formHtml;var_dump($formHtml);
				//die();
				
				echo '<script>alert(document.getElementById("payuForm").name);document.getElementById("payuForm").submit();</script>'; //sleep(3);
			}elseif($return['payment_type'] == 'paytm'){
				$_SESSION['POST'] = $_POST;
				$_SESSION['POST']['ORDER_ID'] = $return['txnid'];
				$_SESSION['POST']['CUST_ID'] = $_SESSION['USER_ID'];
				$_SESSION['POST']['TXN_AMOUNT'] = $return['total_price'];die();
				header("Location: paytmredirect");

				
			}elseif($return['payment_type'] == 'instamojo'){
				$payload = Array(
								'purpose'				  => 'Buy items from '.$WEBSITE_NAME,
								'amount'				  => $return['total_price'],
								'phone'					  => $userInfo['mobile'],
								'buyer_name'			  => $_SESSION['USER_NAME'],
								'redirect_url' 			  => $INS_PAYMENT_REDIRECT_URL,
								'send_email' 		      => false,
								'send_sms' 				  => false,
								'customer_id' 			  => $_SESSION['USER_ID'],
								'email' 				  => $userInfo['email'],
								'allow_repeated_payments' => false
							);
				include $INS_PAYMENT_PATH."/instamojo.class.php";
				$instamojoObj    = new instamojo();				
				$response        = $instamojoObj->createRequest($payload);
				$_SESSION['TID'] = $response['payment_request']['id'];
				$proObj->editUserOrderTxnID($pdoObj,$_SESSION['TID'],$orderID);
				if($response['success'] == 1){
					$paymentURL = $response['payment_request']['longurl'];
					header("Location:$paymentURL");die();
				}
				else{
					echo $response['message'];
				}				
			}
			else{
				$return['info']      = $proObj->getMyOrderDtls($pdoObj,$orderID,$_SESSION['USER_ID']);
				$return['user_info'] = $proObj->getUserSingleOrder($pdoObj,$_SESSION['USER_ID'],$orderID);
				if(empty($return['user_info'])){
					header("Location:$HOSTNAME_URL");
					die();
				}
				$proObj->sendInvoiceEmail($userInfo['email'],$return,$orderID);
				header("Location:thankyou?status=complete");die();
				
				
				/*$path   = $HOSTNAME_URL."/invoicemail?id=".$orderID."&userid=".$_SESSION['USER_ID']."&from=checkout";				
				$body   = file_get_contents($path);
				$sub    = $WEBSITE_NAME." Invoice - Order ID No - ". $orderID;	
				$result = $proObj->sendEmail($userInfo['email'],$sub,$body);
				header("Location:thankyou?status=2");
				die();*/
			}
		}			
	}
}