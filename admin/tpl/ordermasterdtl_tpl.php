<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Detail </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
				    <table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Product Name</th>
									<th class="product-thumbnail">Vendor</th>
									<th class="product-thumbnail"><span class="nobr">Product Image</span></th>
									<th class="product-name"><span class="nobr">Qty</span></th>
									<th class="product-price"><span class="nobr"> Price </span></th>
									<th class="product-price"><span class="nobr"> Total Price </span></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($return['info'] as $v ) { ?>
								<tr>
									<td class="product-name"><a href="myorderdtls?id=<?php echo $v['name'] ?>"><?php echo $v['name'] ?></a></td>
									<td class="product-name"><?php echo $v['username'] ?></td>
									<td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="ordered item"></td>
									<td class="product-name"><a href="#"><?php echo $v['qty'] ?></a></td>
									<td class="product-name"><span class="amount"><?php echo $proObj->formatCurrency($v['price']) ?></span></td>
									<td class="product-name"><span class="wishlist-in-stock"><?php echo $proObj->formatCurrency($v['qty']*$v['price']) ?></span></td>										
								</tr>
							<?php } if($return['info'][0]['coupon_value']) {?>	
									<tr>
										<td colspan="4"></td>
										<td class="product-name">Coupon Discount: <span style="color:red"><?php echo $return['info'][0]['coupon_code'] ?></span></td>
										<td class="product-name"><?php echo $proObj->formatCurrency($return['info'][0]['coupon_value']) ?></td>
									</tr>
								<?php } ?>							
								<tr>
									<td colspan="4"></td>
									<td class="product-name">Total Price</td>
									<td class="product-name"><a href="#"><?php echo $proObj->formatCurrency($return['info'][0]['total_price']) ?></a></td>
								</tr>
							</tbody>
					</table>
					<div id="address_details">
					<strong>Address</strong>
					<?php echo $return['info'][0]['address'].', '.$return['info'][0]['city'].', '.$return['info'][0]['pincode'].', '?><br/>
					<strong>Order Status</strong>
					<?php echo $return['info'][0]['order_status_name']?>
					</div>
					<div><br/>
					<form method="post">
					<select name="update_order_status">
						<option>Select Status</option>
						<?php foreach($return['name'] as $k => $row){
							if($row['id']==$return['info'][0]['order_status']){?>
								<option selected value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
							<?php }else{?>
								<option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
							<?php } } ?>
					</select>&nbsp;&nbsp;&nbsp;
					<input type="submit"/>
					</form>
					</div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>