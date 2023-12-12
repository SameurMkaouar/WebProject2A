<?php

require_once "../../model/user.php";
require_once "../../model/util.php";
require_once "../../model/notifications.php";
require_once "../../model/post.php";

$notif = new notif;
$resultnotif = $notif->getUnreadNotificationsAdmin();
$numRows = count($resultnotif);

$user1 = new user;
$result1 = $user1->pending();
$list1 = $result1->fetchAll(PDO::FETCH_ASSOC);
$numpendingReg = count($list1);

$post = new post();
$result2 = $post->getPendingPosts();
$numPendingPosts = count($result2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Psychologist</title>
  <meta charset="utf-8" />
  <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <link rel="stylesheet" href="../../assets/frontoffice/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/dashboard.css" class="color-switcher-link" />
  <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
      <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
  <style>
    ul.list-unstyled li {
      cursor: pointer;
      /* Change cursor style to pointer */
    }

    .notifs {
      transition: background-color 0.3s ease;
      /* Add smooth transition to background-color property */
    }

    .notifs:hover {

      background-color: thistle;
    }
  </style>
</head>

<body>
  <header class="page_header_side page_header_side_sticked active-slide-side-header ds">
    <div class="side_header_logo ds ms">
      <a href="./admin_index.html">
        <span class="logo_text"> Psychologist </span>
      </a>
    </div>
    <span class="toggle_menu_side toggler_light header-slide">
      <span></span>
    </span>
    <div class="scrollbar-macosx">
      <div class="side_header_inner">
        <!-- user -->

        <div class="user-menu">
          <ul class="menu-click">
            <li>
              <a href="#">
                <div class="media">
                  <div class="media-left media-middle">
                    <?php displayPicture($_SESSION['picture']); ?>
                  </div>
                  <div class="media-body media-middle">
                    <h4><?php echo $_SESSION['username']; ?></h4>
                    Administrator
                  </div>
                </div>
              </a>
              <ul>
                <li>
                  <a href="admin_profile.php">
                    <i class="fa fa-user"></i>
                    Profile
                  </a>
                </li>
                <li>
                  <a href="admin_profile_edit.php">
                    <i class="fa fa-edit"></i>
                    Edit Profile
                  </a>
                </li>
                <li>
                  <a href="admin_inbox.php">
                    <i class="fa fa-envelope-o"></i>
                    Inbox
                  </a>
                </li>
                <li>
                  <a href="../../controller/logout.php">
                    <i class="fa fa-sign-out"></i>
                    Log Out
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- main side nav start -->
        <nav class="mainmenu_side_wrapper">
          <h3 class="dark_bg_color">Dashboard</h3>
          <ul class="menu-click">
            <li>
              <a href="admin_index.php">
                <i class="fa fa-th-large"></i>
                Dashboard
              </a>
            </li>
          </ul>

          <h3 class="dark_bg_color">Pages</h3>
          <ul class="menu-click">
            <li>
              <a href="#">
                <i class="fa fa-user"></i>
                Account
              </a>
              <ul>
                <li>
                  <a href="admin_profile.html"> Profile </a>
                </li>
                <li>
                  <a href="admin_profile_edit.html"> Edit Profile </a>
                </li>
                <li>
                  <a href="admin_inbox.html"> Inbox </a>
                </li>
                <li>
                  <a href="admin_signin.html"> Sign In </a>
                </li>
                <li>
                  <a href="admin_signup.html"> Sign Up </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="tabs.php">
                <i class="fa fa-file-text"></i>
                lists <?php if ($numpendingReg > 0) : ?>
                  <span class="posts-number"> <?php echo $numpendingReg; ?> </span>
                <?php else : ?>
                  <span class="posts-number" style="display: none;">0</span>
                <?php endif; ?>
              </a>

            </li>
            <li>
              <a href="admin_posts.html">
                <i class="fa fa-file-text"></i>
                Posts <?php if ($numPendingPosts > 0) : ?>
                  <span class="posts-number"> <?php echo $numPendingPosts; ?> </span>
                <?php else : ?>
                  <span class="posts-number" style="display: none;">0</span>
                <?php endif; ?>
              </a>
              <ul>
                <li>
                  <a href="test.php"> Posts </a>
                </li>
                <li>
                  <a href="admin_post.php"> Single Post </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="admin_products.html">
                <i class="fa fa-suitcase"></i>
                Products
              </a>
              <ul>
                <li>
                  <a href="admin_products.html"> Products </a>
                </li>
                <li>
                  <a href="admin_product.html"> Single Product </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="admin_orders.php">
                <i class="fa fa-shopping-cart"></i>
                Orders
              </a>

            </li>


            <li>
              <a href="backview.php">
                <i class="fa fa-support"></i>
                Events
              </a>
              <ul>
                <li>
                  <a href="backview.php"> Events </a>
                </li>
                <li>
                  <a href="addevents.php"> Single Event </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="admin_tickets.php">
                <i class="fa fa-ticket"></i>
                Tickets
              </a>

            </li>

          </ul>

          <h3 class="dark_bg_color">UI Elements</h3>
          <ul class="menu-click">
            <li>
              <a href="admin_tables.html">
                <i class="fa fa-table"></i>
                Tables
              </a>
            </li>
            <li>
              <a href="admin_forms.html">
                <i class="fa fa-check-square-o"></i>
                Forms
              </a>
            </li>
            <li>
              <a href="admin_bootstrap.html">
                <i class="fa fa-cog"></i>
                Bootstrap
              </a>
            </li>
          </ul>
        </nav>
        <!-- eof main side nav -->

        <div class="with_padding grey text-center">
          10GB of
          <strong>250GB</strong> Free
        </div>
      </div>
    </div>
  </header>

  <header class="page_header header_darkgrey">
    <div class="widget widget_search">
      <form method="get" class="searchform form-inline" action="/">
        <div class="form-group">
          <label class="screen-reader-text" for="widget-search-header">Search for:</label>
          <input id="widget-search-header" type="text" value="" name="search" class="form-control" placeholder="Search" />
        </div>
        <button type="submit" class="theme_button">Search</button>
      </form>
    </div>

    <div class="pull-right big-header-buttons">
      <ul class="inline-dropdown inline-block">
        <li class="dropdown header-notes-dropdown">
          <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
            <i class="fa fa-bell-o grey"></i>
            <span class="header-button-text">Messages</span>
            <?php if ($numRows > 0) : ?>
              <span class="header-dropdown-number"> <?php echo $numRows; ?> </span>
            <?php else : ?>
              <span class="header-dropdown-number" style="display: none;">0</span>
            <?php endif; ?>
          </a>

          <div class="dropdown-menu ls">
            <div class="dropdwon-menu-title with_background ">
              <strong><?php echo $numRows; ?> Pending</strong> Notifications

              <div class="pull-right darklinks">
                <a href="../../controller/viewall.php">View All</a>
              </div>
            </div>

            <ul class="list-unstyled list-notif">
              <?php
              foreach ($resultnotif as $row) {
              ?>

                <li data-notification-id="<?php echo $row['Notif_id']; ?>">
                  <a href="tabs.php">
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <?php if ($row['Type'] === "registration") { ?>
                          <div class="teaser_icon label-success">
                            <i class="fa fa-user"></i>
                          </div>
                        <?php } else if ($row['Type'] === "post") { ?>
                          <div class="teaser_icon label-info">
                            <i class="rt-icon2-file"></i>
                          </div>
                        <?php } ?>
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
          <?php include "./ticket_messages.php"; ?>
        </li>

        <li class="dropdown header-notes-dropdown">
          <?php include "./ticket_tasks.php"; ?>
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
    <!-- eof .header_right_buttons -->
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