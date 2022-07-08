function add_more_images(){
	total_image++;
	var html = '<div id="add_image_box_'+total_image+'" class="col-lg-6" style="margin-top:20px"><label for="categories" class="form-control-label">Image</label><input type="file" name="product_images[]" class="form-control" required><button onclick="remove_image('+total_image+');" id="payment-button" type="button" class="btn btn-lg btn-danger btn-block" ><span id="payment-button-amount">Remove</span></button></div>';
	jQuery('#image_box').append(html);
}
function add_more_attr(){
	attr_count++;
	var size_html = jQuery('#attr_1 #size_id').html();
	var colour_html = jQuery('#attr_1 #colour_id').html();
	size_html   = size_html.replace('selected','');
	colour_html = colour_html.replace('selected','');
	var html = '<div class="row mt20" id="attr_'+attr_count+'"><div class="col-lg-2"><label for="categories" class="form-control-label">MRP</label><input type="text" name="mrp[]" placeholder="MRP" class="form-control" required value=""></div><div class="col-lg-2"><label for="categories" class="form-control-label">Price</label><input type="text" name="price[]" placeholder="Price" class="form-control" required value=""></div><div class="col-lg-2"><label for="categories" class="form-control-label">Qty</label><input type="text" name="qty[]" placeholder="Qty" class="form-control" required value=""></div><div class="col-lg-2"><label for="categories" class="form-control-label">Size</label><select class="form-control" name="size_id[]" id="size_id">'+size_html+'</select></div><div class="col-lg-2"><label for="categories" class="form-control-label">Colour</label><select class="form-control" name="colour_id[]" id="colour_id">'+colour_html+'</select></div><div class="col-lg-2"><label for="categories" class="form-control-label"></label> <button id="addimage-button" type="button" onclick="remove_attr('+attr_count+');" class="btn btn-lg btn-danger btn-block"> <span id="payment-button-amount">Remove</span> </button><input type="hidden" name="attr_id[]" value=""></div></div>';
	jQuery('#product_attr_box').append(html);
}
function remove_image(id){
	jQuery('#add_image_box_'+id).remove();
}
function remove_attr(attr_count,id){
	jQuery.ajax({
		url:'manageproduct?mode=delattr',
		data:'aid='+id,
		type:'post',
		success:function(result){
			jQuery('#attr_'+attr_count).remove();
		}
	});
	
}