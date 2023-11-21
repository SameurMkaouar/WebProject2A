
<?php
require_once "../../controller/util.php";
session_start();
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
	<link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
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

			<section class="page_topline cs table_section table_section_md columns_padding_0">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3 text-center text-md-left">
						

							<?php
							// Check if the user is logged in
							if (is_loggedin()) {
								// User is logged in
							
								$username = $_SESSION['username'];
								
								echo '<div class="profile-container">';
									echo '<div class="profile-icon">';
									echo '<a href="test.php"><img src="../../assets/frontoffice/images/Default_ProfilePic.jpg" alt=""></a>';
									echo '</div>';
								// 	echo '<ul class="profile-details">';
								// 	echo '<li><a href="">bob</a></li>';
								// 	echo '<li><a href="">bob</a></li>';
								// 	echo '<li><a href="">bob</a></li>';
								// 	echo '</ul>';
								echo "<div class='logout'>";
								echo "<li>Welcome, $username! <a href='../../controller/logout.php'>Logout</a></li>";
								 echo '</div>';
								 echo '</div>';
								 
							} else {
								// User is not logged in
								echo "<li><a href='login.html'>Sign In</a></li>";
							}
							?>
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

						<div class="col-md-3 text-center text-md-right bottommargin_0">
							<a href="#appointment" class="theme_button color1 margin_0">Make an appointment</a>
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
										<a href="index.html">Home</a>
									</li>

									<!-- blog -->
									<li>
										<a href="blog-right.html">Blog</a>
										
									</li>
									<!-- eof blog -->

									<li>
										<a href="#">Features</a>
										
										<!-- eof mega menu -->
									</li>
									<!-- eof features -->


									<li>
										<a href="about.html">Pages</a>
										
									</li>
									<!-- eof pages -->

									<!-- gallery -->
									<li>
										<a href="gallery-regular.html">Gallery</a>
										<ul>
											<!-- Gallery regular -->
											<li>
												<a href="gallery-regular.html">Gallery Regular</a>
												<ul>
													<li>
														<a href="gallery-regular.html">1 column</a>
													</li>
													<li>
														<a href="gallery-regular-2-cols.html">2 columns</a>
													</li>
													<li>
														<a href="gallery-regular-3-cols.html">3 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery regular -->

											<!-- Gallery full width -->
											<li>
												<a href="gallery-fullwidth.html">Gallery Full Width</a>
												<ul>
													<li>
														<a href="gallery-fullwidth.html">2 column</a>
													</li>
													<li>
														<a href="gallery-fullwidth-3-cols.html">3 columns</a>
													</li>
													<li>
														<a href="gallery-fullwidth-4-cols.html">4 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery full width -->

											<!-- Gallery extended -->
											<li>
												<a href="gallery-extended.html">Gallery Extended</a>
												<ul>
													<li>
														<a href="gallery-extended.html">1 column</a>
													</li>
													<li>
														<a href="gallery-extended-2-cols.html">2 columns</a>
													</li>
													<li>
														<a href="gallery-extended-3-cols.html">3 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery extended -->

											<!-- Gallery carousel -->
											<li>
												<a href="gallery-carousel.html">Gallery Carousel</a>
												<ul>
													<li>
														<a href="gallery-carousel.html">1 column</a>
													</li>
													<li>
														<a href="gallery-carousel-2-cols.html">2 columns</a>
													</li>
													<li>
														<a href="gallery-carousel-3-cols.html">3 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery carousel -->

											<!-- Gallery tile -->
											<li>
												<a href="gallery-tile.html">Gallery Tile</a>
											</li>
											<!-- eof Gallery tile -->

											<!-- Gallery left sidebar -->
											<li>
												<a href="gallery-left.html">Gallery Left Sidebar</a>
												<ul>
													<li>
														<a href="gallery-left.html">1 column</a>
													</li>
													<li>
														<a href="gallery-left-2-cols.html">2 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery left sidebar -->

											<!-- Gallery right sidebar -->
											<li>
												<a href="gallery-right.html">Gallery Right Sidebar</a>
												<ul>
													<li>
														<a href="gallery-right.html">1 column</a>
													</li>
													<li>
														<a href="gallery-right-2-cols.html">2 columns</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery right sidebar -->

											<!-- Gallery item -->
											<li>
												<a href="gallery-single.html">Gallery Item</a>
												<ul>
													<li>
														<a href="gallery-single.html">Style 1</a>
													</li>
													<li>
														<a href="gallery-single2.html">Style 2</a>
													</li>
													<li>
														<a href="gallery-single3.html">Style 3</a>
													</li>
												</ul>
											</li>
											<!-- eof Gallery item -->
										</ul>
									</li>
									<!-- eof Gallery -->

									<!-- contacts -->
									<li>
										<a href="contact.html">Contact</a>
										<ul>
											<li>
												<a href="contact.html">Contact 1</a>
											</li>
											<li>
												<a href="contact2.html">Contact 2</a>
											</li>
											<li>
												<a href="contact3.html">Contact 3</a>
											</li>
											<li>
												<a href="contact4.html">Contact 4</a>
											</li>
										</ul>
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

			<section class="intro_section page_mainslider ds">
				<div class="flexslider">
					<ul class="slides">

						<li>
							<img src="https://images.pexels.com/photos/5699431/pexels-photo-5699431.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
							<div class="container">
								<div class="row">
									<div class="col-sm-12 text-center">
										<div class="slide_description_wrapper">
											<div class="slide_description">
												<div class="intro-layer" data-animation="fadeInRight">
													<h3>
														Rita Solomou
													</h3>
												</div>
												<div class="intro-layer" data-animation="fadeInLeft">
													<p class="small-text grey">
														Premium HTML Template
													</p>
												</div>
											</div>
											<!-- eof .slide_description -->
										</div>
										<!-- eof .slide_description_wrapper -->
									</div>
									<!-- eof .col-* -->
								</div>
								<!-- eof .row -->
							</div>
							<!-- eof .container -->
						</li>

						<li>
							<img src="https://images.pexels.com/photos/7176030/pexels-photo-7176030.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
							<div class="container">
								<div class="row">
									<div class="col-sm-12 text-center">
										<div class="slide_description_wrapper">
											<div class="slide_description">
												<div class="intro-layer" data-animation="fadeInRight">
													<h3>
														Rita Solomou
													</h3>
												</div>
												<div class="intro-layer" data-animation="fadeInLeft">
													<p class="small-text grey">
														Premium HTML Template
													</p>
												</div>
											</div>
											<!-- eof .slide_description -->
										</div>
										<!-- eof .slide_description_wrapper -->
									</div>
									<!-- eof .col-* -->
								</div>
								<!-- eof .row -->
							</div>
							<!-- eof .container -->
						</li>

					</ul>
				</div>
				<!-- eof flexslider -->
			</section>

			<section id="services" class="ls section_padding_top_130 section_padding_bottom_100">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2 class="section_header with_icon">What We Can Offer</h2>
							<p>
								Porchetta dolor magna ipsum. Irure beef ribs chicken dolore, laboris filet mignon ribeye bacon swine pork loin commodo pork chop corned beef hamburger.
							</p>
						</div>
					</div>
					<div class="row columns_padding_0 columns_margin_0 fontsize_16">
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/relationship.png" alt="" />
								<h4>
									<a href="service-single.html">Relationship</a>
								</h4>
								<p>
									A therapy that helps establish a more profound ground for healthy relationship.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/mental.png" alt="" />
								<h4>
									<a href="service-single.html">Mental health</a>
								</h4>
								<p>
									Improve your focus, relieve stress and anxiety, and develop creativity.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 clear-sm">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/feelings.png" alt="" />
								<h4>
									<a href="service-single.html">Feelings</a>
								</h4>
								<p>
									Achieve a better level of your well-being and the ability to manage feelings.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/conflicting.png" alt="" />
								<h4>
									<a href="service-single.html">Conflicting</a>
								</h4>
								<p>
									Invaluable insight into the knowledge of reducing conflict in relationship.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 clear-lg clear-md clear-sm">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/meditation.png" alt="" />
								<h4>
									<a href="service-single.html">Meditation</a>
								</h4>
								<p>
									Learn how to deal with difficult emotions and feelings by using healthy strategies.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/depression.png" alt="" />
								<h4>
									<a href="service-single.html">Depression</a>
								</h4>
								<p>
									If your depression is keeping you from living your life don’t hesitate to seek help.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 clear-sm">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/mind.png" alt="" />
								<h4>
									<a href="service-single.html">Mind Games</a>
								</h4>
								<p>
									It is crucial to understand how to prevent others from playing such games with you.
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="images/service-icons/relaxation.png" alt="" />
								<h4>
									<a href="service-single.html">Relaxation</a>
								</h4>
								<p>
									Focus your attention on calmness and increase your personal awareness.
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="about" class="cs parallax darken_gradient page_about section_padding_top_75 columns_margin_bottom_30">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-push-6 text-center">
							<h2 class="section_header">Welcome to Psychologist &amp; Family Consulting</h2>
							<br>
							<p class="bold fontsize_18">It's my goal to create a comfortable, safe environment, where we'll work to achieve the goal together.</p>
							<p class="fontsize_18">
								I am a certified specialist in the branch of psychology concerned with the assessment and treatment of mental illness and behavioural problems. My other passion is publishing. You can find and purchase all my books within this site.
							</p>
							<div class="with_icon topmargin_60">
								<h5 class="small-text text-uppercase inline-block">Ronda Solomou</h5>
								<span class="lightgrey">Psychologist</span>
							</div>
							<img src="images/signature.png" alt="" />
						</div>
						<div class="col-md-6 col-md-pull-6 text-center bottommargin_0">
							<img src="images/person.png" alt="" class="top-overlap" />
						</div>
					</div>
				</div>
			</section>

			<section class="ls section_padding_top_130 section_padding_bottom_100 columns_margin_top_0 columns_margin_bottom_30">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2 class="section_header with_icon">Recent Articles</h2>
							<p>
								Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin aliquip.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-center">
							<article class="vertical-item content-padding post format-standard with_shadow">

								<div class="item-media entry-thumbnail">
									<img src="images/blog_post1.jpg" alt="">
								</div>

								<div class="item-content entry-content">
									<header class="entry-header">

										<div class="entry-date small-text highlight">
											<a href="blog-right.html" rel="bookmark">
												<time class="entry-date" datetime="2017-03-13T08:50:40+00:00">
													March 13, 2017
												</time>
											</a>
										</div>

										<h4 class="entry-title">
											<a href="blog-single-right.html" rel="bookmark">How to avoid hostile attitude</a>
										</h4>

										<hr class="divider_30_1">

									</header>
									<!-- .entry-header -->

									<p class="bottommargin_40 fontsize_18">Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin eu frankfurter...</p>

									<a href="blog-single-right.html" class="theme_button color1">Read article</a>

								</div>
								<!-- .item-content.entry-content -->
							</article>
						</div>
						<div class="col-md-4 text-center">
							<article class="vertical-item content-padding post format-standard with_shadow">

								<div class="item-media entry-thumbnail">
									<img src="images/blog_post2.jpg" alt="">
								</div>

								<div class="item-content entry-content">
									<header class="entry-header">

										<div class="entry-date small-text highlight">
											<a href="blog-right.html" rel="bookmark">
												<time class="entry-date" datetime="2017-03-13T08:50:40+00:00">
													March 13, 2017
												</time>
											</a>
										</div>

										<h4 class="entry-title">
											<a href="blog-single-right.html" rel="bookmark">How to avoid hostile attitude</a>
										</h4>

										<hr class="divider_30_1">

									</header>
									<!-- .entry-header -->

									<p class="bottommargin_40 fontsize_18">Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin eu frankfurter...</p>

									<a href="blog-single-right.html" class="theme_button color1">Read article</a>

								</div>
								<!-- .item-content.entry-content -->
							</article>
						</div>
						<div class="col-md-4 text-center">
							<article class="vertical-item content-padding post format-standard with_shadow">

								<div class="item-media entry-thumbnail">
									<img src="images/blog_post3.jpg" alt="">
								</div>

								<div class="item-content entry-content">
									<header class="entry-header">

										<div class="entry-date small-text highlight">
											<a href="blog-right.html" rel="bookmark">
												<time class="entry-date" datetime="2017-03-13T08:50:40+00:00">
													March 13, 2017
												</time>
											</a>
										</div>

										<h4 class="entry-title">
											<a href="blog-single-right.html" rel="bookmark">How to avoid hostile attitude</a>
										</h4>

										<hr class="divider_30_1">

									</header>
									<!-- .entry-header -->

									<p class="bottommargin_40 fontsize_18">Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin eu frankfurter...</p>

									<a href="blog-single-right.html" class="theme_button color1">Read article</a>

								</div>
								<!-- .item-content.entry-content -->
							</article>
						</div>
					</div>
				</div>
			</section>

			<section class="cs main_color2 parallax page_testimonials section_padding_75">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="owl-carousel testimonials-carousel top-dots" data-responsive-sm="1" data-responsive-md="1" data-responsive-lg="1" data-dots="true">
								<blockquote>
									“for me this was a wonderful experience. i must say that i am really impressed.”
									<div class="item-meta">
										<h5>Myrtle Murray</h5>
									</div>
								</blockquote>
								<blockquote>
									“for me this was a wonderful experience. i must say that i am really impressed.”
									<div class="item-meta">
										<h5>Myrtle Murray</h5>
									</div>
								</blockquote>
								<blockquote>
									“for me this was a wonderful experience. i must say that i am really impressed.”
									<div class="item-meta">
										<h5>Myrtle Murray</h5>
									</div>
								</blockquote>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="faq" class="ls section_padding_top_130 section_padding_bottom_100">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2 class="section_header with_icon">Frequently Asked Questions</h2>
							<p>
								Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin aliquip.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel-group" id="accordion1">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="collapsed">
												What can I expect in the first session when I see a psychologist?
											</a>
										</h4>
									</div>
									<div id="collapse1" class="panel-collapse collapse">
										<div class="panel-body">
											Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion1" href="#collapse2" class="collapsed">
												What are the sings of being abused by your partner?
											</a>
										</h4>
									</div>
									<div id="collapse2" class="panel-collapse collapse">
										<div class="panel-body">
											Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion1" href="#collapse3" class="collapsed">
												What specific qualities are you looking for?
											</a>
										</h4>
									</div>
									<div id="collapse3" class="panel-collapse collapse">
										<div class="panel-body">
											Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin.
										</div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion1" href="#collapse4" class="collapsed">
												How much money do psychologists make?
											</a>
										</h4>
									</div>
									<div id="collapse4" class="panel-collapse collapse">
										<div class="panel-body">
											Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum jerky tenderloin.
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">

							<div class="tab-content padding_0">

								<div class="tab-pane fade in active" id="tab1">
									<div class="embed-responsive embed-responsive-16by9">
										<a href="//player.vimeo.com/video/1084537" class="embed-placeholder">
											<img src="images/video_tab1.jpg" alt="">
										</a>
									</div>
								</div>

								<div class="tab-pane fade" id="tab2">
									<div class="embed-responsive embed-responsive-16by9">
										<a href="//player.vimeo.com/video/1084537" class="embed-placeholder">
											<img src="images/video_tab2.jpg" alt="">
										</a>
									</div>
								</div>

								<div class="tab-pane fade" id="tab3">
									<div class="embed-responsive embed-responsive-16by9">
										<a href="//player.vimeo.com/video/1084537" class="embed-placeholder">
											<img src="images/video_tab3.jpg" alt="">
										</a>
									</div>
								</div>
							</div>
							<!-- eof .tab-content -->

							<ul class="nav nav-image" role="tablist">
								<li class="active">
									<a href="#tab1" role="tab" data-toggle="tab">
										<img src="images/video_tab1.jpg" alt="">
									</a>
								</li>
								<li>
									<a href="#tab2" role="tab" data-toggle="tab">
										<img src="images/video_tab2.jpg" alt="">
									</a>
								</li>
								<li>
									<a href="#tab3" role="tab" data-toggle="tab">
										<img src="images/video_tab3.jpg" alt="">
									</a>
								</li>
							</ul>

						</div>
					</div>
				</div>
			</section>

			<section id="prices" class="cs darken_gradient section_padding_75 columns_padding_0 columns_margin_0">
				<div class="container">
					<div class="row flex-row price-row">
						<div class="col-md-3 col-sm-6">
							<div class="price-table price-hover">
								<div class="price-media">
									<div class="plan-name">
										Personal
										<br> Help
									</div>
									<div class="plan-price with_icon">
										$99
										<p class="small-text">per hour</p>
									</div>
								</div>
								<div class="price-content ls with_shadow">
									<ul class="features-list">
										<li>
											Depression Therapy
										</li>
										<li>
											Stress Management
										</li>
										<li>
											Anxiety Treatment
										</li>
										<li>
											Individual Coaching
										</li>
										<li>
											Post-Divorce Recovery
										</li>
									</ul>
									<div class="call-to-action">
										<a href="#" class="theme_button color1">Book now</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="price-table price-hover">
								<div class="price-media">
									<div class="plan-name">
										Couples
										<br> Therapy
									</div>
									<div class="plan-price with_icon">
										$149
										<p class="small-text">per hour</p>
									</div>
								</div>
								<div class="price-content ls with_shadow">
									<ul class="features-list">
										<li>
											Depression Therapy
										</li>
										<li>
											Stress Management
										</li>
										<li>
											Anxiety Treatment
										</li>
										<li>
											Post-Divorce Recovery
										</li>
									</ul>
									<div class="call-to-action">
										<a href="#" class="theme_button color1">Book now</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="price-table price-hover">
								<div class="price-media">
									<div class="plan-name">
										Group
										<br> Therapy
									</div>
									<div class="plan-price with_icon">
										$49
										<p class="small-text">per hour</p>
									</div>
								</div>
								<div class="price-content ls with_shadow">
									<ul class="features-list">
										<li>
											Depression Therapy
										</li>
										<li>
											Stress Management
										</li>
										<li>
											Anxiety Treatment
										</li>
									</ul>
									<div class="call-to-action">
										<a href="#" class="theme_button color1">Book now</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="price-table price-hover">
								<div class="price-media">
									<div class="plan-name">
										Personal
										<br> Help
									</div>
									<div class="plan-price with_icon">
										$99
										<p class="small-text">per hour</p>
									</div>
								</div>
								<div class="price-content ls with_shadow">
									<ul class="features-list">
										<li>
											Depression Therapy
										</li>
										<li>
											Stress Management
										</li>
										<li>
											Anxiety Treatment
										</li>
										<li>
											Individual Coaching
										</li>
										<li>
											Post-Divorce Recovery
										</li>
									</ul>
									<div class="call-to-action">
										<a href="#" class="theme_button color1">Book now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="appointment" class="ls section_padding_top_130 section_padding_bottom_100">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
							<h2 class="section_header with_icon highlight">Make an Appointment</h2>
							<div class="fontsize_16">
								Exercitation cupim ex, short ribs cow in ullamco corned beef veniam kevin. Eu frankfurter ham hock ball tip reprehenderit adipisicing ipsum
							</div>

							<form class="contact-form row columns_margin_bottom_40 topmargin_60" method="post" action="./">


								<div class="col-sm-6">
									<div class="contact-form-name">
										<label for="name">Your Name
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Your Name">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-email">
										<label for="email">Email Address
											<span class="required">*</span>
										</label>
										<input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-subject">
										<label for="subject">Subject
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-phone">
										<label for="phone">Phone
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-date select-group">
										<label for="date" class="sr-only">Date
											<span class="required">*</span>
										</label>
										<div class="input-group">
											<select aria-required="true" id="date" name="date" class="choice empty form-control">
												<option value="" disabled selected data-default>Date</option>
												<option value="14.03.2017">14.03.2017</option>
												<option value="15.03.2017">15.03.2017</option>
												<option value="16.03.2017">16.03.2017</option>
												<option value="17.03.2017">17.03.2017</option>
												<option value="18.03.2017">18.03.2017</option>
												<option value="19.03.2017">19.03.2017</option>
												<option value="20.03.2017">20.03.2017</option>
												<option value="21.03.2017">21.03.2017</option>
												<option value="22.03.2017">22.03.2017</option>
												<option value="23.03.2017">23.03.2017</option>
												<option value="24.03.2017">24.03.2017</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-time select-group">
										<label for="time" class="sr-only">Date
											<span class="required">*</span>
										</label>
										<div class="input-group">
											<select aria-required="true" id="time" name="time" class="choice empty form-control">
												<option value="" disabled selected data-default>Time</option>
												<option value="14.03.2017">9:00</option>
												<option value="15.03.2017">10:00</option>
												<option value="16.03.2017">11:00</option>
												<option value="17.03.2017">12:00</option>
												<option value="18.03.2017">13:00</option>
												<option value="19.03.2017">14:00</option>
												<option value="20.03.2017">15:00</option>
												<option value="21.03.2017">16:00</option>
												<option value="22.03.2017">17:00</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="contact-form-message">
										<label for="message">Message</label>
										<textarea aria-required="true" rows="1" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
									</div>
								</div>

								<div class="col-sm-12">

									<div class="contact-form-submit topmargin_20">
										<button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color1 with_shadow">Send message</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</section>

			<footer class="page_footer cs main_color2 table_section section_padding_50 columns_padding_0">
				<div class="container">

					<div class="row">

						<div class="col-sm-4 col-sm-push-4 text-center">
							<a href="./" class="logo big text-shadow">
								Psychologist
								<span class="small-text">Premium HTML Template</span>
							</a>
						</div>

						<div class="col-sm-4 col-sm-pull-4 text-center text-sm-left text-md-left">
							<div class="widget widget_nav_menu greylinks">

								<ul class="menu divided_content wide_divider">
									<li class="">
										<a href="./">Home</a>
									</li>
									<li class="">
										<a href="about.html">About</a>
									</li>
									<li class="">
										<a href="services.html">Services</a>
									</li>
								</ul>

							</div>
						</div>

						<div class="col-sm-4 text-center text-sm-right text-md-right">
							<div class="widget widget_nav_menu greylinks">

								<ul class="menu divided_content wide_divider">
									<li class="">
										<a href="gallery-regular-3-cols.html">Gallery</a>
									</li>
									<li class="">
										<a href="blog-right.html">Blog</a>
									</li>
									<li class="">
										<a href="contact.html">Contacts</a>
									</li>
								</ul>

							</div>
						</div>

					</div>
				</div>
			</footer>

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