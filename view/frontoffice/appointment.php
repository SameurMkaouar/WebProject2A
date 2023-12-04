<?php
ob_start(); 
include_once 'header.php';

require('../../config.php');

include ("../../Controller/appoi.php");

$iddoc = isset($_GET["iddoc"]) ? $_GET["iddoc"] : null;

$a1 = new appointment();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = new appointment();
    $a->addappointment($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["age"], $_POST["date"], $_POST["sex"], $_POST["typr"], $_POST["doc"]);
    header("location: appointments.php");
    exit();

}

?>

            <section class="page_breadcrumbs ds background_cover section_padding_50">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2>Appointments</h2>
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

							<h2 class="section_header small bottommargin_40">Assignment form</h2>

							<form class="columns_margin_bottom_40" method="post" action="appointment.php">


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
									<div class="contact-form-phone">
										<label for="phone">Phone
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="contact-form-age">
										<label for="age">Age
											<span class="required">*</span>
										</label>
										<input type="text" aria-required="true" size="30" value="" name="age" id="age" class="form-control" placeholder="Type your age">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="contact-form-date">
										<label for="age">Preferred date
											<span class="required">*</span>
										</label>
										<input type="datetime-local" aria-required="true" size="30" value="" name="date" id="date" class="form-control" >
									</div>
								</div>

								<div class="col-sm-6" style="margin-bottom: 6rem;">
                                    <div class="contact-form-sex">
                                    <label for="sex">Sex</label>	
									<br>
                                      <input type="radio" class="radio_btn" name="sex" id="sex" value="male" checked> Male
                                      <input type="radio" class="radio_btn" name="sex" id="sex1" value="female"> Female
                                </div>
                                </div>
								<div class="col-sm-6" style="margin-bottom: 6rem;">
                                    <div class="contact-form-sex">
                                    <label for="online">Type</label>	
									<br>
                                      <input type="radio" class="radio_btn" name="typr"  value="online" checked> Online
                                      <input type="radio" class="radio_btn" name="typr"  value="offline"> Offline
                                	</div>
                                </div>
								<div class="col-sm-6" style="margin-bottom: 6rem;">
                                    <div class="contact-form-sex">
                                    <label for="online">Chose your doctor:</label>	
									<br>
                                      <select name="doc">
										<option value="<?php echo $iddoc ; ?>"><?php echo $iddoc; ?></option>
									  </select>
                                	</div>
                                </div>

								<div class="col-sm-12">
									<div class="topmargin_20">
										<input type="submit" name="submit" class="theme_button color1 with_shadow" value="submit" >
										
									</div>
								</div>


							</form>
						</div>
						<!--.col-* -->

						

						

					</div>
					<!--.row -->
					
				</div>
				<!--.container -->

			</section>
			<script src="../Assets/FrontOffice/js/appointment.js"></script>

<?php
include_once 'footer.php';


?>