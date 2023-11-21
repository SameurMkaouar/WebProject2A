<?php
session_start();
require_once "../../model/user.php";
$user = new user();
$userInfo = $user->retrieveInformation($_SESSION['user_id']);

// Check if information is retrieved successfully
if (!empty($userInfo)) {
    // Access the first element of the array (assuming it's a single user record)
    $userRecord = $userInfo[0];

    // Process or store the information as needed
    $username = isset($userRecord['Username']) ? $userRecord['Username'] : "Default Username";
    $email = isset($userRecord['Email']) ? $userRecord['Email'] : "Default Email";
    $password = isset($userRecord['Password']) ? $userRecord['Password'] : "Default Password";
    $firstname = isset($userRecord['Firstname']) ? $userRecord['Firstname'] : "Default Firstname";
    $lastname = isset($userRecord['Lastname']) ? $userRecord['Lastname'] : "Default Lastname";
    $sex = isset($userRecord['Sex']) ? $userRecord['Sex'] : "Default Sex";
    $picture = isset($userRecord['Picture']) ? $userRecord['Picture'] : "Default Picture";
    $DoB = isset($userRecord['DateOfBirth']) ? $userRecord['DateOfBirth'] : "Default Date of Birth";
    $crdate = isset($userRecord['CreationDate']) ? $userRecord['CreationDate'] : "Default Creation Date";
    $role = isset($userRecord['Role']) ? $userRecord['Role'] : "Default Role";

    // Now you can use $username, $email, $password, etc.

} else {
    // Handle the case when no information is retrieved or an error occurs
    echo "Failed to retrieve user information.";
}
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
										<a href="homepage.php">Home</a>
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
            <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
				<div class="container-fluid">

					<div class="row">
						<div class="col-sm-12">
							<h3>User
								<small>profile</small>
							</h3>
						</div>
					</div>
					<!-- .row -->
                    <div class="wrap-forms">
												<div class="row">
													<div class="col-sm-12">
														<a href="profile_edit.php"profil.html class="theme_button wide_button color1" type="submit" value="Send Message">MODIFY</a>
														<input class="theme_button wide_button" type="reset" value="Clear">
													</div>
												</div>
											</div>


					<div class="row">
						<div class="col-md-9">


							<div class="row">
								<!-- User Bio -->
								<div class="col-xs-12 col-sm-12">

									<div class="with_border with_padding">
										<div class="media big-left-media">
											<div class="media-left">
												<img src="images/team/01.jpg" alt="...">
											</div>
											<div class="media-body">
												<h4><?php echo $firstname.' '.$lastname;?>
													<small><?php echo $role;?></small>
												</h4>
												<p>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
												</p>
											</div>
										</div>
									</div>
									<!-- .with_border -->
								</div>
								<!-- .col-* -->

							</div>
							<!-- .row -->

							<div class="row">

								<!-- User Info -->
								<div class="col-xs-12 col-md-6">
									<div class="with_border with_padding">
										<h4>
											User Info
										</h4>

										<ul class="list1 no-bullets">
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-warning round fontsize_16">
															<i class="fa fa-globe"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Location:
														</strong>
														Tunisia
													</div>
												</div>
											</li>
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-success round fontsize_16">
															<i class="fa fa-flag"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Date of birth:
														</strong>
														<?php echo $DoB; ?>
													</div>
												</div>
											</li>
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-info round fontsize_16">
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Sex:
														</strong>
														<?php echo $sex;?>
													</div>
												</div>
											</li>
										</ul>

									</div>
									<!-- .with_border -->
								</div>
								<!-- col-* -->

								<!-- User Statistics -->
								<div class="col-xs-12 col-md-6">
									<div class="with_border with_padding">
										<h4>
											User Statistics
										</h4>

										<ul class="list1 no-bullets">
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-success fontsize_16">
															<i class="fa fa-comments"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Comments:
														</strong>
														146
													</div>
												</div>
											</li>
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-info fontsize_16">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Member sicne:
														</strong>
														<?php echo $crdate;?>
													</div>
												</div>
											</li>
											<li>
												<div class="media small-teaser">
													<div class="media-left media-middle">
														<div class="teaser_icon label-warning fontsize_16">
															<i class="fa fa-bolt"></i>
														</div>
													</div>
													<div class="media-body media-middle">
														<strong class="grey">
															Last activity:
														</strong>
														2 days ago
													</div>
												</div>
											</li>

										</ul>

									</div>
									<!-- .with_border -->
								</div>
								<!-- col-* -->
							</div>
							<!-- .row -->


							<div class="row">

								<!-- Latest Comments -->
								<div class="col-xs-12 col-md-6">

									<div class="with_border with_padding">
										<h4>
											Latest User Comments
										</h4>
										<div class="admin-scroll-panel scrollbar-macosx">
											<ul class="list1 no-bullets">
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
                                                            <?php echo $firstname.' '.$lastname;?>
																<small>2 hours ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, corporis. Voluptatibus odio perspiciatis non quisquam provident, quasi eaque officia.
															</div>
														</div>
													</div>
												</li>
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
                                                            <?php echo $firstname.' '.$lastname;?>
																<small>5 hours ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
															</div>
														</div>
													</div>
												</li>
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
																<?php echo $firstname.' '.$lastname;?>
																<small>1 day ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<!-- .admin-scroll-panel -->
										<div class="text-right greylinks panel-view-all">
											<a href="admin_comments.html">View All</a>
										</div>
									</div>
									<!-- .with_border -->
								</div>
								<!-- .col-* -->

								<div class="col-xs-12 col-md-6">
									<!-- Latest Posts -->
									<div class="with_border with_padding">
										<h4>
											Latest User Posts
										</h4>
										<div class="admin-scroll-panel scrollbar-macosx">
											<ul class="list1 no-bullets">
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
																<?php echo $firstname.' '.$lastname;?>
																<small>2 hours ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, corporis. Voluptatibus odio perspiciatis non quisquam provident, quasi eaque officia.
															</div>
														</div>
													</div>
												</li>
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
																<?php echo $firstname.' '.$lastname;?>
																<small>5 hours ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
															</div>
														</div>
													</div>
												</li>
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<img src="images/team/01.jpg" alt="...">
														</div>
														<div class="media-body">
															<h5>
																<?php echo $firstname.' '.$lastname;?>
																<small>1 day ago</small>
															</h5>
															<div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<!-- .admin-scroll-panel -->
										<div class="text-right greylinks panel-view-all">
											<a href="admin_posts.html">View All</a>
										</div>
									</div>
								</div>
								<!-- .col-* -->

							</div>
							<!-- .row -->
						</div>
						<!-- .col-* left column -->

						<div class="col-xs-12 col-md-3">

							<div class="row">
								<div class="col-sm-12">
									<div class="panel-group bottommargin_0" id="contact-info-accordion">

										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a class="icon-tab" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse1">
														<i class="highlight fontsize_16 fa fa-phone"></i>
														<?php echo $username;?>
													</a>
												</h4>
											</div>
										</div>
										<!-- .panel -->

										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse2">
														<i class="highlight fontsize_16 fa fa-mobile"></i>
														Mobile Phone
													</a>
												</h4>
											</div>
                                            <div id="user-info-collapse2" class="panel-collapse collapse">
												<div class="panel-body">
													<p>
														<strong>+216 00 000 000 </strong> 
													</p>
												</div>
											</div>
											
										</div>
										<!-- .panel -->

										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse3">
														<i class="highlight fontsize_16 fa fa-envelope"></i>
														E-mail address
													</a>
												</h4>
											</div>
											<div id="user-info-collapse3" class="panel-collapse collapse">
												<div class="panel-body">

													<p class="greylinks">
														<?php echo $email ?>
													</p>
												</div>
											</div>
										</div>
										<!-- .panel -->

										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse4">
														<i class="highlight fontsize_16 fa fa-map-marker"></i>
														Address
													</a>
												</h4>
											</div>
											<div id="user-info-collapse4" class="panel-collapse collapse">
												<div class="panel-body">

													<p>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													</p>

												</div>
											</div>
										</div>
										<!-- .panel -->

									
										<!-- .panel -->

									</div>
									<!-- .panel-group -->
								</div>
								<!-- .col-* -->
								<div class="col-sm-12">
									<div class="with_border with_padding">

										<form method="post" action="./">
											<div class="wrap-forms">
												<div class="row">
													<div class="col-xs-12">
														<h4>Send Message</h4>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12">
														<div class="form-group has-placeholder">
															<label for="form-id-1">Name
																<sup>*</sup>
															</label>
															<input class="form-control" type="text" name="name" placeholder="Name" value="" id="form-id-1" required="required">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12">
														<div class="form-group has-placeholder">
															<label for="form-id-2">Phone
																<sup>*</sup>
															</label>
															<input class="form-control" type="text" name="phone" placeholder="Phone" value="" id="form-id-2" required="required">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12">
														<div class="form-group has-placeholder">
															<label for="form-id-3">Email
																<sup>*</sup>
															</label>
															<input class="form-control" type="text" name="email" placeholder="Email" value="" id="form-id-3" required="required">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12">
														<div class="form-group has-placeholder">
															<label for="form-id-4">Message
																<sup>*</sup>
															</label>
															<textarea class="form-control" name="message" placeholder="Message" id="form-id-4" required="required"></textarea>
														</div>
													</div>
												</div>
												<div class="row"></div>
											</div>
											<div class="wrap-forms">
												<div class="row">
													<div class="col-sm-12">
														<input class="theme_button wide_button color1" type="submit" value="Send Message">
														<input class="theme_button wide_button" type="reset" value="Clear">
													</div>
												</div>
											</div>
										</form>

									</div>
									<!-- .with_padding -->
								</div>
								<!-- .col -->
							</div>
							<!-- .row -->
						</div>
						<!-- .col-* right column -->
					</div>
					<!-- .row main columns -->
				</div>
				<!-- .container -->
			</section>

            <!-- template init -->
	<script src="../../assets/frontoffice/js/compressed.js"></script>
	<script src="../../assets/frontoffice/js/main.js"></script>

	<!-- dashboard libs -->

	<!-- events calendar -->
	<script src="../../assets/frontoffice/js/admin/moment.min.js"></script>
	<script src="../../assets/frontoffice/js/admin/fullcalendar.min.js"></script>
	<!-- range picker -->
	<script src="../../assets/frontoffice/js/admin/daterangepicker.js"></script>

	<!-- charts -->
	<script src="../../assets/frontoffice/js/admin/Chart.bundle.min.js"></script>
	<!-- vector map -->
	<script src="../../assets/frontoffice/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="../../assets/frontoffice/js/admin/jquery-jvectormap-world-mill.js"></script>
	<!-- small charts -->
	<script src="../../assets/frontoffice/js/admin/jquery.sparkline.min.js"></script>

	<!-- dashboard init -->
	<script src="../../assets/frontoffice/js/admin.js"></script>
</body>