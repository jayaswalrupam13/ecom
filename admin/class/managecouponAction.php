<?php
class managecouponAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$mode   = $request->getParameter('mode');
		$submit = $request->getParameter('submit');		
		$return = [];
		
		if($submit){
			$return['data']['coupon_code']    = $request->getParameter('coupon_code');
			$return['data']['coupon_value']   = $request->getParameter('coupon_value');
			$return['data']['coupon_type'] 	  = $request->getParameter('coupon_type');
			$return['data']['cart_min_value'] = $request->getParameter('cart_min_value');
			$result                           = $proObj->getCouponFromName($pdoObj,$return['data']['coupon_code']);
			
			if($mode == 'edit'){
				$id = $request->getParameter('id');
				
				if( (is_array($result)) &&  ($id != $result['id']) ){
					$return['msg'] = "Coupon already exist";					
				}
				else{
					$proObj->editCoupon($pdoObj,$return['data'],$id);
				}	
			}
			elseif($mode == 'add'){
				if(is_array($result)){
					$return['msg'] = "Coupon already exist";
				}
				else{	
					$proObj->addCoupon($pdoObj,$return['data']);
				}				
			}
			if($return['msg'] == ''){
				header('location:coupon');
				die();
			}				
		}
		else{
			if($mode == 'edit'){
				$id     = $request->getParameter('id');
				$result = $proObj->getCouponFromID($pdoObj,$id);
				if(is_array($result)){
					$return['data'] = $result;
				}
			}
			else{
				$return['msg']                    = '';
				$return['data']['coupon_code']    = '';
				$return['data']['coupon_value']   = '';
				$return['data']['coupon_type']    = '';
				$return['data']['cart_min_value'] = '';		
			}			
		}
		return $return;				
	}
}
?>