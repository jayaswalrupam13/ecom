<?php
class contactAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$action = $request->getParameter("action");
		if($action == 'delete'){
			$id = $request->getParameter("id");
			$proObj->delContact($pdoObj,$id);
		}
		$return            = [];		
		$return['contact'] = $proObj->getAllContact($pdoObj);
		return $return;
	}
}
?>