<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Vendor</strong><small> Form</small></div>
                        <form method="post">
						<input type="hidden" name="action" value="<?php echo $return['action']?>">
							<div class="card-body card-block">
							   	<div class="form-group">
									<label for="coupon_code" class="form-control-label">Vendor Name</label>
									<?php if($return['action'] == 'add'){ ?><input type="text" name="username" placeholder="Enter Vendor Name" class="form-control" required value="<?php echo $return['username']?>">
									<?php } else { echo ' - '.$return['username']; } ?>
									
								</div>	
								<div class="form-group">
									<label for="coupon_value" class="form-control-label">Email</label>
									<input type="text" name="email" placeholder="Enter Email" class="form-control" required value="<?php echo $return['email']?>">
								</div>
								<div class="form-group">
									<label for="coupon_type" class="form-control-label">Password</label>
									<input type="text" name="password" placeholder="Enter Password" class="form-control" required value="<?php echo $return['password']?>">
								</div>		
								<div class="form-group">
									<label for="coupon_type" class="form-control-label">Mobile</label>
									<input type="text" name="mobile" placeholder="Enter Mobile" class="form-control" required value="<?php echo $return['mobile']?>">
								</div>							
							   <button id="payment-button" name="submit" type="submit" value="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php if(isset($return['msg'])){echo $return['msg'];}?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>