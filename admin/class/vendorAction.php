<?php
class vendorAction
{
	function execute(&$request,$pdoObj,$proObj)
	{
		$id                = $request->getParameter("id");
		$return            = [];	
		$return['action']  = $request->getParameter("action");		
		$return['showtpl'] = 'list';	
		
		if($return['action'] == 'delete'){	
			if( (is_numeric($id) && ($id > 0)) ){			
				if($_SESSION['ADMIN_ROLE'] == 'admin'){
					$proObj->delVendor($pdoObj,$id);
				}
			}
		}
		elseif($return['action'] == 'status'){
			if( (is_numeric($id) && ($id > 0)) ){	
				$operation = $request->getParameter('operation');
				$status    = ($operation == 'active') ? '1' : '0';
				$proObj->editVendorStatus($pdoObj,$status,$id);
			}
		}
		elseif($return['action'] == 'edit'){
			$submit            = $request->getParameter("submit");
			$return['showtpl'] = 'form';
			if($submit){
				$return['email']    = $request->getParameter('email');
				$return['password'] = $request->getParameter('password');
				$return['mobile']   = $request->getParameter('mobile');
				if( empty($return['email']) || empty($return['password']) || empty($return['mobile']) ){
					$return['msg'] = "All fields are mandatory";
				}
				else{
					if( (is_numeric($id) && ($id > 0)) ){	
						$proObj->editVendor($pdoObj,$return,$id);
						$return['showtpl'] = 'list';
					}
				}
			}
			else{
				$return += $proObj->getVendorFromID($pdoObj, $id);	
			}
		}
		elseif($return['action'] == 'add'){
			$submit            = $request->getParameter("submit");
			$return['showtpl'] = 'form';
			if($submit){
				$return['username'] = $request->getParameter('username');
				$return['email']    = $request->getParameter('email');
				$return['password'] = $request->getParameter('password');
				$return['mobile']   = $request->getParameter('mobile');
				if( empty($return['username']) || empty($return['email']) || empty($return['password']) || empty($return['mobile']) ){
					$return['msg'] = "All fields are mandatory";
				}
				else{
					$vendor = $proObj->checkAdminUserExists($pdoObj, $return['username']);
					if(!empty($vendor)){
						$return['msg'] = "Username exits";
					}
					else{
						$proObj->addVendor($pdoObj,$return);
						$return['showtpl'] = 'list';
					}
				}
			}
			else{
				$return['username'] = '';
				$return['email']    = '';
				$return['password'] = '';
				$return['mobile']   = '';
			}				
		}
		if($return['showtpl'] == 'list'){
			$return['vendor'] = $proObj->getAllVendor($pdoObj);
		}
		return $return;
	}
}
?>