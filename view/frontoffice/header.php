<?php

require_once "../../model/user.php";
require_once "../../model/util.php";
require_once "../../model/notifications.php";
if (is_loggedin()) {
  $notif = new notif;
  $result = $notif->getUnreadNotificationsDoc($_SESSION['user_id']);
  $numrows = count($result);
}
?>

<!DOCTYPE html>
<html lang="en">

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
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>rieveInformation
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->
  <style>
    .inline-dropdown>li {
      display: inline-block;
      margin: 0 -2px;
      padding: 8px;
      font-size: larger;
      font-weight: bold;
      color: #fff !important;
    }

    .page_header a.header-button i {
      font-size: 1.2em;
      position: relative;
      top: 0.07em;

    }

    .inline-dropdown i {

      opacity: 1 !important;
    }

    .header-dropdown-number {
      background-color: #4BB0A9 !important;

    }

    .with_background {
      background-color: #f5f5f5 !important;
      border-radius: 2px !important;
    }

    .dropdwon-menu-title {
      padding: 10px 30px !important;
    }

    .dropdown-menu {
      font-size: 13px !important;
      text-align: left !important;
      list-style: none !important;
    }

    .list-notif {
      padding: 15px !important;
    }
  </style>
</head>

<body>

  <section class="page_topline cs table_section table_section_md columns_padding_0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 text-center text-md-left">


          <?php
          // Check if the user is logged in
          if (is_loggedin()) {
            // User is logged in

            $username = $_SESSION['username'];

            echo '<div class="profile-container">';
            echo '<div class="profile-icon">';
            echo '<a href="test.php">';
            displayPicture($_SESSION['picture']);
            echo '</a>';
            echo '</div>';
            echo "<div class='logout'>";
            echo "<li>Welcome, $username! <a href='../../controller/logout.php'>Logout</a></li>";
            echo '</div>';
            echo '</div>';
          } else {
            // User is not logged in
            echo "<li><a href='login.php'>Sign In</a></li>";
          }
          ?>
        </div>

        <div class="col-md-6 text-center divided_content">

          <div>
            <div class="media small-teaser">
              <div class="media-left">
                <i class="fa fa-user highlight fontsize_16"></i>
              </div>
              <div class="media-body">
                +216 94 183 000
              </div>
            </div>
          </div>

          <div>
            <div class="media small-teaser">
              <div class="media-left">
                <i class="fa fa-map-marker highlight fontsize_16"></i>
              </div>
              <div class="media-body">
                1, Pôle Technologique, 2 Rue André Ampère، Ariana 2083
              </div>
            </div>
          </div>

          <div>
            <div class="media small-teaser">
              <div class="media-left">
                <i class="fa fa-envelope highlight fontsize_16"></i>
              </div>
              <div class="media-body">
                support@psychologist.com
              </div>
            </div>
          </div>

        </div>
        <?php if (is_loggedin()) { ?>
          <div class="pull-right big-header-buttons">
            <ul class="inline-dropdown inline-block">
              <li class="dropdown header-notes-dropdown">
                <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                  <i class="fa fa-bell-o grey"></i>


                  <?php if ($numrows > 0) : ?>
                    <span class="header-dropdown-number"> <?php echo $numrows; ?> </span>
                  <?php else : ?>
                    <span class="header-dropdown-number" style="display: none;">0</span>
                  <?php endif; ?>


                </a>

                <div class="dropdown-menu ls">
                  <div class="dropdwon-menu-title with_background ">
                    <strong><?php echo $numrows; ?> Pending</strong> Notifications

                    <div class="pull-right darklinks">
                      <a href="../../controller/viewall.php">View All</a>
                    </div>
                  </div>

                  <ul class="list-unstyled list-notif">
                    <?php
                    foreach ($result as $row) {
                    ?>

                      <li data-notification-id="<?php echo $row['Notif_id']; ?>">
                        <a href="test.php">
                          <div class="media with_background">
                            <div class="media-left media-middle">

                              <div class="teaser_icon label-success">
                                <i class="fa fa-user"></i>
                              </div>

                            </div>
                            <div class="media-body media-middle notifs">
                              <span class="grey"> <?php echo $row['Content']; ?> </span>
                              <span class="pull-right"><?php echo time_elapsed_string($row['Timestamp']); ?></span>
                            </div>
                          </div>
                        </a>
                      </li>

                    <?php } ?>
                  </ul>
                </div>
              </li>

              <li class="dropdown header-notes-dropdown">
                <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                  <i class="fa fa-envelope-o grey"></i>

                  <span class="header-dropdown-number"> 8 </span>
                </a>

                <div class="dropdown-menu ls">
                  <div class="dropdwon-menu-title with_background">
                    <strong>8 New</strong> Messages

                    <div class="pull-right darklinks">
                      <a href="#">View All</a>
                    </div>
                  </div>
                  <ul class="list1 no-bullets no-top-border no-bottom-border">
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <img src="images/team/01.jpg" alt="..." />
                        </div>
                        <div class="media-body">
                          <h5 class="media-heading">
                            <a href="#">
                              Alex Walker
                              <span class="pull-right">23 feb at 11:36</span>
                            </a>
                          </h5>
                          <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Cum, corporis.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <img src="images/team/02.jpg" alt="..." />
                        </div>
                        <div class="media-body">
                          <h5 class="media-heading">
                            <a href="#">
                              Janet C. Donnalds
                              <span class="pull-right">23 feb at 12:17</span>
                            </a>
                          </h5>
                          <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Libero itaque dolor.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <img src="images/team/03.jpg" alt="..." />
                        </div>
                        <div class="media-body">
                          <h5 class="media-heading">
                            <a href="#">
                              Victoria Grow
                              <span class="pull-right">23 feb at 16:44</span>
                            </a>
                          </h5>
                          <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Labore, esse, magni.
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="dropdown header-notes-dropdown">
                <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                  <i class="fa fa-calendar-o grey"></i>

                </a>
                <div class="dropdown-menu ls">
                  <div class="dropdwon-menu-title with_background">
                    <strong>14 Pending</strong> Tasks

                    <div class="pull-right darklinks">
                      <a href="#">View All</a>
                    </div>
                  </div>

                  <ul class="list-unstyled">
                    <li>
                      <p class="progress-bar-title grey">
                        <strong>Progress</strong>
                      </p>
                      <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="90">
                          <span>90%</span>
                        </div>
                      </div>
                    </li>

                    <li>
                      <p class="progress-bar-title grey">
                        <strong>Success</strong>
                      </p>
                      <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="52">
                          <span>52%</span>
                        </div>
                      </div>
                    </li>

                    <li>
                      <p class="progress-bar-title grey">
                        <strong>Knowing</strong>
                      </p>
                      <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" data-transitiongoal="75">
                          <span>75%</span>
                        </div>
                      </div>
                    </li>

                    <li>
                      <p class="progress-bar-title grey">
                        <strong>Rating</strong>
                      </p>
                      <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="95">
                          <span>95%</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- Uncomment following to show user menu 
				
					<li class="dropdown user-dropdown-menu">
						<a class="header-button" id="user-dropdown-menu" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
							<i class="fa fa-user grey"></i> <span class="header-button-text">User</span>
						</a>
						<div class="dropdown-menu ls">
							<ul class="nav darklinks">
								<li>
									<a href="admin_profile.html">
										<i class="fa fa-user"></i>
										Profile
									</a>
								</li>
								<li>
									<a href="admin_profile_edit.html">
										<i class="fa fa-edit"></i>
										Edit Profile
									</a>
								</li>
								<li>
									<a href="admin_inbox.html">
										<i class="fa fa-envelope-o"></i>
										Inbox
									</a>
								</li>
								<li>
									<a href="admin_signin.html">
										<i class="fa fa-sign-out"></i>
										Log Out
									</a>
								</li>
							</ul>

						</div>

					</li>
				
				-->

              <li class="dropdown visible-xs-inline-block">
                <a href="#" class="search_modal_button header-button">
                  <i class="fa fa-search grey"></i>
                  <span class="header-button-text">Search</span>
                </a>
              </li>
            </ul>
          </div>
        <?php } ?>

      </div>
    </div>
  </section>
  <script type="text/javascript" src="https://bot.insertchatgpt.com/widgets/bubble.js?widget_id=2d98b160-43e7-428b-a68b-f55ee1617297" async></script>

  <header class="page_header header_white table_section columns_padding_0 toggler-xs-right">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-5">
          <a href="./" class="logo">
            Psychologist
          </a>
          <!-- header toggler -->
          <span class="toggle_menu visible-xs">
            <span></span>
          </span>
        </div>
        <div class="col-md-6 col-sm-2 text-center">
          <!-- main nav start -->
          <nav class="mainmenu_wrapper">
            <ul class="mainmenu sf-menu">
              <li class="active">
                <a href="homepage.php">Home</a>
              </li>

              <!-- blog -->
              <li>
                <?php
                if (is_loggedin()) {
                  if ($_SESSION['role'] == 'patient')
                    echo '<a href="">My dashboard</a>
                                        <ul>
                                            <li>
                                              <a href=doctors.php>Find Doctors</a>
                                            </li>
                                            <li>
                                              <a href="viewappointements.php">View Appointements</a>
                                            </li>
                                        </ul>';
                  else
                    echo '<a href=dashbordDoc.php>Patients</a>';
                } else
                  echo '<a href=doctors.php>Doctors</a>';
                ?>



              </li>



              <!-- eof blog -->

              <li>
                <a href="blog-full.php">Forum</a>

                <!-- eof mega menu -->
              </li>
              <!-- eof features -->


              <li>
                <a href="shop-right.php">Shop</a>

              </li>
              <!-- eof pages -->

              <!-- gallery -->
              <li>
                <a href="events.php">Events</a>
                <ul>
                  <li>
                    <a href="events.php">Events</a>
                  </li>
                  <li>
                    <a href="reservations.php">My Reservations</a>
                  </li>
                </ul>
              </li>
              <!-- eof Gallery -->

              <!-- contacts -->
              <li>
                <a href="contact.html">Contact</a>
                <ul>
                  <li>
                    <a href="contact.php">Create a Ticket</a>
                  </li>
                  <li>
                    <a href="contact2.php">View replies</a>
                  </li>
                </ul>
              </li>
              <!-- eof contacts -->
            </ul>
          </nav>
          <!-- eof main nav -->
          <span class="toggle_menu hidden-xs">
            <span></span>
          </span>
        </div>
        <div class="col-md-3 col-sm-5 text-right hidden-xs lightgreylinks">
          <div class="page_social_icons divided_content">
            <span>
              <a class="social-icon soc-facebook" href="#" title="Facebook"></a>
            </span>
            <span>
              <a class="social-icon soc-twitter" href="#" title="Twitter"></a>
            </span>
            <span>
              <a class="social-icon soc-google" href="#" title="Google"></a>
            </span>
            <span>
              <a class="social-icon soc-linkedin" href="#" title="LinkedIn"></a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- template init -->
  <script>
    $(document).ready(function() {
      // Attach a click event handler to each notification
      $('ul.list-unstyled li').click(function() {

        // Get the notification ID from the clicked notification
        var notificationId = $(this).data('notification-id');

        // Make an AJAX request to markRead.php
        $.ajax({
          type: 'POST',
          url: '../../controller/markRead.php',
          data: {
            notificationId: notificationId
          },
          success: function(response) {
            // Handle the response if needed
            console.log(response);
          },
          error: function(error) {
            // Handle errors
            console.error(error);
          }
        });
      });
    });
  </script>

</body>

</html>