<?php
$css  = file_get_contents($HTDOCS_URL.'/pdf/style.css');
$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Receipt of Purchase - '.$return['user_info']['id'].'</title>	
</head>
<body>
	<div style="text-align:right;">
        <b>Sender:</b>'.$name.'
    </div>
    <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">INVOICE</div>
    </div>
	<table style="line-height: 1.5;">
		<tr>
			<td><b>Date:</b> '.$return['user_info']['added_on'].'</td>
			<td style="text-align:right;">'.$name.'</td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:right;">'.$return['user_info']['city'].' - '.$return['user_info']['pincode'].'</td>
		</tr>
	</table>
	<div></div>
    <div style="border-bottom:1px solid #000;">
        <table style="line-height: 2;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border:1px solid #cccccc;width:200px;">Item Description</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:85px">Price </td>
                <td style = "text-align:right;border:1px solid #cccccc;width:75px;">Quantity</td>
                <td style = "text-align:right;border:1px solid #cccccc;">Subtotal</td>
            </tr>';
			foreach($return['info'] as $k=>$v ){				
			$html .= '
			<tr> <td style="border:1px solid #cccccc;">'.$v['name'].'</td>
                    <td style = "text-align:right; border:1px solid #cccccc;">'.$this->formatCurrency($v['price']).'</td>
                    <td style = "text-align:right; border:1px solid #cccccc;">'.$v['qty'].'</td>
                    <td style = "text-align:right; border:1px solid #cccccc;">'.$this->formatCurrency($v['qty']*$v['price']).'</td>
            </tr>';
			}
			if($return['user_info']['coupon_value']) {
			$html .= '
			<tr style = "font-weight: bold;">
				<td></td><td></td>
				<td style = "text-align:right;">Total </td>
				<td style = "text-align:right;">'.$this->formatCurrency($return['user_info']['coupon_value']).'</td>
			</tr>';
			}
			$html .= '
			<tr style = "font-weight: bold;">
				<td></td><td></td>
				<td style = "text-align:right;">Total </td>
				<td style = "text-align:right;">'.$this->formatCurrency($return['user_info']['total_price']).'</td>
			</tr>
		</table>
	</div>
</body>
</html>';
?>