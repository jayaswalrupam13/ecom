<?php
class searchAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		global $HOSTNAME_URL;
		$return    = [];
		$return['str'] = $request->getParameter("str");
		if( isset($return['str']) ){
			
			$return['product'] = $proObj->searchProduct($pdoObj,$return['str']);
			return $return;
		}else{
			//header("Location:$HOSTNAME_URL");
			die();
		}
	}
}
?>