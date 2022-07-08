 <div class="body__overlay"></div>
        
	<!-- Start Bradcaump area -->
	<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('<?php echo $BANNER_CAT_URL ?>/search1.jpg') no-repeat scroll center center / cover ;">
		<div class="ht__bradcaump__wrap">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="bradcaump__inner">
							<nav class="bradcaump-inner">
							  <a class="breadcrumb-item" href="<?php echo $HOSTNAME_URL?>">Home</a>
							  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							  <span class="breadcrumb-item active">Search</span>
							  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							  <span class="breadcrumb-item active"><?php echo $return['str']?></span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Bradcaump area -->
	<!-- Start Product Grid -->
	<section class="htc__product__grid ptb--100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="htc__product__rightidebar">
						<div class="htc__grid__top">
							<div class="htc__select__option">
								<select class="ht__select">
									<option>Default softing</option>
									<option>Sort by popularity</option>
									<option>Sort by average rating</option>
									<option>Sort by newness</option>
								</select><div> Search results </div>
							</div>
						</div>						
				<?php if(is_array($return['product'])){foreach($return['product'] as $v){?>
				<!-- Start Single Category -->
				<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
					<div class="category">
						<div class="ht__cat__thumb">
							<a href="product?id=<?php echo $v['id']?>">
								<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$v['image']?>" alt="product images">
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
				<!-- End Single Category -->
						<?php } } else { ?>  
				<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">No data Found</div>
				<?php }  ?>  								   
								</div> 
							</div>
						</div>
						<!-- End Product View -->
					</div>					
				</div>
				<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
					<div class="htc__product__leftsidebar">					   
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Product Grid -->       