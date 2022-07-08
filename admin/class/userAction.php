<?php
class userAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$action = $request->getParameter("action");
		if($action == 'delete'){
			$id = $request->getParameter("id");
			$proObj->delUser($pdoObj,$id);
		}
		$return         = [];		
		$return['user'] = $proObj->getAllAdminUser($pdoObj);
		return $return;
	}
}
?>