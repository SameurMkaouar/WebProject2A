<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location:../frontoffice/login.php");
}
require_once "../../model/user.php";
include_once "adminHeader.php";
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



      <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h3>Products</h3>
            </div>
            <!-- .col-* -->
          </div>
          <!-- .row -->

          <div class="row">
            <div class="col-xs-12">
              <div class="with_border with_padding">
                <div class="row admin-table-filters">
                  <div class="col-lg-9">
                    <form action="" method="get" class="form-inline filters-form" id="filtersForm">
                      <span>
                        <label class="grey" for="orderby">Sort By:</label>
                        <select class="form-control orderby" name="orderby" id="orderby">
                          <option value="date" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'date') echo 'selected'; ?>>Date</option>
                          <option value="price" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'price') echo 'selected'; ?>>Price</option>
                          <option value="title" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'title') echo 'selected'; ?>>Title</option>
                        </select>
                      </span>

                      <span>
                        <label class="grey" for="showcount">Show:</label>
                        <select class="form-control showcount" name="showcount" id="showcount">
                          <option value="5" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 5) echo 'selected'; ?>>5</option>
                          <option value="10" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 10) echo 'selected'; ?>>10</option>
                          <option value="20" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 20) echo 'selected'; ?>>20</option>
                          <option value="30" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 30) echo 'selected'; ?>>30</option>
                          <option value="50" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 50) echo 'selected'; ?>>50</option>
                        </select>
                      </span>

                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="widget-search">Search for:</label>
                    </div>
                    <input id="widget-search" type="text" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" name="search" class="form-control" placeholder="Search" />
                    <div class="input-group-append">
                      <button type="submit" class="theme_button" style="background-color: transparent; border: none;">
                        <i class="fa fa-search highlight"></i>
                      </button>
                    </div>
                  </div>

                  <style>
                    .theme_button .fa-search {
                      transition: color 0.3s ease-out;
                      /* Separate transition property for color */
                    }

                    .theme_button:hover .fa-search {
                      color: black !important;
                      transition: color 0.3s ease-in-out;
                      /* Add the ease-in-out transition effect */
                    }
                  </style>


                  <style>
                    .input-group-append {
                      display: flex;
                      align-items: center;
                    }
                  </style>
                  </form>

                  <!-- .col-* -->


                </div>
                <!-- .row -->

                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td class="media-middle text-center">
                        <input type="checkbox" />
                      </td>
                      <th>Title:</th>
                      <th>Price:</th>
                      <th>Date:</th>
                      <th>Categories:</th>
                      <th>Update:</th>
                      <th>Delete:</th>
                    </tr>
                    <?php
                    include_once '../../controller/readproduct.php';
                    ?>
                  </table>
                </div>
                <!-- .table-responsive -->
              </div>
              <!-- .with_border -->
            </div>
            <!-- .col-* -->
          </div>

          <script>
            // Auto-submit the form when sorting, showing, or search input changes
            document.getElementById('orderby').addEventListener('change', function() {
              document.getElementById('filtersForm').submit();
            });

            document.getElementById('showcount').addEventListener('change', function() {
              document.getElementById('filtersForm').submit();
            });

            document.getElementById('widget-search').addEventListener('input', function() {
              //document.getElementById('filtersForm').submit();
            });
          </script>

          <!-- .row -->
          <!-- Add this part to display the pagination links -->
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-md-6">
                  <ul class="pagination">
                    <?php
                    // Pagination links will be echoed from readproduct.php
                    ?>
                  </ul>
                </div>
                <div class="col-md-6 text-md-right">
                  Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $showcount, $totalRecords); ?> of <?php echo $totalRecords; ?> items
                </div>
              </div>
            </div>
          </div>
          <!-- End of pagination display -->

          <!-- .row main columns -->
        </div>
        <!-- .container -->
      </section>

      <section class="page_copyright ds darkblue_bg_color">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p class="grey">&copy; Copyrights 2017</p>
            </div>
            <div class="col-sm-6 text-sm-right">
              <p class="grey">
                Last account activity <i class="fa fa-clock-o"></i> 52 mins
                ago
              </p>
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
  <script src="../../assets/frontoffice/../../assets/frontoffice/js/admin/jquery.sparkline.min.js"></script>

  <!-- dashboard init -->
  <script src="../../assets/frontoffice/js/admin.js"></script>
</body>

</html>