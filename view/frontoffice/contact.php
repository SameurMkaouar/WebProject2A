<?php
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";

$user = new user();
$userInfo = $user->retrieveInformation($_SESSION['user_id']);
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
    <link rel="stylesheet" href="../../assets/frontoffice/css/mainsamer.css" class="color-switcher-link">
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


            <section class="page_breadcrumbs ds background_cover section_padding_50">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2>Ticket</h2>
                            <ol class="breadcrumb divided_content wide_divider">
                                <li>
                                    <a href="./">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Pages</a>
                                </li>
                                <li class="active">Contacts</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>


            <section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
                <div class="container">
                    <div class="row">

                        <div class="col-md-8 to_animate" data-animation="scaleAppear">

                            <h2 class="section_header small bottommargin_40">Create a ticket</h2>

                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            <style>
                                .error-message {
                                    color: #91d0cc;
                                }
                            </style>
                            </head>

                            <body>

                                <form class="contact-form row columns_margin_bottom_40" method="post" action="../../controller/ticket_create.php" id="contactForm">
                                    <div class="col-sm-6">
                                        <div class="contact-form-subject">
                                            <label for="subject">Subject <span class="required">*</span></label>
                                            <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject">
                                            <div id="subjectError" class="error-message"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="contact-form-message">
                                            <label for="message">Message</label>
                                            <textarea aria-required="true" rows="1" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
                                            <div id="messageError" class="error-message"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="contact-form-submit topmargin_20">
                                            <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color1 with_shadow">Send Message</button>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                    $(document).ready(function() {
                                        function validateName() {
                                            var name = $("#name").val();
                                            if (!/^[a-zA-Z ]{3,}$/.test(name)) {
                                                $("#nameError").text("Please enter a valid name (at least 3 characters, no numbers or symbols).");
                                                $("#nameError").addClass("contact-form-respond highlight");
                                                $("#name").css("border-color", "#e74c3c");
                                                return false;
                                            } else {
                                                $("#nameError").text("");
                                                $("#nameError").removeClass("contact-form-respond highlight");
                                                $("#name").css("border-color", "");
                                                return true;
                                            }
                                        }

                                        function validateSubject() {
                                            var subject = $("#subject").val();
                                            if (!/^[a-zA-Z ]{3,}$/.test(subject)) {
                                                $("#subjectError").text("Please enter a valid subject (at least 3 characters, no numbers or symbols).");
                                                $("#subjectError").addClass("contact-form-respond highlight");
                                                $("#subject").css("border-color", "#e74c3c");
                                                return false;
                                            } else {
                                                $("#subjectError").text("");
                                                $("#subjectError").removeClass("contact-form-respond highlight");
                                                $("#subject").css("border-color", "");
                                                return true;
                                            }
                                        }

                                        function validateMessage() {
                                            var message = $("#message").val();
                                            if (message.length < 10) {
                                                $("#messageError").text("Message should have at least 10 characters.");
                                                $("#messageError").addClass("contact-form-respond highlight");
                                                $("#message").css("border-color", "#e74c3c");
                                                return false;
                                            } else {
                                                $("#messageError").text("");
                                                $("#messageError").removeClass("contact-form-respond highlight");
                                                $("#message").css("border-color", "");
                                                return true;
                                            }
                                        }

                                        $("#contactForm").submit(function(event) {
                                            if (!validateName() || !validateSubject() || !validateMessage()) {
                                                event.preventDefault();
                                            }
                                        });

                                        $("#name").on("input", validateName);
                                        $("#subject").on("input", validateSubject);
                                        $("#message").on("input", validateMessage);
                                    });
                                </script>

                                <!-- <div id="jitsi-container"></div>
                                <script>
                                    const domain = 'meet.jit.si';
                                    const options = {
                                        roomName: 'company-meetinga', // Choose a unique room name
                                        width: '100%',
                                        height: 600,
                                    };

                                    const api = new JitsiMeetExternalAPI(domain, options);
                                </script> -->







                        </div>
                        <!--.col-* -->

                        <div class="col-md-4 to_animate" data-animation="scaleAppear">

                            <h2 class="section_header small bottommargin_40">Contact Form</h2>

                            <div class="small-teaser media fontsize_16">
                                <div class="media-left">
                                    <i class="highlight fa fa-phone"></i>
                                </div>
                                <div class="media-body">
                                    +216 29 186 048
                                </div>
                            </div>

                            <div class="small-teaser media fontsize_16">
                                <div class="media-left">
                                    <i class="highlight fa fa-map-marker"></i>
                                </div>
                                <div class="media-body">
                                    Av. Fethi Zouhir, Cebalat Ben Ammar 2083
                                </div>
                            </div>

                            <div class="small-teaser media fontsize_16">
                                <div class="media-left">
                                    <i class="highlight fa fa-envelope-o"></i>
                                </div>
                                <div class="media-body">
                                    support@psychologist.com
                                </div>
                            </div>
                        </div>
                        <!--.col-* -->
                    </div>
                    <!--.row salut ici?-->

                </div>

                <!--.container -->

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

</body>

</html>