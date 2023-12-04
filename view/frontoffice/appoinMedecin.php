<?php
include_once 'header.php';

require('../../config.php');

include ("../../Controller/appoi.php");

$a1=new appointment;

?>

            <section class="page_breadcrumbs ds background_cover section_padding_50">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2>My Appointments</h2>
							<ol class="breadcrumb divided_content wide_divider">
								<li>
									<a href="./">
										Home
									</a>
								</li>
								<li>
									<a href="#">Pages</a>
								</li>
								
							</ol>
						</div>
					</div>
				</div>
			</section>

			

			<section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
				<div class="container">
					<div class="row">

						<div class="col-md-8 to_animate" data-animation="scaleAppear">

							<h2 class="section_header small bottommargin_40"></h2>
							
                            <?php
								$a1->listAppForDoctorConfirmed();
						?>

					</div>
					<!--.row -->

				</div>
				<!--.container -->

			</section>

<?php
include_once 'footer.php';


?>