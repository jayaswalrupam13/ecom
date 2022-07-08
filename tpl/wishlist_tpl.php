 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/wishlist2.jpg') no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Wishlist</span>
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
                                            <th class="product-remove">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if(is_array($return['prodInfo'])){
										foreach($return['prodInfo'] as $v){
										?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="product?id=<?php echo $v['product_id']?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="product?id=<?php echo $v['product_id']?>"><?php echo $v['name']?></a>
                                                <ul class="pro__prize">
                                                    <li class="old__prize"><?php echo $proObj->formatCurrency($v['mrp'])?></li>
                                                    <li><?php echo $proObj->formatCurrency($v['price'])?></li>
                                                </ul>
                                            </td>
                                            <td class="product-remove">
												<a href="wishlist?id=<?php echo $v['id']?>&action=delete"><i class="icon-trash icons"></i></a>
												<a href="javascript:void(0);" onclick="manage_cart('<?php echo $v['product_id']?>','add');"><i class="icon-handbag icons"></i></a>
												<input type="hidden" value="1" id="qty">
											</td>
                                        </tr>
									<?php }}else{ ?>  
										No Product in the Wishlist									
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