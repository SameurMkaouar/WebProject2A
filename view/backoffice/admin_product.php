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
            <div class="col-sm-12">
              <h3>
                Single product
                <small class="pull-right">
                  <a href="admin_comments.html">
                    <i class="fa fa-comments"></i> product discussion</a>
                </small>
              </h3>
            </div>
          </div>
          <!-- .row -->
          <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
          <style>
            .error-message {
              color: red;
            }
          </style>
          <form class="form-horizontal" method="post" action="../../controller/createproduct.php" enctype="multipart/form-data" id="productForm">
            <div class="row">
              <div class="col-md-8">
                <div class="with_border with_padding">
                  <h4>Product text</h4>
                  <hr />

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Product title:</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="productTitle" />
                      <div id="productTitleError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Product slug:</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="productSlug" />
                      <div id="productSlugError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group admin-product-price">
                    <label class="col-lg-3 control-label">Product Price:</label>
                    <div class="col-lg-9">
                      <input type="number" step="0.01" class="form-control" name="productPrice" />
                      <div id="productPriceError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Short description:</label>
                    <div class="col-lg-9">
                      <textarea rows="3" class="form-control" name="productShortDesc"></textarea>
                      <div id="productShortDescError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Product description:</label>
                    <div class="col-lg-9">
                      <textarea rows="8" class="form-control" name="productDesc"></textarea>
                      <div id="productDescError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 text-right">
                      <button type="submit" class="theme_button wide_button">
                        Save product
                      </button>
                      <a href="admin_products.php" class="theme_button inverse wide_button">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="with_border with_padding bottommargin_10">
                  <h4>Product Meta</h4>
                  <hr />

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Publish date:</label>
                    <div class="col-lg-9">
                      <input type="date" class="form-control" name="productPublishDate" />
                      <div id="productPublishDateError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Publish time:</label>
                    <div class="col-lg-9">
                      <input type="time" class="form-control" name="productPublishTime" />
                      <div id="productPublishTimeError" class="error-message"></div>
                    </div>
                  </div>
                </div>

                <div class="with_border with_padding bottommargin_10">
                  <h4>Tags and Categories</h4>
                  <hr />
                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Categories:</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="productCategory" />
                      <div id="productCategoryError" class="error-message"></div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-lg-3 control-label">Product Tags:</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" name="productTags" />
                      <div id="productTagsError" class="error-message"></div>
                    </div>
                  </div>
                </div>

                <div class="with_border with_padding">
                  <h4>Product Media</h4>
                  <hr />

                  <div class="item-editable bottommargin_20">
                    <div class="item-media">
                      <img src="../../assets/frontoffice/images/gallery/01.jpg" alt="..." />
                    </div>

                    <div class="item-edit-controls darklinks">
                      <a href="#">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#">
                        <i class="fa fa-trash-o"></i>
                      </a>
                    </div>
                  </div>

                  <div>
                    <label class="control-label">Product Image:</label>
                    <input type="file" accept="image/*" name="productMedia" required />
                    <div id="productMediaError" class="error-message"></div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <script>
            $(document).ready(function() {
              function validateProductTitle() {
                var title = $("input[name='productTitle']").val();
                if (!/^[a-zA-Z ]+$/.test(title)) {
                  $("#productTitleError").text(
                    "Please enter a valid title (only letters and spaces)."
                  );
                  $("input[name='productTitle']").css("border-color", "red");
                  return false;
                } else {
                  $("#productTitleError").text("");
                  $("input[name='productTitle']").css("border-color", "");
                  return true;
                }
              }

              function validateProductSlug() {
                var slug = $("input[name='productSlug']").val();
                if (!/^[a-zA-Z]+$/.test(slug)) {
                  $("#productSlugError").text(
                    "Please enter a valid slug (only letters)."
                  );
                  $("input[name='productSlug']").css("border-color", "red");
                  return false;
                } else {
                  $("#productSlugError").text("");
                  $("input[name='productSlug']").css("border-color", "");
                  return true;
                }
              }

              function validateProductPrice() {
                var price = $("input[name='productPrice']").val();
                if (isNaN(price)) {
                  $("#productPriceError").text(
                    "Please enter a valid price (only numbers)."
                  );
                  $("input[name='productPrice']").css("border-color", "red");
                  return false;
                } else {
                  $("#productPriceError").text("");
                  $("input[name='productPrice']").css("border-color", "");
                  return true;
                }
              }

              function validateProductShortDesc() {
                var shortDesc = $("textarea[name='productShortDesc']").val();
                if (shortDesc.length < 5) {
                  $("#productShortDescError").text(
                    "Short description should have at least 5 characters."
                  );
                  $("textarea[name='productShortDesc']").css(
                    "border-color",
                    "red"
                  );
                  return false;
                } else {
                  $("#productShortDescError").text("");
                  $("textarea[name='productShortDesc']").css(
                    "border-color",
                    ""
                  );
                  return true;
                }
              }

              function validateProductDesc() {
                var productDesc = $("textarea[name='productDesc']").val();
                if (productDesc.length < 10) {
                  $("#productDescError").text(
                    "Product description should have at least 10 characters."
                  );
                  $("textarea[name='productDesc']").css(
                    "border-color",
                    "red"
                  );
                  return false;
                } else {
                  $("#productDescError").text("");
                  $("textarea[name='productDesc']").css("border-color", "");
                  return true;
                }
              }

              function validateProductPublishDate() {
                var publishDate = $("input[name='productPublishDate']").val();
                if (!publishDate) {
                  $("#productPublishDateError").text(
                    "Please enter a valid publish date."
                  );
                  $("input[name='productPublishDate']").css(
                    "border-color",
                    "red"
                  );
                  return false;
                } else {
                  $("#productPublishDateError").text("");
                  $("input[name='productPublishDate']").css(
                    "border-color",
                    ""
                  );
                  return true;
                }
              }

              function validateProductPublishTime() {
                var publishTime = $("input[name='productPublishTime']").val();
                if (!publishTime) {
                  $("#productPublishTimeError").text(
                    "Please enter a valid publish time."
                  );
                  $("input[name='productPublishTime']").css(
                    "border-color",
                    "red"
                  );
                  return false;
                } else {
                  $("#productPublishTimeError").text("");
                  $("input[name='productPublishTime']").css(
                    "border-color",
                    ""
                  );
                  return true;
                }
              }

              function validateProductCategory() {
                var category = $("input[name='productCategory']").val();
                if (!/^[a-zA-Z]+$/.test(category)) {
                  $("#productCategoryError").text(
                    "Please enter a valid category (only letters)."
                  );
                  $("input[name='productCategory']").css(
                    "border-color",
                    "red"
                  );
                  return false;
                } else {
                  $("#productCategoryError").text("");
                  $("input[name='productCategory']").css("border-color", "");
                  return true;
                }
              }

              function validateProductTags() {
                var tags = $("input[name='productTags']").val();
                if (!/^[a-zA-Z]+$/.test(tags)) {
                  $("#productTagsError").text(
                    "Please enter valid tags (only letters)."
                  );
                  $("input[name='productTags']").css("border-color", "red");
                  return false;
                } else {
                  $("#productTagsError").text("");
                  $("input[name='productTags']").css("border-color", "");
                  return true;
                }
              }

              function validateProductMedia() {
                var media = $("input[name='productMedia']").val();
                if (!media) {
                  $("#productMediaError").text(
                    "Please select a product image."
                  );
                  $("input[name='productMedia']").css("border-color", "red");
                  return false;
                } else {
                  $("#productMediaError").text("");
                  $("input[name='productMedia']").css("border-color", "");
                  return true;
                }
              }

              $("#productForm").submit(function(event) {
                if (
                  !validateProductTitle() ||
                  !validateProductSlug() ||
                  !validateProductPrice() ||
                  !validateProductShortDesc() ||
                  !validateProductDesc() ||
                  !validateProductPublishDate() ||
                  !validateProductPublishTime() ||
                  !validateProductCategory() ||
                  !validateProductTags() ||
                  !validateProductMedia()
                ) {
                  event.preventDefault();
                }
              });

              $("input[name='productTitle']").on(
                "input",
                validateProductTitle
              );
              $("input[name='productSlug']").on("input", validateProductSlug);
              $("input[name='productPrice']").on(
                "input",
                validateProductPrice
              );
              $("textarea[name='productShortDesc']").on(
                "input",
                validateProductShortDesc
              );
              $("textarea[name='productDesc']").on(
                "input",
                validateProductDesc
              );
              $("input[name='productPublishDate']").on(
                "input",
                validateProductPublishDate
              );
              $("input[name='productPublishTime']").on(
                "input",
                validateProductPublishTime
              );
              $("input[name='productCategory']").on(
                "input",
                validateProductCategory
              );
              $("input[name='productTags']").on("input", validateProductTags);
              $("input[name='productMedia']").on(
                "change",
                validateProductMedia
              );
            });
          </script>
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
  <script src="../../assets/frontoffice/js/admin/jquery.sparkline.min.js"></script>

  <!-- dashboard init -->
  <script src="../../assets/frontoffice/js/admin.js"></script>
</body>

</html>