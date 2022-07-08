  <?php if(isset($return['product']) && is_array($return['product'])){?>
  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="category?id=<?php echo $return['product']['categories_id']?>"><?php echo $return['product']['categories']?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $return['product']['name']?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active imageZoom" id="img-tab-1">
                                            <img id="big_image" data-origin="<?php echo PRODUCT_IMAGE_SITE_PATH.$return['product']['image']?>" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$return['product']['image']?>" alt="full-image" width="290" height="290">
                                        </div>
										<?php if(isset($return['product']['multiple_images'])) { ?>
										<div id="multiple_images">										
										<?php foreach($return['product']['multiple_images'] as $list) { ?>
										<img id="small_img_<?php echo $list['id']?>" onclick="swapImage('<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images'] ?>',this.id);" style="margin-top:10px" src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']?>" width="15%"/>
										<?php } ?>
										</div>
										<?php } ?>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $return['product']['name']?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize">MRP: &nbsp;<?php echo $proObj->formatCurrency($return['product']['mrp'])?></li>
                                    <li>&nbsp;&nbsp;&nbsp;OFFER PRICE: &nbsp;<?php echo $proObj->formatCurrency($return['product']['price'])?></li>
                                </ul>
                                <p class="pro__info"><?php echo $return['product']['short_desc']?></p>
                                <div class="ht__pro__desc">	
																
								<div class="sin__desc align--left">
									<p><span>Categories:</span></p>
									<ul class="pro__cat__list">
										<li><a href="category?id=<?php echo $return['product']['categories_id']?>"><?php echo $return['product']['categories']?></a></li>
									</ul>
								</div>
								<div class="sin__desc align--left">
									<p><span>Seller:</span></p> <?php if($return['product']['username'] == 'admin') { echo "Ecom Retail";} else{echo ucfirst($return['product']['username']).' Enterprises ';}?>
								</div>
								
								
								
								<div class="sin__desc align--left">
									<p><span>Colour:</span></p>
									<ul class="pro__color">
									<?php foreach($return['product']['colour'] as $k=>$v){ ?>
										<li style="background:<?php echo $v[0]; ?> none repeat scroll 0 0"><a href="javascript:void(0);" onclick="loadAttr('<?php echo $k ?>','<?php echo $return['product']['id']; ?>','colour');"><?php echo $v[0]; ?></a></li>
									<?php } ?>
									</ul>									
								</div>
								
								<div class="sin__desc align--left">
									<p><span>Size: &nbsp;</span></p>
									<select  id="size_attr" onchange="showQty();" style="width:100px;height: 25px;">
										<option value="">Size</option>
										<?php foreach($return['product']['size'] as $v){ ?>
										<option><?php echo $v; ?></option>
									<?php } ?>
									</select>
								</div>
								<div class="field_error" id="cart_attr_msg"></div>
								<div class="sin__desc hide" id="cart_qty">
									<p><span>Qty:</span>
									<select id="qty">
									<?php $count = 10; /*if($return['product']['num_prod'] > 10){ 
												$count = 10;
											}else{
												$count = $return['product']['num_prod'];
									} */for($i=1; $i<=$count; $i++){?>
									<option><?php echo $i ?></option>
									<?php } ?>										
									</select>	
								</div>
								
								<?php if($return['product']['num_prod'] > 0){ ?>
								<div class="sin__desc">
									<p><span>Availability:</span> 
									<?php if($return['product']['num_prod'] > 0) { ?> In Stock <?php } else { ?> Out of Stock<?php } ?>					
									</p>
								</div>								                              
								<a class="fr__btn" href="javascript:void(0);" onclick="manage_cart('<?php echo $return['product']['id']?>','add');" style="margin-top:20px">Add to Cart</a>									
								</div>
								<?php } ?>									
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
		<input type="hidden" id="cid" value="">
		<input type="hidden" id="sid" value="">
		
        <!-- End Product Details Area -->
		  <!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            
                            <li role="presentation" class="review"><a href="#review" role="tab" data-toggle="tab">review</a></li>
							<li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <!-- <p><?php echo $return['product']['description']?></p> -->
                                </div>
                            </div>
                            <!-- End Single Content --> 
		
							<!-- <div role="tabpanel" id="review" class="pro__single__content tab-pane fade active show"> -->
							<div role="tabpanel" id="review" class="pro__single__content tab-pane fade active show">
								<div class="pro__tab__content__inner">
									<?php if( isset($return['comment']) && is_array($return['comment']) ) { foreach($return['comment'] as $k=>$v) { ?> 
									<article class="row">
										<div class="col-md-12 col-sm-12">
											<div class="panel panel-default arrow left">
												<div class="panel-body">
													<header class="text-left">
														<div><span class="comment-rating"><?php echo $v['rating']?></span>(<?php echo $v['name']?>)</div>
														<time class="comment-date"><?php echo $proObj->dateFormat($v['added_on']); ?></time>
														</header>
														<div class="comment-post">
															<p><?php echo $v['review']?></p>
														</div>
													</div>
												</div>
											</div>
									</article>
									<?php } } else { ?>
									<h3 class="submit_review_hint">No review added</h3><br/>
									<?php } ?>
									<h3 class="review_heading">Enter your review</h3><br/>
									<?php if(isset($_SESSION['USER_LOGIN'])) { ?>
									<div class="row" id="post-review-box" style="">
										<div class="col-mod-12">
											<form method="post">
												<select class="form-control" name="rating" required>
													<option value="">Select Rating</option>
													<option>Worst</option>
													<option>Bad</option>
													<option>Good</option>
													<option>Very Good</option>
													<option>Fantastic</option>
												</select><br/>
												<textarea class="form-control" cols="50" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>	
												<div class="text-right mt10"><button class="btn btn-success btn-lg" type="submit" name="submit" value="submit">Submit</button></div><input type="hidden" name="id" value="<?php echo $return['id'];?>">
											</form>
										</div>
									</div>
									<?php } else { ?>
									<span class="submit_review_hint">Please <a href="login">login</a> to submit your review</span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
        <!-- End Product Description -->
		<?php if(isset($_COOKIE['recently_viewed'])) { ?>
		<section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Recently Viewed</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
							<div class="row">
							<?php foreach($return['recently_viewed'] as $v){ ?>
								<div class="col-xs-3">
									<div class="category">
										<div class="ht__cat__thumb">
											<a href="product?id=<?php echo $v['id']?>">
												<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="product images" >
											</a>
										</div>
										<div class="fr__hover__info">
											<ul class="product__action">
												<li><a href="javascript:void(0);" onclick="manage_wishlist('<?php echo $v['id']?>','add');"><i class="icon-heart icons"></i></a></li>
												<li><a href="javascript:void(0);" onclick="manage_cart('<?php echo $v['id']?>','add');"><i class="icon-handbag icons"></i></a></li>	
												<input type="hidden" value="1" id="qty">								
											</ul>
										</div>
										<div class="fr__product__inner">
											<h4><a href="product?id=<?php echo $v['id']?>"><?php echo $v['name']?></a></h4>
											<ul class="fr__pro__prize">
												<li class="old__prize"><?php echo $proObj->formatCurrency($v['mrp'])?></li>
												<li><?php echo $proObj->formatCurrency($v['price'])?></li>
											</ul>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php } ?>
  <?php } else { ?>
  No data Found
   <?php }  ?>