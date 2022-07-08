<?php
class searchAction
{
	function execute(&$request,$pdoObj,$proObj,$pagiObj)
	{		
		$return = [];
		$CATEGORY_NUM = 1;
		$return['search']    = $_GET['search'];
		$totalRows = count($proObj->searchAllPostTitle($pdoObj,$return['search']));
		$page      = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		
		$return['pagiData']  = $pagiObj->calculate_pages($totalRows, $CATEGORY_NUM, $page);
		$return['list']      = $proObj->searchFewPostTitle($pdoObj,$return['search'],$return['pagiData']['start'],$CATEGORY_NUM);
		$return['title']     = $return['search'];
		return $return;
	}
}
?>