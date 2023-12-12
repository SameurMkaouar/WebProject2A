<?php
session_start();
include_once "header.php";
require_once "../../model/appoi.php";
$app = new appointment;
$result = $app->listAppPendingDoctor($_SESSION['user_id']);
$result2 = $app->doctorAppOnline($_SESSION['user_id']);
$result3 = $app->doctorAppIRL($_SESSION['user_id']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link">
    <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css">

    <style>
        .lnk {
            color: black;
            text-decoration: none;
        }
    </style>
    <title>Document</title>
</head>

<body>





    <div class="row">
        <div class="col-md-6 ">
            <div class="with_border with_padding ">

                <h4>Tabs</h4>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#tab1" role="tab" data-toggle="tab">Pending</a>
                    </li>
                    <li>
                        <a href="#tab2" role="tab" data-toggle="tab">online</a>
                    </li>
                    <li>
                        <a href="#tab3" role="tab" data-toggle="tab">IRL</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in" id="tab1">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><i class="fa fa-hourglass-end"></i> Pending</h3>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion1">
                            <?php foreach ($result as $index => $row) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1_<?php echo $index; ?>">
                                                <i class="rt-icon2-bubble highlight"></i>
                                                <?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?>
                                                <small style="float: right;"><?php echo date('d M Y', strtotime($row['date'])); ?></small>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse1_<?php echo $index; ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <a href="">click here</a>
                                            <a href="../../controller/denyAppoint.php?id_app=<?php echo $row['id']; ?>">
                                                <i style="font-size: 20px; float: right;" class="rt-icon2-minus"></i>
                                            </a>
                                            <a href="../../controller/confirmAppointment.php?id_app=<?php echo $row['id']; ?>">
                                                <i style="font-size: 20px; float: right;" class="rt-icon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tab2">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><i class="fa fa-laptop"></i> ONLINE</h3>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion2">
                            <?php foreach ($result2 as $index => $row) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2_<?php echo $index; ?>">
                                                <i class="rt-icon2-head"></i>
                                                <?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?>
                                                <small style="float: right;"><?php echo date('d M Y', strtotime($row['date'])); ?></small>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2_<?php echo $index; ?>" class="panel-collapse collapse <?php echo ($index === 0) ? 'in' : ''; ?>">
                                        <div class="panel-body">
                                            <a href="call.php">click to join room</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tab3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><i class="fa fa-building"></i>&ensp;IRL</h3>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion3">
                            <?php foreach ($result3 as $index => $row) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion3" href="#collapse3_<?php echo $index; ?>">
                                                <i class="rt-icon2-head"></i>
                                                <?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3_<?php echo $index; ?>" class="panel-collapse collapse <?php echo ($index === 0) ? 'in' : ''; ?>">
                                        <div class="panel-body">
                                            <!-- Content for tab3 -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <div class="col-xs-12 col-md-6">

            <h3 class="module-title darkgrey_bg_color"><i class="rt-icon2-time"></i>My
                Schedule</h3>
            <div class="events_calendar"></div>
            <!-- Calendar -->
            <div class="col-xs-12 col-md-6 dashboard-map">
                <div id="calendar"></div>
            </div>


        </div> <!-- .col-* -->

        <!-- .col-* -->
    </div>
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
    <script src="../../assets/frontoffice/js/admin.js"></script>
</body>

</html>
<script src="../../assets/frontoffice/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
<script src="../../assets/frontoffice/js/admin/jquery-jvectormap-world-mill.js"></script>
<!-- small charts -->
<script src="../../assets/frontoffice/js/admin/jquery.sparkline.min.js"></script>

<!-- dashboard init -->
<script src="../../assets/frontoffice/js/admin.js"></script>
</body>

</html>