<?php
include_once 'header.php';
?>

			<section class="page_breadcrumbs ds background_cover section_padding_50">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2>Contacts</h2>
							<ol class="breadcrumb divided_content wide_divider">
								<li>
									<a href="./">
										Home
									</a>
								</li>
								<li>
									<a href="#">Pages</a>
								</li>
								<li class="active">Contacts</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section class="ls page_map" data-address="sydney, australia, Liverpool street">
				<!-- marker description and marker icon goes here -->
				<div class="map_marker_description">
					<h3>Map Title</h3>
					<p>Map description text</p>
					<img class="map_marker_icon" src="../../Assets/FrontOffice/images/map_marker_icon.png" alt="">
				</div>
			</section>

			<section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
				<div class="container">
					<div class="row">

						<div class="col-md-8 to_animate" data-animation="scaleAppear">

							<h2 class="section_header small bottommargin_40">Contact Form</h2>

							<form class="contact-form row columns_margin_bottom_40" method="post" action="./">


								<div class="col-sm-6">
									<div class="contact-form-name">
										<label for="name">Your Name
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Your Name">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-email">
										<label for="email">Email address
											<span class="required">*</span>
										</label>
										<input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-subject">
										<label for="subject">Subject
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contact-form-phone">
										<label for="phone">Phone
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone">
									</div>
								</div>
								<div class="col-sm-12">

									<div class="contact-form-message">
										<label for="message">Message</label>
										<textarea aria-required="true" rows="1" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="contact-form-submit topmargin_20">
										<button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color1 with_shadow">Send Message</button>
									</div>
								</div>


							</form>
						</div>
						<!--.col-* -->

						<div class="col-md-4 to_animate" data-animation="scaleAppear">

							<h2 class="section_header small bottommargin_40">Contact Form</h2>

							<div class="small-teaser media fontsize_16">
								<div class="media-left">
									<i class="highlight fa fa-phone"></i>
								</div>
								<div class="media-body">
									8(800) 123-12345
								</div>
							</div>

							<div class="small-teaser media fontsize_16">
								<div class="media-left">
									<i class="highlight fa fa-map-marker"></i>
								</div>
								<div class="media-body">
									350 Leverton Cove Road Springfield, MA
								</div>
							</div>

							<div class="small-teaser media fontsize_16">
								<div class="media-left">
									<i class="highlight fa fa-envelope-o"></i>
								</div>
								<div class="media-body">
									support@psychologist.com
								</div>
							</div>

						</div>
						<!--.col-* -->

					</div>
					<!--.row -->

				</div>
				<!--.container -->

			</section>


<?php
include_once 'footer.php';
?>