<?php
class categoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		global $HOSTNAME_URL,$NUM_PROD_CATEGORY;
		$return             = [];
		$return['id']       = $request->getParameter("id");
		$return['sort']     = $request->getParameter("sort");
		$return['subcatid'] = $request->getParameter("subcatid");		
		
		if(isset($return['sort'])){
			if($return['sort'] == 'price_low_to_high'){
				$sort_order = "p.price ASC";
			}
			elseif($return['sort'] == 'price_high_to_low'){
				$sort_order = "p.price DESC";
			}
			elseif($return['sort'] == 'old'){
				$sort_order = "p.id ASC";
			}
			else{
				$sort_order = "p.id DESC";
			}			
		}
		else{
			$return['sort'] = 'new';
			$sort_order     = "p.id DESC";
		}
		if( (is_numeric($return['id']) && ($return['id'] > 0)) ){
				if( isset($return['subcatid']) && (is_numeric($return['subcatid']) && ($return['subcatid'] > 0))   ){
					$return['product'] = $proObj->getProductOfCatAndSubCat($pdoObj,$return['id'],$sort_order,$NUM_PROD_CATEGORY,$return['subcatid']);
				}
				else{
					$return['product'] = $proObj->getProductOfCat($pdoObj,$return['id'],$sort_order,$NUM_PROD_CATEGORY);
				}
			return $return;
		}else{
			header("Location:$HOSTNAME_URL");
			die();
		}
	}
}
?>