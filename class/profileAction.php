<?php
class profileAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$details['action'] = $request->getParameter("action");
		if($details['action'] == 'edit'){
			$details['name'] = $request->getParameter("name");
			$details['id']   = $_SESSION['USER_ID'];
			if(empty($details['name'])){
				$details['status'] = '2';
			}	
			else{
				$proObj->editUserFromID($pdoObj, $details);
				$details['status']     = 'success';
				$_SESSION['USER_NAME'] = $details['name'];
			}
			echo $details['status'];
			$details['showtpl'] = 'none';
		}
		else{
			$details['showtpl'] = 'profileform';
		}
		return $details;		
	}
}
?>