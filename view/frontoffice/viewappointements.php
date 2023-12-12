<?php
session_start();
require_once "../../model/user.php";
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

    <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
    <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css">
    <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

    <!--[if lt IE 9]>
    <script src="../../assets/frontoffice/js/vendor/html5shiv.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/respond.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
    <STYLE>
    .row {
        display: flex;
        justify-content: center;
    }
    </STYLE>

    <script src="https://meet.jit.si/external_api.js"></script>
</head>

<body>
    <!--[if lt IE 9]>
<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
<![endif]-->

    <div class="row ">

        <div class=" col-xs-12 col-md-8">
            <h3 class="module-title darkgrey_bg_color"><i class="rt-icon2-time"></i>My
                Schedule
            </h3>
            <div class="events_calendar"></div>
            <!-- Calendar -->
            <div class="col-xs-12 col-md-6 dashboard-map">
                <div id="calendar"></div>
            </div>

        </div> <!-- .col-* -->
    </div>





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
    <script src="../../assets/frontoffice/js/admin_copy.js"></script>
</body>

</html>