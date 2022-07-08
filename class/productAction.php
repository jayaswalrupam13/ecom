<?php
class productAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		global $HOSTNAME_URL;
        	$return       = [];
		$return['id'] = $request->getParameter("id");
		if( (is_numeric($return['id']) && ($return['id'] > 0)) ){
						
			$return['product'] = $proObj->getProductFromID($pdoObj,$return['id']);
			if(is_array($return['product'])){
				$soldNum = $proObj->getProdSoldNumByID($pdoObj,$return['id']);
				$return['product']['num_prod'] = $return['product']['qty'] - $soldNum;

                		//recently viewed - setcookie
				global $RECENTLY_VIEW_TIME,$RECENTLY_VIEW_NUM;
				if(isset($_COOKIE['recently_viewed'])) {
					$view = unserialize($_COOKIE['recently_viewed']);	
					if(count($view) > $RECENTLY_VIEW_NUM){
						$view = array_slice($view,-$RECENTLY_VIEW_NUM);
					}
					$return['recently_viewed'] = $proObj->getRecentViewProductInfo($pdoObj,$view);				
					if( ($key = array_search($return['id'], $view)) !== false ){
						unset($view[$key]);
					}
				}
				$view[] = $return['id'];	
				setcookie('recently_viewed',serialize($view),time()+$RECENTLY_VIEW_TIME);

                		//add review
				if($submit && isset($_SESSION['USER_ID'])){
					$return['review'] = $request->getParameter("review");
					$return['rating'] = $request->getParameter("rating");
					$proObj->addProductReview($pdoObj,$return,$return['id'],$_SESSION['USER_ID']);
					$URL = $proObj->getCurrentURL();
					header("Location:$URL");
				}
				$return['comment'] = $proObj->getProductReview($pdoObj,$return['id']);

				return $return;
			}
		}
		header("Location:$HOSTNAME_URL");
		die();
	}	
}
?>
