<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Size</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="size" class=" form-control-label">Size</label>
									<input type="text" name="size" placeholder="Enter size name" class="form-control" required value="<?php echo $return['size']?>">
									<input type="hidden" name="mode" value="<?php echo $return['mode']?>">
								</div>
								<div class="form-group">
									<label for="priority" class=" form-control-label">Priority</label>
									<input type="text" name="priority" placeholder="Enter priority" class="form-control" required value="<?php echo $return['priority']?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" value="submit" class="btn btn-lg btn-info btn-block">
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