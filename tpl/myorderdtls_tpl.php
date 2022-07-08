<div class="body__overlay"></div>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/myorderdtls1.jpg') no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
						  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
						  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
						  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL.'/myorder' ?>">My Orders</a>
						  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
						  <span class="breadcrumb-item active">My Order ID No - <?php echo $return['order_id']?></span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<!-- End Product Grid -->  
<div class="wishlist-area ptb--100">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="wishlist-content">
					<form action="#">
						<div class="wishlist-table table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-thumbnail">SR.No</th>
										<th class="product-name">Product Name</th>
										<th class="product-name"><span class="nobr">Product Image</span></th>
										<th class="product-name"><span class="nobr">Qty</span></th>
										<th class="product-thumbnail"><span class="nobr"> Price </span></th>
										<th class="product-thumbnail"><span class="nobr"> Total Price </span></th>
									</tr>
								</thead>
								<tbody>
								<?php if( isset($return['info']) && is_array($return['info']) ){ foreach($return['info'] as $k=>$v ) { ?>
									<tr>
										<td class="product-name"><?php echo $k+1; ?></td>
										<td class="product-name"><a href="<?php echo $HOSTNAME_URL.'/myorderdtls?id='.$v['name'] ?>"><?php echo $v['name'] ?></a></td>
										<td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="ordered item" height="100" width="100"></td>
										<td class="product-name"><?php echo $v['qty'] ?></td>
										<td class="product-name"><span class="amount"><?php echo $proObj->formatCurrency($v['price']) ?></span></td>
										<td class="product-name"><span class="wishlist-in-stock"><?php echo $proObj->formatCurrency($v['qty']*$v['price']) ?></span></td>										
									</tr>
								<?php } if($return['user_info']['coupon_value']) {?>	
									<tr>
										<td colspan="4"></td>
										<td class="product-name">Coupon Discount<br/><span style="color:red"><?php echo $return['user_info']['coupon_code'] ?></span></td>
										<td class="product-name"><?php echo $proObj->formatCurrency($return['user_info']['coupon_value']) ?></td>
									</tr>
								<?php } ?>
									<tr>
										<td colspan="4"></td>
										<td class="product-name">Total Price</td>
										<td class="product-name"><?php echo $proObj->formatCurrency($return['user_info']['total_price']) ?></td>
									</tr>
								<?php } else { ?>
								No Record with this Order ID - <?php echo $return['order_id']?> found for User <?php echo $_SESSION['USER_NAME'] ?>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">
											<div class="wishlist-share">
												<h4 class="wishlist-share-title">Share on:</h4>
												<div class="social-icon">
													<ul>
														<li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
														<li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
														<li><a href="#"><i class="zmdi zmdi-tumblr"></i></a></li>
														<li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
														<li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>  
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- wishlist-area end -->