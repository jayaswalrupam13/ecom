<?php
session_start();
include "C:/xampp/htdocs/ecom/admin/config.inc.php";
require_once $HTDOCS_PATH."/PDOClass.php";
require $ADMIN_CLASS_PATH."/process.class.php";
include $ADMIN_CLASS_PATH."/pagination.class.php";
include $USER_CLASS_PATH."/addToCart.php";

header('Expires: -1');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-Cache');

class Request{

	function getParameter($name){
		if(isset($_REQUEST[$name])){
			return $this->prevent_xss($_REQUEST[$name]);
		}
	}

	function prevent_xss($str){
		if (is_array($str)) {
				foreach($str as $key => $value){
					$str[$key] = $this->prevent_xss($value);
			}
		}
		else{
			$str = trim(htmlentities($str,ENT_QUOTES));
		}
		return $str;
	}
}

$request = new Request();

$do = $request->getParameter("do");

if(isset($_SESSION['ADMIN_LOGIN']) && $do == 'orderpdf'){
}
elseif( !isset($_SESSION['USER_LOGIN']) && ($do == 'wishlist' || $do == 'profile' || $do == 'orderpdf' || $do == 'myorderdtls') ){
	header("Location:$HOSTNAME_URL");
	die();
}

$pdoObj       = new PDOClass();
$proObj       = new process();
$pagiObj      = new pagination();
$addToCartObj = new addToCart();

$categoryList = $proObj->getActiveCategory($pdoObj);
$cartCount    = $addToCartObj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
	$wishlistCount = $proObj->getNumWishlist($pdoObj,$_SESSION['USER_ID']);
}

$pageName = basename($_SERVER['PHP_SELF']);
$meta     = $proObj->setTitle($pdoObj,$proObj,$pageName);

$visitorCount = $proObj->showVisitorCount($pdoObj);
$visitorCount = (string)$visitorCount;
//language feature
/*$lang = '';
if(isset($_REQUEST["app_lang"])){
	$lang = $request->getParameter("app_lang");
	if(!in_array($lang, $LANG_LIST)){
		$lang = '';
	}
}
if($lang == ""){
	$acceptLang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];	
	$acceptLang = explode(",",$acceptLang);
	switch($acceptLang[0])
	{
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
$lang = "hi"; 
$lang = "en-us"; echo "<pre>";print_r();
include($LANG_PATH."/".$lang.".php");*/

$position = stripos($do, 'index.php');
if($position){
	$do = substr($do,0,$position-1);
}

switch($do)
{
	case "category" :
	{
		include_once $USER_CLASS_PATH."/categoryAction.php";
		$categoryAction = new categoryAction();
		$return = $categoryAction->execute($request,$pdoObj,$proObj);
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/category_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "product" :
	{
		include_once $USER_CLASS_PATH."/productAction.php";
		$productAction = new productAction();
		$return = $productAction->execute($request,$pdoObj,$proObj);
		if($return['showtpl'] == 'product' ){	
			include_once $USER_TPL_PATH."/header_tpl.php";
			include_once $USER_TPL_PATH."/product_tpl.php";
			include_once $USER_TPL_PATH."/footer_tpl.php";
		}
		break;
	}
	case "contact" :
	{
		include_once $USER_CLASS_PATH."/contactAction.php";
		$contactAction = new contactAction();
		$return = $contactAction->execute($request,$pdoObj,$proObj);
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/contact_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "login" :
	{
		include_once $USER_CLASS_PATH."/loginAction.php";
		$loginAction = new loginAction();
		$return = $loginAction->execute($request,$pdoObj,$proObj);
		if($return['showtpl'] == 'loginform' ){	
			include_once $USER_TPL_PATH."/header_tpl.php";		
			include_once $USER_TPL_PATH."/login_tpl.php";
			include_once $USER_TPL_PATH."/footer_tpl.php";
		}
		break;
	}
	case "register" :
	{
		include_once $USER_CLASS_PATH."/registerAction.php";
		$registerAction = new registerAction();
		$registerAction->execute($request,$pdoObj,$proObj);		
		break;
	}
	case "setcoupon" :
	{
		include_once $USER_CLASS_PATH."/setcouponAction.php";
		$setcouponAction = new setcouponAction();
		$setcouponAction->execute($request,$pdoObj,$proObj);		
		break;
	}
	case "profile" :
	{
		include_once $USER_CLASS_PATH."/profileAction.php";
		$profileAction = new profileAction();
		$return = $profileAction->execute($request,$pdoObj,$proObj);
		if($return['showtpl'] == 'profileform' ){
			include_once $USER_TPL_PATH."/header_tpl.php";		
			include_once $USER_TPL_PATH."/profile_tpl.php";
			include_once $USER_TPL_PATH."/footer_tpl.php";
		}
		break;
	}
	case "logout" :
	{
		include_once $USER_CLASS_PATH."/logoutAction.php";
		$logoutAction = new logoutAction();
		$logoutAction->execute();
		break;
	}
	case "managecart" :
	{
		include_once $USER_CLASS_PATH."/managecartAction.php";
		$managecartAction = new managecartAction();
		$managecartAction->execute($request,$pdoObj,$proObj,$addToCartObj);
		break;
	}	
	case "managewishlist" :
	{
		include_once $USER_CLASS_PATH."/managewishlistAction.php";
		$managewishlistAction = new managewishlistAction();
		$managewishlistAction->execute($request,$pdoObj,$proObj);
		break;
	}	
	case "cart" :
	{
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/cart_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "sendotp" :
	{
		include_once $USER_CLASS_PATH."/manageotpAction.php";
		$manageotpAction = new manageotpAction();
		$return = $manageotpAction->execute($request,$pdoObj,$proObj);
		break;
	}
	case "checkotp" :
	{
		include_once $USER_CLASS_PATH."/manageotpAction.php";
		$manageotpAction = new manageotpAction();
		$return = $manageotpAction->execute($request,$pdoObj,$proObj);
		break;
	}		
	case "checkout" :
	{
		include_once $USER_CLASS_PATH."/checkoutAction.php";
		$checkoutAction = new checkoutAction();
		$checkoutAction->execute($request,$pdoObj,$proObj);		
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/checkout_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "forgotpassword" :
	case "changepassword" :
	case "resetpassword" :
	{
		include_once $USER_CLASS_PATH."/managepwdAction.php";
		$managepwdAction = new managepwdAction();
		$return = $managepwdAction->execute($request,$pdoObj,$proObj);
		if($return['showtpl'] == "showform"){	
			include_once $USER_TPL_PATH."/header_tpl.php";
			include_once $USER_TPL_PATH."/forgotpwd_tpl.php";
			include_once $USER_TPL_PATH."/footer_tpl.php";
		}
		elseif($return['showtpl'] == "resetform"){	
			include_once $USER_TPL_PATH."/header_tpl.php";
			include_once $USER_TPL_PATH."/reset_pwd_tpl.php";
			include_once $USER_TPL_PATH."/footer_tpl.php";
		}
		break;
	}
	case "myorder" :
	{
		include_once $USER_CLASS_PATH."/myorderAction.php";
		$myorderAction = new myorderAction();
		$return = $myorderAction->execute($pdoObj,$proObj);		
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/myorder_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "myorderdtls" :
	{
		include_once $USER_CLASS_PATH."/myorderdtlsAction.php";
		$myorderdtlsAction = new myorderdtlsAction();
		$return = $myorderdtlsAction->execute($request,$pdoObj,$proObj);	
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/myorderdtls_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "orderpdf" :
	{
		include_once $USER_CLASS_PATH."/myorderdtlsAction.php";
		$myorderdtlsAction = new myorderdtlsAction();
		$myorderdtlsAction->execute($request,$pdoObj,$proObj);		
		/*$return = $myorderdtlsAction->execute($request,$pdoObj,$proObj);		
		include_once $USER_TPL_PATH."/orderpdf_tpl.php";*/
		break;
	}
	case "invoicemail" :
	{
		include_once $USER_CLASS_PATH."/myorderdtlsAction.php";
		$myorderdtlsAction = new myorderdtlsAction();
		$return = $myorderdtlsAction->execute($request,$pdoObj,$proObj);		
		include_once $USER_TPL_PATH."/invoicemail_tpl.php";
		break;
	}
	case "typeinstamojo" :
	{
		include_once $USER_CLASS_PATH."/instamojoAction.php";
		$instamojoAction = new instamojoAction();
		$return = $instamojoAction->execute($request,$pdoObj,$proObj);	
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/instamojo_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "typepayu" :
	{
		include_once $USER_TPL_PATH."/payment_complete_tpl.php";
		break;
	}
	case "typepaytm" :
	{
		include_once $USER_CLASS_PATH."/paytmAction.php";
		$paytmAction = new paytmAction();
		$return = $paytmAction->execute($request,$pdoObj,$proObj);
		include_once $USER_TPL_PATH."/header_tpl.php";		
		include_once $USER_TPL_PATH."/paytm_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "paytmredirect" :
	{
		include_once $PAYTM_PAYMENT_PATH."/pgRedirect.php";
		break;
	}
	case "thankyou" :
	{
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/thank_you_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}	
	case "search" :
	{
		include_once $USER_CLASS_PATH."/searchAction.php";
		$searchAction = new searchAction();
		$return = $searchAction->execute($request,$pdoObj,$proObj);		
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/search_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
	case "wishlist" :
	{
		include_once $USER_CLASS_PATH."/wishlistAction.php";
		$wishlistAction = new wishlistAction();
		$return = $wishlistAction->execute($request,$pdoObj,$proObj);
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/wishlist_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}	
	default:
	{
		include_once $USER_CLASS_PATH."/homeAction.php";
		$homeAction = new homeAction();
		$return = $homeAction->execute($request,$pdoObj,$proObj);
		include_once $USER_TPL_PATH."/header_tpl.php";
		include_once $USER_TPL_PATH."/home_tpl.php";
		include_once $USER_TPL_PATH."/footer_tpl.php";
		break;
	}
}
?>
