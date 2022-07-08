<?php
class managepwdAction
{
	function execute(&$request,$pdoObj,$proObj)
	{		
		$submit = $request->getParameter("submit");
		$action = $request->getParameter("action");
		if($action == 'forgot'){
			$toEmail = $request->getParameter("email");		
			if(!filter_var($toEmail, FILTER_VALIDATE_EMAIL)){
				echo '2';
			}
			elseif(!$proObj->checkUserExists($pdoObj, $toEmail)){
				echo '3';
			}	
			else{
				global $HOSTNAME_URL,$WEBSITE_NAME,$FRGTPWD_LINK_EXP_TIME,$HTDOCS_URL;				
				$curDate = date("Y-m-d H:i:s");
				$timeGap = strtotime("$curDate + $FRGTPWD_LINK_EXP_TIME");
				$expDate = date('Y-m-d H:i:s', $timeGap);				
				$token   = md5(time());$addKey = substr(md5(uniqid(rand(), 1)), 3, 10);$token = $token . $addKey;//unique token generation				
				$proObj->delResetPwdTmp($pdoObj,$toEmail);
				$proObj->addResetPwdTmp($pdoObj,$toEmail,$token,$expDate);
				
				$sub    = "Password Reset for ".$WEBSITE_NAME." on ".$HTDOCS_URL;
			    $url    = $HOSTNAME_URL."/resetpassword?token=". $token . "&email=" . $toEmail . "&action=reset";										
				$body   = "Please click on the link for reseting your password for {$WEBSITE_NAME}.<a href='{$url}' target='_blank'>Password Reset</a>";				
				$result = $proObj->sendEmailYahoo($toEmail,$sub,$body,$pdoObj,'Forgot_Pwd');				
				echo $result;
			}
			$details['showtpl'] = 'none';
		}
		elseif($action == 'reset'){			
			if($submit){
				$email     = $request->getParameter("email");
				$token     = $request->getParameter("token");
				$password  = $request->getParameter("password");
				$cpassword = $request->getParameter("cpassword");
				if(empty($cpassword) || empty($password)){
					echo 'All fields are compulsory';
				}
				elseif($cpassword != $password){
					echo 'Passwords dont match';
				}
				else{
					$details = $proObj->getResetPwdDtls($pdoObj,$email,$token);
					$curDate = date("Y-m-d H:i:s");
					if(empty($details)){
						echo 'Invalid Link';
					}
					elseif($details['exp_date'] < $curDate){
						echo 'Link Expired';
					}
					else{
						$proObj->editPwdFromEmail($pdoObj,$email,$password);
						$proObj->delResetPwdTmp($pdoObj,$email);
						echo 'success';
					}
				}				
				$details['showtpl'] = 'none';
			}
			else{
				$details['email']   = $request->getParameter("email");
				$details['token']   = $request->getParameter("token");
				$details['showtpl'] = "resetform"; 				
			}
		}
		elseif($action == 'change'){			
			$newPwd = $request->getParameter("new_password");
			$curPwd = $request->getParameter("current_password");
			if(empty($newPwd) || empty($curPwd)){
				echo 'All password fields are compulsory';
			}
			else{
				$user = $proObj->getUserInfoFromID($pdoObj,$_SESSION['USER_ID']);
				if($proObj->matchPwd($curPwd,$user['password']) == false){
					echo 'Please enter correct, current password';
				}
				else{
					$proObj->editPwdFromEmail($pdoObj,$user['email'],$newPwd);
					echo 'success';
				}
			}				
			$details['showtpl'] = 'none';
		}
		else{
			$details['showtpl'] = "showform"; 
		}
		return $details;	
	}
}
?>