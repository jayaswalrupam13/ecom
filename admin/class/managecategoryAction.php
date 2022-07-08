<?php
class managecategoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$return             = [];
		$return['category'] = '';
		$return['msg']      = '';
		
		//edit mode
		if(isset($_GET['id']) && $_GET['id']!=''){
			$id     = $request->getParameter('id');
			$result = $proObj->getCategoryFromID($pdoObj,$id);
			
			if(is_array($result)){
				$return['category'] = $result['categories'];
			} 
			else{
				header('location:category');
				die();
			}
		}

		if(isset($_POST['submit'])){
			$category = $request->getParameter('categories');
			$result   = $proObj->getCategoryFromName($pdoObj,$category);
			
			if(is_array($result)){
				if(isset($_GET['id']) && $_GET['id']!=''){					
					if($id != $result['id']){					
						$return['msg'] = "Categories already exist";
					}
				}else{
					$return['msg'] = "Categories already exist";
				}
			}
			
			if($return['msg'] == ''){
				if(isset($_GET['id']) && $_GET['id']!=''){
					$proObj->editCategoryName($pdoObj,$category,$id);
				}else{
					$proObj->addCategory($pdoObj,$category);
				}
				header('location:category');
				die();
			}
		}
		return $return;
	}
}
?>