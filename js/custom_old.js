function add_contactus(){
	var name = jQuery('#name').val();
	var email = jQuery('#email').val();
	var mobile = jQuery('#mobile').val();
	var message = jQuery('#message').val();
	if(name==""){
		alert('Please enter name');
	}else if(email==""){
		alert('Please enter email');
	}else if(mobile==""){
		alert('Please enter mobile');
	}else if(message==""){
		alert('Please enter message');
	}else{
		jQuery.ajax({
			url:'contact',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message+'&ajax=1',
			success:function(result){
				$('#contact-form')[0].reset();
			}
		});
	}
}

function user_register(){
	jQuery('.field_error').html('');
	var name = jQuery('#name').val();
	var email = jQuery('#email').val();
	var mobile = jQuery('#mobile').val();
	var password = jQuery('#password').val();
	var is_error='';
	if(name==""){
		jQuery('#name_error').html('Please enter name');
		is_error='yes';
	}if(email=="" || !validEmail(email)){
		jQuery('#email_error').html('Please enter valid email');
		is_error='yes';
	}if(mobile==""){
		jQuery('#mobile_error').html('Please enter mobile');
		is_error='yes';
	}if(password==""){
		jQuery('#password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'register',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
				if(result == '1'){
					jQuery('#name_error').html('All fields are mandatory');
				}
				if(result == '2'){
					jQuery('#email_error').html('Enter correct email');
				}
				if(result == '3'){
					jQuery('#email_error').html('Email already in use. Choose another one');
				}
				if(result == '4'){
					jQuery('#mobile_error').html('Mobile already in use. Choose another one');
				}
				if(result == 'success'){
					$('#register-form')[0].reset();
					$("#email_otp_result").html("");
					$("#mobile_otp_result").html("");
					jQuery('.register_msg p').html('Account has been created. You can login now.');
					
				}
			}
		});
	}
}

function user_login(back){
	jQuery('.field_error').html('');
	var email = jQuery('#login_email').val();
	var password = jQuery('#login_password').val();
	var is_error='';
	if(email=="" || !validEmail(email)){
		jQuery('#login_email_error').html('Please enter valid email');
		is_error='yes';
	}
	if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login',
			type:'post',
			data:'email='+email+'&password='+password+'&ajax=1&back='+back,
			success:function(result){
				if(result == '1'){
					jQuery('#login_email_error').html('All fields are mandatory');
				}
				if(result == '2'){
					jQuery('#login_email_error').html('Username doesnot exist.');
				}
				if(result == '3'){
					jQuery('#login_password_error').html('Incorrect password entered.');
				}
				if(result == 'success'){
					if(back == 'checkout'){
						window.location.href=window.location.href;
					}
					else{
						window.location.href=HOSTNAME_URL;
					}
				}
			}
		});
	}
}

function manage_cart(pid,type,from){
	jQuery('#update_error').html('');
	if(typeof from !== 'undefined'){		
		var qty = jQuery('#'+from).val();
	}else if(type=='update'){
		var qty = jQuery('#'+pid+'_qty').val();
	}else{
		var qty = jQuery('#qty').val();
	}
	let cid = jQuery('#cid').val();
	let sid = jQuery('#sid').val();alert('cid '+cid+' , sid '+sid);
	jQuery.ajax({
		url:'managecart',
		type:'post',
		data:'qty='+qty+'&pid='+pid+'&type='+type+'&cid='+cid+'&sid='+sid,
		success:function(result){
			if(type=='update' || type=='remove'){
				if($.isNumeric(result) == false){
					jQuery('#update_error').html(result);
				}else{
					window.location.href=window.location.href;
				}
			}
			else{
				jQuery('.htc__qua').html(result);
			}
		}
	});	
}

function manage_wishlist(pid,type){
	jQuery.ajax({
		url:'managewishlist',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			if(result == 'not_login'){
				window.location.href='login';
			}
			else if(result == '1'){
				alert('product already added to wishlist!!');
			}
			else{
				jQuery('.htc__wishlist').html(result);
			}
		}
	});	
}

function sort_product_drop(cat_id){
	var sort_product_id = jQuery('#sort_product_id').val();
	window.location.href=HOSTNAME_URL+'/category?id='+cat_id+'&sort='+sort_product_id;
}

function validEmail(p_str_email){
	var emailExp=/^[_a-z0-9+-=]+(\.[_a-z0-9+-=]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{0,61})$/i;
	if(!p_str_email.match(emailExp)){	
		return false;
	}
	return true;
}

function email_send_otp(){
	jQuery('#email_error').html('');
	var email = jQuery('#email').val();
	if( email == '' || !validEmail(email) ){
		jQuery('#email_error').html('Please enter email');
	}else{
		jQuery('.email_send_otp').html('Please wait....');
		jQuery('.email_send_otp').attr('disabled',true);
		jQuery.ajax({
			url:'sendotp',
			type:'post',
			data:'email='+email+'&type=email',
			success:function(result){
				if(result == 'success'){
					jQuery('#email').attr('disabled',true);
					jQuery('.email_verify_otp').show();
					jQuery('.email_send_otp').hide();
				}else{
					jQuery('.email_send_otp').html('Send OTP');
					jQuery('.email_send_otp').attr('disabled',false);
					if(result == '1'){
						jQuery('#email_error').html('Please enter valid email address');
					}else if(result == '2'){
						jQuery('#email_error').html('Email already in use');
					}else{					
						jQuery('#email_error').html('Please try after some time');
					}
				}
			}
		});
	}
}

function email_verify_otp(){
	jQuery('#email_error').html('');
	var email_otp = jQuery('#email_otp').val();
	if(email_otp == ''){
		jQuery('#email_error').html('Please enter OTP');
	}else{
		jQuery.ajax({
			url:'checkotp',
			type:'post',
			data:'otp='+email_otp+'&type=email',
			success:function(result){
				if(result == 'success'){
					jQuery('.email_verify_otp').hide();
					jQuery('#email_otp_result').html('Email id verified');
					jQuery('#is_email_verified').val('1');
					if(jQuery('#is_mobile_verified').val()== 1){
						jQuery('#btn_register').attr('disabled',false);
					}
				}else{
					jQuery('#email_error').html('Please enter valid OTP');
				}
			}
		});		
	}
}

function mobile_send_otp(){
	jQuery('#mobile_error').html('');
	var mobile = jQuery('#mobile').val();
	if(mobile == ''){
		jQuery('#mobile_error').html('Please enter mobile');
	}else{
		jQuery('.mobile_send_otp').html('Please wait....');
		jQuery('.mobile_send_otp').attr('disabled',true);
		jQuery.ajax({
			url:'sendotp',
			type:'post',
			data:'mobile='+mobile+'&type=mobile',
			success:function(result){
				if(result == 'success'){
					jQuery('#mobile').attr('disabled',true);
					jQuery('.mobile_verify_otp').show();
					jQuery('.mobile_send_otp').hide();
				}else{
					jQuery('.mobile_send_otp').html('Send OTP');
					jQuery('.mobile_send_otp').attr('disabled',false);
					if(result == '1'){
						jQuery('#mobile_error').html('Please enter valid Mobile number');
					}else if(result == '2'){
						jQuery('#mobile_error').html('Mobile already in use');
					}else{
						jQuery('#mobile_error').html('Please try after some time');
					}
				}
			}
		});
	}
}

function mobile_verify_otp(){
	jQuery('#mobile_error').html('');
	var mobile_otp = jQuery('#mobile_otp').val();
	if(mobile_otp == ''){
		jQuery('#mobile_error').html('Please enter OTP');
	}else{
		jQuery.ajax({
			url:'checkotp',
			type:'post',
			data:'otp='+mobile_otp+'&type=mobile',
			success:function(result){
				if(result == 'success'){
					jQuery('.mobile_verify_otp').hide();
					jQuery('#mobile_otp_result').html('Mobile number verified');
					jQuery('#is_mobile_verified').val('1');
					if(jQuery('#is_email_verified').val()== 1){
						jQuery('#btn_register').attr('disabled',false);
					}
				}else{
					jQuery('#mobile_error').html('Please enter valid OTP');
				}
			}
		});		
	}
}

function forgot_password(){
	jQuery('#email_error').html('');
	var email = jQuery('#email').val();
	if( email == '' || !validEmail(email) ){
		jQuery('#email_error').html('Please enter valid email');
	}else{
		jQuery('#btn_submit').html('Please wait....');
		jQuery('#btn_submit').attr('disabled',true);
		jQuery.ajax({
			url:'forgotpassword',
			type:'post',
			data:'email='+email+'&action=forgot',
			success:function(result){
				jQuery('#btn_submit').html('Submit');
				jQuery('#btn_submit').attr('disabled',false);
				if(result == 'success'){
					jQuery('#email').val('');
					jQuery('#email_error').html('Please check your email for password reset');
				}else if(result == '2'){
					jQuery('#email_error').html('Please enter valid email');
				}else if(result == '3'){
					jQuery('#email_error').html('Email doesnot exist');
				}else{
					jQuery('#email_error').html('Please try after some time');
				}
			}
		});
	}
}

function reset_password(){
	jQuery('#password_error').html('');
	var password = jQuery('#password').val();
	var cpassword = jQuery('#cpassword').val();
	var email = jQuery('#email').val();
	var token = jQuery('#token').val();
	if( password == '' || cpassword == '') {
		jQuery('#password_error').html('Please enter password');
	}else if( password != cpassword) {
		jQuery('#password_error').html('Both the passwords should match');
	}
	else{
		jQuery('#btn_submit').html('Please wait....');
		jQuery('#btn_submit').attr('disabled',true);
		jQuery.ajax({
			url:'resetpassword',
			type:'post',
			data:'password='+password+'&cpassword='+cpassword+'&token='+token+'&email='+email+'&submit=1&action=reset',
			success:function(result){
				if(result == 'success'){
					jQuery('#password').val('');
					jQuery('#password_error').html('Password has beed changed successfully.Please login with new one!!');
					jQuery('#btn_submit').html('Submit');
					jQuery('#btn_submit').attr('disabled',false);
				
				}else{
					jQuery('#password_error').html(result);
					jQuery('#btn_submit').html('Submit');
					jQuery('#btn_submit').attr('disabled',false);
				}
			}
		});
	}
}

function update_profile(){
	jQuery('.field_error').html('');	
	var name = jQuery('#name').val();
	if(name == ''){
		jQuery('#name_error').html('Please enter your name');
	}else{
		jQuery('#btn_profile_submit').html('Please wait....');
		jQuery('#btn_profile_submit').attr('disabled',true);
		jQuery.ajax({
			url:'profile',
			type:'post',
			data:'name='+name+'&action=edit',
			success:function(result){
				if(result == 'success'){
					jQuery('#name_error').html('Your name has beed changed successfully updated!!');
					jQuery('#btn_profile_submit').html('Update');
					jQuery('#btn_profile_submit').attr('disabled',false);
				}else if(result == '2'){
					jQuery('#name_error').html('Please enter valid name');
				}else{
					jQuery('#name_error').html('Please try after some time');
				}
			}
		});
	}
}

function update_password(){
	jQuery('.field_error').html('');
	var new_password = jQuery('#new_password').val();
	var cnew_password = jQuery('#cnew_password').val();
	var current_password = jQuery('#current_password').val();
	if( new_password == '' || cnew_password == '' || current_password == '' ) {
		jQuery('#current_password_error').html('Please enter all the passwords');
	}else if( new_password != cnew_password) {
		jQuery('#new_password_error').html('Both the passwords should match');
	}
	else{
		jQuery('#btn_chpwd_submit').html('Please wait....');
		jQuery('#btn_chpwd_submit').attr('disabled',true);
		jQuery.ajax({
			url:'changepassword',
			type:'post',
			data:'new_password='+new_password+'&current_password='+current_password+'&action=change',
			success:function(result){		
					jQuery('#btn_chpwd_submit').html('Submit');
					jQuery('#btn_chpwd_submit').attr('disabled',false);
				if(result == 'success'){
					jQuery('#cnew_password_error').html('Password has beed changed successfully.Please login with new one!!');
					//$('#change-pwd-form')[0].reset();
				}else{
					jQuery('#cnew_password_error').html(result);
				}
			}
		});
	}
}

function set_coupon(){
	var coupon_code = jQuery('#coupon_code').val();
	if(coupon_code != ''){
		jQuery.ajax({
			url:'setcoupon',
			type:'post',
			data:'coupon_code='+coupon_code,
			success:function(result){		
					var data = jQuery.parseJSON(result);
				if(data.status == 'success'){
					jQuery('#coupon_box').show();
					jQuery('#coupon_price').html(data.discount);
					jQuery('#coupon_result').html(data.msg);
					jQuery('#order_total_price').html(data.final_price);
					//$('#change-pwd-form')[0].reset();
				}else{
					jQuery('#coupon_box').hide();
					jQuery('#coupon_result').html(data.msg);
					//jQuery('#order_total_price').html(data.msg);
				}
			}
		});
	}
}

function swapImage(tinyImg,tinyID){ 
	bigImg = document.getElementById('big_image').src;
	document.getElementById(tinyID).src=bigImg;
	document.getElementById('big_image').src=tinyImg;
	document.getElementById('big_image').setAttribute('data-origin',  tinyImg);
	document.getElementById(tinyID).setAttribute('onclick',  "swapImage('"+bigImg+"','"+tinyID+"');");
}

$('.imageZoom').imgZoom();
$('.imageZoom').imgZoom({
  boxWidth: 360,
  boxHeight: 360,
  marginLeft: 5,
});

function loadAttr(attr_id,pid,type){
	jQuery('#cart_attr_msg').html('');
	jQuery.ajax({
		url:'product',
		type:'post',
		data:'attr_id='+attr_id+'&pid='+pid+'&type='+type,
		success:function(result){
			jQuery('#cid').val(attr_id);
			var obj = jQuery.parseJSON(result);
			html = "";
			html += "<option value=''>Size</option>";
			for(var key in obj) {
				html += "<option value=" + obj[key].size_id  + ">" +obj[key].size + "</option>";
			}
			jQuery('#size_attr').html(html);
			}
		
	});
}

function loadSize(arr){
	jQuery('#cart_attr_msg').html('');
	jQuery.ajax({
		url:'product',
		type:'post',
		data:'attr_id='+attr_id+'&pid='+pid+'&type='+type,
		success:function(result){
			jQuery('#cid').val(attr_id);
			var obj = jQuery.parseJSON(result);
			html = "";
			html += "<option value=''>Size</option>";
			for(var key in obj) {
				html += "<option value=" + obj[key].size_id  + ">" +obj[key].size + "</option>";
			}
			jQuery('#size_attr').html(html);
			}
		
	});
}

function makeSizeHTML(val,name,id){
	
}

function displaySize(names){
	//var names = JSON.stringify(names);
  //alert(names.length);
  //alert(names[0]['size']);
  //document.write( arr[0].cust_code );
    html = "";
	//html += "<option value=''>Size</option>";
		

 	for(var i=0; i<names.length; i++){//alert('v');
	    html += "<option value=" + names[i].size_id  + ">" +names[i].size + "</option>";
 		//alert(names[i].size);		
    }
	jQuery('#size_attr').html(html);
	jQuery('#cart_qty').removeClass('hide');
}
//displayName.apply(this, names);

function showQty(attr_status,attr_id){
	if(attr_status == 'size'){
		let sid = jQuery('#size_attr').val();
		jQuery('#sid').val(sid);
		jQuery('#cart_attr_msg').html('');
		jQuery('#cart_qty').removeClass('hide');
	}else if(attr_status == 'colour'){
		jQuery('#cid').val(attr_id);
		jQuery('#cart_attr_msg').html('');
		jQuery('#cart_qty').removeClass('hide');
	}else{
		let cid = jQuery('#cid').val();
		if(cid == ''){
			jQuery('#cart_attr_msg').html('Please select colour');
		}
		else{
			let sid = jQuery('#size_attr').val();
			jQuery('#sid').val(sid);
			jQuery('#cart_attr_msg').html('');
			jQuery('#cart_qty').removeClass('hide');
		}
	}
}