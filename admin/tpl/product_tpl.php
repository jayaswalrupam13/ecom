<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products - Total: <?php echo count($return['row']) ?></h4>
				   <h4 class="box-link"><a href="manageproduct?mode=add">Add Product</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">ID</th>							   
							   <th>Cat</th>
							   <th>Sub Cat</th>
							   <th>Name</th>
							   <th>Image</th>
							   <th>MRP</th>
							   <th>Price</th>
							   <th>Qty</th>
							   <th>Total: <?php echo count($return['row']) ?></th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($return['row'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $row['id']?></td>							   
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['sub_categories_name']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
							   <td><?php echo $proObj->formatCurrency($row['mrp'])?></td>
							   <td><?php echo $proObj->formatCurrency($row['price'])?></td>
							   <td><?php echo $row['qty'];
							   $soldNum = $proObj->getProdSoldNumByID($pdoObj,$row['id']);
							   $leftNum = $row['qty'] - $soldNum;?>
							   <br/>Avail: <?php echo $leftNum ?>
							   </td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=<?php echo $row['id']?>'>ON</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?type=status&operation=active&id=<?php echo $row['id']?>'>OFF</a></span>&nbsp;
								<?php } ?>
								<span  style="width:30px" class='badge badge-edit'><a href='manageproduct?mode=edit&id=<?php echo $row['id']?>'><img width="10px" src="<?php echo $HTDOCS_URL.'/img/edit1.png'?>"/></a></span>&nbsp;			
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