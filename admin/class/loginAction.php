<?php
class loginAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$details = [];
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['submit'])){
			$details['username']  = $request->getParameter("username");
			$details['password']  = $request->getParameter("password");			
			
			if(empty($details['username']) || empty($details['password'])){
				$details['status'] = 'danger';
				$details['msg']    = 'All fields are mandatory';
			}
			else{
				$user = $proObj->checkAdminUserExists($pdoObj, $details['username']);
				if(empty($user)){
					$details['status'] = 'danger';						
					$details['msg']    = 'User doesnot exist.';
				}
				elseif($details['password'] != $user['password']){
					$details['status'] = 'danger';	
					$details['msg']    = 'Wrong Password entered!';
				}
				elseif($user['status'] == '0'){
					$details['status'] = 'danger';	
					$details['msg']    = 'Account De-activated!!';
				}				
				else{	
					$_SESSION['ADMIN_LOGIN']    = 'yes';
					$_SESSION['ADMIN_USERNAME'] = $details['username'];
					$_SESSION['ADMIN_ROLE']     = $user['role'];
					$_SESSION['ADMIN_ID']       = $user['id'];
					header("Location:category"); die();
				}	
			}				
		}
		$details['showtpl'] = 'loginform';
		return $details;
	}
}
?>