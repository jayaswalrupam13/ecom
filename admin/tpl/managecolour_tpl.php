<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Colour</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="colour" class=" form-control-label">Colour</label>
									<input type="text" name="colour" placeholder="Enter colour name" class="form-control" required value="<?php echo $return['colour']?>">
									<input type="hidden" name="mode" value="<?php echo $return['mode']?>">
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