<?php
class subcategoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$return = [];
		if(isset($_GET['type']) && $_GET['type']!=''){
			$type = $request->getParameter('type');
			if($type == 'status'){
				$operation = $request->getParameter('operation');
				$id = $request->getParameter('id');
				if($operation == 'active'){
					$status = '1';
				}else{
					$status = '0';
				}
				$proObj->editSubCategoryStatus($pdoObj,$status,$id);
			}
			
			if($type == 'delete'){
				$id = $request->getParameter('id');
				$proObj->deleteSubCategory($pdoObj,$id);
			}
		}
		
		$return['row'] = $proObj->getAllSubCategory($pdoObj);//echo "<br><pre>return is ";print_r($return);
		return $return;
	}
}
?>