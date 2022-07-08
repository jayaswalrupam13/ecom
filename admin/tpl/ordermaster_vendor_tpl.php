<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Master </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Order ID</th>
									<th class="product-name"><span class="nobr">Order Date</span></th>
									<th class="product-name"><span class="nobr">Product /Qty</span></th>
									<th class="product-name"><span class="nobr">Address</span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($return['info'] as $v ) { ?>
								<tr>
									<td class="product-add-to-cart"><?php echo $v['id'] ?>&nbsp;
									<a href="<?php echo $HOSTNAME_URL?>/orderpdf?id=<?php echo $v['id'] ?>&from=admin"><img title="download pdf" src="<?php echo $HTDOCS_URL.'/img/pdf-2.jfif'?>" alt="ordered item" height="20" width="20"></a></td>
									<td class="product-name"><?php echo $v['added_on'] ?></td>
									<td class="product-name"><?php echo $v['name'].'<br/>QTY - '.$v['qty'] ?></td>
									<td class="product-name"><?php echo $v['address'] ?></td>
									<td class="product-name">
									<?php if($v['payment_type'] == 'instamojo'){ ?>
										<a href="typeinstamojo?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $INSTAMOJO_ICON?>" title="click to view Instamojo transation" alt="logo images" width="80" height="25" ></a>
									<?php } else if($v['payment_type'] == 'paytm'){ ?>
										<a href="typepaytm?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $PAYTM_ICON?>" title="click to view Paytm transation" alt="logo images" width="80" height="25" ></a>
										<?php } else if($v['payment_type'] == 'payu'){ ?>
										<a href="typepayu?action=view&orderid=<?php echo $v['id'] ?>"><img src="<?php echo $PAYU_ICON?>" title="click to view PayU transation" alt="logo images" width="80" height="25" ></a>
										<?php } else { ?>
										<img src="<?php echo $COD_ICON?>" alt="logo images" width="80" height="25" >
										<?php } ?>
										</td>
									<td class="product-name"><?php echo $v['payment_status'] ?></td>
									<td class="product-price"><span class="amount"><?php echo $proObj->formatCurrency($v['total_price']) ?></span></td>
									<td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $v['order_status_str'] ?></span></td>	
								</tr>
							<?php } ?>	
							</tbody>
						</table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>