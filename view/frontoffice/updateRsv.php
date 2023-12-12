<?php
require('../../controller/event.php');
require('../../controller/reservation.php');
$event = new event();
$rsvC = new reservationC();
if (isset($_POST['idevent']) && isset($_POST['nbEvent']) && isset($_POST['oldPlace']) && isset($_POST['id_rsv']) && isset($_POST['nbrPlace']) && isset($_POST['paiement'])) {
	$oldNbr = $_POST['oldPlace'];
	$nbr = $_POST['nbEvent'];
	$nbrRes = $_POST['nbrPlace'];
	if ($oldNbr > $nbrRes) {
		$diff = $oldNbr - $nbrRes;
		$nbr += $diff;
	} else if ($oldNbr < $nbrRes) {
		$diff = $nbrRes - $oldNbr;
		$nbr -= $diff;
	}
	$rsv = new reservation($_POST['nbrPlace'], $_POST['idevent'], $_POST['paiement']);
	$rsvC->modifierReservation($_POST['id_rsv'], $rsv);
	$rsvC->updateNbrPlace($_POST['idevent'], $nbr);
	header('Location: reservations.php');
}
$rsv = $rsvC->recupererReservation($_GET['id']);
$tab_event = $event->afficherevent($rsv["idevent"]);
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
	<link rel="stylesheet" href="..\..\assets\frontoffice\css\main.css" class="color-switcher-link">
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>


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
					<h2>Event Fullwidth</h2>
					<ol class="breadcrumb divided_content wide_divider">
						<li>
							<a href="./">
								Home
							</a>
						</li>
						<li>
							<a href="#">Events</a>
						</li>
						<li class="active">Event Fullwidth</li>
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
									<div class="item-media entry-thumbnail">
										<img src="data:image/jpeg;base64,<?php echo base64_encode($tab_event['image']); ?>" alt="Event Image">
										<div class="event-info">
											<h3> <?php echo $tab_event['nomevent']; ?></h3>
											<p><?php echo $tab_event['descriptionevent']; ?></p>
											<p>Nombre de place : <?php echo $tab_event['nbevent']; ?></p>
											<p>Prix : <?php echo $tab_event['prix']; ?></p>
											<p>Date : <?php echo $tab_event['dateevent']; ?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="item-content">
								<div class="entry-content">
									<header class="entry-header">
										<div class="entry-meta item-meta small-text content-justify">
											<span class="greylinks">

												<!-- .entry-content -->
										</div>
										<!-- .item-content -->


										<div class="comment-respond" id="respond">
											<form class="comment-form" method="post" action="updateRsv.php" id="updateRsvForm">
												<div class="row columns_margin_bottom_40">
													<div class="col-md-6">
														<p class="comment-form-author">
															<label for="nbrPlace">Nombre de place</label>
															<input type="text" value="<?php echo $rsv["nbplace"]; ?>" size="30" name="nbrPlace" id="nbrPlace" class="form-control" placeholder="Nbr Place">
															<span id="errorNB"></span>
														</p>
													</div>
													<div class="col-md-6">
														<p class="comment-form-email">
															<select name="paiement">
																<option value="Paiement en espèces" <?php if ($rsv['paiement'] == 'Paiement en espèces') echo 'selected'; ?>>Paiement en espèces</option>
																<option value="Paiement en ligne" <?php if ($rsv['paiement'] == 'Paiement en ligne') echo 'selected'; ?>>Paiement en ligne</option>
															</select>
														</p>
													</div>
												</div>
												<span id="prixTotal"></span>
												<input type="number" name="id_rsv" value="<?php echo $rsv['idreservation']; ?>" hidden>
												<input type="text" name="idevent" id="idevent" value="<?php echo $tab_event['idevent']; ?>" hidden>
												<input type="text" name="nbEvent" id="nbEvent" value="<?php echo $tab_event['nbevent']; ?>" hidden>
												<input type="date" name="date_event" id="date_event" value="<?php echo $tab_event['dateevent']; ?>" hidden>
												<input type="number" name="oldPlace" value="<?php echo $rsv['nbplace']; ?>" hidden>
												<p class="form-submit text-center topmargin_20">
													<button type="submit" class="theme_button color1 with shadow">Modifier</button>
												</p>
											</form>
											<script>
												let form = document.getElementById("updateRsvForm");
												let nbEvent = document.getElementById("nbEvent");
												let nbPlace = document.getElementById("nbrPlace");
												let dateEvent = document.getElementById("date_event");
												let date = new Date();

												form.addEventListener('submit', function(e) {
													if (parseInt(nbPlace.value, 10) > parseInt(nbEvent.value, 10)) {
														let error = document.getElementById("errorNB");
														error.innerHTML = "Nombre de place insuffisant."
														error.style.color = "red";
														e.preventDefault();
													}
													if (nbPlace.value == "") {
														let error = document.getElementById("errorNB");
														error.innerHTML = "Nombre de place est obligatoire."
														error.style.color = "red";
														e.preventDefault();
													}
													if (new Date(dateEvent.value) < date) {
														alert("Evenement date déjà passée !");
														e.preventDefault();
													}
												});
												let spanPrix = document.getElementById("prixTotal");
												let prixEvent = "<?php echo $tab_event['prix']; ?>";
												let prixTotal = prixEvent * parseInt(nbPlace.value, 10);
												spanPrix.innerHTML = "Prix à payer : " + prixTotal + " TND";
												spanPrix.style.color = "black";
												nbPlace.addEventListener('keyup', function(e) {
													if (nbPlace.value != "") {
														prixTotal = prixEvent * parseInt(nbPlace.value, 10);
														spanPrix.innerHTML = "Prix à payer : " + prixTotal + " TND";
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
	<script>
		document.getElementById("commentform").addEventListener("submit", function(event) {
			var nameInput = document.getElementById("author");
			var firstNameInput = document.getElementById("comment_email");
			var emailInput = document.getElementById("comment_email");
			var phoneInput = document.getElementById("comment_phone");
			var dobInput = document.getElementById("comment_dob");

			var errorMessage = "";

			if (nameInput.value.trim() === "") {
				errorMessage += "Le champ Nom ne peut pas être vide.\n";
			}

			if (firstNameInput.value.trim() === "") {
				errorMessage += "Le champ Prénom ne peut pas être vide.\n";
			}

			if (emailInput.value.trim() === "") {
				errorMessage += "Le champ Email ne peut pas être vide.\n";
			}

			if (phoneInput.value.trim() === "") {
				errorMessage += "Le champ Numéro de téléphone ne peut pas être vide.\n";
			} else if (!/^\d{8}$/.test(phoneInput.value.trim())) {
				errorMessage += "Le numéro de téléphone doit contenir exactement 8 chiffres.\n";
			}

			if (dobInput.value.trim() === "") {
				errorMessage += "Le champ Date de naissance ne peut pas être vide.\n";
			} else {
				var dobDate = new Date(dobInput.value);
				var today = new Date();
				var age = today.getFullYear() - dobDate.getFullYear();
				if (age < 18) {
					errorMessage += "Vous devez avoir au moins 18 ans pour vous inscrire.\n";
				}
			}

			if (errorMessage) {
				event.preventDefault();
				alert(errorMessage);
			}
		});
	</script>
</body>

</html>