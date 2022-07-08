<?php
class manageproductAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		global $FILE_EXT_LIST_2;
		$mode               = $request->getParameter('mode');
		$submit             = $request->getParameter('submit');		
		$pID                = $request->getParameter('pid');		
		$aID                = $request->getParameter('aid');		
		$return             = [];
		$return['category'] = $proObj->getAllCategory($pdoObj);
		$return['size']     = $proObj->getAllActiveSizes($pdoObj);
		$return['colour']   = $proObj->getAllActiveColours($pdoObj);
		
		if($submit){//echo "<br/><pre>_REQUEST  is ";print_r($_REQUEST);die();
			$return['data']['categories_id']     = $request->getParameter('categories_id');
			$return['data']['sub_categories_id'] = $request->getParameter('sub_categories_id');
			$return['data']['name'] 		 	 = $request->getParameter('name');
			/*$return['data']['mrp'] 			 	 = $request->getParameter('mrp');
			$return['data']['price'] 	      	 = $request->getParameter('price');
			$return['data']['qty']           	 = $request->getParameter('qty');*/
			$return['data']['short_desc']    	 = $request->getParameter('short_desc');
			$return['data']['description']   	 = $request->getParameter('description');
			$return['data']['meta_title']    	 = $request->getParameter('meta_title');
			$return['data']['meta_desc']     	 = $request->getParameter('meta_desc');
			$return['data']['meta_keyword']  	 = $request->getParameter('meta_keyword');
			$return['data']['best_seller']   	 = $request->getParameter('best_seller');
			$return['data']['added_by']          = $_SESSION['ADMIN_ID'];
			$return['image_required']            = 'required';	
			$return['msg']                       = '';	
			
			if($mode == 'edit'){
				$return['id'] = $request->getParameter('id');
				$result       = $proObj->getProductFromID($pdoObj,$return['id'],'admin');
				if(is_array($result)){
					if($return['id'] != $result['id']){				
						$return['msg'] = "Product already exist";
					}
				}
				if($_FILES['image']['type']!=''){
					$fileName = $_FILES['image']['name'];
					if(false === $proObj->checkFileType($fileName) ){
						$return['msg'] = "Your file is ".$fileName." .Please choose correct file type i,e ".implode(', ',$FILE_EXT_LIST_2);
					}
				}
				
				//Multiple Images
				if(isset($_FILES['product_images'])){
					foreach($_FILES['product_images']['name'] as $k=>$v){
						if($v != "" ){
							if(false === $proObj->checkFileType($v) ){
								$return['msg'] = "Wrong Edited Multiple Image - '".$v."'. Image should be of type ".implode(', ',$FILE_EXT_LIST_2);
							}
						}
					}
				}			
				
				if($return['msg'] == ''){

					//Multiple Images
					if(isset($_FILES['product_images'])){
						foreach($_FILES['product_images']['name'] as $k=>$v){
							if($v != "" ){
								$image = $proObj->setFileName($v);
								move_uploaded_file($_FILES['product_images']['tmp_name'][$k],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
								
								if(isset($_POST['product_images_id'][$k])){		//edit 
									$data = $proObj->getProdImageFromID($pdoObj,$_POST['product_images_id'][$k]);
									unlink(PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$data['product_images']);	
									$proObj->editProductImage($pdoObj,$image,$_POST['product_images_id'][$k]);   									
								}
								else{  								
									$proObj->addProductImages($pdoObj,$return['id'],$image);  //add
								}
							}
						}	
					}

					//Product Attributes
					if(isset($_POST['mrp'])){
						foreach($_POST['mrp'] as $k=>$v){
							$return['data'][$k]['mrp']       = htmlentities($_POST['mrp'][$k],ENT_QUOTES);
							$return['data'][$k]['price']     = htmlentities($_POST['price'][$k],ENT_QUOTES);
							$return['data'][$k]['qty']       = htmlentities($_POST['qty'][$k],ENT_QUOTES);
							$return['data'][$k]['size_id']   = htmlentities($_POST['size_id'][$k],ENT_QUOTES);
							$return['data'][$k]['colour_id'] = htmlentities($_POST['colour_id'][$k],ENT_QUOTES);
							$return['data'][$k]['attr_id']   = htmlentities($_POST['attr_id'][$k],ENT_QUOTES);
							if( isset($return['data'][$k]['attr_id']) && ($return['data'][$k]['attr_id'] > 0) ){
								$proObj->editProductAttributes($pdoObj,$return['data'][$k]['attr_id'],$return['data'][$k]);
							}
							else{
								$proObj->addProductAttributes($pdoObj,$return['id'],$return['data'][$k]);
							}
						}
					}				
					
					if($_FILES['image']['name']!=''){
						$return['data']['image'] = $proObj->setFileName($_FILES['image']['name']);
						move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$return['data']['image']);
						$proObj->editProductWithImg($pdoObj,$return['data'],$return['id']);
						unlink(PRODUCT_IMAGE_SERVER_PATH.$result['image']);					
					}
					else{
						$proObj->editProductNoImg($pdoObj,$return['data'],$return['id']);
					}
					header('location:product');die();
				}
			}
			elseif($mode == 'add'){
				$result = $proObj->getProductFromName($pdoObj,$return['data']['name']);
				if(is_array($result)){
					$return['msg']            = "Product already exist";
					$return['image_required'] = 'required';
				}
				elseif( ($_FILES['image']['name'] == '') || ($_FILES['image']['size'] == 0) ){	
					$return['msg'] = "Please choose a file";
				}
				elseif(false === $proObj->checkFileType($_FILES['image']['name']) ){
					$return['msg'] = "Please choose correct file type i,e ".implode(', ',$FILE_EXT_LIST_2);
				}
				elseif(isset($_FILES['product_images'])){ //Multiple Images
					foreach($_FILES['product_images']['name'] as $k=>$v){
						if(false === $proObj->checkFileType($v) ){
							$return['msg'] = "Wrong Added Multiple Image - '".$v."'. Image should be of type ".implode(', ',$FILE_EXT_LIST_2);
						}
					}
				}								
			
				if($return['msg'] == ''){
					$return['data']['image'] = $proObj->setFileName($_FILES['image']['name']);
					move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$return['data']['image']);
					$productID = $proObj->addProduct($pdoObj,$return['data']);
					
					//Multiple Images
					if(isset($_FILES['product_images'])){
						foreach($_FILES['product_images']['name'] as $k=>$v){
							$image = $proObj->setFileName($v);
							move_uploaded_file($_FILES['product_images']['tmp_name'][$k],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
							$proObj->addProductImages($pdoObj,$productID,$image);
						}
					}
					
					//Product Attributes
					if(isset($_POST['mrp'])){
						foreach($_POST['mrp'] as $k=>$v){
							$return['data'][$k]['mrp']       = htmlentities($_POST['mrp'][$k],ENT_QUOTES);
							$return['data'][$k]['price']     = htmlentities($_POST['price'][$k],ENT_QUOTES);
							$return['data'][$k]['qty']       = htmlentities($_POST['qty'][$k],ENT_QUOTES);
							$return['data'][$k]['size_id']   = htmlentities($_POST['size_id'][$k],ENT_QUOTES);
							$return['data'][$k]['colour_id'] = htmlentities($_POST['colour_id'][$k],ENT_QUOTES);
							$proObj->addProductAttributes($pdoObj,$productID,$return['data'][$k]);
						}
					}					
					
					header('location:product');die();
				}
			}			
		}
		elseif($mode == 'delattr'){
			if(isset($aID) && ($aID > 0)){
				$proObj->deleteProdAttr($pdoObj,$aID);
			}
		}
		else{
			if($mode == 'edit'){
				if(isset($pID) && ($pID > 0)){
					$data = $proObj->getProdImageFromID($pdoObj,$pID);
					$proObj->deleteProdImages($pdoObj,$pID);
					unlink(PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$data['product_images']);					
				}			
				$return['image_required'] = '';
				$return['id']             = $request->getParameter('id');
				$result                   = $proObj->getProductFromID($pdoObj,$return['id'],'admin');
				if(is_array($result)){
					$return['data'] = $result;
					
					//Multiple Images
					$images = $proObj->getProdImagesFromProdID($pdoObj,$return['id']);
					if(is_array($images)){
						$return['data']['multiple_images'] = $images;
					}
					
					//Product Attributes
					$return['data']['product_attrs'] = $proObj->getProdAttrsFromProdID($pdoObj,$return['id']);
					//echo "<br/><pre>  is ";print_r($return['data']['product_attrs']);
				}
			}
			else{
				$return['msg']                       = '';
				$return['data']['categories_id']     = '';
				$return['data']['sub_categories_id'] = '';
				$return['data']['name']              = '';
				/*$return['data']['mrp']               = '';
				$return['data']['price']             = '';
				$return['data']['qty']               = '';*/
				$return['data']['image']             = '';
				$return['data']['short_desc']        = '';
				$return['data']['description']       = '';
				$return['data']['meta_title']        = '';
				$return['data']['meta_desc']         = '';
				$return['data']['meta_keyword']      = '';				
				$return['data']['best_seller']       = '';				
				$return['data']['added_by']          = '';				
				$return['image_required']            = 'required';
				$return['data']['product_attrs'][0]['mrp'] = '';				
				$return['data']['product_attrs'][0]['id'] = '';				
				$return['data']['product_attrs'][0]['product_id'] = '';				
				$return['data']['product_attrs'][0]['qty'] = '';				
				$return['data']['product_attrs'][0]['price'] = '';				
				$return['data']['product_attrs'][0]['size_id'] = '';				
				$return['data']['product_attrs'][0]['colour_id'] = '';				
			}			
		}
		return $return;				
	}
	
}
?>