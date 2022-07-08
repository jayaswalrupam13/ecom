<?php

class managewishlistAction
{
	function execute(&$request,$pdoObj,$proObj)
	{	
		$return        = [];
		$return['pID'] = $request->getParameter("pid");	
		if(isset($_SESSION['USER_LOGIN'])){
			$return['type']     = $request->getParameter("type");			
			$return['user_id']  = $_SESSION['USER_ID'];
			
			//check same product not to be added twice
			$result = $proObj->getWishlist($pdoObj,$return);
			if(empty($result)){
				$proObj->addWishlist($pdoObj,$return);
				echo $proObj->getNumWishlist($pdoObj,$_SESSION['USER_ID']);
			}
			else{
				echo "1";//product already added!!
			}
		}
		else{
			$_SESSION['WISHLIST_ID'] = $return['pID'];
			echo "not_login";
		}
	}
}
?>