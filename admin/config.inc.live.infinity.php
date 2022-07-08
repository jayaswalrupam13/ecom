<?php
$DB_TYPE     = "mysql";
$DB_NAME     = "epiz_31522433_ecom";
$DB_HOST     = "sql107.epizy.com";
$DB_USERNAME = "epiz_31522433";
$DB_PASSWORD = "Cxi5n1BOIgJmv";
$CHARSET     = "utf8mb4";
$DB_PORT     = "3306";

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecom/');
define('SITE_PATH','http://rupam.infinityfreeapp.com/ecom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

$WEBSITE_NAME  = 'eCOM';
$HTDOCS_URL    = "http://rupam.infinityfreeapp.com";
$HTDOCS_PATH   = $_SERVER["DOCUMENT_ROOT"];
$HT_ROOT_DIR   = "ecom";
$HOSTNAME_URL  = $HTDOCS_URL."/".$HT_ROOT_DIR;              // http://rupam.infinityfreeapp.com/ecom
$HOSTNAME_PATH = $HTDOCS_PATH."/".$HT_ROOT_DIR;             // ecom


$ADMIN_APP_ROOT_DIR = $HOSTNAME_PATH."/admin";              // ecom/admin
$ADMIN_CLASS_PATH   = $ADMIN_APP_ROOT_DIR."/class";         // http://rupam.infinityfreeapp.com/ecom/admin
$ADMIN_TPL_PATH     = $ADMIN_APP_ROOT_DIR."/tpl";
$ADMIN_LANG_PATH    = $ADMIN_APP_ROOT_DIR."/lang";

$USER_APP_ROOT_DIR = $HOSTNAME_PATH;                        // ecom
$USER_CLASS_PATH   = $USER_APP_ROOT_DIR."/class";			// http://rupam.infinityfreeapp.com/ecom/class
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


$PAYU_ICON            = $USER_IMG_URL."/logo/payu1.png";
$PAYTM_ICON           = $USER_IMG_URL."/logo/paytm1.png";
$INSTAMOJO_ICON       = $USER_IMG_URL."/logo/instamojo1.jpg";
$COD_ICON             = $USER_IMG_URL."/logo/cod1.jpg";
$USER_POST_IMAGE_PATH = $USER_APP_ROOT_DIR."/admin/upload";
$USER_POST_IMAGE_URL  = $HOSTNAME_URL."/admin/upload";

$PDF_PATH        = $HOSTNAME_PATH."/vendor";
$ERROR_LOG_FILE  = $HOSTNAME_PATH."/error_log.txt";

$FILE_EXT_LIST_1  = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);  //Array([0] => 3[1] => 2[2] => 1)
$FILE_EXT_LIST_2  = ['jpeg','jpg','png'];
$MAX_FILE_SIZE_MB = 2;                                                    //MB  
$MAX_FILE_SIZE_BY = 2097152;                                              //in bytes. 1 megabyte = 1024 kilobyte, 1 kilobyte = 1024 byte
$DESC_LENGTH      = 130;

$ADMIN_NUM_PRODUCT = 20;
$NUM_NEW_ARRIVAL   = 12;
$NUM_PROD_CATEGORY = 12;

//paytm
$PAYTM_PAYMENT_PATH         = $HOSTNAME_PATH."/paytm";						// ecom/paytm
$PAYTM_TEST_MERCHANT_KEY    = "ZdYg5&AP&Q2e0waI";
$PAYTM_TEST_MERCHANT_ID     = "esaqUR12413794144394";
$PAYTM_PAYMENT_SITE_URL     = "securegw-stage.paytm.in";
$PAYTM_PAYMENT_REDIRECT_URL = $HOSTNAME_URL."/typepaytm?action=callback";						// http://rupam.infinityfreeapp.com/ecom/paytm
$PAYTM_CARD_DETAILS         = '4242 4242 4242 4242, CVV: 123';

//instamojo
$INS_PAYMENT_PATH           = $HOSTNAME_PATH."/instamojo";					// ecom/instamojo
$INS_PRIVATE_API_KEY        = "test_bbf413e9f6f3db7bc101275e67b";
$INS_PRIVATE_AUTH_TOKEN     = "test_191ddca6d6d57da4913052a4c0e";
$INS_PRIVATE_SALT           = "ac6109f098c743bfa2562a078cebcd2d";
$INS_PAYMENT_SITE_URL       = "test.instamojo.com";
$INS_PAYMENT_REDIRECT_URL   = $HOSTNAME_URL."/typeinstamojo?action=callback";					// http://rupam.infinityfreeapp.com/ecom/instamojo
$INS_CARD_DETAILS           = '4242 4242 4242 4242, CVV: 111, 3D-pwd: 1221';

//payu
$PAYU_PAYMENT_PATH         = $USER_APP_ROOT_DIR."/payu";
$PAYU_PAYMENT_URL          = $HOSTNAME_URL."/payu";
//$PAYU_TEST_MERCHANT_KEY    = "gtKFFx";   //vishal
//$PAYU_TEST_SALT            = "eCwWELxi"; //vishal

$PAYU_TEST_MERCHANT_KEY    = "Lpa53U";
$PAYU_TEST_SALT            = "bOMYRCyuBwLClef3yTx9x4oj961nW2JP";  //ver 1
$PAYU_TEST_SALT_2          = "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDfhirbeBUgJe2rORcc9vdJBxh1nDJ19ICcp3jOTBwqaaW4gVn6uO5SBa/+ksRmPzEIkP2BK6M/PIjHhR6batJI7sdqR3fTy653g4z8YTNP+BuHcCPwZucPK/CkBoyxSe7FF2kuL1TyLJWHMmePqOXwlLP797TNYPV4kgDoeyBA4w8YC/dn1qZAtIWnlGcwfAQiZv+yzhkv3IzMKDCgyLR8m5glqTSUJRDzZh6Dx55FopiBVJV90nMh03HjV0u0FOJSYvmGGWrcnqKg82PRhM9I0wh4X24kf+EmOvhUbkuNpYvDI6bA+4IlpelmPmUauflURSCav/lRph6r7wC/A/HPAgMBAAECggEBAKwbxJgkiC+uxKfYV6Gnz5RdcEnusTP9xaHZmb1PAUju+/lrL/tLtcVWN8NPAwavlXPBIFD7ZsFkPPVT3NNSlwQtR0LgMLXV2UqQ8lfKCBaFNb09bY7HzRXzgWDq4h4IjV8YvZYgP8oQ5jmpZ/BH3nU2KrfSbVbOV3Q1B5n6ZEVQn0qY4Gp4KiPQftVCN5mLFIhl3PMauzb9B/d6Z7UDkRhuBekKBV25PY8i3oeHAUZoGT3oiPhhuYv1p7xZR5Wnd9DoLEMxUOwx+5egvfDTOFFPjnH0v4YH9vkN/5U5taMvCWCk1ALyxUVmkk2jf3pPVvb47stsImvuCJBEVPuzyIECgYEA9/HonmULT0mBJBkvfZXT70Wc1Sq/rC2nE3TC15XWQyNhvZ1uXGswFpYM74jBStbbX6w5HQjztONntzlzc/TazzqthXbwhZNCpl3xY5QRV3D6fFrHZP254XYRP0k2q8y5o9bVNg5y12OkSXDDXkp2/lLnLyOMOHMdFMlonr3ZWyECgYEA5skoMUV49Y/OpVWcRrer4DTBdC2dQ1l8VJ6ZskrH4PJ4ISzSmYnkIPLsFSVtoYVwHkUAUyoWtdBbvX6SDd9azIYHbdpZxQDw4fbzKL7+Eft1uV7O1ABfWq9Ge/UKijVlo0Zx07c83QBOG9fyI04fKGNPKUxziJPbSq/7X3UqHu8CgYAfHRwzxDpHGNI71W1ANS0DOZkUpuimkpQEvQI2S3c3tZjuUnMm5cyDCRFWfbLD0XJ17wa7vgPXDzJUq8DxLCjJGHPt658DJBeZCPDhrhL/Bg5ozHt5EN3ijQ5dArL5nBcvmCXpQqbmoHpdPOlHS9Di2URphexyqP9dPGkEgo5kAQKBgHvYnOH79xJH7svYqjlk3S4/AUV4KPl4bvj192KvMJ3tYDvlUsqkLbDky335jOBtvCHyQ19dqbw9qM2Cu5wILTCuCBSSZTQL8jhAjnJiM/OwbpdgYjtwS7tdbcSdVd+fEgDRj8nefiHWxRO6Ca2agavpxxRRe3piZf6pe4rZVBYvAoGAaYqFIjPDo9jXFofQ+P4ZrWe8PCL17cbSwxlObcxiQ2+x4LKX9efNqDh+jP6xCiwGqgY2Hm7cXHsky/A34Ky0QRsDKXL9an/dahun7tj1OW9V7DvdnxXAuS7Y7Jo5jDdok0uYEvv0EcHeKcT5L+6lSSTrdw5Y/eVNWN9o0jbHqo0=";  //ver 2


$PAYU_PAYMENT_SITE_URL     = "https://test.payu.in";
$PAYU_PAYMENT_REDIRECT_URL = $PAYU_PAYMENT_URL."/payment_complete.php";
$PAYU_PAYMENT_FAILURE_URL  = $PAYU_PAYMENT_URL."/payment_fail.php";
$PAYU_CARD_DETAILS         = 'Card: 5123 4567 8901 2346, CVV: 123, Axis-OTP: 123456, Name: Test';
$DUMMY_CARD_MSG            = 'Our sandbox functions similar to the live payment gateway.  However, transactions will never actually process a payment. <br/>You are prohibited from using real card numbers. This dummy card can be used for testing.';

//GMAIL SMTP
//$SMTP_PATH  = $HTDOCS_PATH."/packages/smtp";
$SMTP_PATH  = $HOSTNAME_PATH."/smtp";
$SMTP_HOST  = "smtp.gmail.com";
$SMTP_PORT  = 587;//25, 465
$SMTP_UNAME = "rupam.jaiswal@gmail.com";
$SMTP_PWD   = "lucknow2";
$SMTP_FROM  = "rupam.jaiswal@gmail.com";

//TXTLOCAL SMS
$TXTLOCAL_APIKEY ='NDYzMjM5NTQ1ODRmNjg3MTYzNmE3MDc3NGQ2MzQxMzM=';
$TXTLOCAL_URL    = 'https://api.textlocal.in/send/';
//$sender = 'TXTLCL';


$CURRENCY_SYMBOL = '&#8377;';
$CURRENCY_NAME   = 'Rupee';
$LANG_LIST        = ['en-us','hi'];

?>