 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/cart1.jpg') no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Shopping Cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
									if(!empty($_SESSION['cart'])){//unset($_SESSION['cart']);
									foreach($_SESSION['cart'] as $id=>$val) {
										$prodInfo = $proObj->getProductFromID($pdoObj,$id);//echo "<pre>prodInfo=  ";print_r($prodInfo);print_r($_SESSION['cart']);
										?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$prodInfo['image']?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $prodInfo['name']?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><?php echo $proObj->formatCurrency($prodInfo['mrp'])?></li>
                                                    <li><?php echo $proObj->formatCurrency($prodInfo['price'])?></li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $proObj->formatCurrency($prodInfo['price'])?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $id?>_qty" value="<?php echo $val['qty']?>" /><br/><a href="javascript:void(0);" onclick="manage_cart('<?php echo $id?>','update');">update</a><br/>
											<span class="field_error" id="update_error"></span>
											</td>
                                            <td class="product-subtotal"><?php echo $proObj->formatCurrency($val['qty']*$prodInfo['price'])?></td>
                                            <td class="product-remove"><a href="javascript:void(0);" onclick="manage_cart('<?php echo $id?>','remove');"><i class="icon-trash icons"></i></a></td>
                                        </tr>
									<?php }}else{ ?>  
										No Product in the Cart									
								   <?php } ?>   									
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo $HOSTNAME_URL?>">Continue Shopping</a>
                                        </div>
										<?php if(!empty($_SESSION['cart'])){?>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="checkout">checkout</a>
                                        </div>
										<?php } ?>   
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>