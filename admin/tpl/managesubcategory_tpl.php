<div class="content pb-0">
	<div class="animated fadeIn">
	   <div class="row">
		  <div class="col-lg-12">
			 <div class="card">
				<div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
				<form method="post">
					<div class="card-body card-block">
					   <div class="form-group">
							<label for="categories" class="form-control-label">Sub Categories</label>
							<select name="categories_id" required class="form-control">
							<option value="blank">Select Categories</option>
							
							<?php foreach($return['categories_list'] as $k => $row){
							if($row['id']==$return['categories_id']){?>
								<option selected value="<?php echo $row['id']?>"><?php echo $row['categories']?></option>
							<?php }else{?>
								<option value="<?php echo $row['id']?>"><?php echo $row['categories']?></option>
							<?php } } ?>	
							</select>
						</div>
						<div class="form-group">
							<label for="categories" class=" form-control-label">Sub Categories Name</label>
							<input type="text" name="sub_categories" placeholder="Enter Sub Categories name" class="form-control" required value="<?php echo $return['sub_categories']?>">
						</div>
					   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block" value="submit">
					   <span id="payment-button-amount">Submit</span>
					   </button>
					   <div class="field_error"><?php echo $return['msg']?></div>
					</div>
				</form>
			 </div>
		  </div>
	   </div>
	</div>
	</div>