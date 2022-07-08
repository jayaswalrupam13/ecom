<?php
class productAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$return       = [];
		$return['id'] = $request->getParameter("id");
		$return['showtpl'] = 'product';
		$return['attr_id'] = $request->getParameter("attr_id");
		$submit       = $request->getParameter("submit");
		
		if( (is_numeric($return['attr_id']) && ($return['attr_id'] > 0)) ){
			$return['showtpl'] = 'none';
			$return['type'] = $request->getParameter("type");
			$return['pid']  = $request->getParameter("pid");
			if($return['type'] == 'colour'){
				$result = $proObj->getSizeOfColour($pdoObj,$return['pid'],$return['attr_id']);
				echo json_encode($result);
			}
			return $return;
		}
		elseif( (is_numeric($return['id']) && ($return['id'] > 0)) ){						
			$return['product'] = $proObj->getProductFromID($pdoObj,$return['id']);
			if(is_array($return['product'])){
				$soldNum                       = $proObj->getProdSoldNumByID($pdoObj,$return['id']);
				$return['product']['num_prod'] = $return['product']['qty'] - $soldNum;
				$return['product']['num_prod'] = 100;
				$images                        = $proObj->getProdImagesFromProdID($pdoObj,$return['id']);
				if(is_array($images)){
					$return['product']['multiple_images'] = $images;
				}	

				//Product Attributes
				$return['product']['attr'] = $proObj->getProdFullAttrsFromProdID($pdoObj,$return['id']);
				//$r = $proObj->formatAttrDtls($return['product']['attr']);
				$colour = [];$size = [];
				foreach($return['product']['attr'] as $v){
					$colour[$v['colour_id']][] = $v['colour'];
					$size[]     = $v['size'];
				}	//echo "<br/>  is ";print_r($return['product']['attr']);
				$return['product']['colour'] = $colour;
				$return['product']['size']   = $size; 
				
				//echo "<br/>r  is ";print_r($return['product']['attr']);
				$temp = [];
				 $i = 0;
				foreach($return['product']['attr'] as $v){
					if( isset($v['colour']) && isset($v['size']) ){
						if( !isset( $return['product']['attr_data'][$v['colour']]) ) {$i = 0;}
						$return['product']['attr_data'][$v['colour']][$i]['colour_id'] = $v['colour_id'];
						$return['product']['attr_data'][$v['colour']][$i]['size'] = $v['size'];
						$return['product']['attr_data'][$v['colour']][$i]['size_id'] = $v['size_id'];
						$return['product']['attr_data'][$v['colour']][$i]['qty'] = $v['qty'];
						$return['product']['attr_status'] = 'Both';
					}
					elseif( isset($v['colour']) && !isset($v['size']) ){
						$return['product']['attr_status'] = 'Colour';
					}
					elseif( !isset($v['colour']) && isset($v['size']) ){
						$return['product']['attr_status'] = 'Size';
					}
					else{
						$return['product']['attr_status'] = 'None';
					}
					$i++;
				}
				//echo "<br/>temp  is ";print_r($return['product']['attr_data']);
				echo "<br/>product  is ";print_r($return['product']['attr_status']);
				
				
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
			else{
				global $HOSTNAME_URL;		
				header("Location:$HOSTNAME_URL");
				die();
			}
			
		}
		
	}	
}
?>