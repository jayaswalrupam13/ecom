<div class="body__overlay"></div>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/myorder1.jpg') no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
						  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
						  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
						  <span class="breadcrumb-item active">My Orders</span>
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
										<th class="product-thumbnail">Order ID</th>
										<th class="product-name"><span class="nobr">Order Date</span></th>
										<th class="product-price"><span class="nobr">Address</span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($return['info'] as $v ) { ?>
									<tr>
										<td class="product-stock"><a style="text-decoration: underline;" href="myorderdtls?id=<?php echo $v['id'] ?>"><?php echo $v['id'] ?></a>
										<a href="orderpdf?id=<?php echo $v['id'] ?>">&nbsp;  <img title="download pdf" src="<?php echo $HTDOCS_URL.'/img/pdf-2.jfif'?>" alt="ordered item" height="20" width="20"></a>
										</td>
										<td class="product-name"><?php echo $v['added_on'] ?></td>
										<td class="product-name"><?php echo $v['address'] ?></td>
										<td class="product-name">
										<?php if($v['payment_type'] == 'instamojo'){ ?>
										<a href="typeinstamojo?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $INSTAMOJO_ICON?>" title="click to view Instamojo transation" alt="logo images"><br/>Click</a>
										<?php } elseif($v['payment_type'] == 'payu'){ ?>
										<a href="typepayu?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $PAYU_ICON?>" title="click to view PayU transation" alt="logo images"><br/>Click</a>
										<?php } elseif($v['payment_type'] == 'paytm'){ ?>
										<a href="typepaytm?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $PAYTM_ICON?>" title="click to view Paytm transation" alt="logo images"><br/>Click</a>
										<?php } else { ?>
										<?php echo $v['payment_type']; } ?>
										</td>
										<td class="product-name"><?php echo $v['payment_status'] ?></td>
										<td class="product-price"><span class="amount"><?php echo $proObj->formatCurrency($v['total_price']) ?></span></td>
										<td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $v['order_status_str'] ?></span></td>
										
									</tr>
								<?php } ?>	
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">
											<div class="wishlist-share">
												<h4 class="wishlist-share-title">Share on:</h4>
												<div class="social-icon">
													<ul>
														<li><i class="zmdi zmdi-rss"></i></li>
														<li><i class="zmdi zmdi-vimeo"></i></li>
														<li><i class="zmdi zmdi-tumblr"></i></li>
														<li><i class="zmdi zmdi-pinterest"></i></li>
														<li><i class="zmdi zmdi-linkedin"></i></li>
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