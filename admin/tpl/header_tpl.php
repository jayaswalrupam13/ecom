<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/normalize.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/themify-icons.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/pe-icon-7-filled.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/flag-icon.min.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/cs-skin-elastic.css">
      <link rel="stylesheet" href="<?php echo $ADMIN_CSS_URL?>/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="product">Product</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="ordermaster">Order</a>
                  </li>
				  <?php if($_SESSION['ADMIN_ROLE'] == 'admin') {?>
                  <li class="menu-item-has-children dropdown">
                     <a href="category" >Category</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="subcategory">Sub Category</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="vendor">Vendor</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="coupon">Coupon</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="banner">Banner</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="user">User</a>
                  </li> 
				  <li class="menu-item-has-children dropdown">
                     <a href="colour">Colour Mgt</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="size">Size Mgt</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="productreview">Product Review</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="contactus">Contact Us</a>
                  </li>
				  <?php } ?>  
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="category"><img width="105" src="<?php echo $USER_IMG_URL ?>/logo/4.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right"><a class="nav-link" href="logout"><i class="fa fa-power-off"></i>Logout</a>
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $_SESSION['ADMIN_USERNAME']?></a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>