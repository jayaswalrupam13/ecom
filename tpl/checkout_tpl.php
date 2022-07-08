<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/checkout2.jpg') no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
						  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
						  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
						  <span class="breadcrumb-item active">checkout</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="checkout__inner">
					<div class="accordion-list">
						<div class="accordion">						
						<?php $accordion_class = "accordion__title";
						if(!isset($_SESSION['USER_LOGIN'])){?> 
							<div class="accordion__hide">
								Checkout Method
							</div>
							<div class="accordion__body">
								<div class="accordion__body__form">
									<div class="row">
										<div class="col-md-6">
											<div class="checkout-method__login">
												<form id="login-form" method="post">
													<h5 class="checkout-method__title">Login</h5>
													<div class="single-input">
														<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
														<span class="field_error" id="login_email_error"></span>
													</div>
													<div class="single-input">
														<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
														<span class="field_error" id="login_password_error"></span>
													</div>
													<p class="require">* Required fields</p>
													<div class="dark-btn">
														<button type="button" class="fv-btn" onclick="user_login('checkout');">Login</button>
													</div>
													
													<div class="form-output login_msg">
													<p class="form-messege field_error"></p>
													</div>
													
												</form>
											</div>
										</div>
										<div class="col-md-6">
											<div class="checkout-method__login">
												<form action="#">
													<h5 class="checkout-method__title">Register</h5>
													<div class="single-input">
														<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
														<span class="field_error" id="name_error"></span>
													</div>
													<div class="single-input">
														<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
														<span class="field_error" id="email_error"></span>
													</div>
												   <div class="single-input">
														<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
														<span class="field_error" id="mobile_error"></span>
												   </div>																
													<div class="single-input">
														<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
														<span class="field_error" id="password_error"></span>
													</div>
													<div class="dark-btn">
														<button type="button" class="fv-btn" onclick="user_register();">Register</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
							
							<div class="<?php echo $accordion_class?>">
								Address Information 
							</div>
							<form method="post" name="checkoutform" id="checkoutform" action="">
							<div class="accordion__body">
								<div class="bilinfo">
										<div class="row">
											<div class="col-md-12">
												<div class="single-input">
													<input type="text" name="address" placeholder="Street Address" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="single-input">
													<input type="text" name="city" placeholder="City/State" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="single-input">
													<input type="text" name="pincode" placeholder="Post code/ zip" required>
												</div>
											</div>
										</div>                                          
								</div>
							</div>
							<div class="<?php echo $accordion_class?>">
								payment information
							</div>
							<div class="accordion__body">
								<div class="paymentinfo">
									<div class="single-method">											
										COD : <input type="radio" name="payment_type" value="COD"  required>	
										<img src="<?php echo $COD_ICON?>" alt="logo images">										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Instamojo : <input type="radio" name="payment_type" value="instamojo" required>
										<img src="<?php echo $INSTAMOJO_ICON?>" alt="logo images">								
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Paytm : <input type="radio" name="payment_type" value="paytm" required>
										<img src="<?php echo $PAYTM_ICON?>" alt="logo images">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;											
										PayU : <input type="radio" name="payment_type" value="payu" required>
										<img src="<?php echo $PAYU_ICON ?>" alt="logo images">                                        
									</div><br/>
									<div class="single-method">										
									</div>
								</div>
							</div>
							<input type="submit" name="submit" class="fr__btn" value="submit" onclick="set_action();"/>
							</form>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="order-details">
					<h5 class="order-details__title">Your Order</h5>
					<div class="order-details__item">
					<?php $total = 0;
					foreach($_SESSION['cart'] as $id=>$val) {
						$prodInfo = $proObj->getProductFromID($pdoObj,$id);
						$total   += $val['qty']*$prodInfo['price'];?>
						<div class="single-item">
							<div class="single-item__thumb">
								<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$prodInfo['image']?>" alt="ordered item">
							</div>
							<div class="single-item__content">
								<a href="#"><?php echo $prodInfo['name'].' ('.$val['qty'].')'?></a>
								<span class="price"><?php echo $proObj->formatCurrency($prodInfo['price']).' * '.$val['qty'].'  =  '.$proObj->formatCurrency($val['qty']*$prodInfo['price'])?></span>
							</div>
							<div class="single-item__remove">
								<a href="javascript:void(0);" onclick="manage_cart('<?php echo $id?>','remove');"><i class="zmdi zmdi-delete"></i></a>
							</div>
						</div>
					<?php } ?>		                                
					</div>     
					<div class="ordre-details__total" id="coupon_box">
						<h5>Coupon Value</h5>
						<span class="price" id="coupon_price"><?php echo $proObj->formatCurrency($total)?></span>
					</div>														
					<div class="ordre-details__total">
						<h5>Order total</h5>
						<span class="price" id="order_total_price"><?php echo $proObj->formatCurrency($total)?></span>
					</div>
					<div class="ordre-details__total">
						<h5>availabe coupons</h5>
						<span class="price" id="order_total_price"><?php echo 'ff' ?></span>
					</div>
					<div class="ordre-details__total bilinfo">
					<input type="textbox" class="coupon_style mr5" id="coupon_code"/> 
					<input type="submit" name="submit" class="fr__btn coupon_style" value="Apply Coupon" onclick="set_coupon()"/>
					</div>
					<div id="coupon_result"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);	
}	
?>
<script>
function set_action(){
	for (var i = 0; i < document.checkoutform.payment_type.length; i++) {
		if (document.checkoutform.payment_type[i].checked) {					
			var payment_type = document.checkoutform.payment_type[i].value;
			if(payment_type == 'paytm'){
				document.getElementById('checkoutform').action= 'paytmredirect';
			}else {
				document.getElementById('checkoutform').action= 'checkout';
			}				
		}				
	}
	document.getElementById('checkoutform').submit();
} 
</script>
<!-- cart-main-area end -->
<!-- Start Footer Area -->