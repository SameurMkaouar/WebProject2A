<?php
session_start();
require('../../controller/reservation.php');
require('../../controller/event.php');

$event = new event();
$rsvC = new reservationC();
if (isset($_GET['id']))
	$idevent = $_GET['id'];
if (isset($_POST['idevent']) && isset($_POST['nbEvent']) && isset($_POST['nbrPlace']) && isset($_POST['paiement'])) {
	$rsv = new reservation($_POST['nbrPlace'], $_POST['idevent'], $_POST['paiement']);
	$nbr = $_POST['nbEvent'];
	$nbr -= $_POST['nbrPlace'];
	$rsvC->ajouterReservation($rsv);
	$rsvC->updateNbrPlace($_POST['idevent'], $nbr);
	header('Location: reservations.php');
}
$tab_event = $event->afficherevent($idevent);
?>

<!DOCTYPE html>
<html class="no-js">

<head>
	<title>Psychologist</title>
	<meta charset="utf-8">

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="stylesheet" href="..\..\assets\frontoffice\css\bootstrap.min.css">
	<link rel="stylesheet" href="..\..\assets\frontoffice\css\animations.css">
	<link rel="stylesheet" href="..\..\assets\frontoffice\css\fonts.css">
	<link rel="stylesheet" href="..\..\assets\frontoffice\css\mainsamer.css" class="color-switcher-link">
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>

	<style>
		.smaller-image {
			max-width: 100% !important;
			/* Ajoutez !important pour renforcer la priorité */
			height: auto;
		}


		.image-border {
			border: 2px solid #ffffff;
			/* Ajoute une bordure blanche de 2 pixels */
		}
	</style>



</head>

<body>
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

	<section class="page_breadcrumbs ds background_cover section_padding_50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2>Event Details</h2>
					<ol class="breadcrumb divided_content wide_divider">
						<li>
							<a href="./">
								Home
							</a>
						</li>
						<li>
							<a href="events.php">Events</a>
						</li>

					</ol>
				</div>
			</div>
		</div>



	</section>

	<section class="ls section_padding_top_100 section_padding_bottom_100 columns_padding_25">
		<div class="container">
			<div class="row">

				<div class="col-sm-10 col-sm-push-1">

					<div class="vertical-item content-padding with_shadow">

						<div class="item-media entry-thumbnail">
							<div id="event-list">
								<div class="event-card">


									<article class="vertical-item content-padding post format-standard with_shadow">
										<div class="item-media entry-thumbnail">
											<!-- Ajoutez la classe "smaller-image" et "image-border" à l'élément <img> pour réduire la taille et ajouter une bordure blanche -->
											<img class="smaller-image image-border" src="data:image/jpeg;base64,<?php echo base64_encode($tab_event['image']); ?>" alt="Event Image">
										</div>
										<div class="item-content entry-content">
											<header class="entry-header">
												<div class="entry-date small-text highlight">
													<time class="entry-date" datetime="<?php echo $tab_event['dateevent']; ?>">
														<?php echo $tab_event['dateevent']; ?>
													</time>
												</div>
												<h4 class="entry-title">
													<?php echo $tab_event['nomevent']; ?>
												</h4>
											</header>
											<p class="bottommargin_10 fontsize_18"><?php echo $tab_event['descriptionevent']; ?></p>
											<p class="entry-date small-text highlight">Available spots : <?php echo $tab_event['nbevent']; ?></p>
										</div>
									</article>



									<div class="item-content">
										<div class="entry-content">
											<header class="entry-header">
												<div class="entry-meta item-meta small-text content-justify">
													<span class="greylinks">

														<!-- .entry-content -->
												</div>
												<!-- .item-content -->


												<div class="comment-respond" id="respond">
													<form class="comment-form" id="ajouterRsv" method="post" action="event-single.php">
														<div class="row columns_margin_bottom_40">
															<div class="col-md-6">
																<p class="comment-form-author">
																	<label for="nbrPlace">Available spots</label>
																	<input type="text" size="30" name="nbrPlace" id="nbrPlace" class="form-control" placeholder="Select spots">
																	<span id="errorNB"></span>
																</p>
															</div>
															<input type="text" name="userid" id="userid" value="<?php echo $_SESSION['user_id']; ?>" hidden>
															<input type="text" name="idevent" id="idevent" value="<?php echo $tab_event['idevent']; ?>" hidden>
															<input type="text" name="nbEvent" id="nbEvent" value="<?php echo $tab_event['nbevent']; ?>" hidden>
															<input type="date" name="date_event" id="date_event" value="<?php echo $tab_event['dateevent']; ?>" hidden>

															<div class="col-md-6">
																<p class="comment-form-email">
																	<select name="paiement">
																		<option value="Paiement en espèces">Cash payment</option>
																		<option value="Paiement en ligne">Online payment</option>
																	</select>
																</p>
															</div>
														</div>
														<span id="prixTotal"></span>
														<p class="form-submit text-center topmargin_20">
															<button type="submit" id="submit" name="submit" class="theme_button color2">Register</button>
														</p>
													</form>
													<script>
														let form = document.getElementById("ajouterRsv");
														let nbEvent = document.getElementById("nbEvent");
														let nbPlace = document.getElementById("nbrPlace");
														let dateEvent = document.getElementById("date_event");
														let userid = document.getElementById("userid");
														let date = new Date();

														form.addEventListener('submit', function(e) {
															if (parseInt(nbPlace.value, 10) > parseInt(nbEvent.value, 10)) {
																let error = document.getElementById("errorNB");
																error.innerHTML = "Not enough spots."
																error.style.color = "red";
																e.preventDefault();
															}
															if (nbPlace.value == "") {
																let error = document.getElementById("errorNB");
																error.innerHTML = "Please specify the number of spots."
																error.style.color = "red";
																e.preventDefault();
															}
															if (new Date(dateEvent.value) < date) {
																alert("Event already ended!");
																e.preventDefault();
															}
														});
														let prixEvent = "<?php echo $tab_event['prix']; ?>"
														nbPlace.addEventListener('keyup', function(e) {
															let spanPrix = document.getElementById("prixTotal");
															if (nbPlace.value != "") {
																let prixTotal = prixEvent * parseInt(nbPlace.value, 10);
																spanPrix.innerHTML = "Price : " + prixTotal + " TND";
																spanPrix.style.color = "black";
															} else {
																spanPrix.innerHTML = "";
															}
														});
													</script>
												</div>
										</div>
	</section>

	<?php include_once('footerfront.php'); ?>

	<section class="cs main_color2 page_copyright section_padding_15">
		<div class="container with_top_border">
			<div class="row">
				<div class="col-sm-12 text-center">
				</div>
			</div>
		</div>
	</section>

	</div>
	<!-- eof #box_wrapper -->
	</div>
</body>

</html>