<?php 
require_once "../model/util.php";
require_once "../model/user.php";
if(isset( $_POST["password"] ) && $_POST["password-confirmation"]){
$token=$_POST["token"];
$tokenValidationResult = validateResetToken($token);
if ($tokenValidationResult['status'] === 'invalid') {
    die("Token invalid");
} elseif ($tokenValidationResult['status'] === 'expired') {
    die("Token expired");
}
else {
$password_hash=password_hash($_POST["password"], PASSWORD_DEFAULT);
$user=new user();
if (isset($tokenValidationResult['userRecord'])) {
    $userRecord = $tokenValidationResult['userRecord'];
    $user->updatepassword($password_hash, $userRecord['Id']);
    $successMessage = "Password updated successfully!";
    header("Location: ../view/frontoffice/login.php?success=" . urlencode($successMessage));
            exit();
        }}
}

?>