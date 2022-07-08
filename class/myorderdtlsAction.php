<?php
class myorderdtlsAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		$return             = [];
		$do                 = $request->getParameter("do");
		$return['order_id'] = $request->getParameter("id");	
		$return['from']     = $request->getParameter("from");			
		if( $return['from'] == 'admin' && isset($_SESSION['ADMIN_LOGIN']) ){
			$return['info']      = $proObj->getUserOrderDtlsByAdmin($pdoObj,$return['order_id']);
			$return['user_info'] = $proObj->getUserSingleOrder($pdoObj,$return['info'][0]['user_id'],$return['order_id']);
		}
		elseif( $return['from'] == 'checkout' ){ //session data is lost here temporarily in file_get_contents
			$userID			     = $request->getParameter("userid");	
			$return['info']      = $proObj->getMyOrderDtls($pdoObj,$return['order_id'],$userID);
			$return['user_info'] = $proObj->getUserSingleOrder($pdoObj,$userID,$return['order_id']);
			$details             = $proObj->getUserInfoFromID($pdoObj,$userID);
			$return['user_info']['user_name'] = $details['name'];
		}
		else{
			$return['count'] = $proObj->checkOrderOfUser($pdoObj,$_SESSION['USER_ID'],$return['order_id']);
			if($return['count'] > 0){
				$return['info']      = $proObj->getMyOrderDtls($pdoObj,$return['order_id'],$_SESSION['USER_ID']);
				$return['user_info'] = $proObj->getUserSingleOrder($pdoObj,$_SESSION['USER_ID'],$return['order_id']);
			}
		}
		if($do == 'orderpdf'){
			$proObj->orderPDF($return);
		}
		return $return;					
	}
}