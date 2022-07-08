<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Banner </h4>
				   <h4 class="box-link"><a href="managebanner?mode=add">Add Banner</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">SR.No</th>
							   <th>HEADING 1</th>
							   <th>HEADING 2</th>
							   <th>BUTTON TEXT</th>
							   <th>BUTTON LINK</th>
							   <th>IMAGE</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($return['row'] as $k => $row){?>
							<tr>
							   <td class="serial"><?php echo $k+1?></td>
							   <td><?php echo $row['heading1']?></td>
							   <td><?php echo $row['heading2']?></td>
							   <td><?php echo $row['btn_text']?></td>
							   <td><?php echo $row['btn_link']?></td>
							   <td><img src="<?php echo $BANNER_URL.'/'.$row['image']?>"/></td>
							   <td>
								<?php if($row['status'] == 1){ ?>
									<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=<?php echo $row['id']?>'>ON</a></span>&nbsp;
								<?php }else{?>
									<span class='badge badge-pending'><a href='?type=status&operation=active&id=<?php echo $row['id']?>'>OFF</a></span>&nbsp;
								<?php } ?>
								<span class='badge badge-edit'><a href='managebanner?mode=edit&id=<?php echo $row['id']?>'><img width="10" src="<?php echo $HTDOCS_URL.'/img/edit1.png'?>"/></a></span>&nbsp;					
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