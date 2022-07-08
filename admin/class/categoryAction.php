<?php
class categoryAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		if(isset($_GET['type']) && $_GET['type']!=''){
			$type = $request->getParameter('type');
			$id   = $request->getParameter('id');
			if( (is_numeric($id) && ($id > 0)) ){
				if($type == 'status'){
					$operation = $request->getParameter('operation');					
					$status    = ($operation == 'active') ? '1' : '0';
					$proObj->editCategoryStatus($pdoObj,$status,$id);
				}			
				elseif($type == 'delete'){
					$proObj->deleteCategory($pdoObj,$id);
				}
			}
		}
		$return        = [];		
		$return['row'] = $proObj->getAllCategory($pdoObj);
		return $return;
	}
}
?>