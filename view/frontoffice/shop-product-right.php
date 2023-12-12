<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location:../frontoffice/login.php");
}
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<title>Psychologist</title>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="../../assets/frontoffice/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/frontoffice/css/animations.css">
	<link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css">
	<link rel="stylesheet" href="../../assets/frontoffice/css/mainsamer.css" class="color-switcher-link">
	<link rel="stylesheet" href="../../assets/frontoffice/css/shop.css" class="color-switcher-link">
	<script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>

	<!-- search modal -->
	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">
				<i class="rt-icon2-cross2"></i>
			</span>
		</button>
		<div class="widget widget_search">
			<form method="get" class="searchform search-form form-inline" action="./">
				<div class="form-group">
					<input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input">
				</div>
				<button type="submit" class="theme_button">Search</button>
			</form>
		</div>
	</div>

	<!-- Unyson messages modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
		<div class="fw-messages-wrap ls with_padding">
			<!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
			<!--
		<ul class="list-unstyled">
			<li>Message To User</li>
		</ul>
		-->

		</div>
	</div>
	<!-- eof .modal -->

	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->



			<section class="page_breadcrumbs ds background_cover section_padding_50">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2>Single Product</h2>
							<ol class="breadcrumb divided_content wide_divider">
								<li>
									<a href="./">
										Home
									</a>
								</li>
								<li>
									<a href="#">Shop</a>
								</li>
								<li class="active">Single Product</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section class="ls section_padding_top_100 section_padding_bottom_75 columns_padding_25">
				<div class="container">
					<div class="row">

						<div class="col-sm-7 col-md-8 col-lg-8">

							<?php
							include '../../controller/readproductfrontsingle.php';
							?>
							<!-- .with_background -->



							<!-- .woocommerce-tabs -->


						</div>
						<!--eof .col-sm-8 (main content)-->


						<!-- sidebar -->
						<aside class="col-sm-5 col-md-4 col-lg-4">


							<div class="widget widget_search">

								<form method="get" class="searchform form-inline" action="./">
									<div class="form-group">
										<label class="screen-reader-text" for="widget-search">Search for:</label>
										<input id="widget-search" type="text" value="" name="search" class="form-control" placeholder="Search">
									</div>
									<button type="submit" class="theme_button">Search</button>
								</form>
							</div>

							<div class="widget widget_shopping_cart">
								<p class="buttons">
									<a href="shop-cart-right.html" class="theme_button color2">View Cart</a>
									<a href="shop-checkout-right.html" class="theme_button">Checkout</a>
								</p>

							</div>
					</div>





					</aside>
					<!-- eof aside sidebar -->


				</div>
		</div>
		</section>

		<?php include_once('footerfront.php'); ?>

		<section class="cs main_color2 page_copyright section_padding_15">
			<div class="container with_top_border">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p class="small-text">&copy; 2017 Psychology and Counseling. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</section>

	</div>
	<!-- eof #box_wrapper -->
	</div>
	<!-- eof #canvas -->

	<script src="../../assets/frontoffice/js/compressed.js"></script>
	<script src="../../assets/frontoffice/js/main.js"></script>


</body>

</html>