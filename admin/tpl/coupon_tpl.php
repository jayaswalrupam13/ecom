<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Coupons - Total (<?php echo count($return['row']) ?>)</h4>
				   <h4 class="box-link"><a href="managecoupon?mode=add">Add Coupon</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">ID</th>							   
							   <th>Coupon Code</th>
							   <th>Coupon Value</th>
							   <th>Coupon Type</th>
							   <th>Min Cart Value</th>
							   <th>STATUS</th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($return['row'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $row['id']?></td>							   
							   <td><?php echo $row['coupon_code']?></td>
							   <td><?php echo $row['coupon_value']?></td>
							   <td><?php echo $row['coupon_type']?></td>
							   <td><?php echo $row['cart_min_value']?></td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=<?php echo $row['id']?>'>ON</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?type=status&operation=active&id=<?php echo $row['id']?>'>OFF</a></span>&nbsp;
								<?php } ?>
								<span  style="width:30px" class='badge badge-edit'><a href='managecoupon?mode=edit&id=<?php echo $row['id']?>'><img width="10px" src="<?php echo $HTDOCS_URL.'/img/edit1.png'?>"/></a></span>&nbsp;			
								<span class='badge badge-delete'><a href='?type=delete&id=<?php echo $row['id']?>'>X</a></span>						
							   </td>
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