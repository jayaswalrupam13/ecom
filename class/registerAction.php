<?php
class registerAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$details['email']    = $request->getParameter("email");
		$details['password'] = $request->getParameter("password");
		$details['name']     = $request->getParameter("name");
		$details['mobile']   = $request->getParameter("mobile");
		
		if(empty($details['email']) || empty($details['password']) || empty($details['name']) || empty($details['mobile'])){
			$details['status'] = '1';
		}
		elseif(!filter_var($details['email'], FILTER_VALIDATE_EMAIL)){
			$details['status'] = '2';
		}
		elseif($proObj->checkUserExists($pdoObj, $details['email'])){
			$details['status'] = '3';
		}	
		elseif(!$proObj->validateMobile($details['mobile'])){
			$details['status'] = '4';
		}				
		else{
			$proObj->addUser($pdoObj, $details);
			$details['status'] = 'success';
		}
		echo $details['status'];	
	}
}
?>