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
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="stylesheet" href="../../assets/frontoffice/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/style.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/main.css" class="color-switcher-link" />

  <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>
  <script src="https://use.fontawesome.com/fe459689b4.js"></script>

  <!--[if lt IE 9]>
      <script src="../../Assets/js/vendor/html5shiv.min.js"></script>
      <script src="../../Assets/js/vendor/respond.min.js"></script>
      <script src="../../Assets/js/vendor/jquery-1.12.4.min.js"></script>
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

  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">
      <!-- template sections -->





      <section class="ls section_padding_top_130 section_padding_bottom_100">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="cs intro_section blog_slider">
                <div class="flexslider" data-nav="false">
                  <ul class="slides">
                    <li>
                      <img src="../../Assets/images/gallery/01.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12 text-center">
                            <div class="slide_description_wrapper">
                              <div class="slide_description">
                                <div class="intro-layer" data-animation="fadeInUp">
                                  <h4>
                                    Welcome to Psychologist
                                    <br />
                                    &amp; Evolution of Conscious
                                  </h4>
                                </div>
                              </div>
                              <!-- eof .slide_description -->
                            </div>
                            <!-- eof .slide_description_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>
                    <li>
                      <img src="../../Assets/images/gallery/02.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12 text-center">
                            <div class="slide_description_wrapper">
                              <div class="slide_description">
                                <div class="intro-layer" data-animation="fadeInUp">
                                  <h4>
                                    Welcome to Psychologist
                                    <br />
                                    &amp; Evolution of Conscious
                                  </h4>
                                </div>
                              </div>
                              <!-- eof .slide_description -->
                            </div>
                            <!-- eof .slide_description_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>
                    <li>
                      <img src="../../Assets/images/gallery/03.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12 text-center">
                            <div class="slide_description_wrapper">
                              <div class="slide_description">
                                <div class="intro-layer" data-animation="fadeInUp">
                                  <h4>
                                    Welcome to Psychologist
                                    <br />
                                    &amp; Evolution of Conscious
                                  </h4>
                                </div>
                              </div>
                              <!-- eof .slide_description -->
                            </div>
                            <!-- eof .slide_description_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>
                  </ul>
                </div>
                <!-- eof flexslider -->
              </div>
            </div>
          </div>
          <div class="col-sm-15 col-sm-push-1">
            <div id="button-publish">
              <button class="theme_button" onclick="window.location.href = 'blog-form.html';" style="margin-right: 40px">
                <i class="fa fa-send"></i>
                Publish Post
              </button>
              <ul class="nav nav-tabs" role="tablist">
                <li>
                  <a href="" role="tab" data-toggle="tab" onclick="fetchPosts('recent')" style="cursor: pointer"><i class="fa fa-clock-o"></i>Recent</a>
                </li>
                <li>
                  <a href="" role="tab" data-toggle="tab" onclick="fetchPosts('popular')" style="cursor: pointer"><i class="fa fa-heart"></i>Popular</a>
                </li>
                <li>
                  <a href="" role="tab" data-toggle="tab" onclick="fetchPosts('comments')" style="cursor: pointer"><i class="fa fa-comments"></i>Most Comments</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="row columns_padding_25">
            <div class="col-sm-7 col-md-8 col-lg-8">
              <div id="post-container"></div>
              <div class="row topmargin_30">
                <div class="col-sm-12 text-center">
                  <div id="pagination-container">
                    <ul class="pagination"></ul>
                  </div>
                </div>
              </div>
            </div>
            <!--eof .col-sm-8 (main content)-->

            <!-- sidebar -->
            <aside class="col-sm-5 col-md-4 col-lg-4">
              <div class="widget widget_tag_cloud">
                <h3 class="widget-title">Sort by Tags</h3>
                <div id="tags">
                  <div class="tagcloud" id="sort-tags">
                    <a href="#" title="">Discussion</a>
                    <a href="#" title="">Question</a>
                    <a href="#" title="">Info</a>
                  </div>
                </div>
              </div>
              <div class="widget widget_recent_posts">
                <h3 class="widget-title">Recent Posts</h3>
                <ul id="recentPostsList"></ul>
              </div>

              <div class="widget widget_mailchimp">
                <h3 class="widget-title">Newsletter</h3>

                <a class="theme_button color1" id="news" style="cursor: pointer">
                  Subscribe to newsletter
                  <i class="fa fa-bell"></i>
                </a>

                <p class="topmargin_20">
                  Stay updated with the latest posts and news.
                </p>
              </div>
            </aside>
            <!-- eof aside sidebar -->
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

  <script src="../../assets/frontoffice/js/compressed.js"></script>
  <script src="../../assets/frontoffice/js/main.js"></script>
  <script src="../../assets/ressources/listPosts.js"></script>
  <script src="../../assets/ressources/tags.js"></script>
</body>

</html>