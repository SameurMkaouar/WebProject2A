<?php 
require_once "../../model/user.php";
require_once "../../model/util.php";
$token=$_GET["token"];
$tokenValidationResult = validateResetToken($token);
if ($tokenValidationResult['status'] === 'invalid') {
    die("Token invalid");
} elseif ($tokenValidationResult['status'] === 'expired') {
    die("Token expired");
}
else{
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Dribbble Challenge: Sign Up/Login</title>
  <link rel="stylesheet" href="../../assets/frontoffice/styleForgetPassword.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ubuntu:400,500" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
  <div class="wrapper">
    <div class="background">
    <div class="form-container">
        <div class="content">
            <h1 class="form-header">RESET PASSWORD</h1>
            <form action="../../controller/processResetPassword.php" method="post" id='form'>
                <input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">
                <input type="password" id="password" name="password" placeholder="New Password" >
                <input type="password" id="password-confirmation" name="password-confirmation" placeholder="Repeat Password" >
                <button type="submit">send</button>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script><script  src="../../assets/frontoffice/script.js"></script>
  <script src="../../assets/frontoffice/ResetPassword.js"></script>
  
</body>
</html>



<?php } ?>