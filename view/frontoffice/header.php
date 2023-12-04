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

	<link rel="stylesheet" href="../../Assets/FrontOffice/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../Assets/FrontOffice/css/animations.css">
	<link rel="stylesheet" href="../../Assets/FrontOffice/css/fonts.css">
	<link rel="stylesheet" href="../../Assets/FrontOffice/css/main.css" class="color-switcher-link">
	<script src="../../Assets/FrontOffice/js/vendor/modernizr-2.6.2.min.js"></script>
	

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

			<section class="page_topline cs table_section table_section_md columns_padding_0">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3 text-center text-md-left">
							<ul class="inline-dropdown inline-block divided_content">

								<li class="dropdown login-dropdown">
									<a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
										<i class="fa fa-user"></i>
										<span class="header-button-text">Login</span>
									</a>

									<div class="dropdown-menu ls with_padding">

										<p>
											<strong class="grey">If you have an account, please log in:</strong>
										</p>
										<form role="form" action="/">

											<div class="form-group">
												<label for="login_email" class="sr-only">Email address</label>
												<input type="email" class="form-control" id="login_email" placeholder="Email Address">
											</div>
											<div class="form-group">
												<label for="login_password" class="sr-only">Password</label>
												<input type="password" class="form-control" id="login_password" placeholder="Password">
											</div>
											<div class="checkbox">
												<input type="checkbox" id="remember_checkbox">
												<label for="remember_checkbox">
													Remember Me
												</label>
											</div>

											<button type="button" class="theme_button color1 block_button">
												Log in
											</button>

										</form>
										<div class="topmargin_20 darklinks">
											<a href="#">Forgot Your Password?</a>
										</div>

									</div>
								</li>


								<a class="header-button" href="#">
									<i class="fa fa-lock"></i>
									<span class="header-button-text">Register</span>
								</a>
							</ul>

						</div>

						<div class="col-md-6 text-center divided_content">

							<div>
								<div class="media small-teaser">
									<div class="media-left">
										<i class="fa fa-user highlight fontsize_16"></i>
									</div>
									<div class="media-body">
										0 (800) 337 25 25
									</div>
								</div>
							</div>

							<div>
								<div class="media small-teaser">
									<div class="media-left">
										<i class="fa fa-map-marker highlight fontsize_16"></i>
									</div>
									<div class="media-body">
										350 Leverton Cove Road Springfield, MA
									</div>
								</div>
							</div>

							<div>
								<div class="media small-teaser">
									<div class="media-left">
										<i class="fa fa-envelope highlight fontsize_16"></i>
									</div>
									<div class="media-body">
										support@psychologist.com
									</div>
								</div>
							</div>

						</div>


					</div>
				</div>
			</section>

			<header class="page_header header_white table_section columns_padding_0 toggler-xs-right">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3 col-sm-5">
							<a href="./" class="logo">
								Psychologist
							</a>
							<!-- header toggler -->
							<span class="toggle_menu visible-xs">
								<span></span>
							</span>
						</div>
						<div class="col-md-6 col-sm-2 text-center">
							<!-- main nav start -->
							<nav class="mainmenu_wrapper">
								<ul class="mainmenu nav sf-menu">
									<li class="active">
										<a href="index.php">Home</a>
									</li>
									<li class="">
										<a href="appointments.php">Mes Rendez-vous</a>
									</li>
									<li>
										<a href="medecins.php">medecins</a>
									</li>
									<!-- blog -->
									<li>
										<a href="blog.php">Blog</a>
									</li>
									<!-- eof blog -->
									<li class="">
										<a href="searchappointment.php">Mes ordonances</a>
									</li>

									<li>
												<a href="team.php">Doctors</a>
									</li>

									<!-- gallery -->
									<li>
										<a href="gallery.php">Gallery</a>
									</li>
									<!-- eof Gallery -->
									<!-- about -->
									<li>
										<a href="about.php">About</a>
									</li>
									<!-- eof about -->
									<!-- contacts -->
									<li>
										<a href="contact.php">Contact</a>

									</li>
									<li>
										<a href="appoinMedecin.php">Rendez-vous des medecins</a>

									</li>
									<!-- eof contacts -->
								</ul>
							</nav>
							<!-- eof main nav -->
							<span class="toggle_menu hidden-xs">
								<span></span>
							</span>
						</div>
						<div class="col-md-3 col-sm-5 text-right hidden-xs lightgreylinks">
							<div class="page_social_icons divided_content">
								<span>
									<a class="social-icon soc-facebook" href="#" title="Facebook"></a>
								</span>
								<span>
									<a class="social-icon soc-twitter" href="#" title="Twitter"></a>
								</span>
								<span>
									<a class="social-icon soc-google" href="#" title="Google"></a>
								</span>
								<span>
									<a class="social-icon soc-linkedin" href="#" title="LinkedIn"></a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</header>