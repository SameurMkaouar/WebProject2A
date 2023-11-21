<?php
session_start();
require_once "../../model/user.php";

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
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body>
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
								<ul class="mainmenu nav sf-menu">
									<li class="active">
										<a href="index.html">Home</a>
									</li>

									<!-- blog -->
									<li>
										<a href="blog-right.html">Blog</a>
										
									</li>
									<!-- eof blog -->

									<li>
										<a href="#">Features</a>
										
										<!-- eof mega menu -->
									</li>
									<!-- eof features -->


									<li>
										<a href="about.html">Pages</a>
										
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

        <section
          class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10"
        >
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <h3>
                  Edit User
                  <small>profile</small>
                </h3>
              </div>
            </div>
            <!-- .row -->

            <div class="row">
              <div class="col-xs-12">
                <form class="form-horizontal" action="../../controller/update.php" method="post" id="form">
                  <div class="row flex-row">
                    <div class="col-md-6">
                      <div class="with_border with_padding">
                        <h4>User info</h4>

                        <hr />

                        <div class="row form-group">
                          <label
                            class="col-lg-3 control-label"
                            for="user-profile-avatar"
                            >Select Avatar</label
                          >
                          <div class="col-lg-9">
                            <input type="file" id="user-profile-avatar" name="picture" />
                            <p class="help-block">
                              Select your 200x200px avatar
                            </p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <label class="col-lg-3 control-label">Sex:</label>
                          <div class="col-lg-9">
                            <select class="form-control" name="sex">
                              <option selected=""></option>
                              <option>Male</option>
                              <option>Female</option>
                              <option>Other</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >username:</label
                          >
                          <div class="col-lg-9">
                            <input type="text" class="form-control" name="username" />
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >firstname:</label
                          >
                          <div class="col-lg-9">
                            <input type="text" class="form-control" name="firstname"  />
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >lastname:</label
                          >
                          <div class="col-lg-9">
                            <input type="text" class="form-control" name="lastname"  />
                          </div>
                        </div>
                      </div>
                      <!-- .with_border -->
                    </div>
                    <!-- .col-* -->

                    <div class="col-md-6">
                      <div class="with_border with_padding">
                        <h4>Contact info</h4>

                        <hr />

                       
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >Mobile number:</label
                          >
                          <div class="col-lg-9">
                            <input type="tel" class="form-control" />
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >E-mail address:</label
                          >
                          <div class="col-lg-9">
                            <input type="email" class="form-control" name="email" />
                          </div>
                        </div>
                        
                      </div>
                      <!-- .with_border -->
                    </div>
                    <!-- .col-* -->
                  </div>
                  <!-- .row -->

                  <div class="row flex-row">
                    <div class="col-md-6">
                      <div class="with_border with_padding">
                        <h4>Security</h4>

                        <hr />

                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >Old password:</label
                          >
                          <div class="col-lg-9">
                            <input type="password" class="form-control" />
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >New password:</label
                          >
                          <div class="col-lg-9">
                            <input type="password" class="form-control" />
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-lg-3 control-label"
                            >Repeat New password:</label
                          >
                          <div class="col-lg-9">
                            <input type="password" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <!-- .with_border -->
                    </div>
                    <!-- .col-* -->
                    
                    <!-- .col-* -->
                  </div>
                  <!-- .row -->

                  <div class="row">
                    <div class="col-sm-12">
                      <div>
                        <button type="submit" class="theme_button wide_button">
                          Submit
                        </button>
                        <a href="test.php" class="theme_button color2"
                          >Cancel</a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- .row -->
                </form>
              </div>
              <!-- .col-* main column -->
            </div>
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
      <a
        class="side-button side-chat-button"
        id="chat-dropdown"
        data-target="#"
        href="#"
        data-toggle="dropdown"
        role="button"
        aria-haspopup="true"
        aria-expanded="false"
      >
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
                <time
                  class="pull-right small-chat-date"
                  datetime="2017-03-13T08:50:40+00:00"
                >
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
                <time
                  class="pull-right small-chat-date"
                  datetime="2017-03-13T08:50:40+00:00"
                >
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
                <time
                  class="pull-right small-chat-date"
                  datetime="2017-03-13T08:50:40+00:00"
                >
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
                <input
                  type="text"
                  class="form-control"
                  id="side-chat-message"
                  placeholder="Message"
                />
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

    <a
      class="side-button side-contact-button"
      data-target="#admin_contact_modal"
      href="#admin_contact_modal"
      data-toggle="modal"
      role="button"
    >
      <i class="fa fa-envelope"></i>
    </a>

    <!-- template init -->
    <script src="js/compressed.js"></script>
    <script src="js/main.js"></script>

    <!-- dashboard libs -->

    <!-- events calendar -->
    <script src="js/admin/moment.min.js"></script>
    <script src="js/admin/fullcalendar.min.js"></script>
    <!-- range picker -->
    <script src="js/admin/daterangepicker.js"></script>

    <!-- charts -->
    <script src="js/admin/Chart.bundle.min.js"></script>
    <!-- vector map -->
    <script src="js/admin/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="js/admin/jquery-jvectormap-world-mill.js"></script>
    <!-- small charts -->
    <script src="js/admin/jquery.sparkline.min.js"></script>

    <!-- dashboard init -->
    <script src="js/admin.js"></script>
  </body>
</html>
