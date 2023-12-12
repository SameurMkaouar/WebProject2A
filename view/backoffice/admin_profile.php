<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location:../frontoffice/login.php");
}
require_once "../../model/user.php";
include "adminHeader.php";
$user = new user();
$userInfo = $user->retrieveInformation($_SESSION['user_id']);

// Check if information is retrieved successfully
if (!empty($userInfo)) {
  // Access the first element of the array (assuming it's a single user record)
  $userRecord = $userInfo[0];

  // Process or store the information as needed
  $username = isset($userRecord['Username']) ? $userRecord['Username'] : "Default Username";
  $email = isset($userRecord['Email']) ? $userRecord['Email'] : "Default Email";
  $password = isset($userRecord['Password']) ? $userRecord['Password'] : "Default Password";
  $firstname = isset($userRecord['Firstname']) ? $userRecord['Firstname'] : "Default Firstname";
  $lastname = isset($userRecord['Lastname']) ? $userRecord['Lastname'] : "Default Lastname";
  $sex = isset($userRecord['Sex']) ? $userRecord['Sex'] : "Default Sex";
  $ImageData = isset($userRecord['Picture']) ? $userRecord['Picture'] : "Default Picture";
  $picture = base64_encode($ImageData);
  $DoB = isset($userRecord['DateOfBirth']) ? $userRecord['DateOfBirth'] : "Default Date of Birth";
  $crdate = isset($userRecord['CreationDate']) ? $userRecord['CreationDate'] : "Default Creation Date";
  $role = isset($userRecord['Role']) ? $userRecord['Role'] : "Default Role";

  // Now you can use $username, $email, $password, etc.

} else {
  // Handle the case when no information is retrieved or an error occurs
  echo "Failed to retrieve user information.";
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

  <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
      <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
</head>

<body class="admin">
  <!--[if lt IE 9]>
      <div class="bg-danger text-center">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/" class="highlight"
          >upgrade your browser</a
        >
        to improve your experience.
      </div>
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
          <input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input" />
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

  <!-- Unyson messages modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="admin_contact_modal">
    <!-- <div class="ls with_padding"> -->
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <form class="with_padding contact-form" method="post" action="/">
          <div class="row">
            <div class="col-sm-12">
              <h3>Contact Admin</h3>
              <div class="contact-form-name">
                <label for="name">Full Name
                  <span class="required">*</span>
                </label>
                <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name" />
              </div>
            </div>
            <div class="col-sm-12">
              <div class="contact-form-subject">
                <label for="subject">Subject
                  <span class="required">*</span>
                </label>
                <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject" />
              </div>
            </div>

            <div class="col-sm-12">
              <div class="contact-form-message">
                <label for="message">Message</label>
                <textarea aria-required="true" rows="6" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
              </div>
            </div>

            <div class="col-sm-12 text-center">
              <div class="contact-form-submit">
                <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button wide_button color1">
                  Send Message
                </button>
                <button type="reset" id="contact_form_reset" name="contact_reset" class="theme_button wide_button">
                  Clear Form
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- eof .modal -->

  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">
      <!-- template sections -->



      <section class="ls with_bottom_border">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <ol class="breadcrumb darklinks">
                <li>
                  <a href="#">Dashboard</a>
                </li>
                <li class="active">Profile</li>
              </ol>
            </div>
            <!-- .col-* -->
            <div class="col-md-6 text-md-right">
              <span class="dashboard-daterangepicker">
                <i class="fa fa-calendar"></i>
                <span></span>
                <i class="caret"></i>
              </span>
            </div>
            <!-- .col-* -->
          </div>
          <!-- .row -->
        </div>
        <!-- .container -->
      </section>

      <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <h3>
                User
                <small>profile</small>
              </h3>
            </div>
          </div>
          <!-- .row -->
          <div class="wrap-forms">
            <div class="row">
              <div class="col-sm-12">

                <input class="theme_button wide_button" type="reset" value="Clear" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-9">
              <div class="row">
                <!-- User Bio -->
                <div class="col-xs-12 col-sm-12">
                  <div class="with_border with_padding">
                    <div class="media big-left-media">
                      <div class="media-left">

                        <img src="data:image/jpeg;base64,<?php echo $picture; ?>" alt="Image">

                      </div>
                      <div class="media-body">
                        <h4>
                          <?php echo $firstname . ' ' . $lastname; ?>
                          <small><?php echo $role; ?></small>
                        </h4>
                        <p>
                          As the Website Administrator for our psychology-focused platform, you are the backbone of our digital presence. Your primary responsibility is to oversee the day-to-day functioning of the website, ensuring that it remains a reliable and user-friendly resource for our community of users interested in psychology.


                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- .with_border -->
                </div>
                <!-- .col-* -->
              </div>
              <!-- .row -->

              <div class="row">
                <!-- User Info -->
                <div class="col-xs-12 col-md-6">
                  <div class="with_border with_padding">
                    <h4>User Info</h4>

                    <ul class="list1 no-bullets">
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-warning round fontsize_16">
                              <i class="fa fa-globe"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Location: </strong>
                            Tunisia
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-success round fontsize_16">
                              <i class="fa fa-flag"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Date of birth: </strong>
                            <?php echo $DoB; ?>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-info round fontsize_16">
                              <i class="fa fa-briefcase"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Sex: </strong>
                            <?php echo $sex; ?>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- .with_border -->
                </div>
                <!-- col-* -->

                <!-- User Statistics -->
                <div class="col-xs-12 col-md-6">
                  <div class="with_border with_padding">
                    <h4>User Statistics</h4>

                    <ul class="list1 no-bullets">
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-success fontsize_16">
                              <i class="fa fa-comments"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Comments: </strong>
                            146
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-info fontsize_16">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Member sicne: </strong>
                            <?php echo $crdate; ?>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media small-teaser">
                          <div class="media-left media-middle">
                            <div class="teaser_icon label-warning fontsize_16">
                              <i class="fa fa-bolt"></i>
                            </div>
                          </div>
                          <div class="media-body media-middle">
                            <strong class="grey"> Last activity: </strong>
                            2 days ago
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- .with_border -->
                </div>
                <!-- col-* -->
              </div>
              <!-- .row -->


              <!-- .row -->
            </div>
            <!-- .col-* left column -->

            <div class="col-xs-12 col-md-3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel-group bottommargin_0" id="contact-info-accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="icon-tab" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse1">
                            <i class="highlight fontsize_16 fa fa-phone"></i>
                            <?php echo $username; ?>
                          </a>
                        </h4>
                      </div>
                    </div>
                    <!-- .panel -->

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse2">
                            <i class="highlight fontsize_16 fa fa-mobile"></i>
                            Mobile Phone
                          </a>
                        </h4>
                      </div>
                      <div id="user-info-collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>
                            <strong>+216 00 000 000 </strong>
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- .panel -->

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse3">
                            <i class="highlight fontsize_16 fa fa-envelope"></i>
                            E-mail address
                          </a>
                        </h4>
                      </div>
                      <div id="user-info-collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p class="greylinks">
                            <?php echo $email ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- .panel -->

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse4">
                            <i class="highlight fontsize_16 fa fa-map-marker"></i>
                            Address
                          </a>
                        </h4>
                      </div>
                      <div id="user-info-collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit, sed do eiusmod
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- .panel -->

                    <!-- .panel -->
                  </div>
                  <!-- .panel-group -->
                </div>
                <!-- .col-* -->

                <!-- .col -->
              </div>
              <!-- .row -->
            </div>
            <!-- .col-* right column -->
          </div>
          <!-- .row main columns -->
        </div>
        <!-- .container -->
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
              <input type="text" class="form-control" id="side-chat-message" placeholder="Message" />
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