<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Coupon</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   	<div class="form-group">
									<label for="coupon_code" class=" form-control-label">Coupon Code</label>
									<input type="text" name="coupon_code" placeholder="Enter Coupon Code" class="form-control" required value="<?php echo $return['data']['coupon_code']?>">
								</div>	
								<div class="form-group">
									<label for="coupon_value" class=" form-control-label">Coupon Value</label>
									<input type="text" name="coupon_value" placeholder="Enter Coupon Value" class="form-control" required value="<?php echo $return['data']['coupon_value']?>">
								</div>
								<div class="form-group">
									<label for="coupon_type" class=" form-control-label">Coupon Type</label>
									<select class="form-control" name="coupon_type"  id="coupon_type" required>
									<option>Select Coupon Type</option>										
									<option <?php if($return['data']['coupon_type'] == 'Percentage'){echo "selected";}?> value="Percentage">Percentage</option>
									<option <?php if($return['data']['coupon_type'] == $CURRENCY_NAME){echo "selected";}?> value="<?php echo $CURRENCY_NAME?>"><?php echo $CURRENCY_NAME?></option>
											
									</select>
								</div>								
								<div class="form-group">
									<label for="cart_min_value" class=" form-control-label">Cart Min Value</label>
									<input type="text" name="cart_min_value" placeholder="Enter Cart Min Value" class="form-control" required value="<?php echo $return['data']['cart_min_value']?>">
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