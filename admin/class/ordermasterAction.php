<?php
class ordermasterAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		$return[] = '';
		if($_SESSION['ADMIN_ROLE'] == 'admin'){
			$return['info'] = $proObj->getAllUserOrder($pdoObj);
		}
		else{
			$return['info'] = $proObj->getOrderOfVendor($pdoObj,$_SESSION['ADMIN_ID']);
		}
		return $return;					
	}
}