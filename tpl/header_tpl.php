<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta['meta_title'] ?></title>
    <meta name="description" content="<?php echo $meta['meta_desc'] ?>">
	<meta name="keywords" content="<?php echo $meta['meta_keyword'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $USER_IMG_URL?>/logo/favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">    
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/core.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/shortcode/shortcodes.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/style.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/responsive.css">
    <link rel="stylesheet" href="<?php echo $USER_CSS_URL?>/custom.css">
    <script src="<?php echo $USER_JS_URL?>/vendor/modernizr-3.5.0.min.js"></script>
	<script type="text/javascript">
	var HOSTNAME_URL = "<?php echo $HOSTNAME_URL; ?>";
    </script>
	<style>
	.htc__shopping__cart a span.htc__wishlist {
    background: #c43b68;
    border-radius: 100%;
    color: #fff;
    font-size: 9px;
    height: 17px;
    line-height: 19px;
    position: absolute;
    right: -5px;
    text-align: center;
    top: -4px;
    width: 17px;
	}
	#visitor_counter li{list-style:none;float:left;background-color:#2DA8F8;padding:1%;margin-left:1%;color:#fff;font-size:20px;}
	</style>
</head>

<body style="background-image:url('<?php echo $BANNER_BG_URL ?>/banner1.jpg')">
    <!-- Body main wrapper startstyle="background-color:#ADD8E6" #ccffff #FF7276-->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">					
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="<?php echo $HOSTNAME_URL?>"><img src="<?php echo $USER_IMG_URL?>/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <!-- <li class="drop"><a href="<?php echo $HOSTNAME_URL?>">Home</a></li>    -->                                    
                                        <?php foreach($categoryList as $v){ ?>
										<li  class="drop"><a href="<?php echo $HOSTNAME_URL.'/category?id='.$v['id']?>"><?php echo $v['categories'] ?></a>
										<?php 
										$subCatList = $proObj->getSubCatOfCategory($pdoObj,$v['id']);
										if(is_array($subCatList)){?>
										<ul class="dropdown">
											<?php foreach($subCatList as $subV){ ?>
											<li><a href="<?php echo $HOSTNAME_URL.'/category?id='.$v['id'].'&subcatid='.$subV['id']?>"><?php echo $subV['sub_categories']?></a></li>                                        										
										<?php }?></ul><?php } ?>
										</li>
										<?php } ?>  
                                        <li><a href="<?php echo $HOSTNAME_URL.'/contact' ?>">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="<?php echo $HOSTNAME_URL?>">Home</a></li>
                                           <?php foreach($categoryList as $v){?>
											<li><a href="<?php echo $HOSTNAME_URL.'/category?id='.$v['id']?>"><?php echo $v['categories'] ?></a></li>
											<?php } ?> 
                                            <li><a href="<?php echo $HOSTNAME_URL.'/contact' ?>">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
								<?php 
								$class = 'mr15';
								if(isset($_SESSION['USER_LOGIN'])){
								$class = '';}
								?> 
								<div class="header__search search search__open <?php echo $class ?>">
                                    <a href="<?php echo $HOSTNAME_URL.'/search' ?>"><i class="icon-magnifier icons"></i></a>
                                </div>
								
								<div class="htc__shopping__cart">
									<a class="cart__menu" href="<?php echo $HOSTNAME_URL.'/cart' ?>"><i class="icon-handbag icons"></i></a>
									<a href="<?php echo $HOSTNAME_URL.'/cart' ?>"><span class="htc__qua"><?php echo $cartCount ?></span></a>
                                </div>
								
								
								<?php if(isset($_SESSION['USER_LOGIN'])){?>
								<div class="htc__shopping__cart">
									<a class="cart__menu" href="<?php echo $HOSTNAME_URL.'/wishlist' ?>"><i class="icon-heart icons"></i></a>
									<a href="<?php echo $HOSTNAME_URL.'/wishlist' ?>"><span class="htc__wishlist">
									<?php if( (isset($return['count_wishlist'])) && $return['count_wishlist'] != ''){echo $return['count_wishlist'];}else { echo $wishlistCount;}?>
									</span></a>
                                </div>
																
								<div class="header__account">                                 
									<nav class="navbar navbar-expand-lg navbar-light bg-dark">
									   <button class="navbar-toggler" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
									   </button>
									 
									 <div class="collapse navbar-collapse" id="navbarSupportedContent">
									 <ul class="navbar-nav mr-auto">
										<li class="nav-item dropdown">
										  <a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" role="button" aria-hospopup="true" aria-expanded="false" href="#"><?php echo $_SESSION['USER_NAME']?></a>
										  
										  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
										  <a class="dropdown-item" href="<?php echo $HOSTNAME_URL.'/myorder'?>">Order</a>
										  <a class="dropdown-item" href="<?php echo $HOSTNAME_URL.'/profile' ?>">Profile</a>
										  <a class="dropdown-item" href="<?php echo $HOSTNAME_URL.'/logout' ?>">Logout</a>
										  </div>									  
										</li>
									 </ul>
									 </div>
									</nav>									
								</div>	
							     <?php } else { ?>									
                                        <a href="<?php echo $HOSTNAME_URL.'/login' ?>" class="mr15">Login/Register</a>
								<?php }  ?>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area --> 

<!-- Start Search Popap -->
<div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->		