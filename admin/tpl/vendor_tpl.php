<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Vendors - Total (<?php echo count($return['vendor']) ?>)</h4>
				   <h4 class="box-link"><a href="vendor?action=add">Add Vendor</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
						 <thead>
							<tr>
							   <th class="serial">SR.No</th>							   
							   <th class="serial">ID</th>							   
							   <th>Name</th>
							   <th>Password</th>
							   <th>Email</th>
							   <th>Mobile</th>
							   <th>STATUS</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($return['vendor'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $k+1?></td>							   
							   <td class="serial"><?php echo $row['id']?></td>							   
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['password']?></td>
							   <td><?php echo $row['email']?></td>
							   <td><?php echo $row['mobile']?></td>
							   <td><?php if($row['status'] == 1) { echo 'ACTIVE'; } else { echo 'DEACTIVE';} ?></td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?action=status&operation=deactive&id=<?php echo $row['id']?>'>OFF</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?action=status&operation=active&id=<?php echo $row['id']?>'>ON</a></span>&nbsp;
								<?php } ?>
								<span  style="width:30px" class='badge badge-edit'><a href='vendor?action=edit&id=<?php echo $row['id']?>'><img width="10px" src="<?php echo $HTDOCS_URL.'/img/edit1.png'?>"/></a></span>&nbsp;			
								<span class='badge badge-delete'><a href='?action=delete&id=<?php echo $row['id']?>'>X</a></span>						
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