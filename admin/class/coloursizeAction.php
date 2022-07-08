<?php
class coloursizeAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$do     = $request->getParameter('do');
		$return = [];
		if(isset($_GET['type']) && $_GET['type']!=''){
			$type = $request->getParameter('type');
			$id   = $request->getParameter('id');
			
			if( (is_numeric($id) && ($id > 0)) ){
				if($type == 'status'){
					$operation = $request->getParameter('operation');					
					$status    = ($operation == 'active') ? '1' : '0';					
					($do == 'colour') ? $proObj->editColourStatus($pdoObj,$status,$id) : $proObj->editSizeStatus($pdoObj,$status,$id);					
				}			
				elseif($type == 'delete'){
					($do == 'colour') ? $proObj->deleteColour($pdoObj,$id) : $proObj->deleteSize($pdoObj,$id);						
				}
			}
		}
		if($do == 'colour'){
			$return['row'] = $proObj->getAllColours($pdoObj);
			$return['showtpl'] = "colour"; 
		}
		else{
			$return['row'] = $proObj->getAllSizes($pdoObj);
			$return['showtpl'] = "size"; 
		}
		return $return;
	}
}
?>