<?php
class cartAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$return    = [];
		
		foreach($_SESSION['cart'] as $id=>$val){
			$return['product'][] = $proObj->getProductFromID($pdoObj,$id);
		}
		return $return;
		
	}
}