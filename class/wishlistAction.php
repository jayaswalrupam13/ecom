<?php

class wishlistAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$action = $request->getParameter("action");
		if($action == 'delete'){
			$wishlistID = $request->getParameter("id");
			$proObj->delWishlist($pdoObj,$wishlistID,$_SESSION['USER_ID']);
		}
		$return                   = [];			
		$return['prodInfo']       = $proObj->getProductWishlist($pdoObj,$_SESSION['USER_ID']);
		$return['count_wishlist'] = is_array($return['prodInfo']) ? count($return['prodInfo']) : '';		
		return $return;
	}
}
?>