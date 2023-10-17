<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Electro - HTML Ecommerce Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('index/assets/css/bootstrap.min.css') }}" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ asset('index/assets/css/slick.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('index/assets/css/slick-theme.css') }}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ asset('index/assets/css/nouislider.min.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('index/assets/css/font-awesome.min.css') }}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('index/assets/css/style.css') }}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<?php
	include(__DIR__ . '/../../../resources/views/client/header.blade.php');
	// For Laravel or Blade templates
	?>
	<!-- /NAVIGATION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="{{ asset('index/assets/img/laptop1.jpg') }}" alt="">
						</div>
						<div class="shop-body">
							<h3>Laptop<br>Collection</h3>
							<a href="#" class="cta-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="{{ asset('index/assets/img/pc1.png') }}" alt="">
						</div>
						<div class="shop-body">
							<h3>PC<br>Collection</h3>
							<a href="#" class="cta-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div>
					<div class="col-md-4 col-xs-6">
						<div class="shop" style="height: 200px;">
							<div class="shop-img">
								<img src="{{ asset('index/assets/img/dareu-em901x-pink_mouse.png') }}" alt="">
							</div>
							<div class="shop-body">
								<h3>Mouse<br>Collection</h3>
								<a href="#" class="cta-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop" style="height: 200px;">
							<div class="shop-img">
								<img src="{{ asset('index/assets/img/akko_keyboard.png') }}" alt="">
							</div>
							<div class="shop-body">
								<h3>Keyboard<br>Collection</h3>
								<a href="#" class="cta-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								@php
								$linkNumber = 1;
								@endphp
								@if(is_array($firstFiveCategories))
								@foreach ($firstFiveCategories as $category)
								@php
								$class = ($linkNumber === 1) ? 'active' : '';
								@endphp
								<li class="{{ $class }}">
									<a data-toggle="tab" href="#tab{{ $linkNumber }}">{{ $category }}</a>
								</li>
								@php
								$linkNumber++;
								@endphp
								@endforeach
								@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							@php
							$linkTabNumber = 1;
							@endphp
							@if(is_array($firstFiveCategories))
							@foreach ($firstFiveCategories as $category)
							@if(is_string($category))
							<div id="tab{{ $linkTabNumber }}" class="tab-pane{{ $linkTabNumber === 1 ? ' active' : '' }}">
								<div class="products-slick" data-nav="#slick-nav-{{ $linkTabNumber }}">
									@foreach ($products as $product)
									@if ($product->product_category_name == $category)
									@php
									$isProductOnSale = $allSaleProducts->contains('id', $product->id);
									$salePercent = $activeSales->firstWhere('id', $product->sale_id)->sale_percent ?? null;
									if($isProductOnSale){
									$newProductPrice = $product->price * $salePercent / 100;
									}
									@endphp
									<div class="product">
										<div class="product-img">
											@if ($product->product_image)
											<img src="{{ asset($product->product_image) }}" alt="Product Image" height="230">
											@endif
											<div class="product-label">
												@if ($isProductOnSale)
												<span class="sale">{{ $salePercent ?? 0 }}%</span>
												@endif
												<!-- <span class="new">NEW</span> -->
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">{{ $product->product_subcategory_name }}</p>
											<h3 class="product-name custom-title-product" title="{{ $product->product_name }}">
												<a href="#">{{ $product->product_name }}</a>
											</h3>
											@if ($isProductOnSale)
											<h4 class="product-price">${{ round($newProductPrice) }} <del class="product-old-price">${{ $product->price }}</del></h4>
											@else
											<h4 class="product-price">${{ $product->price }}</h4>
											@endif
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
												<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
											</div>
										</div>
										<div class="add-to-cart">
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
									@endif
									@endforeach
								</div>
								<div id="slick-nav-{{ $linkTabNumber }}" class="products-slick-nav"></div>
							</div>
							@php
							$linkTabNumber++;
							@endphp
							@endif
							@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- /SECTION -->

	<!-- HOT DEAL SECTION -->
	<div id="hot-deal" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<ul class="hot-deal-countdown">
							<li>
								<div>
									<h3 id="days">02</h3>
									<span>Days</span>
								</div>
							</li>
							<li>
								<div>
									<h3 id="hours">10</h3>
									<span>Hours</span>
								</div>
							</li>
							<li>
								<div>
									<h3 id="minutes">34</h3>
									<span>Mins</span>
								</div>
							</li>
							<li>
								<div>
									<h3 id="seconds">60</h3>
									<span>Secs</span>
								</div>
							</li>

						</ul>
						<h2 class="text-uppercase"><?php echo $nearestSale->sale_name ?></h2>
						<p>New Collection Up to <?php echo $nearestSale->sale_percent ?>% OFF</p>
						<a class="primary-btn cta-btn" href="#">Shop now</a>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOT DEAL SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Top selling</h3>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab2" class="tab-pane fade in active">
								<div class="products-slick" data-nav="#slick-nav-2">
									<!-- product -->
									@foreach ($topSaleProducts as $topSaleProduct)
									@php
									$isProductOnSale = $allSaleProducts->contains('id', $topSaleProduct->id);
									$salePercent = $activeSales->firstWhere('id', $topSaleProduct->sale_id)->sale_percent ?? null;
									if($isProductOnSale){
									$newProductPrice = $topSaleProduct->price * $salePercent / 100;
									}
									@endphp
									<div class="product">
										<div class="product-img">
											@if ($topSaleProduct->product_image)
											<img src="{{ asset($topSaleProduct->product_image) }}" alt="Product Image" height="230">
											@endif
											<div class="product-label">
												@if ($isProductOnSale)
												<span class="sale">{{ $salePercent ?? 0 }}%</span>
												@endif
												<!-- <span class="new">NEW</span> -->
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">{{ $topSaleProduct->product_subcategory_name }}</p>
											<h3 class="product-name custom-title-product" title="{{ $topSaleProduct->product_name }}">
												<a href="#">{{ $topSaleProduct->product_name }}</a>
											</h3>
											@if ($isProductOnSale)
											<h4 class="product-price">${{ round($newProductPrice) }} <del class="product-old-price">${{ $topSaleProduct->price }}</del></h4>
											@else
											<h4 class="product-price">${{ $topSaleProduct->price }}</h4>
											@endif
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
												<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
											</div>
										</div>
										<div class="add-to-cart">
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
									@endforeach
									<!-- /product -->
								</div>
								<div id="slick-nav-2" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- /Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Rating</h4>
						<div class="section-nav">
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-3">
						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Best of Every Category</h4>
						<div class="section-nav">
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>
					</div>
				</div>

				<div class="clearfix visible-sm visible-xs"></div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top View</h4>
						<div class="section-nav">
							<div id="slick-nav-5" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>

						<div>
							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- /product widget -->

							<!-- product widget -->
							<div class="product-widget">
								<div class="product-img">
									<img src="{{ asset('index/assets/img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							<!-- product widget -->
						</div>
					</div>
				</div>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- NEWSLETTER -->
	<div id="newsletter" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="newsletter">
						<p>Sign Up for the <strong>NEWSLETTER</strong></p>
						<form>
							<input class="input" type="email" placeholder="Enter Your Email">
							<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
						</form>
						<ul class="newsletter-follow">
							<li>
								<a href="https://www.facebook.com" target=”_blank”><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="https://twitter.com" target=”_blank”><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="https://www.instagram.com" target=”_blank”><i class="fa fa-instagram"></i></a>
							</li>
							<li>
								<a href="https://www.pinterest.com/" target=”_blank”><i class="fa fa-pinterest"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /NEWSLETTER -->

	<!-- FOOTER -->
	<?php
	include(__DIR__ . '/../../../resources/views/client/footer.blade.php');
	?>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{ asset('index/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('index/assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('index/assets/js/nouislider.min.js') }}"></script>
	<script src="{{ asset('index/assets/js/jquery.zoom.min.js') }}"></script>
	<script src="{{ asset('index/assets/js/main.js') }}"></script>

</body>

</html>

<script type="text/javascript">
	function updateCountdownTimer() {
		// Get the current date and time
		var now = new Date().getTime();

		// Calculate the time remaining (in milliseconds) until the sale ends
		var saleEnd = new Date('<?php echo $nearestSale->sale_to; ?>').getTime();
		var timeRemaining = saleEnd - now;

		if (timeRemaining < 0) {
			// Sale has ended
			document.getElementById("days").innerHTML = "00";
			document.getElementById("hours").innerHTML = "00";
			document.getElementById("minutes").innerHTML = "00";
			document.getElementById("seconds").innerHTML = "00";
			return;
		}

		// Calculate days, hours, minutes, and seconds
		var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
		var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

		// Update the HTML elements with the calculated values
		document.getElementById("days").innerHTML = ('0' + days).slice(-2);
		document.getElementById("hours").innerHTML = ('0' + hours).slice(-2);
		document.getElementById("minutes").innerHTML = ('0' + minutes).slice(-2);
		document.getElementById("seconds").innerHTML = ('0' + seconds).slice(-2);
	}

	// Call the function every second
	setInterval(updateCountdownTimer, 1000);
</script>