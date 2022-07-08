<?php
class managebannerAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		global $FILE_EXT_LIST_2,$BANNER_PATH;
		$mode          = $request->getParameter('mode');
		$submit        = $request->getParameter('submit');		
		$return        = [];
		$return['msg'] = '';
		
		if($submit){
			$return['banner']['heading1'] = $request->getParameter('heading1');
			$return['banner']['heading2'] = $request->getParameter('heading2');
			$return['banner']['btn_text'] = $request->getParameter('btn_text');
			$return['banner']['btn_link'] = $request->getParameter('btn_link');
			$return['banner']['status']   = $request->getParameter('status');			
			$result                       = $proObj->getProductFromName($pdoObj,$return['data']['name']);
			
			if($mode == 'edit'){
				$id = $request->getParameter('id');
				
				if($_FILES['image']['type']!=''){
					$fileName = $_FILES['image']['name'];
					if(false === $proObj->checkFileType($fileName) ){
						$return['msg'] = "Your file is ".$fileName." .Please choose correct file type i,e ".implode(', ',$FILE_EXT_LIST_2);
					}
				}				
				if($_FILES['image']['name']!=''){
					$return['banner']['image'] = rand(111111111,999999999).'_'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'],$BANNER_PATH.'/'.$return['banner']['image']);
					$proObj->editBannerWithImg($pdoObj,$return['banner'],$id);
					unlink($BANNER_PATH.'/'.$result['image']);					
				}
				else{
					$proObj->editBannerNoImg($pdoObj,$return['banner'],$id);
				}
			}
			elseif($mode == 'add'){
				if( ($_FILES['image']['name'] == '') || ($_FILES['image']['size'] == 0) ){	
					$return['msg'] = "Please choose a file";
				}
				elseif(false === $proObj->checkFileType($_FILES['image']['name']) ){
					$return['msg'] = "Please choose correct file type i,e ".implode(', ',$FILE_EXT_LIST_2);
				}
				else{	
					$return['banner']['image'] = rand(111111111,999999999).'_'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'],$BANNER_PATH.'/'.$return['banner']['image']);
					$proObj->addBanner($pdoObj,$return['banner']);
				}				
			}
			if($return['msg'] == ''){
				header('location:banner');
				die();
			}				
		}
		else{
			if($mode == 'edit'){
				$id                       = $request->getParameter('id');
				$result                   = $proObj->getBannerFromID($pdoObj,$id);	
				$return['image_required'] = '';								
				if(is_array($result)){
					$return['banner'] = $result;
				} 
				else{
					header('location:banner');
					die();
				}
			}
			else{
				$return                       = [];
				$return['banner']['heading1'] = '';
				$return['banner']['heading2'] = '';
				$return['banner']['btn_text'] = '';
				$return['banner']['btn_link'] = '';
				$return['banner']['image']    = '';
				$return['banner']['status']   = '';
				$return['msg']                = '';	
				$return['image_required']     = 'required';				
			}			
		}
		return $return;	
	}
}
?>