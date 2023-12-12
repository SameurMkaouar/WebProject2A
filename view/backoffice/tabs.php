<?php 
session_start();
if (!isset($_SESSION["user_id"])){
  header("Location:../frontoffice/login.php");
}
include_once "adminHeader.php";
require_once "../../model/user.php";

$user1 = new user;
$result1=$user1->pending();
$user2 = new user;
$result2=$user2->listPatients();
$user3 = new user;
$result3=$user3->listDoctors();
$result4=$user1->listbanned();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css" />
    <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />
    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/main.css"
      class="color-switcher-link"
    />
    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/dashboard.css"
      class="color-switcher-link"
    />
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="col-md-6 tabs">
							<div class="with_border with_padding ">

								<h4>Tabs</h4>

								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="active">
										<a href="#tab1" role="tab" data-toggle="tab">Pending</a>
									</li>
									<li>
										<a href="#tab2" role="tab" data-toggle="tab">Users</a>
									</li>
									<li>
										<a href="#tab3" role="tab" data-toggle="tab">Doctors</a>
									</li>
									<li>
										<a href="#tab4" role="tab" data-toggle="tab">Banned</a>
									</li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab1">
                                    <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <tr>
                   
                    
                    <th>username:</th>
                    <th>id:</th>
                    <th>firstname</th>
                    <th>lastname:</th>
                    <th>email:</th>
                    <th>role:</th>
                    <th>Creation_date:</th>
                    <th width='50px'></th>
                  </tr>
                  <?php
foreach( $result1 as $row)
{
    ?> 
                  <tr class="item-editable">
                    <td>
                          <h5><?=$row['Username'];?></h5>
                    </td>
                    <td>
                    <h5><?=$row['Id'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Firstname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Lastname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Email'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Role'];?></h5>
                    </td>
                    <td class="media-middle"><?=$row['CreationDate'];?></td>
                    <td class="media-middle text-center" width='100px'>
                    <a href="../../controller/acceptpending.php?id=<?php echo $row["Id"];?>"><i class="rt-icon2-checkmark"></i></a>
                    <a href="../../controller/deleteuser.php?id=<?php echo $row["Id"];?>"><i class="rt-icon2-cancel" ></i></a>
                    <a href="visitprofile.php?id=<?php echo $row["Id"];?>"><i class="fa fa-user-md" ></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
									</div>
									<div class="tab-pane fade" id="tab2">
                                    <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  

                    
                    <th>username:</th>
                    <th>id:</th>
                    <th>firstname</th>
                    <th>lastname:</th>
                    <th>email:</th>
                    <th>role:</th>
                    <th>Creation_date:</th>
                    <th></th>
                  </tr>
                  <?php
foreach( $result2 as $row)
{
    ?> 
                  <tr class="item-editable">
                    
                    <td>
                          <h5><?=$row['Username'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Id'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Firstname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Lastname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Email'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Role'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['CreationDate'];?></h5>
                    </td>
                    <td width='75px'>
                    <a href="../../controller/ban.php?id=<?php echo $row["Id"];?>"><i class="fa fa-ban" ></i></a>
                    <a href="visitprofile.php?id=<?php echo $row["Id"];?>"><i class="fa fa-user"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>

              <!-- .table-responsive -->
									</div>
									<div class="tab-pane fade" id="tab3">
                                    <div class="table-responsive">
                <table class="table table-striped table-bordered">
                 
                    
                    <th>username:</th>
                    <th>id:</th>
                    <th>firstname</th>
                    <th>lastname:</th>
                    <th>email:</th>
                    <th>role:</th>
                    <th>Creation_date:</th>
                    <th></th>
                  </tr>
                  <?php
foreach( $result3 as $row)
{
    ?> 
                  <tr class="item-editable">
                    
                    <td>
                      <div class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                          <h5><?=$row['Username'];?></h5>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5><?=$row['Id'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Firstname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Lastname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Email'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Role'];?></h5>
                    </td>
                    <td class="media-middle"><?=$row['CreationDate'];?></td>
                    <td width='75px'>
                      <?php if ($row["Status"]!=="banned"){ ?>
                    <a href="../../controller/ban.php?id=<?php echo $row["Id"];?>"><i class="fa fa-ban" ></i></a>
                    <a href="visitprofile.php?id=<?php echo $row["Id"];?>"><i class="fa fa-user-md"></i></a>
                    <?php } else{?>
                    <a href="visitprofile.php?id=<?php echo $row["Id"];?>"><i class="fa fa-user-md"></i></a>
                    <?php }?>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
									</div>
                  <div class="tab-pane fade" id="tab4">
                                    <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  

                    
                    <th>username:</th>
                    <th>id:</th>
                    <th>firstname</th>
                    <th>lastname:</th>
                    <th>email:</th>
                    <th>role:</th>
                    <th>Creation_date:</th>
                    <th></th>
                  </tr>
                  <?php
foreach( $result4 as $row)
{
    ?> 
                  <tr class="item-editable">
                    
                    <td>
                          <h5><?=$row['Username'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Id'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Firstname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Lastname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Email'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Role'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['CreationDate'];?></h5>
                    </td>
                    <td width='75px'>
                    <a href="../../controller/unban.php?id=<?php echo $row["Id"];?>"><i class="rt-icon2-plus" ></i></a>
                    <a href="visitprofile.php?id=<?php echo $row["Id"];?>"><i class="fa fa-user"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>

              <!-- .table-responsive -->
									</div>
								</div>

							</div>
							<!-- .with_border -->

						</div>
						<!-- .col-* -->

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