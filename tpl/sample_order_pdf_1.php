<?php 
$css  = file_get_contents($USER_CSS_URL.'/bootstrap.min.css');
$css .= file_get_contents($USER_CSS_URL.'/style.css');
$html = '<div class="wishlist-table table-responsive">
		 <div align="center"><img src="'.$USER_IMG_URL.'/logo/4.png" alt="logo images"> <b>'.$WEBSITE_NAME.' - INVOICE</b></div><br/>
			<table>
				<thead>
					<tr>
						<th class="product-name">Ordered By</th>
						<th class="product-name">Delivery Address</th>
					</tr>
				</thead>
				<tbody>				
					<tr>
						<td class="product-stock">'.$name.'</td>
						<td class="product-stock">'.$return['user_info']['address'].'<br/> '.$return['user_info']['city'].' - '.$return['user_info']['pincode'].'</td>						
						</tr>			
				</tbody>
			</table>
			<br/>
			<table>
				<thead>
					<tr>
						<th class="product-name">Order ID</th>
						<th class="product-name"><span class="nobr">Order Date</span></th>
						<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
						<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
						<th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
						<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
					</tr>
				</thead>
				<tbody>				
					<tr>
						<td class="product-stock">'.$return['user_info']['id'].'</td>
						<td class="product-name">'.$return['user_info']['added_on'].'</a></td>
						<td class="product-name">'.$return['user_info']['payment_type'].'</a></td>
						<td class="product-name">'.$return['user_info']['payment_status'].'</a></td>
						<td class="product-price"><span class="amount">'.$this->formatCurrency($return['user_info']['total_price']).'</span></td>
						<td class="product-stock-status"><span class="wishlist-in-stock">'.$return['user_info']['order_status_str'].'</span></td>
					</tr>				
				</tbody>
			</table>
		</div> ';
$html .= '<br/><div class="wishlist-table table-responsive"><table>
			<thead>
				<tr>
					<th class="product-name">SR.No</th>
					<th class="product-name">Product Name</th>
					<th class="product-thumbnail"><span class="nobr">Product Image</span></th>
					<th class="product-name"><span class="nobr">Qty</span></th>
					<th class="product-name"><span class="nobr"> Price </span></th>
					<th class="product-name"><span class="nobr"> Total Price </span></th>
				</tr>
			</thead>
			<tbody>';
			foreach($return['info'] as $k=>$v ){				
			$html .= '<tr>
						<td class="product-name">'.($k+1).'</td>
						<td class="product-name">'.$v['name'].'</td>
						<td class="product-name"><img src="'.PRODUCT_IMAGE_SITE_PATH.$v['image'].'" alt="ordered item" height="100" width="100"></td>
						<td class="product-name">'.$v['qty'] .'</td>
						<td class="product-name"><span class="amount">'.$this->formatCurrency($v['price']) .'</span></td>
						<td class="product-name"><span class="wishlist-in-stock">'.$this->formatCurrency($v['qty']*$v['price']) .'</span></td>										
					</tr>';			
			} 
			if($return['user_info']['coupon_value']) {
			$html .= '<tr>
						<td colspan="4"></td>
						<td class="product-name">Coupon Discount<br/><span style="color:red">'.$return['user_info']['coupon_code'].'</span></td>
						<td class="product-name">'.$this->formatCurrency($return['user_info']['coupon_value']).'</td>
					  </tr>';
			} 				
		    $html .= '<tr>
						<td colspan="4"></td>
						<td class="product-name">Total Price</td>
						<td class="product-name">'.$this->formatCurrency($return['user_info']['total_price']).'</td>
					</tr>
					</tbody></tbody>
		</table></div>';
?>