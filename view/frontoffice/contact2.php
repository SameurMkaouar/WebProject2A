<?php
include_once '../../config.php';
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";

$user = new user();
$userInfo = $user->retrieveInformation($_SESSION['user_id']);
$pdo = config::getConnexion();
if ($pdo) {
    $query = $pdo->query("SELECT * FROM ticket ORDER BY date DESC");
    $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $pdo->query("SELECT * FROM reponse ");
    $reponses = $query->fetchAll(PDO::FETCH_ASSOC);

    $qurey = $pdo->query("SELECT * FROM users");
    $users = $qurey->fetchAll(PDO::FETCH_ASSOC);

    // Calculate average reply time prediction
    $replytimeprediction = 0;
    $ticketCountWithReplies = 0; // Counter for tickets with at least one reply

    foreach ($tickets as $ticket) {
        $hasFirstReply = false; // Flag to check if the first reply is found for the current ticket

        foreach ($reponses as $reponse) {
            if ($ticket['ticketid'] == $reponse['ticketid'] && !$hasFirstReply) {
                $replytimeprediction += (strtotime($reponse['reponsedate']) - strtotime($ticket['date']));
                $hasFirstReply = true;
                $ticketCountWithReplies++;
            }
        }
    }

    // Check if there are responses before calculating average
    if ($ticketCountWithReplies > 0) {
        $replytimeprediction = $replytimeprediction / $ticketCountWithReplies;

        // Convert reply time to days, hours, and minutes
        $replytimepredictionDays = floor($replytimeprediction / (24 * 3600));
        $replytimepredictionHours = floor(($replytimeprediction % (24 * 3600)) / 3600);
        $replytimepredictionMinutes = round(($replytimeprediction % 3600) / 60);

        // Build the output message
        $outputMessage = "Average Reply Time Prediction: ";

        if ($replytimepredictionDays > 1) {
            $outputMessage .= "{$replytimepredictionDays} days, ";
        } elseif ($replytimepredictionDays == 1) {
            $outputMessage .= "{$replytimepredictionDays} day, ";
        }

        $outputMessage .= "{$replytimepredictionHours} hours, and {$replytimepredictionMinutes} minutes";
    } else {
        // Handle case where there are no responses
        $outputMessage = "No replies available to calculate average reply time prediction.";
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
        <link rel="stylesheet" href="../../assets/frontoffice/css/mainsamer.css" class="color-switcher-link">
        <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

        <!--[if lt IE 9]>
        <script src="../../assets/frontoffice/js/vendor/html5shiv.min.js"></script>
        <script src="../../assets/frontoffice/js/vendor/respond.min.js"></script>
        <script src=../../assets/frontoffice/"js/vendor/jquery-1.12.4.min.js"></script>
        <![endif]-->

    </head>
    <style>
        .feedback {
            --normal: #ECEAF3;
            --normal-shadow: #D9D8E3;
            --normal-mouth: #9795A4;
            --normal-eye: #595861;
            --active: #F8DA69;
            --active-shadow: #F4B555;
            --active-mouth: #F05136;
            --active-eye: #313036;
            --active-tear: #76b5e7;
            --active-shadow-angry: #e94f1d;
            margin: 0;
            padding-left: 130px;
            list-style: none;
            display: flex;
        }

        .feedback li {
            position: relative;
            border-radius: 50%;
            background: var(--sb, var(--normal));
            box-shadow: inset 3px -3px 4px var(--sh, var(--normal-shadow));
            transition: background 0.4s, box-shadow 0.4s, transform 0.3s;
            -webkit-tap-highlight-color: transparent;
        }

        .feedback li:not(:last-child) {
            margin-right: 20px;
        }

        .feedback li div {
            width: 40px;
            height: 40px;
            position: relative;
            transform: perspective(240px) translateZ(4px);
        }

        .feedback li div svg,
        .feedback li div:before,
        .feedback li div:after {
            display: block;
            position: absolute;
            left: var(--l, 9px);
            top: var(--t, 13px);
            width: var(--w, 8px);
            height: var(--h, 2px);
            transform: rotate(var(--r, 0deg)) scale(var(--sc, 1)) translateZ(0);
        }

        .feedback li div svg {
            fill: none;
            stroke: var(--s);
            stroke-width: 2px;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke 0.4s;
        }

        .feedback li div svg.eye {
            --s: var(--e, var(--normal-eye));
            --t: 17px;
            --w: 7px;
            --h: 4px;
        }

        .feedback li div svg.eye.right {
            --l: 23px;
        }

        .feedback li div svg.mouth {
            --s: var(--m, var(--normal-mouth));
            --l: 11px;
            --t: 23px;
            --w: 18px;
            --h: 7px;
        }

        .feedback li div:before,
        .feedback li div:after {
            content: "";
            z-index: var(--zi, 1);
            border-radius: var(--br, 1px);
            background: var(--b, var(--e, var(--normal-eye)));
            transition: background 0.4s;
        }

        .feedback li.angry {
            --step-1-rx: -24deg;
            --step-1-ry: 20deg;
            --step-2-rx: -24deg;
            --step-2-ry: -20deg;
        }

        .feedback li.angry div:before {
            --r: 20deg;
        }

        .feedback li.angry div:after {
            --l: 23px;
            --r: -20deg;
        }

        .feedback li.angry div svg.eye {
            stroke-dasharray: 4.55;
            stroke-dashoffset: 8.15;
        }

        .feedback li.angry.active {
            -webkit-animation: angry 1s linear;
            animation: angry 1s linear;
        }

        .feedback li.angry.active div:before {
            --middle-y: -2px;
            --middle-r: 22deg;
            -webkit-animation: toggle 0.8s linear forwards;
            animation: toggle 0.8s linear forwards;
        }

        .feedback li.angry.active div:after {
            --middle-y: 1px;
            --middle-r: -18deg;
            -webkit-animation: toggle 0.8s linear forwards;
            animation: toggle 0.8s linear forwards;
        }

        .feedback li.sad {
            --step-1-rx: 20deg;
            --step-1-ry: -12deg;
            --step-2-rx: -18deg;
            --step-2-ry: 14deg;
        }

        .feedback li.sad div:before,
        .feedback li.sad div:after {
            --b: var(--active-tear);
            --sc: 0;
            --w: 5px;
            --h: 5px;
            --t: 15px;
            --br: 50%;
        }

        .feedback li.sad div:after {
            --l: 25px;
        }

        .feedback li.sad div svg.eye {
            --t: 16px;
        }

        .feedback li.sad div svg.mouth {
            --t: 24px;
            stroke-dasharray: 9.5;
            stroke-dashoffset: 33.25;
        }

        .feedback li.sad.active div:before,
        .feedback li.sad.active div:after {
            -webkit-animation: tear 0.6s linear forwards;
            animation: tear 0.6s linear forwards;
        }

        .feedback li.ok {
            --step-1-rx: 4deg;
            --step-1-ry: -22deg;
            --step-1-rz: 6deg;
            --step-2-rx: 4deg;
            --step-2-ry: 22deg;
            --step-2-rz: -6deg;
        }

        .feedback li.ok div:before {
            --l: 12px;
            --t: 17px;
            --h: 4px;
            --w: 4px;
            --br: 50%;
            box-shadow: 12px 0 0 var(--e, var(--normal-eye));
        }

        .feedback li.ok div:after {
            --l: 13px;
            --t: 26px;
            --w: 14px;
            --h: 2px;
            --br: 1px;
            --b: var(--m, var(--normal-mouth));
        }

        .feedback li.ok.active div:before {
            --middle-s-y: .35;
            -webkit-animation: toggle 0.2s linear forwards;
            animation: toggle 0.2s linear forwards;
        }

        .feedback li.ok.active div:after {
            --middle-s-x: .5;
            -webkit-animation: toggle 0.7s linear forwards;
            animation: toggle 0.7s linear forwards;
        }

        .feedback li.good {
            --step-1-rx: -14deg;
            --step-1-rz: 10deg;
            --step-2-rx: 10deg;
            --step-2-rz: -8deg;
        }

        .feedback li.good div:before {
            --b: var(--m, var(--normal-mouth));
            --w: 5px;
            --h: 5px;
            --br: 50%;
            --t: 22px;
            --zi: 0;
            opacity: 0.5;
            box-shadow: 16px 0 0 var(--b);
            filter: blur(2px);
        }

        .feedback li.good div:after {
            --sc: 0;
        }

        .feedback li.good div svg.eye {
            --t: 15px;
            --sc: -1;
            stroke-dasharray: 4.55;
            stroke-dashoffset: 8.15;
        }

        .feedback li.good div svg.mouth {
            --t: 22px;
            --sc: -1;
            stroke-dasharray: 13.3;
            stroke-dashoffset: 23.75;
        }

        .feedback li.good.active div svg.mouth {
            --middle-y: 1px;
            --middle-s: -1;
            -webkit-animation: toggle 0.8s linear forwards;
            animation: toggle 0.8s linear forwards;
        }

        .feedback li.happy div {
            --step-1-rx: 18deg;
            --step-1-ry: 24deg;
            --step-2-rx: 18deg;
            --step-2-ry: -24deg;
        }

        .feedback li.happy div:before {
            --sc: 0;
        }

        .feedback li.happy div:after {
            --b: var(--m, var(--normal-mouth));
            --l: 11px;
            --t: 23px;
            --w: 18px;
            --h: 8px;
            --br: 0 0 8px 8px;
        }

        .feedback li.happy div svg.eye {
            --t: 14px;
            --sc: -1;
        }

        .feedback li.happy.active div:after {
            --middle-s-x: .95;
            --middle-s-y: .75;
            -webkit-animation: toggle 0.8s linear forwards;
            animation: toggle 0.8s linear forwards;
        }

        .feedback li:not(.active) {
            cursor: pointer;
        }

        .feedback li:not(.active):active {
            transform: scale(0.925);
        }

        .feedback li.active {
            --sb: var(--active);
            --sh: var(--active-shadow);
            --m: var(--active-mouth);
            --e: var(--active-eye);
        }

        .feedback li.active div {
            -webkit-animation: shake 0.8s linear forwards;
            animation: shake 0.8s linear forwards;
        }

        @-webkit-keyframes shake {
            30% {
                transform: perspective(240px) rotateX(var(--step-1-rx, 0deg)) rotateY(var(--step-1-ry, 0deg)) rotateZ(var(--step-1-rz, 0deg)) translateZ(10px);
            }

            60% {
                transform: perspective(240px) rotateX(var(--step-2-rx, 0deg)) rotateY(var(--step-2-ry, 0deg)) rotateZ(var(--step-2-rz, 0deg)) translateZ(10px);
            }

            100% {
                transform: perspective(240px) translateZ(4px);
            }
        }

        @keyframes shake {
            30% {
                transform: perspective(240px) rotateX(var(--step-1-rx, 0deg)) rotateY(var(--step-1-ry, 0deg)) rotateZ(var(--step-1-rz, 0deg)) translateZ(10px);
            }

            60% {
                transform: perspective(240px) rotateX(var(--step-2-rx, 0deg)) rotateY(var(--step-2-ry, 0deg)) rotateZ(var(--step-2-rz, 0deg)) translateZ(10px);
            }

            100% {
                transform: perspective(240px) translateZ(4px);
            }
        }

        @-webkit-keyframes tear {
            0% {
                opacity: 0;
                transform: translateY(-2px) scale(0) translateZ(0);
            }

            50% {
                transform: translateY(12px) scale(0.6, 1.2) translateZ(0);
            }

            20%,
            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(24px) translateX(4px) rotateZ(-30deg) scale(0.7, 1.1) translateZ(0);
            }
        }

        @keyframes tear {
            0% {
                opacity: 0;
                transform: translateY(-2px) scale(0) translateZ(0);
            }

            50% {
                transform: translateY(12px) scale(0.6, 1.2) translateZ(0);
            }

            20%,
            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(24px) translateX(4px) rotateZ(-30deg) scale(0.7, 1.1) translateZ(0);
            }
        }

        @-webkit-keyframes toggle {
            50% {
                transform: translateY(var(--middle-y, 0)) scale(var(--middle-s-x, var(--middle-s, 1)), var(--middle-s-y, var(--middle-s, 1))) rotate(var(--middle-r, 0deg));
            }
        }

        @keyframes toggle {
            50% {
                transform: translateY(var(--middle-y, 0)) scale(var(--middle-s-x, var(--middle-s, 1)), var(--middle-s-y, var(--middle-s, 1))) rotate(var(--middle-r, 0deg));
            }
        }

        @-webkit-keyframes angry {
            40% {
                background: var(--active);
            }

            45% {
                box-shadow: inset 3px -3px 4px var(--active-shadow), inset 0 8px 10px var(--active-shadow-angry);
            }
        }

        @keyframes angry {
            40% {
                background: var(--active);
            }

            45% {
                box-shadow: inset 3px -3px 4px var(--active-shadow), inset 0 8px 10px var(--active-shadow-angry);
            }
        }

        html {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        * {
            box-sizing: inherit;
        }

        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            min-height: 100vh;
            display: flex;
            font-family: "Roboto", Arial;
            justify-content: center;
            /*align-items: center;*/
            flex-direction: column;
            background: #F9F9FC;
        }

        body .dribbble {
            position: fixed;
            display: block;
            right: 20px;
            bottom: 20px;
        }

        body .dribbble img {
            display: block;
            height: 28px;
        }

        body .twitter {
            position: fixed;
            display: block;
            right: 64px;
            bottom: 14px;
        }

        body .twitter svg {
            width: 32px;
            height: 32px;
            fill: #1da1f2;
        }
    </style>
    <style>
        /* Increase the font size of the logo */
        .header_side_right .logo {
            font-size: 24px;
            /* Adjust the font size as needed */
        }

        /* Increase the padding for the header */
        .page_header_side {
            padding: 20px;
            /* Adjust the padding as needed */
        }

        /* Increase the font size of the panel titles */
        .page_header_side h4 a {
            font-size: 18px;
            /* Adjust the font size as needed */
        }

        /* Increase the font size of the panel content */
        .page_header_side .panel-content {
            font-size: 16px;
            /* Adjust the font size as needed */
            left: 1000px;
        }

        .page_header_side.header_side_right {
            right: -400px;
        }

        .page_header_side {
            left: 1520px;
        }
    </style>
    <header class="page_header_side header_side_right ls" style="width: 400px; ">
        <span class="toggle_menu_side">
            <span></span>
        </span>
        <div class="scrollbar-macosx">
            <div class="side_header_inner">
                <div class="text-center">
                    <a class="logo">
                        <i class="fa fa-archive"></i>&ensp;ARCHIVE&ensp;<i class="fa fa-archive"></i>
                    </a>
                    <br>
                    <br>
                </div>
                <div class="header-side-menu darklinks">
                    <div id="accordion3" class="panel-group collapse-unstyled">
                        <?php foreach ($tickets as $index => $ticket) { ?>
                            <?php if ($ticket['archived'] == -1) {
                                if ($_SESSION['user_id'] == $ticket['Id']) {
                            ?>

                                    <div class="panel">
                                        <h4>
                                            <a data-toggle="collapse" data-parent="#accordion3" href="#collapse<?php echo $index; ?>">
                                                <?php echo $ticket['subject']; ?>
                                            </a>
                                        </h4>
                                        <div id="collapse<?php echo $index; ?>" class="panel-collapse collapse">
                                            <div class="panel-content">
                                                <?php echo $ticket['message']; ?>

                                                <div style="display: inline-block; float: right; ">
                                                    <a href='../../controller/ticket_delete.php?ticketid=<?php echo $ticket['ticketid']; ?>'>
                                                        <i class='rt-icon2-trash2 ' style='font-size: 14px;'></i>
                                                    </a>
                                                </div>

                                                <div style="display: inline-block; float: right;margin-right: 4px;">
                                                    <a href='../../controller/ticket_archive_update.php?ticketid=<?php echo $ticket['ticketid']; ?>'>
                                                        <i class='rt-icon2-out' style='font-size: 14px;'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                        <?php }
                        } ?>
                    </div>
                    <!-- .panel-group  -->
                </div>


            </div>

        </div>
        </div>
    </header>

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



                <style>
                    .panel-heading .panel-title>a:after {
                        content: "";
                        /* Empty content to create a pseudo-element */
                        display: block;
                        width: 28%;
                        height: 1px;
                        background-color: rgba(204, 204, 204, 0.4);
                        margin-top: 10px;
                        /* Adjust the margin as needed */
                    }
                </style>
                <section class="ls section_padding_100">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <h2>Previous Tickets:</h2>
                                            <a role="button" href="../frontoffice/contact2.php"><i class="fa fa-refresh">&ensp;</i>refresh</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row vertical-tabs">
                                    <div class="col-sm-4">
                                        <ul class="nav" role="tablist">
                                            <?php foreach ($tickets as $key => $ticket) : ?>
                                                <?php if ($ticket['archived'] == 1) : ?>
                                                    <?php if ($_SESSION['user_id'] == $ticket['Id']) : ?>
                                                        <li <?php echo ($key === 0) ? 'class="active"' : ''; ?>>
                                                            <a href="#vertical-tab<?php echo $key + 1; ?>" role="tab" data-toggle="tab">
                                                                <i class="rt-icon2-ticket"></i> <?php echo $ticket['subject']; ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                        </ul>
                                    </div>
                                    <div class="col-sm-8">

                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                            <?php
                                            foreach ($tickets as $key => $ticket) : ?>
                                                <?php if ($ticket['archived'] == 1) :
                                                    if ($_SESSION['user_id'] == $ticket['Id']) { ?>
                                                        <div class="tab-pane fade <?php echo ($key === 0) ? 'in active' : ''; ?>" id="vertical-tab<?php echo $key + 1; ?>">
                                                            <div style="float: right; margin-top: -0.5em">
                                                                <?php
                                                                $datetime = new DateTime($ticket['date']);
                                                                $formattedDate = $datetime->format('j M \a\t H:i');
                                                                echo $formattedDate;
                                                                ?>
                                                            </div>
                                                            <h3 style="margin-top: -0.5em">
                                                                <i class="rt-icon2-speech-bubble"></i> <?php echo $ticket['subject']; ?>
                                                            </h3>
                                                            <p style="display: inline-block;">
                                                                <i class="rt-icon2-chevron-right"></i> <?php echo $ticket['message']; ?>
                                                            </p>
                                                            <div style="display: inline-block; float: right;">
                                                                <a href='../../controller/ticket_delete.php?ticketid=<?php echo $ticket['ticketid']; ?>'>
                                                                    <i class='rt-icon2-trashcan ' style='font-size: 22px;'></i>
                                                                </a>
                                                            </div>

                                                            <?php $hasReplies = false; ?>
                                                            <?php foreach ($reponses as $reponseKey => $reponse) : ?>
                                                                <?php if ($reponse['ticketid'] === $ticket['ticketid']) : ?>
                                                                    <?php $hasReplies = true; ?>
                                                                    <!-- Assuming you have a form wrapping your content -->
                                                                    <div style="display: inline-block; float: right;">
                                                                        <a href='../../controller/ticket_archive_update.php?ticketid=<?php echo $ticket['ticketid']; ?>'>
                                                                            <i class='fa fa-inbox' style='font-size: 22px;'></i>
                                                                        </a>
                                                                    </div>

                                                                    <?php break; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>

                                                            <?php if (!$hasReplies) : ?>
                                                                <div style="display: inline-block; float: right;">
                                                                    <a href='../../controller/ticket_update.php?ticketid=<?php echo $ticket['ticketid']; ?>'>
                                                                        <i class='rt-icon2-edit ' style='font-size: 22px;'></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <!-- Nested panel structure -->
                                                            <style>
                                                                .ai-prediction {
                                                                    padding: 10px;
                                                                    margin: 10px 0;
                                                                    font-style: italic;
                                                                    font-size: 16px;
                                                                    color: rgba(0, 0, 0, 0.4);
                                                                }
                                                            </style>
                                                            <div class="panel-group" id="accordion<?php echo $key + 1; ?>">
                                                                <?php $responseCounter = 1; ?>
                                                                <?php
                                                                // Check if there are no replies for the current ticket
                                                                $hasRepliesforprediction = false;
                                                                foreach ($reponses as $reponseKey => $reponse) {
                                                                    if ($reponse['ticketid'] === $ticket['ticketid']) {
                                                                        $hasRepliesforprediction = true;
                                                                        break;
                                                                    }
                                                                }

                                                                // Output the message only if there are no replies
                                                                if (!$hasRepliesforprediction) {
                                                                    echo '<div class="ai-prediction">' . $outputMessage . '</div>';
                                                                }
                                                                ?>

                                                                <?php foreach ($reponses as $reponseKey => $reponse) : ?>
                                                                    <?php if ($reponse['ticketid'] === $ticket['ticketid']) : ?>
                                                                        <div class="panel panel-custom"> <!-- Add a custom class for styling -->
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title">
                                                                                    <a data-toggle="collapse" href="#collapse<?php echo $key + 1 . '-' . $reponseKey; ?>">
                                                                                        <i class="rt-icon2-messages highlight"></i>
                                                                                        Reply <?php echo $responseCounter; ?>
                                                                                    </a>
                                                                                </h3>
                                                                            </div>
                                                                            <div id="collapse<?php echo $key + 1 . '-' . $reponseKey; ?>" class="panel-collapse collapse">
                                                                                <div class="panel-body with-border"> <!-- Add a custom class for styling -->
                                                                                    <?php echo $reponse['reponse']; ?>
                                                                                    <!--<div style="display: inline-block; float: right; margin-right: 4px;">
                                                                                <i class='rt-icon2-star-outline highlight' data-toggle="modal" data-target="#feedbackModal" style='font-size: 24px;'></i>
                                                                            </div> -->
                                                                                    <div style="display: inline-block; float: right; margin-right: 4px;">
                                                                                        <ul class="feedback">
                                                                                            <?php if ($reponse['feedback'] == null) { ?>
                                                                                                <li class="ok" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>" style="scale: 60%">
                                                                                                    <div></div>
                                                                                                </li>
                                                                                            <?php } else if ($reponse['feedback'] == 1) { ?>
                                                                                                <li class="angry active" style="scale: 60%" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>">
                                                                                                    <div>
                                                                                                        <svg class="eye left">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="eye right">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="mouth">
                                                                                                            <use xlink:href="#mouth">
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                </li>

                                                                                            <?php } elseif ($reponse['feedback'] == 2) { ?>
                                                                                                <li class="sad active" style="scale: 60%" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>">
                                                                                                    <div>
                                                                                                        <svg class="eye left">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="eye right">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="mouth">
                                                                                                            <use xlink:href="#mouth">
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                </li>
                                                                                            <?php } elseif ($reponse['feedback'] == 3) { ?>
                                                                                                <li class="ok active" style="scale: 60%" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>">
                                                                                                    <div></div>
                                                                                                </li>
                                                                                            <?php } else if ($reponse['feedback'] == 4) { ?>
                                                                                                <li class="good active" style="scale: 60%" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>">
                                                                                                    <div>
                                                                                                        <svg class="eye left">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="eye right">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="mouth">
                                                                                                            <use xlink:href="#mouth">
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                </li>
                                                                                            <?php } else { ?>
                                                                                                <li class="happy active" style="scale: 60%" data-toggle="modal" data-target="#feedbackModal<?php echo $reponse['reponseid']; ?>">
                                                                                                    <div>
                                                                                                        <svg class="eye left">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                        <svg class="eye right">
                                                                                                            <use xlink:href="#eye">
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                </li>
                                                                                            <?php } ?>


                                                                                        </ul>
                                                                                    </div>


                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="feedbackModal<?php echo $reponse['reponseid']; ?>" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                    <h4 class="modal-title" id="feedbackModalLabel">
                                                                                                        <center>How was the reply?</center>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div class="modal-body">

                                                                                                    <form id="feedbackForm<?php echo $reponse['reponseid']; ?>" method="post" action="../../controller/feedback_update.php?id=<?php echo $reponse['reponseid']; ?>">
                                                                                                        <ul class="feedback">
                                                                                                            <li class="angry">
                                                                                                                <div>
                                                                                                                    <svg class="eye left">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="eye right">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="mouth">
                                                                                                                        <use xlink:href="#mouth">
                                                                                                                    </svg>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="sad">
                                                                                                                <div>
                                                                                                                    <svg class="eye left">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="eye right">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="mouth">
                                                                                                                        <use xlink:href="#mouth">
                                                                                                                    </svg>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="ok">
                                                                                                                <div></div>
                                                                                                            </li>
                                                                                                            <li class="good">
                                                                                                                <div>
                                                                                                                    <svg class="eye left">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="eye right">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="mouth">
                                                                                                                        <use xlink:href="#mouth">
                                                                                                                    </svg>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="happy">
                                                                                                                <div>
                                                                                                                    <svg class="eye left">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                    <svg class="eye right">
                                                                                                                        <use xlink:href="#eye">
                                                                                                                    </svg>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <br>
                                                                                                        <input type="hidden" name="reponseid" value="<?php echo $reponse['reponseid']; ?>">
                                                                                                        <input type="hidden" name="feedbacktime" id="feedbackTimeInput<?php echo $reponse['reponseid']; ?>" value="" />
                                                                                                        <input type="hidden" name="key" value="<?php echo $reponse['reponseid']; ?>">
                                                                                                        <input type="hidden" name="ticketid" id="ticketIdInput" value="<?php echo $reponse['reponseid']; ?>">
                                                                                                        <button type="submit" onclick="submitFeedback('<?php echo $reponse['reponseid']; ?>')" class="theme_button" style="margin-left: 220px;">Send</button>
                                                                                                    </form>
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                                                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                                                                                                            <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
                                                                                                        </symbol>
                                                                                                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                                                                                                            <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
                                                                                                        </symbol>
                                                                                                    </svg>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Add this script in the head or before the closing body tag -->
                                                                                    <!-- Add this script in the head or before the closing body tag -->
                                                                                    <!-- Add this script in the head or before the closing body tag -->
                                                                                    <script>
                                                                                        function submitFeedback(key) {


                                                                                            var feedbackForm = document.getElementById('feedbackForm' + key);
                                                                                            var feedbackList = document.querySelectorAll('.feedback li');
                                                                                            var selectedFeedback = null;

                                                                                            for (var i = 0; i < feedbackList.length; i++) {
                                                                                                if (feedbackList[i].classList.contains('active')) {
                                                                                                    selectedFeedback = feedbackList[i].classList[0];
                                                                                                    break;
                                                                                                }
                                                                                            }

                                                                                            var feedbackValue;
                                                                                            switch (selectedFeedback) {
                                                                                                case 'angry':
                                                                                                    feedbackValue = 1;
                                                                                                    break;
                                                                                                case 'sad':
                                                                                                    feedbackValue = 2;
                                                                                                    break;
                                                                                                case 'ok':
                                                                                                    feedbackValue = 3;
                                                                                                    break;
                                                                                                case 'good':
                                                                                                    feedbackValue = 4;
                                                                                                    break;
                                                                                                case 'happy':
                                                                                                    feedbackValue = 5;
                                                                                                    break;
                                                                                                default:
                                                                                                    feedbackValue = null;
                                                                                            }

                                                                                            if (feedbackValue !== null) {
                                                                                                // Get the current action URL
                                                                                                var action = feedbackForm.getAttribute('action');
                                                                                                var currentTime = new Date().toISOString();

                                                                                                // Set the feedback time in the hidden input field
                                                                                                document.getElementById('feedbackTimeInput' + key).value = currentTime;

                                                                                                // Check if the URL already contains a question mark
                                                                                                // If yes, append the feedback value with "&"
                                                                                                // If no, append the feedback value with "?"
                                                                                                action += (action.includes('?') ? '&' : '?') + 'feedback=' + feedbackValue;

                                                                                                // Update the form action
                                                                                                feedbackForm.setAttribute('action', action);

                                                                                                // Trigger form submission using submit method
                                                                                                feedbackForm.submit();
                                                                                            } else {
                                                                                                console.error('Error: No feedback selected.');
                                                                                            }
                                                                                        }
                                                                                    </script>




                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <?php $responseCounter++; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <!-- End of nested panel structure -->
                                                        </div>
                                                <?php }
                                                endif; ?>
                                            <?php endforeach; ?>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>


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

            </div>
            <!-- eof #box_wrapper -->
        </div>
        <!-- eof #canvas -->

        <script src="../../assets/frontoffice/js/compressed.js"></script>
        <script src="../../assets/frontoffice/js/main.js"></script>

        <script>
            document.querySelectorAll('.feedback li').forEach(entry => entry.addEventListener('click', e => {
                if (!entry.classList.contains('active')) {
                    document.querySelector('.feedback li.active').classList.remove('active');
                    entry.classList.add('active');
                }
                e.preventDefault();
            }));
        </script>


    </body>

    </html>
<?php
}
$pdo = config::getConnexion();
?>