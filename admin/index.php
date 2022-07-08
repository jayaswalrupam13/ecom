<?php
session_start();
include "C:/xampp/htdocs/ecom/admin/config.inc.php";
require_once $HTDOCS_PATH."/PDOClass.php";
require $ADMIN_CLASS_PATH."/process.class.php";
include $ADMIN_CLASS_PATH."/pagination.class.php";

header('Expires: -1');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-Cache');

class Request{
	var $glb_arr_skipinputs = array("msgbody","signature","vacsubject","vactext","sigarray","passwd","oldpasswd","newpasswd","newpasswd1","hintquestion","hintquestionother","hintanswer","alternateemail","mothersname","imagetext","txtarea","subject","fname","lname","displayname","address","city","zip","wphone","msg_text");
	
	function getParameter($name){
		if(isset($_REQUEST[$name])){
			if ( ! in_array($name,$this->glb_arr_skipinputs)){
				return $this->prevent_xss($_REQUEST[$name]);
			}
			else{
				return $_REQUEST[$name];
			}
		}
	}

	function prevent_xss($str){
		if (is_array($str)) {
			foreach($str as $key => $value){
				$str[$key] = $this->prevent_xss($value);
			}
		}
		else{
			$str = htmlentities($str,ENT_QUOTES);
		}
		return trim($str);
	}
}

$request = new Request();

//$do = isset($_REQUEST["do"]) ? $request->getParameter("do") :  '';
$do = $request->getParameter("do");

if( (!isset($_SESSION['ADMIN_LOGIN']) || $_SESSION['ADMIN_LOGIN'] == '') && ($do != 'login') ){
	header('location:login');die();
}

$pdoObj  = new PDOClass();
$proObj  = new process();
$pagiObj = new pagination();

//$siteInfo = $proObj->getWebsiteInfo($pdoObj);

//language feature
$lang = '';
if(isset($_REQUEST["app_lang"])){
	$lang = $request->getParameter("app_lang");
	if(!in_array($lang, $LANG_LIST)){
		$lang = '';
	}
}
if($lang == ""){
	$acceptLang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];	
	$acceptLang = explode(",",$acceptLang);
	switch($acceptLang[0]){
		case 'hi' :
		{
			$lang = "hi";
			break;
		}
		default:
		{
			$lang = "en-us";
			break;
		}
	}
}
//$lang = "hi"; 
$lang = "en-us"; 
//include($LANG_PATH."/".$lang.".php");
//print_r($_SESSION);
switch($do)
{
	case "login" :
	{
		include_once $ADMIN_CLASS_PATH."/loginAction.php";
		$loginAction = new loginAction();
		$return = $loginAction->execute($request,$pdoObj,$proObj);
		if($return['showtpl'] == 'loginform' ){		
			include_once $ADMIN_TPL_PATH."/login_tpl.php";
			include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		}
		break;
	}
	case "logout" :
	{
		include_once $ADMIN_CLASS_PATH."/logoutAction.php";
		$logoutAction = new logoutAction();
		$logoutAction->execute();
		break;
	}
	case "signup" :
	{
		include_once $ADMIN_CLASS_PATH."/signupAction.php";
		$signupAction = new signupAction();
		$signupAction->execute($request,$pdoObj,$proObj);
		break;
	}	
	case "banner" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/bannerAction.php";
		$bannerAction = new bannerAction();
		$return = $bannerAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/banner_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}	
	case "managebanner" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/managebannerAction.php";
		$managebannerAction = new managebannerAction();
		$return = $managebannerAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/managebanner_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "getsubcategory" :
	{
		//$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/getsubcategoryAction.php";
		$getsubcategoryAction = new getsubcategoryAction();
		$getsubcategoryAction->execute($request,$pdoObj,$proObj);
		break;
	}
	case "category" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/categoryAction.php";
		$categoryAction = new categoryAction();
		$return = $categoryAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/category_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "coupon" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/couponAction.php";
		$couponAction = new couponAction();
		$return = $couponAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/coupon_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "colour" :
	case "size" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/coloursizeAction.php";
		$coloursizeAction = new coloursizeAction();
		$return = $coloursizeAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		if($return['showtpl'] == "colour"){ 
			include_once $ADMIN_TPL_PATH."/colour_tpl.php";
		}
		else{
			include_once $ADMIN_TPL_PATH."/size_tpl.php";
		}
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "subcategory" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/subcategoryAction.php";
		$subcategoryAction = new subcategoryAction();
		$return = $subcategoryAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/subcategory_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "managecategory" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/managecategoryAction.php";
		$managecategoryAction = new managecategoryAction();
		$return = $managecategoryAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/managecategory_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "managesize" :
	case "managecolour" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/managecoloursizeAction.php";
		$managecoloursizeAction = new managecoloursizeAction();
		$return = $managecoloursizeAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		if($return['showtpl'] == "colour"){
			include_once $ADMIN_TPL_PATH."/managecolour_tpl.php";
		}
		else{
			include_once $ADMIN_TPL_PATH."/managesize_tpl.php";
		}
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "managecoupon" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/managecouponAction.php";
		$managecouponAction = new managecouponAction();
		$return = $managecouponAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/managecoupon_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "managesubcategory" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/managesubcategoryAction.php";
		$managesubcategoryAction = new managesubcategoryAction();
		$return = $managesubcategoryAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/managesubcategory_tpl.php";
		break;
	}
	case "manageproduct" :
	{
		include_once $ADMIN_CLASS_PATH."/manageproductAction.php";
		$manageproductAction = new manageproductAction();
		$return = $manageproductAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/manageproduct_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "product" :
	{
		include_once $ADMIN_CLASS_PATH."/productAction.php";
		$productAction = new productAction();
		$return = $productAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/product_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "productreview" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/productreviewAction.php";
		$productreviewAction = new productreviewAction();
		$return = $productreviewAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/productreview_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "contactus" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/contactAction.php";
		$contactAction = new contactAction();
		$return = $contactAction->execute($request,$pdoObj,$proObj);		
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/contact_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "user" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/userAction.php";
		$userAction = new userAction();
		$return = $userAction->execute($request,$pdoObj,$proObj);		
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/user_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "vendor" :
	{
		$proObj->isAdmin();
		include_once $ADMIN_CLASS_PATH."/vendorAction.php";
		$vendorAction = new vendorAction();
		$return = $vendorAction->execute($request,$pdoObj,$proObj);		
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		if($return['showtpl'] == 'list') {
			include_once $ADMIN_TPL_PATH."/vendor_tpl.php";
		}
		else{
			include_once $ADMIN_TPL_PATH."/managevendor_tpl.php";
		}
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "ordermaster" :
	{
		include_once $ADMIN_CLASS_PATH."/ordermasterAction.php";
		$ordermasterAction = new ordermasterAction();
		$return = $ordermasterAction->execute($request,$pdoObj,$proObj);		
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		if($_SESSION['ADMIN_ROLE'] == 'admin'){
			include_once $ADMIN_TPL_PATH."/ordermaster_tpl.php";
		}
		else{
			include_once $ADMIN_TPL_PATH."/ordermaster_vendor_tpl.php";
		}
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "ordermasterdtl" :
	{//Merchant ID: 8527279 .payu.in
		include_once $ADMIN_CLASS_PATH."/ordermasterdtlAction.php";
		$ordermasterdtlAction = new ordermasterdtlAction();
		$return = $ordermasterdtlAction->execute($request,$pdoObj,$proObj);		
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/ordermasterdtl_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
	default:
	{
		include_once $ADMIN_CLASS_PATH."/categoryAction.php";
		$categoryAction = new categoryAction();
		$return = $categoryAction->execute($request,$pdoObj,$proObj);
		include_once $ADMIN_TPL_PATH."/header_tpl.php";
		include_once $ADMIN_TPL_PATH."/category_tpl.php";
		include_once $ADMIN_TPL_PATH."/footer_tpl.php";
		break;
	}
}

?>