<div class="body__overlay"></div>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/paytm1.jpg') no-repeat scroll center center / cover ;">
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
						  <span class="breadcrumb-item active">Order ID No - <?php echo $return['orderid']?></span>
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
	<div class="container"><div align="center"><img src="<?php echo $PAYTM_ICON?>" alt="logo images"></div><br/>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="wishlist-content">
					<form action="#">
						<div class="wishlist-table table-responsive">
							<table>
								<thead>
								<?php  if (isset($return['response']) && count($return['response'])>0 ) { 
										$temp = $return['response'];?>
									<tr>
										<th class="product-thumbnail">Date</th>
										<td class="product-stock"><?php echo substr($temp['TXNDATE'],0,-2) ?></a></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> ORDERID</span></th>
										<td class="product-name"><?php echo $temp['ORDERID'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> MID </span></th>
										<td class="product-name"><?php echo $temp['MID'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> TXNID </span></th>
										<td class="product-name"><?php echo $temp['TXNID'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> P_MODE </span></th>
										<td class="product-name"><?php echo $temp['PAYMENTMODE'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> Amount </span></th>
										<td class="product-name"><?php echo $proObj->formatCurrency($temp['TXNAMOUNT']) ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> GATEWAY </span></th>
										<td class="product-name"><?php echo $temp['GATEWAYNAME'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> Status </span></th>
										<td class="product-name"><?php echo $temp['STATUS'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> BANKTXNID </span></th>
										<td class="product-name"><?php echo $temp['BANKTXNID'] ?></td>
									</tr>
									<tr>
										<th class="product-stock-stauts"><span class="nobr"> BANK </span></th>
										<td class="product-name"><?php echo $temp['BANKNAME'] ?></td>
									</tr>
								</thead>
								<tbody>
								<?php }  else { ?>	
									<tr>
										<td class="product-stock" colspan="10"><?php if ($temp["STATUS"] != "TXN_SUCCESS"){?>Transaction status is failure.<?php } else { ?>Technical Error Encountered - Checksum mismatched.<?php } ?></td>
									</tr>
								<?php } ?>
									</tr>
								
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

