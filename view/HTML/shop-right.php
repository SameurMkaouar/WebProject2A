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

  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/animations.css" />
  <link rel="stylesheet" href="css/fonts.css" />
  <link rel="stylesheet" href="css/main.css" class="color-switcher-link" />
  <link rel="stylesheet" href="css/shop.css" class="color-switcher-link" />
  <script src="js/vendor/modernizr-2.6.2.min.js"></script>

  <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
      <script src="js/vendor/jquery-1.12.4.min.js"></script>
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

      <header class="page_header header_white table_section columns_padding_0 toggler-xs-right">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3 col-sm-5">
              <a href="./" class="logo"> Psychologist </a>
              <!-- header toggler -->
              <span class="toggle_menu visible-xs">
                <span></span>
              </span>
            </div>
            <div class="col-md-6 col-sm-2 text-center">
              <!-- main nav start -->
              <nav class="mainmenu_wrapper">
                <ul class="mainmenu nav sf-menu">
                  <li class="active">
                    <a href="index.html">Home</a>
                    <ul>
                      <li>
                        <a href="index.html">MultiPage</a>
                      </li>
                      <li>
                        <a href="index_singlepage.html">Single Page</a>
                      </li>
                      <li>
                        <a href="admin_index.html">Admin Dashboard</a>
                      </li>
                    </ul>
                  </li>

                  <!-- blog -->
                  <li>
                    <a href="blog-right.html">Blog</a>
                    <ul>
                      <li>
                        <a href="blog-right.html">Right Sidebar</a>
                      </li>
                      <li>
                        <a href="blog-left.html">Left Sidebar</a>
                      </li>
                      <li>
                        <a href="blog-full.html">No Sidebar</a>
                      </li>
                      <li>
                        <a href="blog-mosaic.html">Blog Grid</a>
                      </li>

                      <li>
                        <a href="blog-single-right.html">Post</a>
                        <ul>
                          <li>
                            <a href="blog-single-right.html">Right Sidebar</a>
                          </li>
                          <li>
                            <a href="blog-single-left.html">Left Sidebar</a>
                          </li>
                          <li>
                            <a href="blog-single-full.html">No Sidebar</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="blog-single-video-right.html">Video Post</a>
                        <ul>
                          <li>
                            <a href="blog-single-video-right.html">Right Sidebar</a>
                          </li>
                          <li>
                            <a href="blog-single-video-left.html">Left Sidebar</a>
                          </li>
                          <li>
                            <a href="blog-single-video-full.html">No Sidebar</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- eof blog -->

                  <li>
                    <a href="#">Features</a>
                    <div class="mega-menu">
                      <ul class="mega-menu-row">
                        <li class="mega-menu-col">
                          <a href="#">Headers</a>
                          <ul>
                            <li>
                              <a href="header1.html">Header Type 1</a>
                            </li>
                            <li>
                              <a href="header2.html">Header Type 2</a>
                            </li>
                            <li>
                              <a href="header3.html">Header Type 3</a>
                            </li>
                            <li>
                              <a href="header4.html">Header Type 4</a>
                            </li>
                            <li>
                              <a href="header5.html">Header Type 5</a>
                            </li>
                            <li>
                              <a href="header6.html">Header Type 6</a>
                            </li>
                            <li>
                              <a href="header7.html">Header Type 7</a>
                            </li>
                            <li>
                              <a href="header8.html">Header Type 8</a>
                            </li>
                            <li>
                              <a href="header9.html">Logo in Menu</a>
                            </li>
                          </ul>
                        </li>
                        <li class="mega-menu-col">
                          <a href="#">Side Menus</a>
                          <ul>
                            <li>
                              <a href="header_side1.html">Slide Left Light</a>
                            </li>
                            <li>
                              <a href="header_side2.html">Slide Right Light</a>
                            </li>
                            <li>
                              <a href="header_side3.html">Push Left Light</a>
                            </li>
                            <li>
                              <a href="header_side4.html">Push Right Light</a>
                            </li>
                            <li>
                              <a href="header_side5.html">Slide Left Dark</a>
                            </li>
                            <li>
                              <a href="header_side6.html">Slide Right Dark</a>
                            </li>
                            <li>
                              <a href="header_side7.html">Push Left Dark</a>
                            </li>
                            <li>
                              <a href="header_side8.html">Push Right Dark</a>
                            </li>
                            <li>
                              <a href="header_side_superfish.html">Superfish Menu</a>
                            </li>
                            <li>
                              <a href="header_side_sticked.html">Sticked Menu</a>
                            </li>
                          </ul>
                        </li>
                        <li class="mega-menu-col">
                          <a href="breadcrumbs1.html">Breadcrumbs</a>
                          <ul>
                            <li>
                              <a href="breadcrumbs1.html">Breadcrumbs 1</a>
                            </li>
                            <li>
                              <a href="breadcrumbs2.html">Breadcrumbs 2</a>
                            </li>
                            <li>
                              <a href="breadcrumbs3.html">Breadcrumbs 3</a>
                            </li>
                            <li>
                              <a href="breadcrumbs4.html">Breadcrumbs 4</a>
                            </li>
                            <li>
                              <a href="breadcrumbs5.html">Breadcrumbs 5</a>
                            </li>
                            <li>
                              <a href="breadcrumbs6.html">Breadcrumbs 6</a>
                            </li>
                          </ul>
                        </li>
                        <li class="mega-menu-col">
                          <a href="footer1.html">Footers</a>
                          <ul>
                            <li>
                              <a href="footer1.html">Footer Type 1</a>
                            </li>
                            <li>
                              <a href="footer2.html">Footer Type 2</a>
                            </li>
                            <li>
                              <a href="footer3.html">Footer Type 3</a>
                            </li>
                            <li>
                              <a href="footer4.html">Footer Type 4</a>
                            </li>
                            <li>
                              <a href="footer5.html">Footer Type 5</a>
                            </li>
                            <li>
                              <a href="footer6.html">Footer Type 6</a>
                            </li>
                            <li>
                              <a href="footer7.html">Footer Type 7</a>
                            </li>
                          </ul>
                        </li>
                        <li class="mega-menu-col">
                          <a href="copyright1.html">Copyrights</a>

                          <ul>
                            <li>
                              <a href="copyright1.html">Copyrights 1</a>
                            </li>
                            <li>
                              <a href="copyright2.html">Copyrights 2</a>
                            </li>
                            <li>
                              <a href="copyright3.html">Copyrights 3</a>
                            </li>
                            <li>
                              <a href="copyright4.html">Copyrights 4</a>
                            </li>
                            <li>
                              <a href="copyright5.html">Copyrights 5</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <!-- eof mega menu -->
                  </li>
                  <!-- eof features -->

                  <li>
                    <a href="about.html">Pages</a>
                    <ul>
                      <!-- features -->
                      <li>
                        <a href="shortcodes_teasers.html">Shortcodes &amp; Widgets</a>
                        <ul>
                          <li>
                            <a href="shortcodes_typography.html">Typography</a>
                          </li>
                          <li>
                            <a href="shortcodes_buttons.html">Buttons</a>
                          </li>
                          <li>
                            <a href="shortcodes_pricing.html">Pricing</a>
                          </li>
                          <li>
                            <a href="shortcodes_teasers.html">Teasers</a>
                          </li>
                          <li>
                            <a href="shortcodes_progress.html">Progress</a>
                          </li>
                          <li>
                            <a href="shortcodes_tabs.html">Tabs &amp; Collapse</a>
                          </li>
                          <li>
                            <a href="shortcodes_bootstrap.html">Bootstrap Elements</a>
                          </li>
                          <li>
                            <a href="shortcodes_widgets.html">Widgets</a>
                          </li>
                          <li>
                            <a href="shortcodes_animation.html">Animation</a>
                          </li>
                          <li>
                            <a href="shortcodes_icons.html">Template Icons</a>
                          </li>
                          <li>
                            <a href="shortcodes_socialicons.html">Social Icons</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof features -->

                      <li>
                        <a href="about.html">About</a>
                      </li>

                      <li>
                        <a href="services.html">Our Services</a>
                        <ul>
                          <li>
                            <a href="services.html">Services</a>
                          </li>
                          <li>
                            <a href="service-single.html">Single service</a>
                          </li>
                          <li>
                            <a href="service-single2.html">Single service 2</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="timetable.html">Timetable</a>
                      </li>

                      <!-- shop -->
                      <li>
                        <a href="shop-right.html">Shop</a>
                        <ul>
                          <li>
                            <a href="shop-right.html">Shop</a>
                          </li>
                          <li>
                            <a href="shop-product-right.html">Single Product</a>
                          </li>
                          <li>
                            <a href="shop-cart-right.html">Shopping Cart</a>
                          </li>
                          <li>
                            <a href="shop-checkout-right.html">Checkout</a>
                          </li>
                          <li>
                            <a href="shop-register.html">Registration</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof shop -->

                      <!-- events -->
                      <li>
                        <a href="events-left.html">Events</a>
                        <ul>
                          <li>
                            <a href="events-left.html">Left Sidebar</a>
                          </li>
                          <li>
                            <a href="events-right.html">Right Sidebar</a>
                          </li>
                          <li>
                            <a href="events-full.html">Full Width</a>
                          </li>
                          <li>
                            <a href="event-single-left.html">Single Event</a>
                            <ul>
                              <li>
                                <a href="event-single-left.html">Left Sidebar</a>
                              </li>
                              <li>
                                <a href="event-single-right.html">Right Sidebar</a>
                              </li>
                              <li>
                                <a href="event-single-full.html">Full Width</a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <!-- eof events -->

                      <li>
                        <a href="team.html">Team</a>
                        <ul>
                          <li>
                            <a href="team.html">Team</a>
                          </li>
                          <li>
                            <a href="team-single.html">Team Member</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="comingsoon1.html">Comingsoon</a>
                        <ul>
                          <li>
                            <a href="comingsoon1.html">Comingsoon</a>
                          </li>
                          <li>
                            <a href="comingsoon2.html">Comingsoon 2</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="faq.html">FAQ</a>
                        <ul>
                          <li>
                            <a href="faq.html">FAQ</a>
                          </li>
                          <li>
                            <a href="faq2.html">FAQ 2</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="404.html">404</a>
                        <ul>
                          <li>
                            <a href="404.html">404</a>
                          </li>
                          <li>
                            <a href="4042.html">404 2</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- eof pages -->

                  <!-- gallery -->
                  <li>
                    <a href="gallery-regular.html">Gallery</a>
                    <ul>
                      <!-- Gallery regular -->
                      <li>
                        <a href="gallery-regular.html">Gallery Regular</a>
                        <ul>
                          <li>
                            <a href="gallery-regular.html">1 column</a>
                          </li>
                          <li>
                            <a href="gallery-regular-2-cols.html">2 columns</a>
                          </li>
                          <li>
                            <a href="gallery-regular-3-cols.html">3 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery regular -->

                      <!-- Gallery full width -->
                      <li>
                        <a href="gallery-fullwidth.html">Gallery Full Width</a>
                        <ul>
                          <li>
                            <a href="gallery-fullwidth.html">2 column</a>
                          </li>
                          <li>
                            <a href="gallery-fullwidth-3-cols.html">3 columns</a>
                          </li>
                          <li>
                            <a href="gallery-fullwidth-4-cols.html">4 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery full width -->

                      <!-- Gallery extended -->
                      <li>
                        <a href="gallery-extended.html">Gallery Extended</a>
                        <ul>
                          <li>
                            <a href="gallery-extended.html">1 column</a>
                          </li>
                          <li>
                            <a href="gallery-extended-2-cols.html">2 columns</a>
                          </li>
                          <li>
                            <a href="gallery-extended-3-cols.html">3 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery extended -->

                      <!-- Gallery carousel -->
                      <li>
                        <a href="gallery-carousel.html">Gallery Carousel</a>
                        <ul>
                          <li>
                            <a href="gallery-carousel.html">1 column</a>
                          </li>
                          <li>
                            <a href="gallery-carousel-2-cols.html">2 columns</a>
                          </li>
                          <li>
                            <a href="gallery-carousel-3-cols.html">3 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery carousel -->

                      <!-- Gallery tile -->
                      <li>
                        <a href="gallery-tile.html">Gallery Tile</a>
                      </li>
                      <!-- eof Gallery tile -->

                      <!-- Gallery left sidebar -->
                      <li>
                        <a href="gallery-left.html">Gallery Left Sidebar</a>
                        <ul>
                          <li>
                            <a href="gallery-left.html">1 column</a>
                          </li>
                          <li>
                            <a href="gallery-left-2-cols.html">2 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery left sidebar -->

                      <!-- Gallery right sidebar -->
                      <li>
                        <a href="gallery-right.html">Gallery Right Sidebar</a>
                        <ul>
                          <li>
                            <a href="gallery-right.html">1 column</a>
                          </li>
                          <li>
                            <a href="gallery-right-2-cols.html">2 columns</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery right sidebar -->

                      <!-- Gallery item -->
                      <li>
                        <a href="gallery-single.html">Gallery Item</a>
                        <ul>
                          <li>
                            <a href="gallery-single.html">Style 1</a>
                          </li>
                          <li>
                            <a href="gallery-single2.html">Style 2</a>
                          </li>
                          <li>
                            <a href="gallery-single3.html">Style 3</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery item -->
                    </ul>
                  </li>
                  <!-- eof Gallery -->

                  <!-- contacts -->
                  <li>
                    <a href="contact.html">Contact</a>
                    <ul>
                      <li>
                        <a href="contact.html">Contact 1</a>
                      </li>
                      <li>
                        <a href="contact2.html">Contact 2</a>
                      </li>
                      <li>
                        <a href="contact3.html">Contact 3</a>
                      </li>
                      <li>
                        <a href="contact4.html">Contact 4</a>
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

      <section class="page_breadcrumbs ds background_cover section_padding_50">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2>Products</h2>
              <ol class="breadcrumb divided_content wide_divider">
                <li>
                  <a href="./"> Home </a>
                </li>
                <li>
                  <a href="#">Shop</a>
                </li>
                <li class="active">Products</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="ls section_padding_top_100 section_padding_bottom_100 columns_padding_25">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 col-md-8 col-lg-8">
              <div class="shop-sorting with_padding_small with_background clearfix">
                <form action="" method="get" class="form-inline filters-form" id="filtersForm">
                  <span>
                    <label class="grey" for="orderby">Sort By:</label>
                    <select class="form-control orderby" name="orderby" id="orderby">
                      <option value="price" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'price') echo 'selected'; ?>>Low To High</option>
                      <option value="price-desc" <?php if (!isset($_GET['orderby']) || $_GET['orderby'] == 'price-desc') echo 'selected'; ?>>High To Low</option>
                    </select>
                  </span>

                  <span>
                    <a href="#" id="toggle_shop_view" class=""></a>
                  </span>
                  <span class="pull-right">
                    <label class="grey" for="showcount">Show:</label>
                    <select class="form-control showcount" name="showcount" id="showcount">
                      <option value="6" <?php if (!isset($_GET['showcount']) || $_GET['showcount'] == 6) echo 'selected'; ?>>6</option>
                      <option value="12" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 12) echo 'selected'; ?>>12</option>
                      <option value="18" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 18) echo 'selected'; ?>>18</option>
                      <option value="24" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 24) echo 'selected'; ?>>24</option>
                      <option value="30" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 30) echo 'selected'; ?>>30</option>
                      <option value="36" <?php if (isset($_GET['showcount']) && $_GET['showcount'] == 36) echo 'selected'; ?>>36</option>
                    </select>
                  </span>
                </form>
              </div>
              <div class="columns-2">
                <ul id="products" class="products list-unstyled grid-view">
                  <?php
                  include '../../controller/readproductfront.php';
                  ?>
                </ul>
              </div>
              <!-- Pagination links -->
              <div class="row">
                <div class="col-sm-12 text-center">
                  <ul class="pagination">
                    <!-- Pagination links will be echoed from readproductfront.php -->
                  </ul>
                </div>
              </div>
              <!-- eof .columns-* -->


            </div>
            <!--eof .col-sm-8 (main content)-->

            <!-- sidebar -->
            <aside class="col-sm-5 col-md-4 col-lg-4">
              <div class="widget widget_search">
                <form action="" method="get" class="form-inline filters-form" id="filtersForm">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="widget-search">Search for:</label>
                    </div>
                    <input id="widget-search" type="text" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" name="search" class="form-control" placeholder="Search" />
                    <div class="input-group-append">
                      <button type="submit" class="theme_button">Search</button>
                    </div>
                  </div>
                </form>
              </div>


              <div class="widget widget_shopping_cart">
                <h3 class="widget-title">Your Cart</h3>
                <div class="widget_shopping_cart_content">
                  <ul class="cart_list product_list_widget media-list darklinks">

                  </ul>
                  <!-- end product list -->


                  <p class="buttons">
                    <a href="shop-cart-right.html" class="theme_button color2">View Cart</a>
                    <a href="carthistory.php" class="theme_button color1">View History</a>
                  </p>
                </div>
              </div>

              <script>
                document.getElementById('orderby').addEventListener('change', function() {
                  document.getElementById('filtersForm').submit();
                });

                document.getElementById('showcount').addEventListener('change', function() {
                  document.getElementById('filtersForm').submit();
                });
              </script>
            </aside>
            <!-- eof aside sidebar -->
          </div>
        </div>
      </section>


      <footer class="page_footer cs main_color2 table_section section_padding_50 columns_padding_0">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-sm-push-4 text-center">
              <a href="./" class="logo big text-shadow">
                Psychologist
                <span class="small-text">Premium HTML Template</span>
              </a>
            </div>

            <div class="col-sm-4 col-sm-pull-4 text-center text-sm-left text-md-left">
              <div class="widget widget_nav_menu greylinks">
                <ul class="menu divided_content wide_divider">
                  <li class="">
                    <a href="./">Home</a>
                  </li>
                  <li class="">
                    <a href="about.html">About</a>
                  </li>
                  <li class="">
                    <a href="services.html">Services</a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-sm-4 text-center text-sm-right text-md-right">
              <div class="widget widget_nav_menu greylinks">
                <ul class="menu divided_content wide_divider">
                  <li class="">
                    <a href="gallery-regular-3-cols.html">Gallery</a>
                  </li>
                  <li class="">
                    <a href="blog-right.html">Blog</a>
                  </li>
                  <li class="">
                    <a href="contact.html">Contacts</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <section class="cs main_color2 page_copyright section_padding_15">
        <div class="container with_top_border">
          <div class="row">
            <div class="col-sm-12 text-center">
              <p class="small-text">
                &copy; 2023 Psychology and Counseling. All Rights Reserved
              </p>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- eof #box_wrapper -->
  </div>
  <!-- eof #canvas -->


  <script src="js/compressed.js"></script>
  <script src="js/main.js"></script>
</body>

</html>