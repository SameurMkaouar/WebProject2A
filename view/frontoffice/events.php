<?php

session_start();
include_once "header.php";
require('../../controller/event.php');
$user = new event();
if (isset($_POST["sub"])) {
    $_SESSION["idevent"] = $_POST["sub"];
    header("Location: event-single.php");
    exit();
}
// pagination
$per_page_record = 4;  // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
/////////LIMIT
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sqlSearch = "SELECT * FROM event WHERE idevent = '$search' OR nomevent = '$search' LIMIT $start_from, $per_page_record";
} else
    $sqlSearch = "SELECT * FROM event LIMIT $start_from, $per_page_record";
$query = $user->paginationLIMIT($sqlSearch);
////////////COUNTER
$sql = "SELECT COUNT(*) FROM event";
$total_recordse = $user->paginationCOUNTER($sql);
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

    <link rel="stylesheet" href="..\..\assets\frontoffice\css\bootstrap.min.css">
    <link rel="stylesheet" href="..\..\assets\frontoffice\css\animations.css">
    <link rel="stylesheet" href="..\..\assets\frontoffice\css\fonts.css">
    <link rel="stylesheet" href="..\..\assets\frontoffice\css\mainsamer.css" class="color-switcher-link">
    <link rel="stylesheet" href="..\..\assets\frontoffice\css\eventSearch.css">
    <link href="css/tooplate-kool-form-pack.css" rel="stylesheet">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="../../assets/frontoffice/js/map.js"></script>
    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Inclure le fichier JavaScript externe -->
    <script src="../../assets/frontoffice/js/favoris.js"></script>

</head>

<body>

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
            <section class="page_breadcrumbs ds background_cover section_padding_50">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2>List of Reservations</h2>
                            <ol class="breadcrumb divided_content wide_divider">
                                <li>
                                    <a href="homepage.php">
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="events.php">Events</a>
                                </li>
                                <li><a href="reservations.php">My Reservations</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ls section_padding_top_100 section_padding_bottom_100 columns_padding_25">
                <div class="container">
                    <div class="row">
                        <style>
                            .pagination {
                                padding-left: 40%;
                                margin-top: 20px;
                            }

                            .pagination a {
                                color: #fff;
                                background-color: #333;
                                padding: 8px 12px;
                                text-decoration: none;
                                border-radius: 4px;
                                margin: 0 4px;
                            }

                            .pagination a.active {
                                background-color: #fff;
                                color: #333;
                            }

                            .grayscale-image {
                                filter: grayscale(100%);
                            }

                            .complet-stamp {
                                background-color: black;
                                color: white;
                                font-weight: bold;
                                padding: 5px;
                                border-radius: 5px;
                                position: absolute;
                                top: 10px;
                                right: 10px;
                            }


                            .favorite-icon {
                                /* Styles de l'icône du cœur par défaut */
                                color: black;
                                /* Couleur noire par défaut */
                                /* Autres styles... */
                            }

                            .favorite-icon.favorited {
                                /* Styles de l'icône du cœur lorsqu'elle est favoris (rouge) */
                                color: red;
                                /* Autres styles... */
                            }
                        </style>
                        <div class="col-sm-10 col-sm-push-1">
                            <div class="" style="float: right;">
                                <form action="events.php" method="post">
                                    <input type="text" class="input" id="recherche_event" name="search" placeholder="Search" oninput="searchFun()">
                                    <i class="ri-search-2-line"></i>
                                </form>
                            </div>
                            <button id="mes-favoris-btn" class="theme_button color2">
                                <i class="glyphicon glyphicon-heart"></i> Favourites
                            </button>
                            <section id="favorites-section" style="display: none;">
                                <div id="favorites-list"></div>
                            </section>
                            <br>
                            <style>
                                .event-container {
                                    position: relative;
                                    display: inline-block;
                                }

                                .event-image {
                                    min-height: 340px;
                                    width: 100%;
                                    object-fit: cover;
                                }

                                .date-box {
                                    position: absolute;
                                    top: 50%;
                                    left: 0;
                                    transform: translateY(-50%);
                                    color: white;
                                    background-color: rgba(145, 208, 204, 1);
                                    padding: 10px;
                                    border-radius: 0 8px 8px 0;
                                    z-index: 2;
                                    /* Set a higher z-index for the date box */
                                }

                                .date-box p {
                                    margin-bottom: 0;
                                    /* Remove default margin for better alignment */
                                }

                                .grayscale-image {
                                    /* Add any additional styles for grayscale images if needed */
                                }
                            </style>
                            <?php foreach ($query as $even) { ?>
                                <article class="post side-item content-padding with_shadow" data-event-id="<?php echo $even['idevent']; ?>">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="item-media">
                                                <?php
                                                $imageBase64 = base64_encode($even["image"]);
                                                $imageSrc = "data:image/jpeg;base64,$imageBase64";
                                                $isComplete = $even['nbevent'] == 0;
                                                $imageClass = $isComplete ? 'grayscale-image' : '';
                                                $formattedDate = date('d M Y', strtotime($even["dateevent"]));
                                                list($day, $month, $year) = explode(' ', $formattedDate);
                                                ?>

                                                <div class="event-container">
                                                    <img src="<?php echo $imageSrc; ?>" alt="Event Image" class="mx-auto event-image <?php echo $imageClass; ?>">
                                                    <div class="date-box">
                                                        <p><?php echo $day . ' ' . $month; ?><br>&nbsp;<?php echo $year; ?></p>
                                                    </div>
                                                </div>
                                                <div class="media-links">
                                                    <?php if ($isComplete) { ?>
                                                        <div class="complet-stamp">Complet !</div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="item-content">
                                                <div class="item-header">
                                                    <h2>
                                                        <?php echo $even["nomevent"]; ?>
                                                    </h2>
                                                    <div class="favorite-icon-container">
                                                        <i class="fa fa-heart favorite-icon" data-event-id="<?php echo $even['idevent']; ?>"></i>
                                                    </div>
                                                </div>
                                                <p class="item-meta grey darklinks content-justify fontsize_16">
                                                    <span>
                                                        <i class="fa fa-calendar highlight"></i> <?php echo $even["dateevent"]; ?>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-map-marker highlight map-marker" data-location="<?php echo $even["location"]; ?>" style="cursor: pointer;"></i> <?php echo $even["location"]; ?>
                                                    </span>
                                                </p>
                                                <p>
                                                    <?php echo $even["descriptionevent"]; ?>
                                                </p>
                                                <?php if ($even['nbevent'] != 0) { ?>

                                                    <p style="font-size: 24px; padding-left: 372px;">
                                                        <strong> <?php echo $even["prix"]; ?> DT</strong>
                                                    </p>
                                                    <a class="theme_button color2" style="float: right; border-radius: 16px" href="event-single.php?id=<?php echo $even['idevent']; ?>">Register</a>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .item-header {
                                            display: flex;
                                            justify-content: space-between;
                                            align-items: flex-start;
                                        }

                                        .favorite-icon-container {
                                            margin-top: -10px;
                                            /* Adjust the margin-top as needed for vertical positioning */
                                            margin-right: 10px;
                                            /* Adjust the margin-right as needed for horizontal positioning */
                                        }
                                    </style>



                                </article>
                            <?php } ?>
                            <div class="pagination" style="padding-left:40%;">
                                <?php
                                $total_records = $user->paginationCOUNTER($sql);

                                echo "</br>";
                                // Number of pages required.   
                                $total_pages = ceil($total_records / $per_page_record);
                                $pagLink = "";

                                if ($page >= 2) {
                                    echo "<a href='events.php?page=" . ($page - 1) . "'>  Prev </a>";
                                }

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $page) {
                                        $pagLink .= "<a class = 'active' href='events.php?page="
                                            . $i . "'>" . $i . " </a>";
                                    } else {
                                        $pagLink .= "<a href='events.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                                    }
                                };
                                echo $pagLink;

                                if ($page < $total_pages) {
                                    echo "<a href='events.php?page=" . ($page + 1) . "'>  Next </a>";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ... votre contenu existant ... -->




            <div id="canvas">
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

            <!-- Add your script includes here -->
            <script src="../../assets/frontoffice/js/compressed.js"></script>
            <script src="../../assets/frontoffice/js/main.js"></script>

            <body>

</html>