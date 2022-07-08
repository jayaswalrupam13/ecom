<?php
class productAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$type = $request->getParameter('type');
		if(isset($type) && $type != ''){
			$id = $request->getParameter('id');	
			if( (is_numeric($id) && ($id > 0)) ){	
				if($type == 'status'){
					$operation = $request->getParameter('operation');
					$status    = ($operation == 'active') ? '1' : '0';	
					$proObj->editProductStatus($pdoObj,$status,$id);
				}
				elseif($type == 'delete'){
					$proObj->deleteProduct($pdoObj,$id);
				}
			}
		}
		$return        = [];
		$return['row'] = $proObj->getAllProduct($pdoObj);	
		return $return;			
	}
}
?>