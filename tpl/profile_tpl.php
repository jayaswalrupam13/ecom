<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/profile1.jpg') no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Profile</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100">
            <div class="container">			
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Profile</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="profile-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" value="<?php echo $_SESSION['USER_NAME']?>" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_profile();" id="btn_profile_submit">Update</button>
									</div>
								</form>
							</div>
						</div> 
					</div>				
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Change Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="change-pwd-form" method="post">
									<div class="single-contact-form">
									<label class="password-label">Current Password:</label>
										<div class="contact-box name">										
											<input type="password" name="current_password" id="current_password" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
										</div>
										<span class="field_error" id="current_password_error"></span>
									</div>
									<div class="single-contact-form">
									<label class="password-label">New Password:</label>
										<div class="contact-box name">										
											<input type="password" name="new_password" id="new_password" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
										</div>
										<span class="field_error" id="new_password_error"></span>
									</div>
									<div class="single-contact-form">
									<label class="password-label">Confirm New Password:</label>
										<div class="contact-box name">										
											<input type="password" name="cnew_password" id="cnew_password" style="width:100%" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');"/>
										</div>
										<span class="field_error" id="cnew_password_error"></span>
									</div>
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_password();" id="btn_chpwd_submit">Update</button>
									</div>
								</form>
							</div>
						</div> 
					</div>
				</div>				
            </div>
        </section>
        <!-- End Contact Area -->
        <!-- End Banner Area -->