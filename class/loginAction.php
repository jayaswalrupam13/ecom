<?php
class loginAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$details          = [];
		$details['ajax']  = $request->getParameter("ajax");
		if($details['ajax'] == 1){			
			$details['email']    = $request->getParameter("email");
			$details['password'] = $request->getParameter("password");			
			if(empty($details['email']) || empty($details['password'])){
				$details['status'] = '1';
			}
			else{
				$user = $proObj->checkUserExists($pdoObj, $details['email']);
				if(empty($user)){
					$details['status'] = '2';	
				}
				elseif($proObj->matchPwd($details['password'],$user['password']) == false){
					$details['status'] = '3';
				}
				else{	
					$details['status']      = 'success';
					$_SESSION['USER_LOGIN'] = true;
					$_SESSION['USER_ID']    = $user['id'];
					$_SESSION['USER_NAME']  = $user['name'];
					
					//when user tries to add whislist and is not logged in, then on login, immediately add his item in wishlist
					if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID'] != ''){
						$return['pID'] 		= $_SESSION['WISHLIST_ID'];	
						$return['user_id']  = $_SESSION['USER_ID'];
						
						//check same product not to be added twice
						$result = $proObj->getWishlist($pdoObj,$return);
						if(empty($result)){
							$proObj->addWishlist($pdoObj,$return);
						}
						unset($_SESSION['WISHLIST_ID']);	
					}
				}					
			}
			echo $details['status'];
			$details['showtpl'] = 'none';
		}
		else{
			$details['showtpl'] = 'loginform';			
		}
		return $details;		
	}
}
?>