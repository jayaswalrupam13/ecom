<?php
class manageotpAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$type = $request->getParameter("type");	
		if($type == 'email'){
			$toEmail = $request->getParameter("email");
			if(isset($toEmail)){				
				if(filter_var($toEmail, FILTER_VALIDATE_EMAIL)){
					if($proObj->checkUserExists($pdoObj, $toEmail)){
						echo '2'; //Email already in use
					}
					else{
						global $SMTP_PATH,$WEBSITE_NAME,$HTDOCS_URL;					
						
						$OTP     = rand(1111,9999);
						$_SESSION['EMAIL_OTP'] = $OTP;
						$sub     = "Email verifcation OTP for $WEBSITE_NAME registration on $HTDOCS_URL";
						$body    = "$OTP is your Email OTP";				
						
						$result  = $proObj->sendEmailYahoo($toEmail,$sub,$body,$pdoObj,'Email_OTP');
						echo $result;
					}
				}
				else{
					echo '1'; //invalid email address
				}
			}
			else{
				$otp = $request->getParameter("otp");
				if($otp == $_SESSION['EMAIL_OTP']){
					unset($_SESSION['EMAIL_OTP']);
					echo "success";
				}
				else{
					echo '1';
				}
			}				
		}
		elseif($type == 'mobile'){
			$mobile = $request->getParameter("mobile");
			if(isset($mobile)){
				if($proObj->validateMobile($mobile)){
					if($proObj->checkMobileExists($pdoObj, $mobile)){
						echo '2';
					}			
					else{				
						$OTP     = rand(1111,9999);
						$_SESSION['MOBILE_OTP'] = $OTP;
						//global $TXTLOCAL_APIKEY,$TXTLOCAL_URL,$WEBSITE_NAME;
						//$result  = $proObj->sendSMS($message,$mobile,$apiKey,$sender,$url);
						//$result = "success";
						
						global $SMTP_PATH,$WEBSITE_NAME,$HTDOCS_URL;
						
						$sub     = "Mobile verifcation OTP for $WEBSITE_NAME registration on $HTDOCS_URL";
						$body    = "$OTP for mobile verifcation - OTP";		
						$toEmail = 'rupam.jaiswal@gmail.com';			
						
						$result  = $proObj->sendEmailYahoo($toEmail,$sub,$body,$pdoObj,'Mobile_Temp_OTP');
						echo $result;
					}
				}
				else{
					echo '1';
				}
			}
			else{
				$otp = $request->getParameter("otp");
				if($otp == $_SESSION['MOBILE_OTP']){
					unset($_SESSION['MOBILE_OTP']);
					echo "success";
				}
				else{
					echo '1';
				}	
			}	
		}	
	}
}
?>