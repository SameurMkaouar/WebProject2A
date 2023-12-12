<?php
session_start();
include_once "header.php";

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
  <meta property="og:url" content="https://yourdomain.com/your-page-url" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:image" content="../../Assets/images/profile.png" />
  <meta property="og:title" content="When Great Minds Don’t Think Alike" />
  <meta property="og:image" content="data:image/jpeg;base64,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" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="stylesheet" href="../../assets/frontoffice/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link" />

  <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>
  <link rel="stylesheet" href="../../assets/frontoffice/css/style.css" />

  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v18.0&appId=279489657921380" nonce="Yoh3jYHN"></script>

  <!-- <script src="../../Assets/js/vendor/modernizr-2.6.2.min.js"></script> -->

  <!--[if lt IE 9]>
      <script src="../../Assets/jsvendor/html5shiv.min.js"></script>
      <script src="../../Assets/jsvendor/respond.min.js"></script>
      <script src="../../Assets/jsvendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
</head>

<body>
  <!--[if lt IE 9]>
      <div class="bg-danger text-center">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/" class="highlight"
          >upgrade your browser</a
        >
        to improve your experience.
      </div>
    <![endif]-->



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
  <!-- <div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
      <div class="fw-messages-wrap ls with_padding">
        Uncomment this UL with LI to show messages in modal popup to your user: 

        <ul class="list-unstyled">
          <li>Message To User</li>
        </ul>
      </div>
    </div> -->
  <!--  eof .modal -->

  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">
      <!-- template sections -->

      <section class="page_breadcrumbs ds background_cover section_padding_50">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2>Post Page</h2>
              <ol class="breadcrumb divided_content wide_divider">
                <li>
                  <a href="./"> Home </a>
                </li>
                <li>
                  <a href="#">Blog</a>
                </li>
                <li class="active">Post Page</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="ls section_padding_top_130 section_padding_bottom_130 columns_padding_25">
        <div class="container">
          <div class="row">
            <div class="col-sm-10 col-sm-push-1">
              <div class="vertical-item content-padding with_shadow">
                <div class="entry-thumbnail item-media">
                  <img src="images/gallery/01.jpg" alt="" />
                </div>
                <div class="apsc-each-profile">
                  <a class="apsc-facebook-icon clearfix" href="#">
                    <div class="apsc-inner-block">
                      <span class="social-icon">
                        <i class="fa fa-facebook apsc-facebook"></i>
                        <span class="media-name">Facebook</span>
                      </span>
                      <span class="apsc-count">9.8K</span>
                      <span class="apsc-media-type">Fans</span>
                    </div>
                  </a>
                </div>
                <!-- ##################### POST ##################### -->
                <div class="item-content" id="post" style="padding: 5px 30px">
                  <!-- SHARE -->

                  <!-- .entry-content -->

                  <div id="button-user">
                    <div class="widget widget_apsc_widget" style="margin-top: 22px">
                      <div class="apsc-icons-wrapper clearfix apsc-theme-4">
                        <div class="apsc-each-profile">
                          <a class="apsc-facebook-icon clearfix" onclick="shareOnFacebook(event)">
                            <div class="apsc-inner-block">
                              <span class="social-icon">
                                <i class="fa fa-facebook apsc-facebook"></i>
                                <span class="media-name">Share on Facebook</span>
                              </span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr />
                  <div class="comment-respond" id="respond">
                    <form class="comment-form" id="comment_form" method="post" action="../../controller/createComment.php">
                      <div class="with_border with_padding">
                        <h3>Comment:</h3>
                        <hr />
                        <div class="row columns_margin_bottom_40">
                          <div class="col-md-12">
                            <p class="comment-form-chat">
                              <label for="comment">Comment</label>
                              <i class="rt-icon2-pencil3"></i>
                              <textarea aria-required="true" rows="1" cols="45" name="comment_content" id="comment" class="form-control" placeholder="Your comment here..."></textarea>
                            </p>
                          </div>
                        </div>

                        <button type="submit" id="submit" name="submit" class="theme_button color1 with_shadow">
                          <i class="rt-icon2-send-o"></i>
                          Send Comment
                        </button>
                      </div>
                    </form>
                  </div>
                  <!-- #respond -->

                  <div class="comments-area" id="comments">
                    <ol cl3ass="comment-list">
                      <li class="comment even thread-even depth-1 parent" id="comment_container"></li>
                      <!-- #comment-## -->
                    </ol>
                    <!-- .comment-list -->
                  </div>
                  <!-- #comments -->
                </div>
              </div>
            </div>
            <!--eof .col-sm-8 (main content)-->
          </div>
        </div>
      </section>

      <?php include_once('footerfront.php'); ?>

      <section class="cs main_color2 page_copyright section_padding_15">
        <div class="container with_top_border">
          <div class="row">
            <div class="col-sm-12 text-center">
              <p class="small-text">
                &copy; 2017 Psychology and Counseling. All Rights Reserved
              </p>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- eof #box_wrapper -->
  </div>
  <!-- eof #canvas -->
  <script src="../../assets/ressources/showSinglePost.js"></script>
  <script src="../../assets/ressources/showComments.js"></script>
  <script src="../../assets/ressources/facebook.js"></script>
</body>

</html>