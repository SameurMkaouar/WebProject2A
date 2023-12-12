<?php
session_start();
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
	<link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
	<script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->
	<style>
		.alert-top.show {
			animation: slideInDown 0.7s ease-out forwards;
		}

		.alert-top.hide {
			animation: slideOutUp 1s ease-out forwards;
		}

		@keyframes slideOutUp {
			from {
				opacity: 1;
				transform: translateY(0);
			}

			to {
				opacity: 0;
				transform: translateY(-100%);
			}
		}
	</style>

</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->
	<?php
	if (isset($_GET['warning'])) {
		echo '<div class="alert alert-warning alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>warning!</strong>  ' . $_GET['warning'] . '     
</div>';
	} ?>



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
														Psychologist
													</h3>
												</div>
												<div class="intro-layer" data-animation="fadeInLeft">
													<p class="small-text grey">
														Team Shelly
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
														Psychologist
													</h3>
												</div>
												<div class="intro-layer" data-animation="fadeInLeft">
													<p class="small-text grey">
														Team Shelly
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
								Discover a holistic approach to well-being at our online platform where psychology meets a world of possibilities. Here's a glimpse into what we offer:

							</p>
						</div>
					</div>
					<div class="row columns_padding_0 columns_margin_0 fontsize_16">
						<div class="col-md-3 col-sm-6">
							<div class="with_padding text-center teaser hover_shadow">
								<img src="../../assets/frontoffice/images/service-icons/relationship.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/mental.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/feelings.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/conflicting.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/meditation.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/depression.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/mind.png" alt="" />
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
								<img src="../../assets/frontoffice/images/service-icons/relaxation.png" alt="" />
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





			<section class="cs main_color2 parallax page_testimonials section_padding_75">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="owl-carousel testimonials-carousel top-dots" data-responsive-sm="1" data-responsive-md="1" data-responsive-lg="1" data-dots="true">
								<blockquote>
									“Your present circumstances don't determine where you can go; they merely determine where you start.”
									<div class="item-meta">
										<h5>Nido Qubein</h5>
									</div>
								</blockquote>
								<blockquote>
									“Every morning we are born again. What we do today matters most.”
									<div class="item-meta">
										<h5>Buddha</h5>
									</div>
								</blockquote>
								<blockquote>
									“You are not a drop in the ocean. You are the entire ocean in a drop.”
									<div class="item-meta">
										<h5>Rumi</h5>
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
											In the first session with a psychologist, you can expect to discuss your reasons for seeking therapy, your background, and any immediate concerns. The psychologist may gather information to better understand your goals and develop a plan for future sessions.
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
											Signs of partner abuse may include physical injuries, emotional distress, isolation from friends and family, control tactics, constant criticism, and fearfulness around the partner. If you suspect abuse, seek help from a trusted person or professional immediately. </div>
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

											In psychology, specific qualities often sought include empathy, active listening skills, non-judgmental attitude, confidentiality, cultural competence, and the ability to establish a therapeutic rapport. </div>
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
											Psychologists' salaries vary based on factors like location, experience, and specialization. On average, in the United States, clinical, counseling, and school psychologists earn around $80,000 annually. However, this figure can range from $60,000 to over $100,000. </div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">

							<div class="tab-content padding_0">

								<div class="tab-pane fade in active" id="tab1">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/WPPPFqsECz0" allowfullscreen></iframe>
									</div>
								</div>

								<div class="tab-pane fade" id="tab2">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/n3Xv_g3g-mA" allowfullscreen></iframe>
									</div>
								</div>

								<div class="tab-pane fade" id="tab3">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/MBRqu0YOH14" allowfullscreen></iframe>
									</div>
								</div>
							</div>
							<!-- eof .tab-content -->
							<style>

							</style>
							<ul class="nav nav-image" role="tablist">
								<li class="active">
									<a href="#tab1" role="tab" data-toggle="tab">
										<img src="" alt="Video Tab 1" id="thumbnail1" width="100%" height="auto">
									</a>
								</li>
								<li class="">
									<a href="#tab2" role="tab" data-toggle="tab">
										<img src="" alt="Video Tab 2" id="thumbnail2" width="100%" height="auto">
									</a>
								</li>
								<li class="">
									<a href="#tab3" role="tab" data-toggle="tab">
										<img src="" alt="Video Tab 3" id="thumbnail3" width="100%" height="auto">
									</a>
								</li>
							</ul>

							<script>
								// Replace these video IDs with the actual IDs of your YouTube videos
								var videoIds = ['WPPPFqsECz0', 'n3Xv_g3g-mA', 'MBRqu0YOH14'];

								function getVideoThumbnailUrl(videoId) {
									// Construct the URL for the thumbnail using the video ID
									return 'https://img.youtube.com/vi/' + videoId + '/default.jpg';
								}

								// Loop through video IDs, set thumbnail URLs, and apply dimensions
								videoIds.forEach(function(videoId, index) {
									var thumbnailUrl = getVideoThumbnailUrl(videoId);
									var imageId = 'thumbnail' + (index + 1);
									document.getElementById(imageId).src = thumbnailUrl;
								});
							</script>


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
	<script src="../../assets/frontoffice/alert.js"></script>

</body>

</html>