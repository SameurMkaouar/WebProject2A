<?php
session_start();
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";
$user=new user;
$result=$user->listDoctors();
?>

<!doctype html>
                        <html>
                            <head>
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
                                    .lnk{
                                        color: black;
                                        text-decoration: none;
                                    }
                                </style>
                            </head>
                            <body class='snippet-body'>
                            <div class="container mt-5 mb-5">
    <div class="row g-2">
    <?php foreach($result as $row){ ?>
       
        <div class="col-md-3">
        <a href="doctorProfile.php?id=<?php echo $row['Id']; ?>" class="lnk" >
            <div class="card p-2 py-3 text-center">
                <div class="img mb-2"><?php displayPicture($row['Picture']); ?></div>
                <h5 class="mb-0"><?php echo $row['Firstname'].' '.$row['Lastname']; ?></h5> <small><?php echo $row['Role']; ?></small>
                <div class="ratings mt-2"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                <div class="mt-4 apointment"> <button class="btn btn-success text-uppercase">Book Appointment</button> </div>
            </div>
        </a>
        </div>
        <?php } ?>
        
    </div>
</div>
                            <script type='text/javascript'></script>
                            </body>
                        </html>