<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Appointment</title>
</head>
<body>
    <h1>Ajouter un appointment</h1>
    <form class="contact-form row columns_margin_bottom_40" method="post" action="addappointment.php">


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


<div class="col-sm-12">
    <div class="topmargin_20">
        <input type="submit" name="submit" class="theme_button color1 with_shadow" value="submit" >
    </div>
</div>


</form>
</body>
</html>

<?php
include ("../Controller/appoi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$a = new appointment();
$a->addappointment($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["age"], $_POST["date"], $_POST["sex"], $_POST["typr"]);
header("location: ListApp.php");
exit();
}


?>