<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Contact Us </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Name/Email</th>
							   <th>Product</th>
							   <th>Review</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							foreach($return['comment'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $k+1 ?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['username']." / ".$row['email']?></td>
							   <td><?php echo $row['pname']?></td>
							   <td><?php echo $row['review']?></td>
							   <td><?php echo $row['added_on']?></td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=<?php echo $row['id']?>'>ON</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?type=status&operation=active&id=<?php echo $row['id']?>'>OFF</a></span>&nbsp;
								<?php } ?>											
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