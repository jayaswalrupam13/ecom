<?php
class homeAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		global $NUM_NEW_ARRIVAL;
		$return                = [];		
		$return['product']     = $proObj->getProductInfo($pdoObj,$NUM_NEW_ARRIVAL);
		$return['best_seller'] = $proObj->getBestSeller($pdoObj,$NUM_NEW_ARRIVAL);
		$return['banner']      = $proObj->getActiveBanner($pdoObj);
		return $return;
	}
}
?>