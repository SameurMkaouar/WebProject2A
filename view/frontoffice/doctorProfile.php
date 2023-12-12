<?php
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";
include_once "../../model/Post.php";
$user = new user();
$doc_id = $_GET['id'];
$userInfo = $user->retrieveInformation($_GET['id']);

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
	$picture = isset($userRecord['Picture']) ? $userRecord['Picture'] : "";
	$DoB = isset($userRecord['DateOfBirth']) ? $userRecord['DateOfBirth'] : "Default Date of Birth";
	$crdate = isset($userRecord['CreationDate']) ? $userRecord['CreationDate'] : "Default Creation Date";
	$role = isset($userRecord['Role']) ? $userRecord['Role'] : "Default Role";
	$numero = isset($userRecord['Numero']) ? $userRecord['Numero'] : "00 000 000";
	$Region = isset($userRecord['Region']) ? $userRecord['Region'] : "not specified";
	$City = isset($userRecord['City']) ? $userRecord['City'] : "not specified";
	$Street = isset($userRecord['Street']) ? $userRecord['Street'] : "not specified";
	$description = isset($userRecord['Description']) ? $userRecord['Description'] : "no description";
	if ($description === "") $description = "no description";
	// Now you can use $username, $email, $password, etc.

} else {
	// Handle the case when no information is retrieved or an error occurs
	echo "Failed to retrieve user information.";
}
//FETCH POSTS
$Post = new Post();
$posts = $Post->getMyRecentPosts($userRecord['Id']);








function getTimeDiff($postTime)
{
	$postTimeObj = new DateTime($postTime);
	$currentTime = new DateTime();

	$timeDiff = $postTimeObj->diff($currentTime);

	if ($timeDiff->y > 0) {
		return $timeDiff->y . ' year' . ($timeDiff->y > 1 ? 's' : '') . ' ago';
	} elseif ($timeDiff->m > 0) {
		return $timeDiff->m . ' month' . ($timeDiff->m > 1 ? 's' : '') . ' ago';
	} elseif ($timeDiff->d > 0) {
		return $timeDiff->d . ' day' . ($timeDiff->d > 1 ? 's' : '') . ' ago';
	} elseif ($timeDiff->h > 0) {
		return $timeDiff->h . ' hour' . ($timeDiff->h > 1 ? 's' : '') . ' ago';
	} elseif ($timeDiff->i > 0) {
		return $timeDiff->i . ' minute' . ($timeDiff->i > 1 ? 's' : '') . ' ago';
	} else {
		return 'Just now';
	}
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
	<link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css">
	<link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
	<script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body>

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
					<div class="col-md-9">


						<div class="row">
							<!-- User Bio -->
							<div class="col-xs-12 col-sm-12">

								<div class="with_border with_padding">
									<div class="media big-left-media">
										<div class="media-left">
											<?php displayPicture($picture); ?>
										</div>
										<div class="media-body">
											<h4><?php echo $firstname . ' ' . $lastname; ?>
												<small><?php echo $role; ?></small>
											</h4>
											<p>
												<?php echo $description; ?>
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
													<?php echo $sex; ?>
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
								<!-- Latest Posts -->
								<div class="with_border with_padding">
									<h4>
										Latest User Posts
									</h4>
									<div class="admin-scroll-panel scrollbar-macosx">
										<ul class="list1 no-bullets">
											<?php foreach ($posts as $post) : ?>
												<li class="item-editable">
													<div class="media">
														<div class="media-left">
															<?php displayPicture($userRecord['Picture']); ?>
														</div>
														<div class="media-body">
															<h5>
																<strong> <?php echo $firstname . ' ' . $lastname; ?></strong>
																<small><?php echo getTimeDiff($post['post_time']); ?></small>
															</h5>
															<div>
																<a href="blog-single-full.php?id=<?php echo $post['id_post']; ?>"><?php echo $post['post_title']; ?></a>
															</div>

														</div>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
									<!-- .admin-scroll-panel -->
									<div class="text-right greylinks panel-view-all">
										<a href="admin_posts.html">View All</a>
									</div>
								</div>
							</div>

							<!-- col-* -->
						</div>
						<!-- .row -->



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
													<?php echo $username; ?>
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
													<strong>+216 <?php echo $numero; ?> </strong>
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
													<?php echo $Region . ',' . $City . ',' . $Street; ?>
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

									<form method="post" action="../../controller/addAppointment.php">
										<div class="wrap-forms">
											<div class="row">
												<div class="col-xs-12">
													<h4>book an appointment</h4>
												</div>
											</div>
											<input type="text" name="doc_id" value="<?php echo $doc_id; ?>" class="hidden" id="">
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group has-placeholder">
														<label for="appointmentType">Type <sup>*</sup></label>

														<select id="appointmentType" name="type" class="custom-select">
															<option value="online">Online</option>
															<option value="inPerson">In Person</option>
														</select>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12">
													<div class="form-group has-placeholder">
														<label for="form-id-2">date
															<sup>*</sup>
														</label>

														<input type="datetime-local" name="date" id="appoint_date">
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