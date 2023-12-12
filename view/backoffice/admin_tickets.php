<?php
session_start();
if (!isset($_SESSION["user_id"])){
  header("Location:../frontoffice/login.php");

}
require_once "../../model/user.php";
include_once "adminHeader.php";


include_once '../../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    function readticket()
    {
        global $pdo;
        global $stat;
        $ticketCount = -1; // Initialize a counter
        $selectedOption = isset($_GET['with-selected']) ? $_GET['with-selected'] : '';
        $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'date'; // Default sorting by date
        $showCount = isset($_GET['showcount']) ? $_GET['showcount'] : '10'; // Default show count

        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';


        try {
            $query = $pdo->query("SELECT * FROM ticket");
            $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

            $query1=$pdo->query("SELECT * FROM reponse");
            $reponses=$query1->fetchAll(PDO::FETCH_ASSOC);

                $query2=$pdo->query("SELECT * FROM users");
                $users=$query2->fetchAll(PDO::FETCH_ASSOC);
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
                <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css" class="color-switcher-link">
                <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

                <!--[if lt IE 9]>
                <script src="../../assets/frontoffice/js/vendor/html5shiv.min.js"></script>
                <script src="../../assets/frontoffice/js/vendor/respond.min.js"></script>
                <script src="../../assets/frontoffice/js/vendor/jquery-1.12.4.min.js"></script>
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
                .feedback li div svg, .feedback li div:before, .feedback li div:after {
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
                .feedback li div:before, .feedback li div:after {
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
                .feedback li.sad div:before, .feedback li.sad div:after {
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
                .feedback li.sad.active div:before, .feedback li.sad.active div:after {
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
                    20%, 80% {
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
                    20%, 80% {
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
                *:before, *:after {
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
            <script>
                document.querySelectorAll('.feedback li').forEach(entry => entry.addEventListener('click', e => {
                    if(!entry.classList.contains('active')) {
                        document.querySelector('.feedback li.active').classList.remove('active');
                        entry.classList.add('active');
                    }
                    e.preventDefault();
                }));
            </script>
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


            <!-- eof .modal -->

            <!-- Unyson messages modal -->

                        <!-- eof .modal -->

            <!-- wrappers for visual page editor and boxed version of template -->
            <div id="canvas">
                <div id="box_wrapper">

                    <!-- template sections -->

                    <style>
                        .yassine{
                            padding-left:30px; padding-rigt:30px; padding-bottom:30px; padding-top:-30px;
                        }
                    </style>
                    <script>
                        if (!window.location.search) {
                            window.location.href = "./admin_tickets.php?with-selected=all&showcount=10&orderby=date";
                        }
                    </script>
                    <script>
                        // Helper function to get the value of a parameter from the URL
                        function getParameterByName(name) {
                            var url = window.location.href;
                            name = name.replace(/[\[\]]/g, "\\$&");
                            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                                results = regex.exec(url);
                            if (!results) return null;
                            if (!results[2]) return '';
                            return decodeURIComponent(results[2].replace(/\+/g, " "));
                        }
                    </script>
                    <script>
                        function handleSelectionChange() {
                            // Get the selected value
                            var selectedValue = document.getElementById("with-selected").value;
                            var selectedSorting = document.getElementById('orderby').value;
                            // Get the current showcount value
                            var currentShowCount = getParameterByName('showcount');

                            // For example, redirect to the same page with the selected option and current showcount in the URL
                            window.location.href = "./admin_tickets.php?with-selected=" + selectedValue + "&showcount=" + currentShowCount + "&orderby=" + selectedSorting;
                        }
                    </script>
                    <script>
                        function handleSortingChange() {
                            // Get the selected sorting option
                            var selectedSorting = document.getElementById('orderby').value;
                            var selectedValue = document.getElementById("with-selected").value;
                            // Get the current showcount value
                            var currentShowCount = getParameterByName('showcount');

                            // Redirect to the same page with the new sorting option and current showcount in the URL
                            window.location.href = "./admin_tickets.php?with-selected=" + selectedValue + "&showcount=" + currentShowCount + "&orderby=" + selectedSorting;
                        }

                        // Helper function to get the value of a parameter from the URL
                        function getParameterByName(name) {
                            var url = window.location.href;
                            name = name.replace(/[\[\]]/g, "\\$&");
                            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                                results = regex.exec(url);
                            if (!results) return null;
                            if (!results[2]) return '';
                            return decodeURIComponent(results[2].replace(/\+/g, " "));
                        }
                    </script>

                    <script>
                        $(document).ready(function () {
                            // Function to sort the table rows
                            function sortTable(columnIndex, dataType) {
                                var table = $('table');
                                var rows = $('tbody tr', table).toArray().sort(comparer($(this).index()));

                                function comparer(index) {
                                    return function (a, b) {
                                        var valA = getCellValue(a, index, dataType);
                                        var valB = getCellValue(b, index, dataType);
                                        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
                                    };
                                }

                                function getCellValue(row, index, dataType) {
                                    var cell = $('td', row).eq(index);
                                    switch (dataType) {
                                        case 'date':
                                            return new Date(cell.text());
                                        default:
                                            return cell.text();
                                    }
                                }

                                $.each(rows, function (index, row) {
                                    table.append(row);
                                });
                            }

                            // Attach click event to the table headers for sorting
                            $('th').click(function () {
                                var index = $(this).index();
                                var dataType = 'text'; // Default to text if not specified
                                sortTable(index, dataType);
                            });
                        });
                    </script>
                    <script>
                        function handleShowCountChange() {
                            // Get the selected value from the showcount dropdown
                            var selectedShowCount = document.getElementById("showcount").value;

                            // Get the current URL
                            var currentUrl = new URL(window.location.href);

                            // Update only the showcount parameter
                            currentUrl.searchParams.set("showcount", selectedShowCount);

                            // Change the URL
                            window.location.href = currentUrl.href;
                        }
                    </script>
                    <script>
                        // Function to update the URL based on checkbox state
                        function updateURL() {
                            var archivedCheckbox = document.getElementById('archivedCheckbox');
                            var url = new URL(window.location.href);

                            // Update the 'archived' parameter based on checkbox state
                            if (archivedCheckbox.checked) {
                                url.searchParams.set('archived', -1);
                            } else {
                                url.searchParams.delete('archived');
                            }

                            // Replace the current URL with the updated one
                            window.history.replaceState({}, '', url.href);

                            window.location.reload();
                        }
                    </script>

                    <div class="yassine">
                    <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Tickets</h3>
                                </div>
                                <!-- .col-* -->
                            </div>
                            <!-- .row -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="with_border with_padding">

                                        <div class="row admin-table-filters">
                                            <div class="col-lg-9">

                                                <form method="get" action="./admin_tickets.php" class="form-inline filters-form" id="filter-form">
											<span>
												<label class="grey" for="with-selected">Status Selected:</label>
												<select class="form-control with-selected" name="with-selected" id="with-selected" onchange="handleSelectionChange()">
                                                    <option value="all" <?php echo ($selectedOption === 'all') ? 'selected' : ''; ?>>All</option>
                                                    <option value="done" <?php echo ($selectedOption === 'done') ? 'selected' : ''; ?>>Done</option>
                                                    <option value="not done" <?php echo ($selectedOption === 'not done') ? 'selected' : ''; ?>>Not yet</option>
                                                </select>

											</span>
                                                    <span>
												<label class="grey" for="orderby">Sort By:</label>
												<select class="form-control orderby" name="orderby" id="orderby" onchange="handleSortingChange()">
                                                    <option value="date" <?php echo ($orderBy === 'date') ? 'selected' : ''; ?>>Old to New</option>
                                                    <option value="reversedate" <?php echo ($orderBy === 'reversedate') ? 'selected' : ''; ?>>New to Old</option>
                                                    <option value="subject" <?php echo ($orderBy === 'subject') ? 'selected' : ''; ?>>Subject</option>
                                                </select>
											</span>

                                                    <span>
												<label class="grey" for="showcount">Show:</label>
												<select class="form-control showcount" name="showcount" id="showcount" onchange="handleShowCountChange()">
                                                    <option value="5" <?php echo ($showCount === '5') ? 'selected' : ''; ?>>5</option>
                                                    <option value="10" <?php echo ($showCount === '10') ? 'selected' : ''; ?>>10</option>
                                                    <option value="20" <?php echo ($showCount === '20') ? 'selected' : ''; ?>>20</option>
                                                    <option value="50" <?php echo ($showCount === '50') ? 'selected' : ''; ?>>50</option>
                                                    <option value="100" <?php echo ($showCount === '100') ? 'selected' : ''; ?>>100</option>
                                                </select>
											</span>
                                                    <span>
                                                            <div class="form-group">
                                                                <label for="show-archived">Show Archived</label>
                                                                <input type="checkbox" id="archivedCheckbox" onchange="updateURL()" <?php echo (isset($_GET['archived']) && $_GET['archived'] == -1) ? 'checked' : ''; ?>>


                                                            </div>
                                                    </span>

                                                </form>


                                            </div>

                                            <!-- .col-* -->
                                            <div class="col-lg-3 text-lg-right">
                                                <div class="widget widget_search">
                                                    <form method="get" class="form-inline" action="./admin_tickets.php">
                                                        <div class="form-group">
                                                            <label class="screen-reader-text" for="widget-search">Search for:</label>
                                                            <input id="widget-search" type="text" value="<?php echo $searchTerm; ?>" name="search" class="form-control" placeholder="Search">
                                                        </div>
                                                        <input type="hidden" name="showcount" value="<?php echo isset($_GET['showcount']) ? $_GET['showcount'] : '10'; ?>">
                                                        <button type="submit" class="theme_button">Search</button>
                                                    </form>
                                                </div>
                                            </div>


                                            <!-- .col-* -->
                                        </div>
                                        <!-- .row -->


                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>From:</th>
                                                    <th>Subject:</th>
                                                    <th>Message:</th>
                                                    <th width="190px">Date:</th>
                                                    <th width="50px"> Status:</th>
                                                    <th width="100px">Answer</th>
                                                    <th> Replies:</th>
                                                    <th width="70px"> Edit</th>
                                                </tr>

                                                <?php
                                                $selectedOption = isset($_GET['with-selected']) ? $_GET['with-selected'] : '';
                                                $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'date'; // Default sorting by date
                                                $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : ''; // Trim leading and trailing whitespaces
                                                $archivedFilter = isset($_GET['archived']) ? intval($_GET['archived']) : null; // Added archive filter

                                                // Filter and sort tickets based on the selected criteria
                                                $filteredAndSortedTickets = $tickets;

                                                usort($filteredAndSortedTickets, function ($a, $b) use ($orderBy) {
                                                    switch ($orderBy) {
                                                        case 'reversedate':
                                                            return strtotime($a['date']) - strtotime($b['date']);
                                                        case 'subject':
                                                            return strcasecmp($a[$orderBy], $b[$orderBy]); // Case-insensitive string comparison
                                                        case 'date':
                                                            return strtotime($b['date']) - strtotime($a['date']);
                                                    }
                                                });

                                                // Search filter
                                                $filteredAndSortedTickets = array_filter($filteredAndSortedTickets, function ($ticket) use ($searchTerm) {
                                                    $searchFields = [$ticket['name'], $ticket['subject'], $ticket['message']];
                                                    return empty($searchTerm) || array_reduce($searchFields, function ($carry, $field) use ($searchTerm) {
                                                            return $carry || stripos($field, $searchTerm) !== false;
                                                        }, false);
                                                });

                                                // Apply archived filter
                                                $filteredAndSortedTickets = array_filter($filteredAndSortedTickets, function ($ticket) use ($archivedFilter) {
                                                    if ($archivedFilter === 1) {
                                                        return $ticket['archived'] == 1; // Not archived
                                                    } elseif ($archivedFilter === -1) {
                                                        return $ticket['archived'] == -1; // Archived
                                                    } else {
                                                        return $ticket['archived'] == 1; // Show only not archived when the checkbox is unchecked
                                                    }
                                                });


                                                $filteredAndSortedTicketsWithResponses = array_filter($filteredAndSortedTickets, function ($ticket) use ($selectedOption, $reponses) {
                                                    $hasNonNullResponse = false;

                                                    foreach ($reponses as $reponse) {
                                                        if ($reponse['ticketid'] == $ticket['ticketid'] && $reponse['reponse'] !== null) {
                                                            $hasNonNullResponse = true;
                                                            break;
                                                        }
                                                    }

                                                    switch ($selectedOption) {
                                                        case 'all':
                                                            return true;
                                                        case 'done':
                                                            return $hasNonNullResponse;
                                                        case 'not done':
                                                            return !$hasNonNullResponse;
                                                        default:
                                                            return true;
                                                    }
                                                });

                                                // Paginate based on the filtered and sorted items
                                                $totalItems = count($filteredAndSortedTicketsWithResponses);
                                                $showCount = isset($_GET['showcount']) ? $_GET['showcount'] : 10;
                                                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                                                // Calculate the total number of pages
                                                $totalPages = ceil($totalItems / $showCount);

                                                // Calculate the range of items to display
                                                $startItem = ($currentPage - 1) * $showCount;
                                                $endItem = min($startItem + $showCount - 1, $totalItems - 1);

                                                // Extract the items to display for the current page
                                                $displayedItems = array_slice($filteredAndSortedTicketsWithResponses, $startItem, $showCount);

                                                foreach ($displayedItems as $ticket) {
        ?>
                                                   <div class="modal fade" tabindex="-1" role="dialog" id="admin_contact_modal_<?php echo $ticket['ticketid'] ?>">
                                                        <div class="modal-dialog" style="width:700px" role="document">
                                                            <div class=" yassine modal-content">
                                                                <form class="with_padding contact-form" method="post" action="../../controller/reponse_create.php?id=<?php echo $ticket['ticketid'] ?>">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <h2><center>Message Details</center></h2>
                                                                        </div>
                                                                        <div class="col-sm-12" style="font-size: 18px">
                                                                            <p> &nbsp; &nbsp; <?php echo $ticket['message']; ?></p>
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <h2><center>Reply to
                                                                                <?php
                                                                                foreach ($users as $user) {
                                                                                    if ($ticket['Id'] == $user['Id']) {
                                                                                        echo $user['Username'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                ?></center></h2>
                                                                        </div>
                                                                        <style>

                                                                            #reponse::placeholder {
                                                                                font-size: 18px;
                                                                            }
                                                                        </style>
                                                                        <div class="col-sm-12">
                                                                            <div class="contact-form-message" >

                                                                                <textarea style="font-size: 18px" rows="8" cols="70" name="reponse" id="reponse" class="form-control" placeholder="Message"></textarea>
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

                                                    <div class="modal fade" tabindex="-1" role="dialog" id="read_admin_contact_modal_<?php echo $ticket['ticketid'] ?>">
                                                        <div class="modal-dialog" style="width:700px" role="document">
                                                            <div class="yassine modal-content">
                                                                <form class="with_padding contact-form">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <h2><center>Your Replies</center></h2>
                                                                        </div>
                                                                        <?php foreach ($reponses as $reponse) {
                                                                            if ($reponse['ticketid'] == $ticket['ticketid']) { ?>
                                                                                <div class="col-sm-12" style="font-size: 18px;">
                                                                                    <div class="edit-container">
                                                                                        <input type="hidden" id="reponseId" name="reponseId" value="">
                                                                                        <p id="reponseText_<?php echo $reponse['reponseid']; ?>" style="display: inline-block;"><?php echo $reponse['reponse']; ?></p>
                                                                                        <div style="display: inline-block; float: right; padding-right: 10px">
                                                                                            <ul class="feedback">
                                                                                            <?php if ($reponse['feedback']==null) { ?>
                                                                                            <li class="ok" style="scale: 60%" title="User's Feedback">
                                                                                        <div></div>
                                                                                        </li>
                                                                                        <?php } else if ($reponse['feedback']==1) { ?>
                                                                                            <li class="angry active" style="scale: 60%" title="User's Feedback">
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

                                                                                        <?php } elseif ($reponse['feedback']==2) {?>
                                                                                            <li class="sad active" style="scale: 60%" title="User's Feedback" >
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
                                                                                        <?php } elseif ($reponse['feedback']==3) {?>
                                                                                            <li class="ok active"  style="scale: 60%" title="User's Feedback">
                                                                                                <div></div>
                                                                                            </li>
                                                                                        <?php } else if($reponse['feedback']==4) {?>
                                                                                            <li class="good active" style="scale: 60%" title="User's Feedback">
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
                                                                                        <?php } else {?>
                                                                                            <li class="happy active" style="scale: 60%" title="User's Feedback">
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

                                                                                        <textarea class="form-control"  id="reponseTextarea_<?php echo $reponse['reponseid']; ?>" style="display: none; height: 50px;"><?php echo $reponse['reponse']; ?></textarea>
                                                                                    </div>


                                                                                    <div id="buttons_<?php echo $reponse['reponseid']; ?>">
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        <a href="javascript:void(0);" onclick="toggleEdit('<?php echo $reponse['reponseid']; ?>')">
                                                                                            <i class="rt-icon2-pencil" role="button"></i>
                                                                                            &nbsp;
                                                                                        </a>
                                                                                        <a href="../../controller/reponse_delete.php?reponseid=<?php echo $reponse['reponseid']?>" id="deleteButton_<?php echo $reponse['reponseid']; ?>">
                                                                                            <i class="rt-icon2-close2" role="button"></i>
                                                                                            <br>
                                                                                        </a>
                                                                                    </div>

                                                                                    <hr>
                                                                                </div>
                                                                            <?php }
                                                                        } ?><svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                                                                                <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
                                                                            </symbol>
                                                                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                                                                                <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
                                                                            </symbol>
                                                                        </svg>


                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ... Your existing HTML code ... -->

                                                    <!-- ... Your existing HTML code ... -->
                                                    <!-- Add this script after your HTML content -->

                                                    <script>
                                                        function toggleEdit(reponseid) {
                                                            var textElement = document.getElementById('reponseText_' + reponseid);
                                                            var textareaElement = document.getElementById('reponseTextarea_' + reponseid);
                                                            var buttonsContainer = document.getElementById('buttons_' + reponseid);

                                                            if (textElement.style.display === 'none') {
                                                                textElement.style.display = 'block';
                                                                textareaElement.style.display = 'none';

                                                                buttonsContainer.innerHTML = `
            <a href="javascript:void(0);" onclick="toggleEdit(${reponseid})">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="rt-icon2-pencil" role="button"></i>
                &nbsp;
            </a>
        `;
                                                            } else {
                                                                textElement.style.display = 'none';
                                                                textareaElement.style.display = 'block';

                                                                buttonsContainer.innerHTML = `
            <a href="javascript:void(0);" onclick="saveEdit(${reponseid})">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="rt-icon2-checkmark" role="button"></i>
                Save
            </a>
        `;
                                                            }
                                                        }

                                                        function saveEdit(reponseId) {
                                                            var textareaElement = document.getElementById('reponseTextarea_' + reponseId);
                                                            var reponse = textareaElement.value;

                                                            fetch(`../../controller/response_processupdate.php?id=${reponseId}`, {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/x-www-form-urlencoded',
                                                                },
                                                                body: `reponse=${encodeURIComponent(reponse)}`,
                                                            })
                                                                .then(response => {
                                                                    if (!response.ok) {
                                                                        throw new Error('Network response was not ok');
                                                                    }
                                                                    return response.text();  // Response is plain text
                                                                })
                                                                .then(data => {
                                                                    console.log('Update response:', data);
                                                                    // Check if the update was successful
                                                                    if (data === 'Update successful!') {
                                                                        // Redirect to admin_tickets.php
                                                                        window.location.href = './admin_tickets.php';
                                                                    } else {
                                                                        // Handle other responses if needed
                                                                    }
                                                                })
                                                                .catch(error => {
                                                                    console.error('Error during fetch:', error);
                                                                });
                                                        }


                                                    </script>

                                                    <!-- ... Your existing HTML code ... -->






                                                    <tr class="item-editable">
                                                        <?php
                                                        $showCount = isset($_GET['showcount']) ? $_GET['showcount'] : '';
                                                        $ticketCount++;
                                                        if ($ticketCount>= $showCount) { break;}
                                                        else {
                                                            ?>

                                                            <td>
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <?php
                                                                    foreach ($users as $user) {
                                                                        if ($ticket['Id'] == $user['Id']) {
                                                                            echo $user['Username'];
                                                                            break;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="media-middle">
                                                            <?php echo $ticket['subject'] ?>
                                                        </td>
                                                        <td class="media-middle">
                                                            <?php echo $ticket['message'] ?>
                                                        </td>
                                                        <td width="190px" class="media-middle">
                                                            <?php echo $ticket['date'] ?>
                                                        </td>
                                                        <td class="media-middle">
                                                            <?php

                                                            $hasNonNullResponse = false;

                                                            foreach ($reponses as $reponse) {
                                                                if ($reponse['ticketid'] == $ticket['ticketid'] && $reponse['reponse'] !== null) {
                                                                    $hasNonNullResponse = true;
                                                                    break; // No need to continue checking once we find a non-null response
                                                                }
                                                            }

                                                            if ($hasNonNullResponse) {
                                                                echo '<h4><i class="rt-icon2-check2"></i></h4>';
                                                            } else {
                                                                echo '<h4><i class="rt-icon2-cross2"></i></h4>';
                                                            }


                                                            ?>
                                                        </td>
                                                        <td width="100px">
                                                            <button data-target="#admin_contact_modal_<?php echo $ticket['ticketid'] ?>" href="#admin_contact_modal_<?php echo $ticket['ticketid'] ?>" data-toggle="modal" class="theme_button inverse wide_button" style="font-size: 12px">Answer</button>
                                                        </td>
                                                        <td class="media-middle">
                                                            <?php
                                                            $foundResponses = 0;

                                                            foreach ($reponses as $reponse) {
                                                                if ($reponse['ticketid'] == $ticket['ticketid']) {
                                                                    if ( $foundResponses<2) echo $reponse['reponse'];
                                                                    $foundResponses++;
                                                                    break; // Break out of the loop after the first matching response is found
                                                            ?>


                                                            <br>
                                                            <?php }}?>
                                                            <?php if ($hasNonNullResponse === true) { ?>
                                                                <br>
                                                            <a role="button" #read_admin_contact_modal_<?php echo $reponse['reponseid']; ?> href="#read_admin_contact_modal_<?php echo $reponse['ticketid'] ?>" data-toggle="modal" > View all...</a>
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($reponses as $reponse) {
                                                                if ($reponse['ticketid'] == $ticket['ticketid']) {
                                                                    ?>
                                                                    <div class="modal fade" tabindex="-1" role="dialog" id="admin_contact_modal_<?php echo $reponse['reponseid']; ?>">
                                                                        <div class="modal-dialog" style="width:700px" role="document">
                                                                            <div class="yassine modal-content">
                                                                                <form class="with_padding contact-form" method="post" action="../../controller/reponse_process.php?reponseid=<?php echo $reponse['reponseid'] ?>">
                                                                                    <input type="hidden" name="reponseid" value="<?php echo $reponse['reponseid']; ?>">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <h2><center>Update ticket</center></h2>
                                                                                        </div>
                                                                                        <div class="col-sm-12">
                                                                                            <div class="contact-form-message">
                                                                                                <label for="reponse">Message</label>
                                                                                                <textarea style="font-size: 18px" rows="6" cols="45" name="reponse" id="reponse" class="form-control" placeholder="Message"><?php echo $reponse['reponse']; ?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-12 text-center">
                                                                                            <div class="contact-form-submit">
                                                                                                <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button wide_button color1">Update</button>
                                                                                                <button type="reset" id="contact_form_reset" name="contact_reset" class="theme_button wide_button">Clear Form</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $s=0;
                                                                    if ($reponse['ticketid']===$ticket['ticketid']) {
                                                                       ?>
                                                                    <a data-target="#admin_contact_modal_<?php echo $reponse['reponseid']; ?>" href="#admin_contact_modal_<?php echo $reponse['reponseid']; ?>" id="reponseid" data-toggle="modal">
                                                                        <i class="rt-icon2-pencil" role="button"></i>

                                                                    </a>
                                                                    <a href="../../controller/reponse_delete.php?reponseid=<?php echo $reponse['reponseid']?>" id="reponseid">
                                                                        <i class="rt-icon2-close2" role="button"></i>
                                                                        <br>
                                                                    </a>
                                                                        <?php  break;}
                                                                    ?>
                                                                <?php }} ?>

                                                        </td>
                                                        <?php
                                                        }?>
                                                    </tr>
                                                <?php
                                                }
                                                 ?>
                                            </table>
                                        </div>
                                        <!-- .table-responsive -->
                                    </div>
                                    <!-- .with_border -->
                                </div>
                                <!-- .col-* -->
                            </div>
                            <!-- .row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="pagination">
                                                <li <?php echo ($currentPage == 1) ? 'class="disabled"' : ''; ?>>
                                                    <a href="?page=<?php echo $currentPage - 1; ?>&with-selected=<?php echo $selectedOption; ?>&orderby=<?php echo $orderBy; ?>&showcount=<?php echo $showCount; ?>">
                                                        <span class="sr-only">Prev</span>
                                                        <i class="fa fa-angle-left"></i>
                                                    </a>
                                                </li>

                                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                    <li <?php echo ($currentPage == $i) ? 'class="active"' : ''; ?>>
                                                        <a href="?page=<?php echo $i; ?>&with-selected=<?php echo $selectedOption; ?>&orderby=<?php echo $orderBy; ?>&showcount=<?php echo $showCount; ?>">
                                                            <?php echo $i; ?>
                                                        </a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li <?php echo ($currentPage == $totalPages) ? 'class="disabled"' : ''; ?>>
                                                    <a href="?page=<?php echo $currentPage + 1; ?>&with-selected=<?php echo $selectedOption; ?>&orderby=<?php echo $orderBy; ?>&showcount=<?php echo $showCount; ?>">
                                                        <span class="sr-only">Next</span>
                                                        <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-6 text-md-right">
                                            Showing <?php echo $startItem + 1; ?> to <?php echo $endItem + 1; ?> of <?php echo $totalItems; ?> items
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- .row main columns -->
                        </div>
                        <!-- .container -->
                    </section></div>

                    <section class="page_copyright ds darkblue_bg_color">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="grey">&copy; Copyrights 2017</p>
                                </div>
                                <div class="col-sm-6 text-sm-right">
                                    <p class="grey">Last account activity
                                        <i class="fa fa-clock-o"></i> 52 mins ago</p>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <!-- eof #box_wrapper -->
            </div>
            <!-- eof #canvas -->


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
            <?php
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Call the function to show ticket

    readticket();

} else {
    echo "Error: Unable to connect to the database.";
}
?>