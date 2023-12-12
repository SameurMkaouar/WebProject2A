<?php
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";
$user = new user;
$result = $user->listDoctors();
?>

<!doctype html>
<html>

<head>
    <style>
        .logo {
            text-decoration: none;
        }
    </style>
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


    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - GoSNippets</title>
    <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../../assets/frontoffice/doctors.css">
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <style>
        .lnk {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<section class="page_breadcrumbs ds background_cover section_padding_50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><strong>List of Doctors</strong></h2>

            </div>
        </div>
    </div>
</section>
<section class="ls section_padding_top_130 section_padding_bottom_130">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php foreach ($result as $row) { ?>
                    <a href="doctorProfile.php?id=<?php echo $row["Id"]; ?>">
                        <div class="isotope-item col-lg-4 col-md-6 col-sm-12 category3">
                            <div class="vertical-item content-padding with_shadow text-center">
                                <div class="item-media"><?php displayProfilePicture($row['Picture']); ?></div>
                                <div class="item-content">

                                    <h4 class="bottommargin_5"><strong><?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?></strong></h4>

                                    <p class="small-text highlight"><?php echo $row['Role']; ?></p>
                                    <div class="ratings mt-2">
                                        <?php
                                        $randomStars = rand(3, 5);
                                        for ($i = 0; $i < $randomStars; $i++) {
                                            echo '<i class="fa fa-star"></i> ';
                                        }
                                        ?>
                                    </div>

                                    <hr class="divider_30_1">
                                    <div class="">
                                        <button class="theme_button color1">Book Appointment</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>

            </div>
        </div>
    </div>
    <script type='text/javascript'></script>
</section>

<script src="../../assets/frontoffice/js/compressed.js"></script>
<script src="../../assets/frontoffice/js/main.js"></script>

</html>