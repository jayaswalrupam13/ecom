<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">	
							   <div class="field_error"><?php if(isset($return['msg']) && $return['msg'] != ''){echo 'Error : '.$return['msg'];}?></div>						   
								   <div class="row">
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Categories</label>
											<select class="form-control" name="categories_id"  id="categories_id" onchange="get_sub_cat();" required>
												<option>Select Category</option>
												<?php foreach($return['category'] as $k => $row){?>
													<option 
													<?php if($row['id']==$return['data']['categories_id']){ ?>selected<?php } ?> value="<?php echo $row['id']?>"><?php echo $row['categories']?></option>
													<?php }  ?>
											</select>	
										</div>										
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Sub Categories</label>
												<select class="form-control" name="sub_categories_id" id="sub_categories_id">
													<option>Select Sub Category</option>
												</select>
										</div>
									</div>								
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-lg-9">
											<label for="categories" class="form-control-label">Product Name</label>
											<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $return['data']['name']?>">
										</div>
										<div class="col-lg-3">
											<label for="categories" class="form-control-label">Best Seller</label>
											<select class="form-control" name="best_seller" required>
												<option value="1" <?php if($return['data']['best_seller'] == "1"){ echo "selected";} ?>>Yes</option>
												<option value="0" <?php if($return['data']['best_seller'] == "0"){ echo "selected";} ?>>No</option>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group" id="product_attr_box">
								<?php $i = 1; foreach($return['data']['product_attrs'] as $k => $v) { ?>
									<div class="row" id="attr_<?php echo $i;?>">										
										<div class="col-lg-2">
											<label for="categories" class="form-control-label">MRP</label>
											<input type="text" name="mrp[]" placeholder="MRP" class="form-control" required value="<?php echo $v['mrp']?>">
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label">Price</label>
											<input type="text" name="price[]" placeholder="Price" class="form-control" required value="<?php echo $v['price']?>">
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label">Qty</label>
											<input type="text" name="qty[]" placeholder="Qty" class="form-control" required value="<?php echo $v['qty']?>">
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label">Size</label>
											<select class="form-control" name="size_id[]"  id="size_id">
												<option>Select Size</option>
												<?php foreach($return['size'] as $k => $row){ ?>
												<option <?php if($row['id']==$v['size_id']){?> selected <?php } ?> value="<?php echo $row['id']?>"><?php echo $row['size']?></option>
												<?php } ?>
											</select>	
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label">Colour</label>
											<select class="form-control" name="colour_id[]"  id="colour_id">
												<option>Select Colour</option>
												<?php foreach($return['colour'] as $k => $row){ ?>
													<option <?php if($row['id']==$v['colour_id']){?>selected <?php } ?>value="<?php echo $row['id']?>"><?php echo $row['colour']?></option>
													<?php }  ?>
											</select>	
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label"></label>
											<?php if($i == 1) { ?>
											 <button id="addimage-button" type="button" onclick="add_more_attr();" class="btn btn-lg btn-info btn-block">
											  <span id="payment-button-amount">Add More</span></button>
											<?php } else { ?>
											<button id="addimage-button" type="button" onclick="remove_attr('<?php echo $i;?>','<?php echo $v['id'];?>');" class="btn btn-lg btn-danger btn-block"><span id="payment-button-amount">Remove</span></button>
											<?php } ?>
										</div><input type="hidden" name="attr_id[]" value="<?php echo $v['id'];?>">
									</div>
								<?php $i++; } ?>
								</div>
								
								<div class="form-group">
									<div class="row" id="image_box">
										<div class="col-lg-10">
											<label for="categories" class="form-control-label">Image  &nbsp;&nbsp;&nbsp;<span style="color:red">* Image should be of type <?php echo implode(', ',$FILE_EXT_LIST_2)?></span></label>
											<input type="file" name="image" class="form-control" <?php echo $return['image_required']?>>
										<?php if(isset($return['data']['image']) && $return['data']['image'] != '') { ?> 
											<a href="<?php echo PRODUCT_IMAGE_SITE_PATH.$return['data']['image']?>" target="_blank"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$return['data']['image']?>" width="150px"/></a>
										<?php } ?>
										</div>
										<div class="col-lg-2">
											<label for="categories" class="form-control-label"></label>
											 <button id="addimage-button" type="button" onclick="add_more_images();" class="btn btn-lg btn-info btn-block">
											  <span id="payment-button-amount">Add Image</span>
											  </button>
										</div>
										<?php if( isset($return['data']['multiple_images']) && is_array($return['data']['multiple_images']) ) { 
										foreach($return['data']['multiple_images'] as $k => $list){ ?>
										<div id="add_image_box_<?php echo $list['id'];?>" class="col-lg-6" style="margin-top:20px">
											<label for="categories" class="form-control-label">Image</label>
											<input type="file" name="product_images[]" class="form-control"><a href="manageproduct?mode=edit&id=<?php echo $return['id'].'&pid='.$list['id']; ?>" style="color:white"><button  id="payment-button" type="button" class="btn btn-lg btn-danger btn-block" ><span id="payment-button-amount">Remove</span></button></a>
											<a style="color:white" href="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']?>" target="_blank"><img src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']?>" width="150px"/>
											</a><input type="hidden" name="product_images_id[]" value="<?php echo $list['id']; ?>"/>
										</div>
										<?php } } ?>
									</div>									
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Short Description</label>
											<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $return['data']['short_desc']?></textarea>
										</div>
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Description</label>
											<textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $return['data']['description']?></textarea>
										</div>
									</div>									
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-lg-4">
											<label for="categories" class="form-control-label">Meta Title</label>
											<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $return['data']['meta_title']?></textarea>
										</div>
										<div class="col-lg-4">
											<label for="categories" class="form-control-label">Meta Description</label>
											<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $return['data']['meta_desc']?></textarea>
										</div>
										<div class="col-lg-4">
											<label for="categories" class="form-control-label">Meta Keyword</label>
											<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $return['data']['meta_keyword']?></textarea>
										</div>
									</div>									
								</div>
							   <button id="payment-button" name="submit" type="submit" value="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 <script>	
		 var total_image=1;
		 var attr_count=1;
		 function get_sub_cat(){
			 var categories_id=jQuery('#categories_id').val();
			 jQuery.ajax({
				 url:'getsubcategory',
				 type:'post',
				 data:'categories_id='+categories_id,
				 success:function(result){
					 jQuery('#sub_categories_id').html(result);
				 }
			 });
		 }
		 <?php if(isset($_GET['id'])){?>
		 window.onload = get_sub_cat;
		 
		 //$(document).ready( function () {		  get_sub_cat();			});
		 <?php } ?>
		 </script>