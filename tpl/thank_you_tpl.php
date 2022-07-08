<div class="body__overlay"></div>

<!-- Start Bradcaump area -->
<?php $status = $request->getParameter("status");$type = $request->getParameter("type");?>
<div style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL;if($status == 'fail'){ ?>/failure1.png'<?php } else { ?>/thankyou2.jpg' <?php } ?>) no-repeat scroll center center / cover ;" class="ht__bradcaump__area">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
						  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
						  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
						  <span class="breadcrumb-item active"><?php if($status == 'fail'){ ?>OOPS Error!!<?php } else {?>Thank You<?php } ?></span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid ptb--100">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="htc__product__rightidebar">
					<div class="htc__grid__top"><b><h5><?php if($status == 'fail'){ ?>Your payment with <img alt="logo images" src="<?php if($type == 'instamojo'){ echo $INSTAMOJO_ICON; } elseif($type == 'payu'){ echo $PAYU_ICON; } elseif($type == 'paytm'){ echo $PAYTM_ICON; }  ?>" > is failed<?php if($type == 'paytm'){?> due to <?php $msg = $request->getParameter("msg");echo '<b>'.urldecode($msg).'</b>';} ?>. Please try after some time.<?php } else {?>Your order has been placed successfully. <?php } ?></h5></b>
					</div>
				<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
				</div>
				</div> 
			</div>
		</div>
		<!-- End Product View -->
	</div>
		<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
			<div class="htc__product__leftsidebar">				   
			</div>
		</div>
</section>
<!-- End Product Grid -->       
