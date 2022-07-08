<?php
class managecoloursizeAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$do             = $request->getParameter('do');		
		$submit         = $request->getParameter('submit');		
		$return         = [];
		$return['mode'] = $request->getParameter('mode');
		$return['msg']  = '';
		
		if($submit){
			if($do == "managecolour"){
				$return['showtpl'] = "colour";
				$return['colour']  = $request->getParameter('colour');
				$result            = $proObj->getColourFromName($pdoObj,$return['colour']);
				
				if($return['mode'] == 'edit'){
					$id = $request->getParameter('id');
					
					if( (is_array($result)) &&  ($id != $result['id']) ){
						$return['msg'] = "Colour already exist";					
					}
					else{
						$proObj->editColour($pdoObj,$return['colour'],$id);
					}	
				}
				elseif($return['mode'] == 'add'){
					if(is_array($result)){
						$return['msg'] = "Colour already exist";
					}
					else{	
						$proObj->addColour($pdoObj,$return['colour']);
					}				
				}
				if($return['msg'] == ''){
					header('location:colour');
					die();
				}
			}
			else{
				$return['showtpl']  = "size";				
				$return['size']     = $request->getParameter('size');
				$return['priority'] = $request->getParameter('priority');
				$result             = $proObj->getSizeFromName($pdoObj,$return['size']);
				
				if($return['mode'] == 'edit'){
					$id = $request->getParameter('id');
					
					if( (is_array($result)) &&  ($id != $result['id']) ){
						$return['msg'] = "Size already exist";					
					}
					else{
						$proObj->editSize($pdoObj,$return['size'],$return['priority'],$id);
					}	
				}
				elseif($return['mode'] == 'add'){
					if(is_array($result)){
						$return['msg'] = "Size already exist";
					}
					else{	
						$proObj->addSize($pdoObj,$return['size'],$return['priority']);
					}				
				}
				if($return['msg'] == ''){
					header('location:size');
					die();
				}
			}				
		}
		else{
			if($do == "managecolour"){
				$return['showtpl'] = "colour";
				if($return['mode'] == 'edit'){
					$id     = $request->getParameter('id');
					$result = $proObj->getColourFromID($pdoObj,$id);
					if(is_array($result)){
						$return += $result;
					}
				}
				else{
					$return['colour'] = '';
				}
			}
			else{	
				$return['showtpl'] = "size";			
				if($return['mode'] == 'edit'){
					$id     = $request->getParameter('id');
					$result = $proObj->getSizeFromID($pdoObj,$id);
					if(is_array($result)){
						$return += $result;
					}
				}
				else{
					$return['size']     = '';
					$return['priority'] = 0;
				}
			}
			//$return['msg']    = '';					
			$return['id']     = '';
			$return['status'] = '';				
		}
		return $return;				
	}
}
?>