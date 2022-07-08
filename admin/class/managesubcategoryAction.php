<?php
class managesubcategoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$return                   = [];
		$return['categories']     = '';
		$return['sub_categories'] = '';
		$return['msg']            = '';
		
		//edit mode
		if(isset($_GET['id']) && $_GET['id']!=''){
			$id     = $request->getParameter('id');
			$result = $proObj->getSubCategoryFromID($pdoObj,$id);
			
			if(is_array($result)){
				$return['categories'] = $result['categories_id'];
				$return['sub_categories'] = $result['sub_categories'];
				$return['id'] = $result['id'];
				$return['categories_name'] = $result['categories_name'];
				$return['categories_id'] = $result['categories_id'];
				$return['status'] = $result['status'];
			} 
			else{
				header('location:subcategory');
				die();
			}
		}

		if(isset($_POST['submit'])){
			$category    = $request->getParameter('categories_id');
			$subCategory = $request->getParameter('sub_categories');
			$result      = $proObj->getSubCategoryFromName($pdoObj,$category,$subCategory);
			
			if(is_array($result)){
				if(isset($_GET['id']) && $_GET['id']!=''){					
					if($id != $result['id']){					
						$return['msg'] = "Sub Categories already exist";
					}
				}else{
					$return['msg'] = "Sub Categories already exist";
				}
			}
			
			if($return['msg'] == ''){
				if(isset($_GET['id']) && $_GET['id']!=''){
					$proObj->editSubCategory($pdoObj,$category,$subCategory,$id);
				}else{
					$proObj->addSubCategory($pdoObj,$category,$subCategory);
				}
				header('location:subcategory');
				die();
			}
		}
		$return['categories_list'] = $proObj->getAllCategory($pdoObj);
		return $return;
	}
}
?>