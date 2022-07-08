<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Sub Categories </h4>
				   <h4 class="box-link"><a href="managesubcategory">Add Sub Categories</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">SR.No</th>
							   <th>ID</th>
							   <th>Categories</th>
							   <th>Sub Categories</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($return['row'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $k+1?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['categories_name']?></td>
							   <td><?php echo $row['sub_categories']?></td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=<?php echo $row['id']?>'>Active</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?type=status&operation=active&id=<?php echo $row['id']?>'>Deactive</a></span>&nbsp;
								<?php } ?>
								<span class='badge badge-edit'><a href='managesubcategory?id=<?php echo $row['id']?>'>Edit</a></span>&nbsp;					
								<span class='badge badge-delete'><a href='?type=delete&id=<?php echo $row['id']?>'>Delete</a></span>						
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