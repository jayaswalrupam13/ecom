<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Banner</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="heading1" class=" form-control-label">Heading 1</label>
									<input type="text" name="heading1" placeholder="Enter Heading 1" class="form-control" required value="<?php echo $return['banner']['heading1']?>">
								</div>
								<div class="form-group">
									<label for="heading2" class=" form-control-label">Heading 2</label>
									<input type="text" name="heading2" placeholder="Enter Heading 2" class="form-control" required value="<?php echo $return['banner']['heading2']?>">
								</div>
								<div class="form-group">
									<label for="btn_text" class=" form-control-label">Button Text</label>
									<input type="text" name="btn_text" placeholder="Enter Button Text" class="form-control" value="<?php echo $return['banner']['btn_text']?>">
								</div>
								<div class="form-group">
									<label for="btn_link" class=" form-control-label">Button Link</label>
									<input type="text" name="btn_link" placeholder="Enter Button Link" class="form-control" value="<?php echo $return['banner']['btn_link']?>">
								</div>
								<div class="form-group">
									<label for="image" class=" form-control-label">Image</label>
									<input type="file" name="image" placeholder="Enter Image" class="form-control" required value="<?php echo $return['banner']['image']?>" <?php echo $return['image_required']?>>
									<?php if($return['banner']['image']){ ?>
									<a target="_blank" href="<?php echo $BANNER_URL.'/'.$return['banner']['image']?>"><img width="150px" src="<?php echo $BANNER_URL.'/'.$return['banner']['image'] ?>"/></a>
									<?php } ?>
									<input type="hidden" name="status" value="<?php echo $return['banner']['status']?>">
								</div>
							   <button id="payment-button" name="submit" type="submit"  value="submit" class="btn btn-lg btn-info btn-block">
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