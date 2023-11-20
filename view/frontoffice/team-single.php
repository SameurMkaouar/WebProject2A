<?php 
include_once 'header.php';
$iddoc=$_GET["iddoc"];
?>
			<section class="page_breadcrumbs ds background_cover section_padding_50">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2>Team Member</h2>
							<ol class="breadcrumb divided_content wide_divider">
								<li>
									<a href="./">
										Home
									</a>
								</li>
								<li>
									<a href="team.php">Team</a>
								</li>
								<li class="active">Team Member</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section class="ls section_padding_top_130 section_padding_bottom_130 columns_padding_25">
				<div class="container">
					<div class="row">
						<div class="col-md-5">
							<div class="vertical-item content-padding with_shadow text-center">
								<div class="item-media">
									<img src="../../Assets/FrontOffice/images/team/05.jpg" alt="">
								</div>
								<div class="item-content">
									<h4 class="bottommargin_5">
										<a href="team-single.html">Ruby Ryan</a>
									</h4>

									<p class="small-text highlight">assistant</p>
								</div>
							</div>
							<div class="col-md mx-auto text-center w-full mt-4 bottommargin_0">
							<a href="appointment.php?iddoc=<?php echo $iddoc; ?>" class="theme_button color1 margin_0">Make an appointment</a>
						</div>
						</div>

						<div class="col-md-6">
							<p>
								Lorem idolorame conseetur sadipscing elitdiam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam ersed diam voluptua vero eoet accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
								sit amet rem ipsum dolorsit amet consetetur sadipscing elitr:
							</p>
							<ul class="list2 darklinks">
								<li>
									<a href="services.html">Lorem ipsum dolor sit amet</a>
								</li>
								<li>
									<a href="services.html">Sint animi non ut sed</a>
								</li>
								<li>
									<a href="services.html">Eaque blanditiis nemo</a>
								</li>
								<li>
									<a href="services.html">Amet, consectetur adipisicing</a>
								</li>
							</ul>
							<p>
								Pork salami capicola alcatra, pig boudin bresaola. Short loin shoulder bacon swine jerky, chicken kevin pancetta shankle. Fatback pork chop tongue, shank ball tip jowl sausage.
							</p>


							<!-- Nav tabs -->
							<ul class="nav nav-tabs topmargin_40" role="tablist">
								<li class="active">
									<a href="#tab1" role="tab" data-toggle="tab">Biography</a>
								</li>
								<li>
									<a href="#tab2" role="tab" data-toggle="tab">Skills</a>
								</li>
								<li>
									<a href="#tab3" role="tab" data-toggle="tab">Send Message</a>
								</li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content top-color-border bottommargin_40">

								<div class="tab-pane fade in active" id="tab1">
									<h3 class="topmargin_0">Biography:</h3>
									<p>
										Ut wisi enim ad minim veniaquis nostrud exetation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Dutem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at
										vero eros et accumsan et iusto odio dignissim qui blandit.
									</p>
									<h3>Professional Life:</h3>
									<p>
										Dutem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit. Praesent luptatum zzril delenit augue duis dolore te feugait
										nulla facilisi.
									</p>

								</div>

								<div class="tab-pane fade" id="tab2">
									<p>
										<strong class="grey">Skill Name</strong>
									</p>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="90">
											<span>90%</span>
										</div>
									</div>

									<p>
										<strong class="grey">Skill Name</strong>
									</p>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="100">
											<span>100%</span>
										</div>
									</div>

									<p>
										<strong class="grey">Skill Name</strong>
									</p>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="75">
											<span>75%</span>
										</div>
									</div>

									<p>
										<strong class="grey">Skill Name</strong>
									</p>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="95">
											<span>95%</span>
										</div>
									</div>


								</div>

								<div class="tab-pane fade" id="tab3">
									<form class="contact-form" method="post" action="./">
										<p class="contact-form-name">
											<!-- <label for="name">Name <span class="required">*</span></label> -->
											<input type="text" aria-required="true" size="30" value="" name="name" class="form-control" placeholder="Name">
										</p>
										<p class="contact-form-email">
											<!-- <label for="email">Email <span class="required">*</span></label> -->
											<input type="email" aria-required="true" size="30" value="" name="email" class="form-control" placeholder="Email">
										</p>
										<p class="contact-form-message">
											<!-- <label for="message">Message</label> -->
											<textarea aria-required="true" rows="8" cols="45" name="message" class="form-control" placeholder="Message"></textarea>
										</p>
										<p class="contact-form-submit topmargin40">
											<button type="submit" name="contact_submit" class="theme_button">Send Message</button>
										</p>
									</form>
								</div>
							</div>
							<!-- eof .tab-content -->

							<p>
								Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet rem ipsum dolorsit amet consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt.
							</p>

							<blockquote>
								<p class="highlight">“Pork chop cow tenderin ball tip jerky biltong”</p>
								<div class="item-meta">
									<h5>Sean Watts</h5>
								</div>
							</blockquote>

							<p>Ham hock shankle fatback beef ball tip short loin short ribs andouille. Pig alcatra chuck meatball pastrami.</p>

						</div>

					</div>
				</div>
			</section>

<?php
include_once 'footer.php';
?>