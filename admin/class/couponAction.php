<?php
class couponAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$return = [];
		if(isset($_GET['type']) && $_GET['type']!=''){
			$type = $request->getParameter('type');
			if($type == 'status'){
				$operation = $request->getParameter('operation');
				$id = $request->getParameter('id');
				if($operation == 'active'){
					$status = '1';
				}else{
					$status = '0';
				}
				$proObj->editCouponStatus($pdoObj,$status,$id);
			}
			
			if($type == 'delete'){
				$id = $request->getParameter('id');
				$proObj->deleteCoupon($pdoObj,$id);
			}
		}

		$return['row'] = $proObj->getAllCoupon($pdoObj);
		return $return;
	}
}
?>