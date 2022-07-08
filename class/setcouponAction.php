<?php
class setcouponAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$couponCode = $request->getParameter('coupon_code');
		if($couponCode != ''){
			$details    = $proObj->getCouponFromName($pdoObj,$couponCode);
			$return     = [];
			
			if(is_array($details) && $details['status'] = '1'){
				if(isset($_SESSION['COUPON_ID'])){
					unset($_SESSION['COUPON_ID']);
					unset($_SESSION['COUPON_CODE']);
					unset($_SESSION['COUPON_VALUE']);	
				}				
				
				$cartTotal = 0;
				foreach($_SESSION['cart'] as $id=>$val) {
					$prodInfo   = $proObj->getProductFromID($pdoObj,$id);
					$cartTotal += $val['qty']*$prodInfo['price'];
				}
				if($cartTotal < $details['cart_min_value']){
					$return = ['status' => 'failure', 'msg' => 'Coupon to be applied on minimum amount of '.$proObj->formatCurrency($details['cart_min_value'])];
				}
				else{
					if($details['coupon_type'] == 'Percentage'){
						$symbol     = $details['coupon_value'].'%';
						$finalPrice = $cartTotal -($cartTotal * $details['coupon_value'])/100;					
					}
					else{
						global $CURRENCY_NAME,$CURRENCY_SYMBOL;	
						$symbol     = $CURRENCY_SYMBOL.$details['coupon_value'];					
						$finalPrice = $cartTotal - $details['coupon_value'];					
					}
					$discount = $cartTotal - $finalPrice;
					$return   = ['status' => 'success', 'discount' => $proObj->formatCurrency($discount), 
								'final_price' => $proObj->formatCurrency($finalPrice), 
								'msg' => 'Discount of '.$symbol.' applied. Final price '.$proObj->formatCurrency($finalPrice)];	
					$_SESSION['COUPON_ID']    = $details['id'];
					$_SESSION['COUPON_VALUE'] = $discount;
					$_SESSION['COUPON_CODE']  = $couponCode;
					$_SESSION['FINAL_PRICE']  = $finalPrice;
				}
			}
			else{
				$return = ['status' => 'failure', 'msg' => 'Invalid Coupon'];
			}
		}
		else{
			$return = ['status' => 'failure', 'msg' => 'Enter Coupon'];
		}
		echo json_encode($return);
	}
}
?>