<?php
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once"header.php";
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
    <script src="../../assets/frontoffice/js/vendor/html5shiv.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/respond.min.js"></script>
    <script src="../../assets/frontoffice/js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->


    <script src="https://meet.jit.si/external_api.js"></script>
</head>

<body>
    <!--[if lt IE 9]>
<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
<![endif]-->

    <div class="preloader">
        <div class="preloader_image"></div>
    </div>



    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">
            <div id="jitsi-container"></div>
            <script>
            const domain = 'meet.jit.si';
            const options = {
                roomName: 'company-meetinga', // Choose a unique room name
                width: '100%',
                height: 600,
            };

            const api = new JitsiMeetExternalAPI(domain, options);
            </script>



            <!-- Footer Section -->


        </div>
        <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->

    <footer class="page_footer cs main_color2 table_section section_padding_50 columns_padding_0">
        <div class="container">

            <div class="row">

                <div class="col-sm-4 col-sm-push-4 text-center">
                    <a href="./" class="logo big text-shadow">
                        Psychologist
                        <span class="small-text">Premium HTML Template</span>
                    </a>
                </div>

                <div class="col-sm-4 col-sm-pull-4 text-center text-sm-left text-md-left">
                    <div class="widget widget_nav_menu greylinks">

                        <ul class="menu divided_content wide_divider">
                            <li class="">
                                <a href="./">Home</a>
                            </li>
                            <li class="">
                                <a href="about.html">About</a>
                            </li>
                            <li class="">
                                <a href="services.html">Services</a>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-sm-4 text-center text-sm-right text-md-right">
                    <div class="widget widget_nav_menu greylinks">

                        <ul class="menu divided_content wide_divider">
                            <li class="">
                                <a href="gallery-regular-3-cols.html">Gallery</a>
                            </li>
                            <li class="">
                                <a href="blog-right.html">Blog</a>
                            </li>
                            <li class="">
                                <a href="contact.html">Contacts</a>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </footer>

    <section class="cs main_color2 page_copyright section_padding_15">
        <div class="container with_top_border">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="small-text">&copy; 2017 Psychology and Counseling. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </section>

    <script src="../../assets/frontoffice/js/compressed.js"></script>
    <script src="../../assets/frontoffice/js/main.js"></script>

</body>

</html>