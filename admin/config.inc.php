<?php

$DB_TYPE     = "mysql";
$DB_NAME     = "###";
$DB_HOST     = "localhost";
$DB_USERNAME = "###";
$DB_PASSWORD = "###";
$CHARSET     = "utf8mb4";

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecom/');
define('SITE_PATH','http://127.0.0.1/ecom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'media/product_images/');
define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'media/product_images/');

$WEBSITE_NAME  = 'eCOM';
$HTDOCS_URL    = "http://localhost";
$HTDOCS_PATH   = "C:/xampp/htdocs";
$HT_ROOT_DIR   = "ecom";
$HOSTNAME_URL  = $HTDOCS_URL."/".$HT_ROOT_DIR;              //http://localhost/ecom
$HOSTNAME_PATH = $HTDOCS_PATH."/".$HT_ROOT_DIR;             //C:/xampp/htdocs/ecom



$ADMIN_APP_ROOT_DIR = $HOSTNAME_PATH."/admin";              //C:/xampp/htdocs/ecom/admin
$ADMIN_CLASS_PATH   = $ADMIN_APP_ROOT_DIR."/class";         //http://localhost/ecom/admin
$ADMIN_TPL_PATH     = $ADMIN_APP_ROOT_DIR."/tpl";
$ADMIN_LANG_PATH    = $ADMIN_APP_ROOT_DIR."/lang";

$USER_APP_ROOT_DIR = $HOSTNAME_PATH;                        //C:/xampp/htdocs/ecom
$USER_CLASS_PATH   = $USER_APP_ROOT_DIR."/class";			//http://localhost/ecom/class
$USER_TPL_PATH     = $USER_APP_ROOT_DIR."/tpl";
$USER_LANG_PATH    = $USER_APP_ROOT_DIR."/lang";

$ADMIN_CSS_PATH = $ADMIN_APP_ROOT_DIR."/assets/css";
$ADMIN_CSS_URL  = $HOSTNAME_URL."/admin/assets/css";
$ADMIN_JS_PATH  = $ADMIN_APP_ROOT_DIR."/assets/js";
$ADMIN_JS_URL   = $HOSTNAME_URL."/admin/assets/js";
$ADMIN_IMG_PATH = $ADMIN_APP_ROOT_DIR."/images";
$ADMIN_IMG_URL  = $HOSTNAME_URL."/admin/images";

$USER_CSS_PATH = $USER_APP_ROOT_DIR."/css";
$USER_CSS_URL  = $HOSTNAME_URL."/css";
$USER_JS_PATH  = $USER_APP_ROOT_DIR."/js";
$USER_JS_URL   = $HOSTNAME_URL."/js";
$USER_IMG_PATH = $USER_APP_ROOT_DIR."/images";
$USER_IMG_URL  = $HOSTNAME_URL."/images";

$BANNER_PATH     = $HOSTNAME_PATH."/media/banner"; 
$BANNER_URL      = $HOSTNAME_URL."/media/banner"; 
$BANNER_BG_URL   = $HOSTNAME_URL."/images/banner/big-img"; 
$BANNER_CAT_URL  = $HOSTNAME_URL."/images/banner/cat-img"; 
$BANNER_CAT_LIST = ['10' => 'toy2.jpg', '11' => 'footwear1.jpg', '2' => 'hat1.jpg', '7' =>'watch2.jpg', '5' => 'shirt1.jpg', '9' => 'dress1.jpg', '3' =>'sunglass2.jpg'];

$RECENTLY_VIEW_TIME = 60*60*24*365;
$RECENTLY_VIEW_NUM  = 8;

$FRGTPWD_LINK_EXP_TIME = "30 minute";


$PAYU_ICON            = $USER_IMG_URL."/logo/payu1.png";
$PAYTM_ICON           = $USER_IMG_URL."/logo/paytm1.png";
$INSTAMOJO_ICON       = $USER_IMG_URL."/logo/instamojo1.jpg";
$COD_ICON             = $USER_IMG_URL."/logo/cod1.jpg";
$USER_POST_IMAGE_PATH = $USER_APP_ROOT_DIR."/admin/upload";
$USER_POST_IMAGE_URL  = $HOSTNAME_URL."/admin/upload";

$PDF_PATH = $HOSTNAME_PATH."/vendor";
$ERROR_LOG_FILE  = $HOSTNAME_PATH."/error_log.txt";
$BOOTSTRAP_CSS_URL    = $HTDOCS_URL."/bootstrap-5.1.3-dist/css/bootstrap.min.css";

$FILE_EXT_LIST_1  = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);  //Array([0] => 3[1] => 2[2] => 1)
$FILE_EXT_LIST_2  = ['jpeg','jpg','png'];
$MAX_FILE_SIZE_MB = 2;                                                    //MB  
$MAX_FILE_SIZE_BY = 2097152;                                              //in bytes. 1 megabyte = 1024 kilobyte, 1 kilobyte = 1024 byte
$DESC_LENGTH      = 130;

$ADMIN_NUM_PRODUCT = 20;
$NUM_NEW_ARRIVAL   = 12;
$NUM_PROD_CATEGORY = 12;

$BOOTSTRAP_PATH     = $HTDOCS_PATH."/bootstrap";
$BOOTSTRAP_PATH_CSS = $BOOTSTRAP_PATH."/css";
$BOOTSTRAP_CSS_URL  = $HTDOCS_URL."/bootstrap-5.1.3-dist/css/bootstrap.min.css";
$BOOTSTRAP_JS_URL   = $HTDOCS_URL."/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js";

//paytm
$PAYTM_PAYMENT_PATH         = $HOSTNAME_PATH."/paytm";						//C:/xampp/htdocs/ecom/paytm
$PAYTM_TEST_MERCHANT_KEY    = "&###";
$PAYTM_TEST_MERCHANT_ID     = "###";
$PAYTM_PAYMENT_SITE_URL     = "securegw-stage.paytm.in";
$PAYTM_PAYMENT_REDIRECT_URL = $HOSTNAME_URL."/typepaytm?action=callback";						//http://localhost/ecom/paytm


//instamojo
$INS_PAYMENT_PATH           = $HOSTNAME_PATH."/instamojo";					//C:/xampp/htdocs/ecom/instamojo
$INS_PRIVATE_API_KEY        = "##";
$INS_PRIVATE_AUTH_TOKEN     = "###";
$INS_PRIVATE_SALT           = "###";
$INS_PAYMENT_SITE_URL       = "test.instamojo.com";
$INS_PAYMENT_REDIRECT_URL   = $HOSTNAME_URL."/typeinstamojo?action=callback";					//http://localhost/ecom/instamojo

//payu
$PAYU_PAYMENT_PATH         = $USER_APP_ROOT_DIR."/payu";
$PAYU_PAYMENT_URL          = $HOSTNAME_URL."/payu";
$PAYU_TEST_MERCHANT_KEY    = "####";
$PAYU_TEST_SALT            = "###";  //ver 1
$PAYU_TEST_SALT_2          = "######b##";  //ver 2


$PAYU_PAYMENT_SITE_URL     = "https://test.payu.in";
$PAYU_PAYMENT_REDIRECT_URL = $PAYU_PAYMENT_URL."/payment_complete.php";
$PAYU_PAYMENT_FAILURE_URL  = $PAYU_PAYMENT_URL."/payment_fail.php";

//GMAIL SMTP
$SMTP_PATH  = $HTDOCS_PATH."/packages/smtp";
$SMTP_HOST  = "smtp.gmail.com";
$SMTP_PORT  = 587;
$SMTP_UNAME = "##";
$SMTP_PWD   = "##";
$SMTP_FROM  = "##";

//YAHOO SMTP
$YAHOO_SMTP_HOST      = "smtp.mail.yahoo.com";
$YAHOO_SMTP_PORT      = 465;
$YAHOO_SMTP_UNAME     = "###";
$YAHOO_SMTP_PWD       = "####";
$YAHOO_SMTP_FROM      = "####";
$YAHOO_SMTP_FROM_NAME = "eCom Shopping Destination";

$SENDGRID_API_KEY = '#';

//TXTLOCAL SMS
$TXTLOCAL_APIKEY ='##';
$TXTLOCAL_URL    = 'https://api.textlocal.in/send/';
//$sender = 'TXTLCL';

$CURRENCY_SYMBOL = '&#8377;';
$CURRENCY_NAME   = 'Rupee';
$LANG_LIST        = ['en-us','hi'];

?>
