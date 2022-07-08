<?php
class myorderAction
{
	function execute($pdoObj,$proObj)
	{	
		$return[] = '';
		$return['info'] = $proObj->getMyOrder($pdoObj,$_SESSION['USER_ID']);
		return $return;					
	}
}