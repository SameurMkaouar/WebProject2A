<?php
session_start();
require_once('../../controller/reservation.php');
require_once('../../controller/event.php');

include_once "header.php";
$rsvC = new reservationC();
$eventC = new event();
$list = $rsvC->afficherReservation();
//$reservations=$rsvC->userReservation($_SESSION["user_id"]);


$pdo = config::getConnexion();


$query = $pdo->query("SELECT * FROM reservation");
$reservations = $query->fetchAll(PDO::FETCH_ASSOC);

$query1 = $pdo->query("SELECT * FROM users");
$users = $query1->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../../assets/frontoffice/css/fontssa.css">
    <link rel="stylesheet" href="../../assets/frontoffice/css/mainsamer.css" class="color-switcher-link">
    <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css" class="color-switcher-link">
    <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>



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

        </div>
    </div>

    <div id="canvas">
        <div id="box_wrapper">

            <!-- template sections -->





            <section class="page_breadcrumbs ds background_cover section_padding_50">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2>Reservations list</h2>
                            <ol class="breadcrumb divided_content wide_divider">
                                <li>
                                    <a href="./">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="events.php">Events</a>
                                </li>
                                <li class="active"><a href="reservations.php">Réservations</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ls section_padding_top_100 section_padding_bottom_100 columns_padding_25">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-10 col-sm-push-1">
                            <?php foreach ($reservations as $r) {
                                if ($_SESSION['user_id'] == $r['Id']) {
                                    $e = $eventC->afficherevent($r['idevent']);


                            ?>

                                    <article class="post side-item content-padding with_shadow">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="item-media">
                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($e["image"]); ?>" alt="Event Image" class="mx-auto">
                                                    <div class="media-links">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="item-content">
                                                    <h3>
                                                        <a href="event-single-full.html"><?php echo $e["nomevent"]; ?></a>
                                                    </h3>
                                                    <h6>
                                                        <?php echo $r["idreservation"]; ?>
                                                    </h6>
                                                    <h6>
                                                        <?php echo $r["paiement"]; ?>
                                                    </h6>
                                                    <h6>
                                                        NBR Place : <?php echo $r["nbplace"]; ?>
                                                    </h6>
                                                    <p>
                                                        #Event : <?php echo $r["idevent"]; ?>
                                                    </p>
                                                </div>
                                                <a style="margin-top:-20px;margin-left: 20px;" href="updateRsv.php?id=<?php echo $r['idreservation']; ?>">Update</a>
                                                <a style="margin-top:-20px;margin-left: 20px;" href="deleteRsv.php?id=<?php echo $r['idreservation']; ?>&nbEvent=<?php echo $e['nbevent']; ?>">Delete</a>
                                            </div>

                                        </div>
                                    </article>
                            <?php }
                            } ?>


                        </div>

                    </div>
                </div>
            </section>

            <!-- ... votre contenu existant ... -->




            <<div id="canvas">
                <div id="box_wrapper">



                    <section class="page_content">
                        <div class="container">


                            <!-- Main content -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Add your main content here -->
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

        <body>

</html>