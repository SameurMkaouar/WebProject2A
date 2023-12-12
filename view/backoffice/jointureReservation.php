<?php
session_start();
if (!isset($_SESSION["user_id"])){
    header("Location:../frontoffice/login.php");

}
require_once "../../model/user.php";
include_once "adminHeader.php";

include_once '../../config.php';
 $pdo = config::getConnexion();
 $query=$pdo->query("SELECT * FROM reservation");
 $reservations=$query->fetchAll(PDO::FETCH_ASSOC);

 $query2=$pdo->query("SELECT * FROM users");
 $users=$query2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html class="no-js">
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
    <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css" class="color-switcher-link">
    <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
    <script src="../../assets/frontoffice/js/vendor/html5shiv.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/respond.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body class="admin">
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

	<!-- Unyson messages modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="admin_contact_modal">
		<!-- <div class="ls with_padding"> -->
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<form class="with_padding contact-form" method="post" action="/">
					<div class="row">
						<div class="col-sm-12">
							<h3>Contact Admin</h3>
							<div class="contact-form-name">
								<label for="name">Full Name
									<span class="required">*</span>
								</label>
								<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="contact-form-subject">
								<label for="subject">Subject
									<span class="required">*</span>
								</label>
								<input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject">
							</div>
						</div>

						<div class="col-sm-12">

							<div class="contact-form-message">
								<label for="message">Message</label>
								<textarea aria-required="true" rows="6" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
							</div>
						</div>

						<div class="col-sm-12 text-center">
							<div class="contact-form-submit">
								<button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button wide_button color1">Send Message</button>
								<button type="reset" id="contact_form_reset" name="contact_reset" class="theme_button wide_button">Clear Form</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- eof .modal -->

	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->

			<section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
				<div class="container-fluid">

					<div class="row">
						<div class="col-sm-12">
							<h3> Réservation :
								<small>Event #<?php echo $_GET['id']; ?></small>
							</h3>
						</div>
					</div>
					<!-- .row -->
<?php
require('../../controller/reservation.php');

$resC = new reservationC();
$list = $resC->jointureReservation($_GET['id']);
echo $_GET['id']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Images</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            font-size: 20px;
        }

        .card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .card__content {
            flex: 1;
        }

        .card__content p {
            margin: 8px 0;
        }

        .card__content button {
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
foreach ($list as $reservation) {
?>
<form method="POST">
    <div class="card">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($reservation["image"]); ?>" alt="Event Image">
        <div class="card__content">
            <p class="card__title">ID Event : <?php echo $reservation["idevent"]; ?></p>
            <p class="card__description">Date : <?php echo $reservation["dateevent"]; ?></p>
            <p class="card__description">ID Réservation : <?php echo $reservation["idreservation"]; ?></p>
            <p class="card__description">Nombre Place : <?php echo $reservation["nbplace"]; ?></p>
            <p class="card__description">Mode de paiement : <?php echo $reservation["paiement"]; ?></p>
            <p class="card__description">Username : <?php
                foreach($users as $user)
                {
                    if ($user['Id'] == $reservation['Id'])
                    {
                        echo $user['Username'];
                        break;
                    }
                }
                ?></p>
        </div>
    </div>
</form>
<?php
}
?>



</body>
</html>


					<div class="row">
						<div class="col-xs-12 col-md-6">

							
			
	<!-- chat -->
	<div class="side-dropdown side-chat dropdown">
		<a class="side-button side-chat-button" id="chat-dropdown" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-comments-o"></i>
		</a>

		<ul class="dropdown-menu list-unstyled" aria-labelledby="chat-dropdown">
			<li class="dropdown-title darkgrey_bg_color">
				<h4>
					Small Chat
					<span class="pull-right">14.03.2017</span>
				</h4>
			</li>
			<li>

				<ul class="list-unstyled">
					<li class="side-chat-item item-secondary">
						<h5>
							Michael Anderson
							<time class="pull-right small-chat-date" datetime="2017-03-13T08:50:40+00:00">
								08:50
							</time>
						</h5>
						<div class="danger_bg_color">
							Duis autem veum iriure dolor in hendrerit
						</div>
					</li>
					<li class="side-chat-item item-primary">
						<h5>
							Jane Walker
							<time class="pull-right small-chat-date" datetime="2017-03-13T08:50:40+00:00">
								08:52
							</time>
						</h5>
						<div class="warning_bg_color">
							Vulputate vese molestie consequatl illum
						</div>
					</li>
					<li class="side-chat-item item-secondary">
						<h5>
							Michael Anderson
							<time class="pull-right small-chat-date" datetime="2017-03-13T08:50:40+00:00">
								08:50
							</time>
						</h5>
						<div class="danger_bg_color">
							Duis autem veum iriure dolor in hendrerit
						</div>
					</li>
				</ul>
			</li>

			<li role="separator" class="divider"></li>

			<li>
				<div class="side-chat-answer">
					<form class="form-inline button-on-input">
						<div class="form-group">
							<label for="side-chat-message" class="sr-only">Message</label>
							<input type="text" class="form-control" id="side-chat-message" placeholder="Message">
						</div>
						<button type="submit" class="btn btn-danger">
							<i class="fa fa-paper-plane-o"></i>
						</button>
					</form>
				</div>
			</li>
		</ul>
	</div>
	<!-- .chat-dropdown -->


	<a class="side-button side-contact-button" data-target="#admin_contact_modal" href="#admin_contact_modal" data-toggle="modal" role="button">
		<i class="fa fa-envelope"></i>
	</a>


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

</html>