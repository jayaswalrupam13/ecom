<div class="body__overlay"></div>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/instamojo1.jpg') no-repeat scroll center center / cover ;">
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
						  <span class="breadcrumb-item active">My Order ID No - <?php echo $return['orderid']?></span>
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
			<div class="col-md-12 col-sm-12 col-xs-12"><div align="center"><img src="<?php echo $INSTAMOJO_ICON?>" alt="logo images"></div>
				<div class="wishlist-content">
					<form action="#">
						<div class="wishlist-table table-responsive">
							<table class="table  table-borderless table-success table-striped" style="background-color: #76D7C4;">
								<thead>
									<tr>
										<th class="product-thumbnail">Date</th>
										<th class="product-stock-stauts"><span class="nobr"> Payment<br/> Request ID </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment<br/> ID </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment<br/> Mode </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment<br/> Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Total<br/> Price </span></th>
									</tr>
								</thead>
								<tbody>
								<?php if(!isset($return['response']['technical_error'])){ foreach($return['paymentArr'] as $v){ ?>
									<tr>
										<td class="product-stock"><?php echo substr($v['created_at'],0,10)."<br/> @ " .substr($v['created_at'],11,8) ?></a></td>
										<td class="product-name"><?php echo $return['payment_request_id'] ?></td>
										<td class="product-name"><?php echo $v['payment_id'] ?></td>
										<td class="product-name"><?php echo $v['instrument_type'] ?></td>
										<td class="product-name"><?php echo $v['status'];if($v['status'] == 'Failed'){ echo '<br/>('.$v['failure']['reason'].')';} ?></td>
										<td class="product-price"><?php echo $v['currency'].'<br/>'.$proObj->formatCurrency($v['amount']) ?></td>
										
									</tr>
								<?php } } else { ?>	
									<tr>
										<td class="product-stock" colspan="6">Technical Error: <?php echo $return['response']['technical_error'] ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>  
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- wishlist-area end -->