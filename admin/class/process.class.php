<?php
class process{
	
	function checkAdminUserPwd($pdoObj, $details){
		$sql    = "SELECT * FROM admin_users WHERE username = :username AND password = :password";
		$array  = ['username' => $details['username'],'password' => $details['password']];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function checkAdminUserExists($pdoObj, $username){
		$sql    = "SELECT * FROM admin_users WHERE username = :username";
		$array  = ['username' => $username];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function editOrderStatus($pdoObj,$order_status,$id){
		$sql    = "UPDATE user_order SET order_status = :order_status WHERE id = :id";
		$array  = ['order_status' => $order_status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editCategoryStatus($pdoObj,$status,$id){
		$sql    = "UPDATE categories set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editVendorStatus($pdoObj,$status,$id){
		$sql    = "UPDATE admin_users set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editBannerStatus($pdoObj,$status,$id){
		$sql    = "UPDATE banner set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editColourStatus($pdoObj,$status,$id){
		$sql    = "UPDATE colour_master set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editSizeStatus($pdoObj,$status,$id){
		$sql    = "UPDATE size_master set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editCouponStatus($pdoObj,$status,$id){
		$sql    = "UPDATE coupon_master SET status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editProductReviewStatus($pdoObj,$status,$id){
		$sql    = "UPDATE product_review SET status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
		
	function editProductStatus($pdoObj,$status,$id){
		$where = "";
		if($_SESSION['ADMIN_ROLE'] == 'vendor'){
			$where .= ' AND added_by = "'.$_SESSION['ADMIN_ID'].'"';
		} 
		$sql    = "UPDATE product SET status = :status WHERE id = :id $where";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function editSubCategoryStatus($pdoObj,$status,$id){
		$sql    = "UPDATE sub_categories set status = :status WHERE id = :id";
		$array  = ['status' => $status,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function deleteCategory($pdoObj,$id){
		$sql   = "DELETE FROM categories WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteProdImages($pdoObj,$id){
		$sql   = "DELETE FROM product_images WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteProdAttr($pdoObj,$id){
		$sql   = "DELETE FROM product_attributes WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteBanner($pdoObj,$id){
		$sql   = "DELETE FROM banner WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteColour($pdoObj,$id){
		$sql   = "DELETE FROM colour_master WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteSize($pdoObj,$id){
		$sql   = "DELETE FROM size_master WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteSubCategory($pdoObj,$id){
		$sql   = "DELETE FROM sub_categories WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}		
	
	function getAllCategory($pdoObj){
		$sql = "SELECT * FROM categories ORDER BY categories ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllColours($pdoObj){
		$sql = "SELECT * FROM colour_master ORDER BY colour ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllSizes($pdoObj){
		$sql = "SELECT * FROM size_master ORDER BY priority ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllActiveColours($pdoObj){
		$sql = "SELECT * FROM colour_master WHERE status = 1 ORDER BY colour ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllActiveSizes($pdoObj){
		$sql = "SELECT * FROM size_master WHERE status = 1 ORDER BY priority ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllBanner($pdoObj){
		$sql = "SELECT * FROM banner ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllUser($pdoObj){
		$sql = "SELECT * FROM users ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllAdminUser($pdoObj){
		$sql = "SELECT * FROM admin_users ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllSubCategory($pdoObj){
		//$sql = "SELECT sc.*, c.categories AS categories_name FROM sub_categories sc, categories c WHERE sc.categories_id = c.id ORDER BY sc.id DESC";
		$sql = "SELECT sc.*, c.categories AS categories_name FROM sub_categories sc LEFT JOIN categories c ON sc.categories_id = c.id ORDER BY sc.id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getActiveCategory($pdoObj){
		$sql = "SELECT * FROM categories WHERE status = '1' ORDER BY categories ASC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getActiveBanner($pdoObj){
		$sql = "SELECT * FROM banner WHERE status = '1' ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function editColour($pdoObj,$colour,$id){
		$sql    = "UPDATE colour_master SET colour = :colour WHERE id = :id";
		$array  = ['colour' => $colour,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editSize($pdoObj,$size,$priority,$id){
		$sql    = "UPDATE size_master SET size = :size, priority = :priority WHERE id = :id";
		$array  = ['size' => $size,'priority' => $priority,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editCategoryName($pdoObj,$category,$id){
		$sql    = "UPDATE categories SET categories = :category WHERE id = :id";
		$array  = ['category' => $category,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editBannerWithImg($pdoObj,$return,$id){
		$sql    = "UPDATE `banner` SET `heading1` = :heading1,`heading2`= :heading2,`btn_text`= :btn_text,`btn_link`= :btn_link,`image`= :image,`status`= :status WHERE id = :id";
		$array  = ['heading1' => $return['heading1'], 'heading2' => $return['heading2'], 'btn_text' => $return['btn_text'], 'btn_link' => $return['btn_link'], 'image' => $return['image'], 'status' => $return['status'], 'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editBannerNoImg($pdoObj,$return,$id){
		$sql    = "UPDATE `banner` SET `heading1` = :heading1,`heading2`= :heading2,`btn_text`= :btn_text,`btn_link`= :btn_link,`status`= :status WHERE id = :id";
		$array  = ['heading1' => $return['heading1'], 'heading2' => $return['heading2'], 'btn_text' => $return['btn_text'], 'btn_link' => $return['btn_link'], 'status' => $return['status'], 'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editSubCategory($pdoObj,$categories_id,$sub_categories,$id){
		$sql    = "UPDATE sub_categories SET categories_id = :categories_id, sub_categories = :sub_categories WHERE id = :id";
		$array  = ['categories_id' => $categories_id,'sub_categories' => $sub_categories,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function editVendor($pdoObj,$details,$id){
		$sql    = "UPDATE admin_users SET password = :password, email = :email, mobile = :mobile WHERE id = :id";
		$array  = ['password' => $details['password'], 'email' => $details['email'], 'mobile' => $details['mobile'], 'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function editCoupon($pdoObj,$return,$id){
		$sql    = "UPDATE coupon_master SET coupon_code = :coupon_code, coupon_value = :coupon_value, coupon_type = :coupon_type, cart_min_value = :cart_min_value WHERE id = :id";
		$array  = ['coupon_code' => $return['coupon_code'],'coupon_value' => $return['coupon_value'], 'coupon_type' => $return['coupon_type'], 'cart_min_value' => $return['cart_min_value'], 'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function addCategory($pdoObj,$category){
		$array = array('category' => $category, 'status' => 1);
		$sql   = "INSERT INTO categories(categories, status) VALUES( :category, :status)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function addColour($pdoObj,$colour){
		$array = array('colour' => $colour, 'status' => 1);
		echo $sql   = "INSERT INTO colour_master(colour, status) VALUES( :colour, :status)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function addSize($pdoObj,$size,$priority){
		$array = array('size' => $size, 'priority' => $priority, 'status' => 1);
		$sql   = "INSERT INTO size_master(size, priority, status) VALUES( :size, :priority, :status)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function addBanner($pdoObj,$return){
		$array  = ['heading1' => $return['heading1'], 'heading2' => $return['heading2'], 'btn_text' => $return['btn_text'], 'btn_link' => $return['btn_link'], 'image' => $return['image'], 'status' => 1];
		$sql    = "INSERT INTO `banner`(`heading1`, `heading2`, `btn_text`, `btn_link`, `image`, `status`) VALUES ( :heading1, :heading2, :btn_text, :btn_link, :image, :status)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function addSubCategory($pdoObj,$categories_id,$sub_categories){
		$array = array('categories_id' => $categories_id, 'sub_categories' => $sub_categories, 'status' => 1);
		$sql   = "INSERT INTO sub_categories(categories_id, sub_categories, status) VALUES( :categories_id, :sub_categories, :status)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function addVendor($pdoObj,$details){
		$array = array('username' => $details['username'], 'password' => $details['password'], 'email' => $details['email'], 'mobile' => $details['mobile'], 'role' => 'vendor', 'status' => 1);
		$sql   = "INSERT INTO admin_users(username, password, email, mobile, status, role) VALUES( :username, :password, :email, :mobile, :status, :role)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function getCategoryFromID($pdoObj,$id){
		$sql    = "SELECT * FROM categories WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getColourFromID($pdoObj,$id){
		$sql    = "SELECT * FROM colour_master WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getSizeFromID($pdoObj,$id){
		$sql    = "SELECT * FROM size_master WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getVendorFromID($pdoObj,$id){
		$sql    = "SELECT * FROM admin_users WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getBannerFromID($pdoObj,$id){
		$sql    = "SELECT * FROM banner WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getCouponFromID($pdoObj,$id){
		$sql    = "SELECT * FROM coupon_master WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getSubCategoryFromID($pdoObj,$id){
		$sql    = "SELECT sub_categories.*, categories AS categories_name FROM sub_categories, categories WHERE sub_categories.id = :id AND sub_categories.categories_id = categories.id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getSubCatOfCategory($pdoObj,$categories_id){
		$sql    = "SELECT * FROM sub_categories WHERE categories_id = :categories_id AND status = 1";
		$array  = ['categories_id' => $categories_id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getCategoryFromName($pdoObj,$category){
		$sql    = "SELECT * FROM categories WHERE categories = :category";
		$array  = ['category' => $category];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getColourFromName($pdoObj,$colour){
		$sql    = "SELECT * FROM colour_master WHERE colour = :colour";
		$array  = ['colour' => $colour];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getSizeFromName($pdoObj,$size){
		$sql    = "SELECT * FROM size_master WHERE size = :size";
		$array  = ['size' => $size];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getCouponFromName($pdoObj,$coupon_code){
		$sql    = "SELECT * FROM coupon_master WHERE coupon_code = :coupon_code";
		$array  = ['coupon_code' => $coupon_code];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getSubCategoryFromName($pdoObj,$categories_id,$sub_categories){
		$sql    = "SELECT * FROM sub_categories WHERE categories_id = :categories_id AND sub_categories = :sub_categories";
		$array  = ['categories_id' => $categories_id,'sub_categories' => $sub_categories];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function deleteProduct($pdoObj,$id){
		$where = "";
		if($_SESSION['ADMIN_ROLE'] == 'vendor'){
			$where .= ' AND added_by = "'.$_SESSION['ADMIN_ID'].'"';
		}
		$sql   = "DELETE FROM product WHERE id = :id $where";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function deleteProductReview($pdoObj,$id){
		$sql   = "DELETE FROM product_review WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}	
	
	function deleteCoupon($pdoObj,$id){
		$sql   = "DELETE FROM coupon_master WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}	
	
	function getAllProduct($pdoObj){
		//$sql = "SELECT product.*,categories.categories FROM product,categories WHERE product.categories_id=categories.id ORDER BY product.id DESC";
		$where = "";
		if($_SESSION['ADMIN_ROLE'] == 'vendor'){
			$where .= ' AND p.added_by = "'.$_SESSION['ADMIN_ID'].'"';
		}
		$sql = "SELECT p.*,c.categories,sc.sub_categories AS sub_categories_name FROM product p,categories c,sub_categories sc WHERE p.categories_id=c.id AND p.sub_categories_id = sc.id $where ORDER BY p.id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getAllCoupon($pdoObj){
		$sql = "SELECT * FROM coupon_master";
		return $pdoObj->selectNoWhere($sql);
	}
		
	function getProductFromID($pdoObj,$id,$type=NULL){
		$where = "";
		if($type == 'admin'){		
			if($_SESSION['ADMIN_ROLE'] == 'vendor'){
				$where .= ' AND added_by = "'.$_SESSION['ADMIN_ID'].'"';
			} 
		}
		$sql    = "SELECT product.*,categories.categories,username FROM product,categories,admin_users WHERE product.categories_id=categories.id AND product.added_by = admin_users.id AND product.id = :id $where";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getProdImagesFromProdID($pdoObj,$id){
		$sql    = "SELECT * FROM product_images WHERE product_id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getProdAttrsFromProdID($pdoObj,$id){
		$sql    = "SELECT * FROM product_attributes WHERE product_id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getSizeOfColour($pdoObj,$pid,$cid){
		$sql    = "SELECT pa.size_id, sm.size FROM product_attributes pa, size_master sm WHERE pa.product_id = :pid AND pa.colour_id = :cid AND sm.id = pa.size_id AND sm.status = 1 ORDER BY sm.priority ASC";
		$array  = ['pid' => $pid,'cid' => $cid];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getDtlsFromAttrs($pdoObj,$pid,$cid,$sid){
		$sql    = "SELECT * FROM product_attributes WHERE product_id = :pid AND colour_id = :cid AND size_id = :sid";
		$array  = ['pid' => $pid,'cid' => $cid,'sid' => $sid];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getProdFullAttrsFromProdID($pdoObj,$id){
		//$sql    = "SELECT pa.*, cm.colour, sm.size FROM product_attributes pa, colour_master cm, size_master sm WHERE product_id = :id AND cm.id = pa.colour_id AND cm.status = 1 AND sm.id = pa.size_id AND sm.status = 1";
		$sql    = "SELECT pa.*, cm.colour, sm.size FROM product_attributes pa
				   LEFT JOIN colour_master cm ON pa.colour_id = cm.id AND cm.status = 1 
				   LEFT JOIN size_master   sm ON sm.id = pa.size_id AND sm.status = 1 
				   WHERE product_id = :id ORDER BY cm.colour";
		
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getProdImageFromID($pdoObj,$id){
		$sql    = "SELECT * FROM product_images WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getProductQty($pdoObj,$id){
		$sql    = "SELECT qty FROM product WHERE product.id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0]['qty'];
		}
		return false;
	}	
	
	function getProdSoldNumByID($pdoObj, $pID){
		$sql     = "SELECT SUM(order_detail.qty) FROM order_detail, user_order WHERE user_order.id = order_detail.order_id AND order_detail.product_id = :pID AND user_order.order_status != 4 AND ( (user_order.payment_type = 'payu' AND user_order.payment_status = 'Success') OR (user_order.payment_type = 'COD' AND user_order.payment_status != '') )";
		$array  = ['pID' => $pID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0]['SUM(order_detail.qty)'];
		}
		return false;
	}
	
	function getProductFromName($pdoObj,$name){
		$sql    = "SELECT * FROM product WHERE name = :name";
		$array  = ['name' => $name];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getProductInfo($pdoObj,$limit = ''){			
		$sql = "SELECT * FROM product WHERE status = 1 ORDER BY id DESC";
		if($limit){		
			$sql .= " LIMIT $limit";	
		}	
		$result = $pdoObj->selectNoWhere($sql);		
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getRecentViewProductInfo($pdoObj,$arr1){	
		$in = "";
		$i  = 0;                                                 //using an external counter as the actual [] key could be dangerous
		foreach ($arr1 as $item){
			$key        = ":id".$i++;
			$in        .= "$key,";
			$arr2[$key] = $item;                                 // collecting values into key-value array
		}
		$in     = rtrim($in,",");                                // :id0,:id1,:id2
		$sql    = "SELECT * FROM product WHERE id IN ($in)";
		$result = $pdoObj->selectWhereClause($sql,$arr2);
		
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getBestSeller($pdoObj,$limit = ''){			
		$sql = "SELECT * FROM product WHERE status = 1 AND best_seller = 1 ORDER BY id DESC";
		if($limit){		
			$sql .= " LIMIT $limit";	
		}	
		$result = $pdoObj->selectNoWhere($sql);		
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getProductOfCat($pdoObj,$categories_id,$sort_order,$limit=''){			
		//$sql    = "SELECT product.*,categories.categories FROM product,categories WHERE product.status = 1 AND product.categories_id = :categories_id AND product.categories_id=categories.id ORDER BY $sort_order";
		$sql = "SELECT p.*,c.categories FROM product p,categories c WHERE p.status = 1 AND p.categories_id = :categories_id AND p.categories_id=c.id AND c.status = 1 ORDER BY $sort_order";
		
		if($limit){
			$sql .= " LIMIT $limit";
		}
		$array  = ['categories_id' => $categories_id];		
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getProductOfCatAndSubCat($pdoObj,$categories_id,$sort_order,$limit='',$sub_categories_id){	
		$sql = "SELECT p.*,c.categories,sc.sub_categories AS sub_categories_name  FROM product p,categories c,sub_categories sc WHERE p.sub_categories_id = :sub_categories_id AND p.status = 1 AND p.categories_id = :categories_id AND p.categories_id=c.id AND p.sub_categories_id = sc.id AND c.status = 1 ORDER BY $sort_order";
		if($limit){
			$sql .= " LIMIT $limit";
		}
		$array  = ['categories_id' => $categories_id, 'sub_categories_id' => $sub_categories_id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function editProductWithImg($pdoObj,$return,$id){
		$sql    = "UPDATE product SET categories_id = :categories_id, sub_categories_id = :sub_categories_id, name = :name, short_desc = :short_desc, description = :description, meta_title = :meta_title, meta_desc = :meta_desc, meta_keyword = :meta_keyword, image = :image, best_seller = :best_seller WHERE id = :id";
		$array  = ['categories_id' => $return['categories_id'],'sub_categories_id' => $return['sub_categories_id'],'name' => $return['name'],'short_desc' => $return['short_desc'],'description' => $return['description'],'meta_title' => $return['meta_title'],'meta_desc' => $return['meta_desc'],'meta_keyword' => $return['meta_keyword'],'image' => $return['image'],'best_seller' => $return['best_seller'],'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editProductNoImg($pdoObj,$return,$id){
		$sql    = "UPDATE product SET categories_id = :categories_id, sub_categories_id = :sub_categories_id, name = :name, short_desc = :short_desc, description = :description, meta_title = :meta_title, meta_desc = :meta_desc, meta_keyword = :meta_keyword, best_seller = :best_seller WHERE id = :id";
		$array  = ['categories_id' => $return['categories_id'],'sub_categories_id' => $return['sub_categories_id'],'name' => $return['name'],'short_desc' => $return['short_desc'],'description' => $return['description'],'meta_title' => $return['meta_title'],'meta_desc' => $return['meta_desc'],'meta_keyword' => $return['meta_keyword'],'best_seller' => $return['best_seller'],'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}		
	
	function editProductImage($pdoObj,$product_images,$id){
		$sql    = "UPDATE product_images SET product_images = :product_images WHERE id = :id";
		$array  = ['product_images' => $product_images,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function editProductAttributes($pdoObj,$attr_id,$return){
		$sql    = "UPDATE product_attributes SET size_id = :size_id, colour_id = :colour_id, mrp = :mrp, qty = :qty, price = :price WHERE id = :id";
		$array  = ['size_id' => $return['size_id'], 'colour_id' => $return['colour_id'], 'mrp' => $return['mrp'], 'qty' => $return['qty'], 'price' => $return['price'], 'id' => $return['attr_id']];
		$pdoObj->updatePrepare($sql,$array);
	}		
	
	function addProduct($pdoObj,$return){
		$sql    = "INSERT INTO product(categories_id, sub_categories_id, name, short_desc, description, meta_title, meta_desc, meta_keyword, status, image, best_seller, added_by) VALUES (:categories_id, :sub_categories_id, :name, :short_desc, :description, :meta_title, :meta_desc, :meta_keyword, 1, :image, :best_seller, :added_by)";
		$array  = ['categories_id' => $return['categories_id'],'sub_categories_id' => $return['sub_categories_id'],'name' => $return['name'],'short_desc' => $return['short_desc'],'description' => $return['description'],'meta_title' => $return['meta_title'],'meta_desc' => $return['meta_desc'],'meta_keyword' => $return['meta_keyword'],'image' => $return['image'],'best_seller' => $return['best_seller'],'added_by' => $return['added_by']];
		$productID = $pdoObj->insertPrepare($sql,$array,'yes');
		return $productID;
	}
	
	function addProductImages($pdoObj,$productID,$image){
		$sql    = "INSERT INTO product_images(product_id, product_images) VALUES (:product_id, :product_images)";
		$array  = ['product_id' => $productID,'product_images' => $image];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function addProductAttributes($pdoObj,$productID,$return){
		$sql    = "INSERT INTO product_attributes(product_id, size_id, colour_id, mrp, price, qty) VALUES (:product_id, :size_id, :colour_id, :mrp, :price, :qty)";
		$array  = ['product_id' => $productID,'size_id' => $return['size_id'],'colour_id' => $return['colour_id'],'mrp' => $return['mrp'], 'price' => $return['price'], 'qty' => $return['qty']];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function addCoupon($pdoObj,$return){
		$sql    = "INSERT INTO coupon_master(coupon_code, coupon_value, coupon_type, cart_min_value, status) VALUES (:coupon_code, :coupon_value, :coupon_type, :cart_min_value, :status)";
		$array  = ['coupon_code' => $return['coupon_code'],'coupon_value' => $return['coupon_value'],'coupon_type' => $return['coupon_type'],'cart_min_value' => $return['cart_min_value'],'status' => 1];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function addProductReview($pdoObj,$return,$productID,$userID){
		$return['added_on'] = date("Y-m-d h:i:s");
		$sql    = "INSERT INTO product_review(user_id, product_id, rating, review, status, added_on) VALUES (:user_id, :product_id, :rating, :review, :status, :added_on)";
		$array  = ['user_id' => $userID,'product_id' => $productID,'rating' => $return['rating'],'review' => $return['review'],'status' => 1,'added_on' => $return['added_on']];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function delContact($pdoObj,$id){
		$sql   = "DELETE FROM contact_us WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function getAllContact($pdoObj){
		$sql = "SELECT * FROM contact_us ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getProductReview($pdoObj,$prodID){
		$sql = "SELECT u.name, u.email, p.* FROM users u, product_review p WHERE p.status = 1 AND p.user_id = u.id AND p.product_id = :product_id ORDER BY p.added_on DESC";
		$array  = ['product_id' => $prodID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getAllProductReviews($pdoObj){
		$sql = "SELECT u.name as username, p.name as pname, u.email, pr.* FROM users u, product_review pr, product p WHERE pr.user_id = u.id AND pr.product_id = p.id ORDER BY pr.added_on DESC";
		$result = $pdoObj->selectNoWhere($sql);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getAllVendor($pdoObj){
		$sql = "SELECT * FROM admin_users WHERE role = 'vendor' ORDER BY id DESC";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function addContactUs($pdoObj,$return){
		$return['added_on'] = date("Y-m-d h:i:s");			
		$sql    = "INSERT INTO contact_us(name, email, mobile, comment, added_on) VALUES (:name, :email, :mobile, :comment, :added_on)";
		$array  = ['name' => $return['name'],'email' => $return['email'],'mobile' => $return['mobile'],'comment' => $return['comment'],'added_on' => $return['added_on']];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function checkFileType($fileName){
		
		/*global $FILE_EXT_LIST_1;
		$detectedType = exif_imagetype($fileName);
		if(!in_array($detectedType, $FILE_EXT_LIST_1)){
			return false;
		}
		return true;*/
		
		global $FILE_EXT_LIST_2;
		$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
		if(!in_array($fileExt,$FILE_EXT_LIST_2)){
			return false;
		}
		return true;
	}
	
	function checkUserExists($pdoObj, $email){
		$sql    = "SELECT * FROM users WHERE email = :email";
		$array  = ['email' => $email];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function delUser($pdoObj, $ID){
		$sql   = "DELETE FROM users WHERE id = :ID";
		$array = ['id' => $ID];
		$pdoObj->deletePrepare($sql,$array);		
	}
	
	function delVendor($pdoObj, $id){
		$sql   = "DELETE FROM admin_users WHERE id = :id";
		$array = ['id' => $id];
		$pdoObj->deletePrepare($sql,$array);		
	}
	
	function checkMobileExists($pdoObj, $mobile){
		$sql    = "SELECT * FROM users WHERE mobile = :mobile";
		$array  = ['mobile' => $mobile];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function addUser($pdoObj,$input){
		$input['added_on'] = date('Y-m-d h:i:s');
		$input['password'] = password_hash($input['password'],PASSWORD_DEFAULT);
		$array = array('email' => $input['email'], 'password' => $input['password'], 'name' => $input['name'], 'mobile' => $input['mobile'],'added_on' => $input['added_on']);
		$sql   = "INSERT INTO users(email, password, name, mobile, added_on) VALUES( :email, :password, :name, :mobile, :added_on)";
	    return $pdoObj->insertPrepare($sql,$array);
	}
	
	function matchPwd($userPwd,$dbPwd){		
		return password_verify($userPwd, $dbPwd);
	}
	
	function addUserOrder($pdoObj,$return){
		$return['added_on'] = date('Y-m-d h:i:s');
		$sql     = "INSERT INTO user_order(user_id, address, city, pincode, payment_type, total_price, payment_status, order_status, added_on, coupon_id, coupon_code, coupon_value, txnid) VALUES (:user_id, :address, :city, :pincode, :payment_type, :total_price, :payment_status, :order_status, :added_on, :coupon_id, :coupon_code, :coupon_value, :txnid)";
		$array   = ['user_id' => $return['user_id'],'address' => $return['address'],'city' => $return['city'],'pincode' => $return['pincode'],'payment_type' => $return['payment_type'],'total_price' => $return['total_price'],'coupon_id' => $return['coupon_id'],'coupon_code' => $return['coupon_code'],'coupon_value' => $return['coupon_value'],'payment_status' => $return['payment_status'],'order_status' => $return['order_status'],'added_on' => $return['added_on'],'txnid' => $return['txnid']];
		$orderID = $pdoObj->insertPrepare($sql,$array, 'yes');
		return $orderID;
	}
	
	function editUserOrderTxnID($pdoObj,$txnid,$id){
		$sql    = "UPDATE user_order SET txnid = :txnid WHERE id = :id";
		$array  = ['txnid' => $txnid,'id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editUserOrderGatewayPAYID($pdoObj,$txnid,$payment_status,$gateway_payid){
		$sql    = "UPDATE user_order SET payment_status = :payment_status, gateway_payid = :gateway_payid WHERE txnid = :txnid";
		$array  = ['txnid' => $txnid,'payment_status' => $payment_status,'gateway_payid' => $gateway_payid];
		$pdoObj->updatePrepare($sql,$array);
	}	
	
	function addOrderDetail($pdoObj,$return){
		$sql     = "INSERT INTO order_detail(order_id, product_id, qty, price) VALUES (:order_id, :product_id, :qty, :price)";
		$array   = ['order_id' => $return['order_id'],'product_id' => $return['product_id'],'qty' => $return['qty'],'price' => $return['price']];
		$pdoObj->insertPrepare($sql,$array, 'yes');
	}
	
	function addOrderEvent($pdoObj,$order=NULL,$product=NULL){
		try{
			$pdoObj->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdoObj->PDO->beginTransaction();
			
			$proObj->addUserOrder($pdoObj,$order);
			$proObj->addOrderDetail($pdoObj,$product);			
			
			$pdoObj->PDO->commit();echo "All Data saved";			
		}catch(Exception $e){
			$pdoObj->PDO->rollback();
			echo $e->getMessage();die();
		}			
	}
	
	function getMyOrder($pdoObj,$user_id){
		$sql    = "SELECT user_order.*, order_status.name AS order_status_str FROM user_order, order_status WHERE user_order.user_id = :user_id AND order_status.id = user_order.order_status ORDER BY user_order.id DESC";
		$array  = ['user_id' => $user_id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		return $result;
	}
	
	function getDtlsFromTxnID($pdoObj,$txnid){
		$sql    = "SELECT user_order.*, users.name FROM user_order, users WHERE user_order.txnid = :txnid AND user_order.user_id = users.id";
		$array  = ['txnid' => $txnid];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
	}
	
	function getUserSingleOrder($pdoObj,$user_id,$order_id){
		$sql    = "SELECT user_order.*, order_status.name AS order_status_str FROM user_order, order_status WHERE user_order.user_id = :user_id AND order_status.id = user_order.order_status AND user_order.id = :order_id";
		$array  = ['user_id' => $user_id, 'order_id' => $order_id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function checkOrderOfUser($pdoObj,$user_id,$order_id){
		$sql    = "SELECT count(1) FROM user_order WHERE id = :order_id AND user_id = :user_id";
		$array  = ['user_id' => $user_id, 'order_id' => $order_id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0]['count(1)'];
		}
		return false;
	}
	
	function getAllUserOrder($pdoObj){
		$sql    = "SELECT user_order.*, order_status.name AS order_status_str FROM user_order, order_status WHERE order_status.id = user_order.order_status";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getOrderOfVendor($pdoObj,$vendorID){
		$sql    = "SELECT order_detail.qty, product.name, user_order.*, order_status.name AS order_status_str FROM user_order, order_detail, product, order_status WHERE order_status.id = user_order.order_status AND product.id = order_detail.product_id AND user_order.id = order_detail.order_id AND product.added_by = :vendorID";
		$array  = ['vendorID' => $vendorID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getOrderStatusName($pdoObj){
		$sql    = "SELECT * FROM order_status";
		return $pdoObj->selectNoWhere($sql);
	}
	
	function getMyOrderDtls($pdoObj,$orderID,$userID){
		$sql    = "SELECT DISTINCT(od.id), od.*, p.name, p.image FROM order_detail od, product p, user_order uo WHERE od.order_id = :orderID AND uo.user_id = :userID AND p.id = od.product_id";
		$array  = ['orderID' => $orderID,'userID' => $userID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		return $result;
	}
	
	function getTxnIDFromOrderID($pdoObj,$orderID,$userID){
		$sql    = "SELECT txnid FROM user_order uo WHERE uo.id = :orderID AND uo.user_id = :userID";
		$array  = ['orderID' => $orderID,'userID' => $userID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0]['txnid'];
		}
		return false;
	}
	
	function getUserOrderDtlsByAdmin($pdoObj,$orderID){
		//$sql    = "SELECT DISTINCT(od.id), od.*, p.name, p.image FROM order_detail od, product p, user_order uo WHERE od.order_id = :orderID AND p.id = od.product_id";
		$sql    = "SELECT DISTINCT(od.id), od.*, p.name, p.image, uo.user_id, u.email, u.name AS user_name FROM users u, order_detail od, product p, user_order uo WHERE od.order_id = :orderID AND p.id = od.product_id AND od.order_id = uo.id AND uo.user_id = u.id;";
		
		$array  = ['orderID' => $orderID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		return $result;
	}
	
	function getAllOrderDtls($pdoObj,$orderID,$tmpOrderID){
		$sql    = "SELECT DISTINCT(od.id), od.*, p.name, p.image, uo.address, uo.city, uo.pincode, uo.order_status, uo.total_price, uo.coupon_value, uo.coupon_code, au.username, os.name AS order_status_name FROM admin_users au, order_detail od, product p, user_order uo, order_status os WHERE od.order_id = :orderID AND od.product_id = p.id AND uo.id = :tmpOrderID AND uo.order_status = os.id AND p.added_by = au.id";
		$array  = ['orderID' => $orderID,'tmpOrderID' => $tmpOrderID];
		$result = $pdoObj->selectWhereClause($sql,$array);
		return $result;
	}
	
	
	function searchProduct($pdoObj,$str){	
		//$sql   = "SELECT * FROM `threads` WHERE match (thread_title, thread_desc) against (:keyword)";
		$pattern = '%'.$str.'%';		
		$sql     = "SELECT product.*,categories.categories FROM product,categories WHERE product.status = 1 AND product.categories_id=categories.id AND (product.name LIKE :pattern OR product.description LIKE :pattern1) ORDER BY product.id DESC LIMIT 5";
		$array   = ['pattern' => $pattern,'pattern1' => $pattern];	
		$result  = $pdoObj->selectWhereClause($sql,$array);		
		if(!empty($result)){
			return $result;
		}
		return false;
	}

	function formatCurrency($num){
		global $CURRENCY_SYMBOL;
		return $CURRENCY_SYMBOL.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num);
	}
	
	function addWishlist($pdoObj,$return){
		$return['added_on'] = date("Y-m-d h:i:s");
		$sql     = "INSERT INTO wishlist(user_id, product_id, added_on) VALUES (:user_id, :product_id, :added_on)";
		$array   = ['user_id' => $return['user_id'],'product_id' => $return['pID'],'added_on' => $return['added_on']];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function getWishlist($pdoObj,$return){
		$sql     = "SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
		$array   = ['user_id' => $return['user_id'],'product_id' => $return['pID']];
		$result  = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getProductWishlist($pdoObj,$user_id){
		$sql     = "SELECT product.name, product.image, product.price, product.mrp, wishlist.id, wishlist.product_id FROM wishlist, product WHERE wishlist.product_id = product.id AND wishlist.user_id = :user_id";
		$array   = ['user_id' => $user_id];
		$result  = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	function getNumWishlist($pdoObj,$user_id){
		$sql     = "SELECT count(1) FROM wishlist WHERE user_id = :user_id";
		$array   = ['user_id' => $user_id];
		$result  = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0]['count(1)'];
		}
		return false;
	}
	
	function delWishlist($pdoObj,$wishlist_id,$user_id){
		$sql   = "DELETE FROM wishlist WHERE id = :wishlist_id AND user_id = :user_id";
		$array = ['wishlist_id' => $wishlist_id,'user_id' => $user_id];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function setTitle($pdoObj,$proObj,$pageName){
		$return 			    = [];
		$return['meta_title']   = 'Ecom Market';
		$return['meta_desc']    = 'Online In India at Great Prices, Free Shipping';
		$return['meta_keyword'] = 'Where Learning Meets Fun';
		if($pageName == 'product'){
			if(isset($_GET['id'])){
				$productName = $proObj->getProductFromID($pdoObj,$_GET['id']);
				if(is_array($productName)){
					$return['meta_title']   = $productName['meta_title'];
					$return['meta_desc']    = $productName['meta_desc'];
					$return['meta_keyword'] = $productName['meta_keyword'];
				}
			}	
		}
		elseif($pageName == 'category'){
			if(isset($_GET['id'])){
				$categoryName = $proObj->getCategoryFromID($pdoObj,$_GET['id']);
				if(is_array($categoryName)){
					$return['meta_title']   = $categoryName['categories']. ' Shopping Online - Shop for '.$categoryName['categories'];
					$return['meta_desc']    = $categoryName['categories']. ' Online shopping from a great selection at '.$categoryName['categories'];;
					$return['meta_keyword'] = $categoryName['categories']. ' Best Offers Store Online';
				}
			}	
		}
		elseif($pageName == 'contact'){
			$return['meta_title'] = 'Contact Us';
		}
		return $return;
	}
	
	function sendEmail($to,$sub,$body,$pdoObj,$module){
		global $SMTP_PATH,$SMTP_HOST,$SMTP_PORT,$SMTP_UNAME,$SMTP_PWD,$SMTP_FROM;	
		include $SMTP_PATH."/PHPMailerAutoload.php";
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPSecure  = "tls";
			$mail->SMTPAuth	   = true;		
			$mail->Host		   = $SMTP_HOST;
			$mail->Port	       = $SMTP_PORT;
            $mail->Username	   = $SMTP_UNAME;
			$mail->Password	   = $SMTP_PWD;		
			$mail->Subject	   = $sub;
			$mail->Body		   = $body;
			$mail->SMTPOptions = array('ssl' => array(
													'verify_peer'       => false,
													'verify_peer_name'  => false,
													'allow_self_signed' => false
												));
			$mail->isSMTP();
			$mail->SetFrom($SMTP_FROM);
			$mail->addAddress($to);
			$mail->IsHTML(true);
			$mail->send();
			return "success";
		} 
		catch (phpmailerException $e){
			$this->errorLog( $pdoObj,$module.': SENDEMAIL():','phpmailerException: '.substr($e->errorMessage(),8,-15) );
		} 
		catch (Exception $e){
			$this->errorLog($pdoObj,$module.': SENDEMAIL():','Exception: '.$e->getMessage());
		}		
		return "failure";
	}
	
	function sendEmailYahoo($to,$sub,$body,$pdoObj,$module,$toname=''){
		global $SMTP_PATH,$YAHOO_SMTP_HOST,$YAHOO_SMTP_PORT,$YAHOO_SMTP_UNAME,$YAHOO_SMTP_PWD,$YAHOO_SMTP_FROM,$YAHOO_SMTP_FROM_NAME;	
		include $SMTP_PATH."/PHPMailerAutoload.php";
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPSecure  = "ssl";
			$mail->SMTPAuth	   = true;		
			$mail->Host		   = $YAHOO_SMTP_HOST;
			$mail->Port	       = $YAHOO_SMTP_PORT;
            $mail->Username	   = $YAHOO_SMTP_UNAME;
			$mail->Password	   = $YAHOO_SMTP_PWD;	
			$mail->From	       = $YAHOO_SMTP_FROM;
			$mail->FromName	   = $YAHOO_SMTP_FROM_NAME;	
			//$mail->SMTPDebug   = 1;			
			//$mail->AddAddress("$to", 'To Name'); 			
			$mail->AddAddress("$to", "$toname"); 			
			$mail->Subject	   = $sub;
			$mail->Body		   = $body;
			$mail->SMTPOptions = array('ssl' => array(
													'verify_peer'       => false,
													'verify_peer_name'  => false,
													'allow_self_signed' => false
												));
			$mail->isSMTP();
			$mail->IsHTML(true);
			$mail->send();
			return "success";
		} 
		catch (phpmailerException $e){
			$this->errorLog( $pdoObj,$module.': SENDEMAIL():','phpmailerException: '.substr($e->errorMessage(),8,-15) );
		} 
		catch (Exception $e){
			$this->errorLog($pdoObj,$module.': SENDEMAIL():','Exception: '.$e->getMessage());
		}		
		return "failure";
	}
	
	function sendSMS($message,$mobile,$apiKey,$sender,$url){
		$mobile       = '91'.$mobile;
		$numbers      = array($mobile);
		$numbers      = implode(',',$numbers);
		$apiKeyEncode = urlencode($apiKey);	
		$senderEncode = urlencode($sender);
		$msgEncode    = rawurlencode($message);	
		$data         = array('apikey' => $apiKeyEncode, 'numbers' => $numbers, 'sender' => $senderEncode, 'message' => $msgEncode);
		
		$ch = curl_init($url);		
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);	
		
		if(curl_errno($ch)){
			$response['technical_error'] = curl_error($ch);
		}
		else{		
			$response = json_decode($response,true);
		}
		curl_close($ch);
		echo "<pre>response ";print_r($response);	
	}
	
	function validateMobile($mobile){
		return preg_match('/^[0-9]{10}+$/', $mobile);
	}
	
	function addResetPwdTmp($pdoObj,$email,$token,$exp_date){
		$sql     = "INSERT INTO password_reset_temp(`email`, `token`, `exp_date`) VALUES (:email, :token, :exp_date)";
		$array   = ['email' => $email,'token' => $token,'exp_date' => $exp_date];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function delResetPwdTmp($pdoObj,$email){
		$sql   = "DELETE FROM password_reset_temp WHERE email = :email";
		$array = ['email' => $email];
		$pdoObj->deletePrepare($sql,$array);
	}
	
	function editPwdFromEmail($pdoObj,$email,$password){
		$password = password_hash($password,PASSWORD_DEFAULT);
		$sql    = "UPDATE users SET password = :password WHERE email = :email";
		$array  = ['password' => $password,'email' => $email];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editUserFromID($pdoObj,$return){
		$sql    = "UPDATE users SET name = :name WHERE id = :id";
		$array  = ['name' => $return['name'],'id' => $return['id']];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function getResetPwdDtls($pdoObj,$email,$token){
		$sql     = "SELECT * FROM password_reset_temp WHERE email = :email AND token = :token";
		$array   = ['email' => $email,'token' => $token];
		$result  = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function getUserInfoFromID($pdoObj, $id){
		$sql    = "SELECT * FROM users WHERE id = :id";
		$array  = ['id' => $id];
		$result = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function orderPDF($return){
		if(empty($return['info'])){
			die();
		}
		global $PDF_PATH,$USER_IMG_URL,$WEBSITE_NAME,$USER_TPL_PATH,$USER_CSS_URL;
		if($return['from'] == 'admin' && isset($_SESSION['ADMIN_LOGIN'])){
			$name = $return['info'][0]['user_name'];
		}
		else{
			$name = $_SESSION['USER_NAME'];
		} //7.4.8 php version live infinity requires mpdf v8.0.4  //composer require mpdf/mpdf:7.1.0
		include $USER_TPL_PATH."/sample_order_pdf_1.php";
		include $PDF_PATH.'/autoload.php';		
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($css,1);
		$mpdf->WriteHTML($html, 2);
		//$mpdf->WriteHTML($html, 1);
		$name = str_replace(' ', '_', $name);
		$file = $name.'_'.date('d_M_Y-h A:i:s').'.pdf';
		$mpdf->Output();
		//$mpdf->Output($file,'D');
	}
	
	function sendInvoiceEmail($email,$return,$orderID,$pdoObj,$module){
		global $USER_TPL_PATH,$WEBSITE_NAME,$USER_IMG_URL ;
		include $USER_TPL_PATH."/sample_invoice_email_1.php";
		$sub = $WEBSITE_NAME." Invoice - Order ID No - ". $orderID;	
		$this->sendEmailYahoo($email,$sub,$html,$pdoObj,$module);
	}
	
	function processCheckout(&$request,$pdoObj){
		$total = 0;
		foreach($_SESSION['cart'] as $id=>$val) {
			$prodInfo = $this->getProductFromID($pdoObj,$id);
			$total   += $val['qty']*$prodInfo['price'];
		}
		
		$return 				  = [];
		$return['address']   	  = $request->getParameter("address");
		$return['city'] 		  = $request->getParameter("city");
		$return['pincode'] 		  = $request->getParameter("pincode");
		$return['payment_type']   = $request->getParameter("payment_type");
		$return['payment_status'] = ($return['payment_type'] == 'COD') ? 'success' : 'pending';			
		$return['user_id'] 		  = $_SESSION['USER_ID'];			
		$return['order_status']   = '1';
		$return['txnid']		  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		
		if(isset($_SESSION['COUPON_ID'])){
			$return['coupon_id']      = $_SESSION['COUPON_ID']; 
			$return['coupon_code']    = $_SESSION['COUPON_CODE']; 
			$return['coupon_value']   = $_SESSION['COUPON_VALUE'];
			$return['total_price']    = $total - $_SESSION['COUPON_VALUE'];
			unset($_SESSION['COUPON_ID']);
			unset($_SESSION['COUPON_CODE']);
			unset($_SESSION['COUPON_VALUE']);
		}
		else{
			$return['total_price']  = $total;
			$return['coupon_id']    = ''; 
			$return['coupon_code']  = ''; 
			$return['coupon_value'] = '';
		}
		
		$return['order_id'] = $this->addUserOrder($pdoObj,$return);			
		$product            = [];
		foreach($_SESSION['cart'] as $id=>$val) {
			$prodInfo              = $this->getProductFromID($pdoObj,$id);
			$product['order_id']   = $return['order_id'];
			$product['price']      = $prodInfo['price'];
			$product['qty']        = $val['qty'];
			$product['product_id'] = $id;
			$this->addOrderDetail($pdoObj,$product);
		}
		unset($_SESSION['cart']);
		$return['user_info'] = $this->getUserInfoFromID($pdoObj,$_SESSION['USER_ID']);	
		return $return;
	}
	
	function errorLog($pdoObj,$module,$error){
		global $ERROR_LOG_FILE;
		$datetime       = date('d-M-Y H:i:s');
		$arrQueryString = explode('&',$_SERVER["QUERY_STRING"]);
		$strDoAction    = substr($arrQueryString[0],3);
		$user['email']  = 'Visitor';
		if( isset($_SESSION['USER_ID']) ){
			$user = $this->getUserInfoFromID($pdoObj,$_SESSION['USER_ID']);
		}
		$logstr         = $datetime." " .":\t[URL: ".$strDoAction."]:\t[REMOTE_ADDR: ".$_SERVER["REMOTE_ADDR"]."]\t[USER_EMAIL: ".$user['email']."]\t[session_id: ".session_id()."]\t[Module: ".$module."]\t[Error: ".$error."]\n";
		$fp             = fopen($ERROR_LOG_FILE, "a");
		if($fp){
			fwrite($fp, $logstr);
			fclose($fp);
		}
	}
	
	function isAdmin(){
		if($_SESSION['ADMIN_ROLE'] == 'vendor'){
			header("Location:product"); die();
		}
	}
	
	function getCurrentURL(){
		global $HTDOCS_URL;
		return $HTDOCS_URL.$_SERVER['REQUEST_URI'];   
	}
	
	function setFileName($name){
		return rand(111111111,999999999).'_'.$name;
	}
	
	function dateFormat($date){
		$date = strtotime($date);
		return date('d M Y',$date);
	}
	
	function addVisitorCount($pdoObj){
		$ip      = $_SERVER['REMOTE_ADDR'];
		$sql     = "INSERT INTO visitor_count(`ip`, `visitor_count`, `date`) VALUES (:ip, :visitor_count, :date)";
		$array   = ['ip' => $ip,'visitor_count' => $visitor_count,'date' => $date];
		$pdoObj->insertPrepare($sql,$array);
	}
	
	function getVisitorCount($pdoObj){
		$sql    = "SELECT visitor_count FROM visitor_count";
		$result = $pdoObj->selectNoWhere($sql);
		return $result[0]['visitor_count'];
	}
	
	function editVisitorCount($pdoObj){
		$sql    = "UPDATE visitor_count SET visitor_count = visitor_count + 1";		
		$pdoObj->updatePrepareNoWhereNoData($sql);
	}		
	
	function showVisitorCount($pdoObj){
		if(!isset($_COOKIE['visit'])){
			setcookie('visit','yes',time()+60*2);
			$this->editVisitorCount($pdoObj);
		}
		return $this->getVisitorCount($pdoObj);
	}
	
	function getEmailOpenDtlsFromEmail($pdoObj,$email){
		$sql    = "SELECT * FROM email_open WHERE email = :email";
		$array  = ['email' => $email];
		$result  = $pdoObj->selectWhereClause($sql,$array);
		if(!empty($result)){
			return $result[0];
		}
		return false;
	}
	
	function editEmailOpenForSend($pdoObj,$email){
		$sql    = "UPDATE email_open SET sent = 1 WHERE email = :email";
		$array  = ['email' => $email];
		$pdoObj->updatePrepare($sql,$array);
	}
	
	function editEmailOpenForOpen($pdoObj,$id){
		$sql    = "UPDATE email_open SET open = open + 1 WHERE id = :id";
		$array  = ['id' => $id];
		$pdoObj->updatePrepare($sql,$array);
	}
}
?>