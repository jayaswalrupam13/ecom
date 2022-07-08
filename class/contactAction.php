<?php
class contactAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$return             = [];
		$return['ajax']     = $request->getParameter("ajax");
		if($return['ajax'] == 1){
			$return['name']     = $request->getParameter("name");
			$return['email']    = $request->getParameter("email");
			$return['mobile']   = $request->getParameter("mobile");
			$return['comment']  = $request->getParameter("message");
			$proObj->addContactUs($pdoObj,$return);
			
			/*global $HOSTNAME_URL;
			$dtls = $proObj->getEmailOpenDtlsFromEmail($pdoObj,$return['email']);
			$sub  = 'Test Email Open';
			echo $body = "Hi Hello, <img src='".$HOSTNAME_URL."/contact?id=".$dtls['id']."' width='1px' height='1px'/>";
			$proObj->sendEmailYahoo($return['email'],$sub,$body,$pdoObj,'Contact_EmailOpen');
			$proObj->editEmailOpenForSend($pdoObj,$return['email']);*/
			
			return $return;
		}
	
		$return['id']     = $request->getParameter("id");
		if(isset($return['id']) && $return['id'] > 0 ){
			$proObj->editEmailOpenForOpen($pdoObj,$return['id']);
		}
	}
}
?>