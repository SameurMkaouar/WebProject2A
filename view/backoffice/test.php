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
										<a href="#tab2" role="tab" data-toggle="tab">Published</a>
									</li>
									
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab1">
                                    <div class="table-responsive">
                                    <table
                              class="table table-striped table-bordered"
                              id="post-table-pending"
                            >
                              <tr>
                                <td class="media-middle text-center">
                                  <input type="checkbox" />
                                </td>
                                <th>Post:</th>
                                <!-- <th>Rating:</th> -->
                                <th>Date:</th>
                                <th>User:</th>
                                <th width='86px'></th>
                              </tr>
                            </table>
                    <!-- BOUTON DELETE POST -->

                    <button
                      id="delete-button"
                      type="button"
                      class="btn btn-danger"
                      style="margin: 10px"
                    >
                      Delete
                    </button>
              </div>
									</div>
									<div class="tab-pane fade" id="tab2">
                                    <div class="table-responsive">
                                    <table
                              class="table table-striped table-bordered"
                              id="post-table-published"
                            >
                              <tr>
                                <td class="media-middle text-center">
                                  <input type="checkbox" />
                                </td>
                                <th>Post:</th>
                                <!-- <th>Rating:</th> -->
                                <th>Date:</th>
                                <th>User:</th>
                                <th></th>
                              </tr>
                            </table>
                    <!-- BOUTON DELETE POST -->

                    <button
                      id="delete-button"
                      type="button"
                      class="btn btn-danger"
                      style="margin: 10px"
                    >
                      Delete
                    </button>

              <!-- .table-responsive -->
									</div>
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
    <script src="../../assets/ressources/listPostsAdmin.js"></script>
    <script src="../../assets/ressources/deletePost.js"></script>
  </body>
    
</body>
</html>