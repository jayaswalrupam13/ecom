<?php
class ordermasterdtlAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		$return             = [];
		$return['order_id'] = $request->getParameter("id");
		$orderStatus        = $request->getParameter("update_order_status");
		if(isset($orderStatus)){
			$proObj->editOrderStatus($pdoObj,$orderStatus,$return['order_id']);
		}			
		$return['info'] = $proObj->getAllOrderDtls($pdoObj,$return['order_id'],$return['order_id']);
		$return['name'] = $proObj->getOrderStatusName($pdoObj);
		return $return;					
	}
}