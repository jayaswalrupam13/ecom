<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title><?php echo $WEBSITE_NAME?> Invoice</title>	
	<style>#hiderow,
* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }
textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
tr.border_bottom td {  border-bottom: 1px solid black;}
table td, table th { border: 1px solid black; padding: 5px; }
#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }
#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }
#logo { text-align: right; float: right; position: relative; margin-top: -15px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }

#customer-title { font-size: 20px; font-weight: bold; float: left; }
#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }
#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 1; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }
#terms { text-align: center; margin: 20px 0 0 0; }
#terms textarea { width: 100%; text-align: center;}

	</style>
</head>
<body>
	<div id="page-wrap">
		<textarea id="header">INVOICE</textarea>		
		<div id="identity">		
            <textarea id="address">Ordered By: <?php echo $return['user_info']['user_name'].'
Delivery Address: '.$return["user_info"]["address"].'
'.$return["user_info"]["city"].'
'.$return["user_info"]["pincode"]?></textarea>
            <div id="logo">
              <img src="<?php echo $USER_IMG_URL?>/logo/4.png" alt="logo images">
            </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
            <textarea id="customer-title"><?php echo $WEBSITE_NAME?></textarea>
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo $return['user_info']['id']?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo $return['user_info']['added_on']?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due"><?php echo $proObj->formatCurrency($return['user_info']['total_price'])?></div></td>
                </tr>
            </table>		
		</div>		
		<table id="items">		
		  <tr>
		      <th>SR.No</th>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr><?php foreach($return['info'] as $k=>$v ){	?>				  
		  <tr  class="border_bottom" align="center" >
			  <td class="item-name"><?php echo ($k+1)?></td>
		      <td class="item-name"><?php echo $v['name']?></td>
		      <td class="description"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="PRODUCT_IMAGE_SITE_URL" height="100" width="100"/></td>
		      <td class="cost"><?php echo $proObj->formatCurrency($v['price'])?></textarea></td>
		      <td class="qty"><?php echo $v['qty']?></td>
		      <td><span class="price"><?php echo $proObj->formatCurrency($v['qty']*$v['price'])?></span></td>
		  </tr>	
		<?php } if($return['user_info']['coupon_value']) { ?>		  
			<tr>
		      <td colspan="3" class="blank"> </td>
		      <td class="total-line">Coupon Discount<br/><span style="color:red"><?php echo $return['user_info']['coupon_code']?></span></td>
		      <td class="total-value"  colspan="2"><div id="total">&nbsp;&nbsp;&nbsp;<?php echo $proObj->formatCurrency($return['user_info']['coupon_value'])?></div></td>
		  </tr>
			<?php } ?> 				
		    <tr>
		      <td colspan="3" class="blank"> </td>
		      <td class="total-line balance">Total Price</td>
		      <td class="total-value balance" colspan="2"><div class="due">&nbsp;&nbsp;&nbsp;<?php echo $proObj->formatCurrency($return['user_info']['total_price'])?></div></td>
		  </tr>		
		</table>
	</div>	
</body>
</html>