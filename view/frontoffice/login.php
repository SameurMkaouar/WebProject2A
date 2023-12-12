<?php

$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
include_once "../../model/APIgoogleConfig.php";
require_once "../../model/user.php";
require_once "../../model/util.php";
if (isset($_COOKIE['emailid']) && isset($_COOKIE['password'])) {
  $emailid = $_COOKIE['emailid'];
  $password = $_COOKIE['password'];
} else {
  $emailid = $password = "";
}

$login_button = "";

if (isset($_GET['code'])) {
  // Get Token
  $token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);

  // Check if fetching token did not return any errors
  if (!isset($token['error'])) {
    // Setting Access token
    $gclient->setAccessToken($token['access_token']);

    // store access token
    $_SESSION['access_token'] = $token['access_token'];

    // Get Account Profile using Google Service
    $gservice = new Google_Service_Oauth2($gclient);

    // Get User Data
    $udata = $gservice->userinfo->get();
    if (!empty($udata['email'])) {
      $user = new user;
      $result = $user->authenticationGoogle($udata['email']);
      if ($result) {

        // Authentication successful
        // Do further actions, like setting session variables and redirecting
        $_SESSION['user_id'] = $result[0]['Id']; // Assuming 'Id' is the column in your users table
        $_SESSION['username'] = $result[0]['Username']; // Assuming 'Username' is the column in your users table
        $_SESSION['role'] = $result[0]['Role']; // Assuming 'Username' is the column in your users table 
        $_SESSION['picture'] = $result[0]['Picture'];
        $_SESSION['mail'] = $result[0]['Email'];
        if (has_role('admin')) {

          header("Location:../backoffice/admin_index.php");
          exit();
        } else {
          header("Location: homepage.php");
          exit();
        }
      } else {
        // Authentication failed
        // You might want to display an error message or redirect back to the login page
        $googleErrorMsg = "there is no account with that email";
        header("Location: login.php?googleError=" . urlencode($googleErrorMsg));
      }
    }




    //header('location: homepage.php');
    //exit;
  }
}
// Display the message

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Dribbble Challenge: Sign Up/Login</title>
  <link rel="stylesheet" href="../../assets/frontoffice/style.css">
  <link rel="stylesheet" href="../../assets/frontoffice/alert.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css">
  <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />






  <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ubuntu:400,500" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <style>
    .gsi-material-button {
      margin-top: 22px;
      margin-left: 55px;
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
      -webkit-appearance: none;
      background-color: WHITE;
      background-image: none;
      border: 1px solid #747775;
      -webkit-border-radius: 4px;
      border-radius: 4px;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      color: #1f1f1f;
      cursor: pointer;
      font-family: 'Roboto', arial, sans-serif;
      font-size: 14px;
      height: 40px;
      letter-spacing: 0.25px;
      outline: none;
      overflow: hidden;
      padding: 0 12px;
      position: relative;
      text-align: center;
      -webkit-transition: background-color .218s, border-color .218s, box-shadow .218s;
      transition: background-color .218s, border-color .218s, box-shadow .218s;
      vertical-align: middle;
      white-space: nowrap;
      width: auto;
      max-width: 400px;
      min-width: min-content;
    }

    .gsi-material-button .gsi-material-button-icon {
      height: 20px;
      margin-right: 12px;
      min-width: 20px;
      width: 20px;
    }

    .gsi-material-button .gsi-material-button-content-wrapper {
      -webkit-align-items: center;
      align-items: center;
      display: flex;
      -webkit-flex-direction: row;
      flex-direction: row;
      -webkit-flex-wrap: nowrap;
      flex-wrap: nowrap;
      height: 100%;
      justify-content: space-between;
      position: relative;
      width: 100%;
    }

    .gsi-material-button .gsi-material-button-contents {
      -webkit-flex-grow: 1;
      flex-grow: 1;
      font-family: 'Roboto', arial, sans-serif;
      font-weight: 500;
      overflow: hidden;
      text-overflow: ellipsis;
      vertical-align: top;
    }

    .gsi-material-button .gsi-material-button-state {
      -webkit-transition: opacity .218s;
      transition: opacity .218s;
      bottom: 0;
      left: 0;
      opacity: 0;
      position: absolute;
      right: 0;
      top: 0;
    }

    .gsi-material-button:disabled {
      cursor: default;
      background-color: #ffffff61;
      border-color: #1f1f1f1f;
    }

    .gsi-material-button:disabled .gsi-material-button-contents {
      opacity: 38%;
    }

    .gsi-material-button:disabled .gsi-material-button-icon {
      opacity: 38%;
    }

    .gsi-material-button:not(:disabled):active .gsi-material-button-state,
    .gsi-material-button:not(:disabled):focus .gsi-material-button-state {
      background-color: #303030;
      opacity: 12%;
    }

    .gsi-material-button:not(:disabled):hover {
      -webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
      box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
    }

    .gsi-material-button:not(:disabled):hover .gsi-material-button-state {
      background-color: #303030;
      opacity: 8%;
    }

    .or-container {
      display: flex;
      align-items: center;
      margin-top: 30px;
      /* Adjust the margin as needed */
    }

    .line {
      flex-grow: 1;
      height: 1px;
      background-color: #000;
      /* Adjust the color as needed */
      margin: 0 10px;
      /* Adjust the margin as needed */
    }

    .or {
      font-size: 18px;
      /* Adjust the font size as needed */
      padding: 0 10px;
      /* Adjust the padding as needed */
    }
  </style>
</head>

<body>

  <div class="wrapper">
    <?php
    if (isset($_GET['success'])) {
      echo '<div class="alert alert-success alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Well done!</strong>  ' . $successMessage . '     
</div>';
    }
    if (isset($_GET['signup_error']) && !empty($_GET['signup_error']))
      echo '<div class="alert alert-danger alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Ssap!</strong>' . htmlspecialchars($_GET['signup_error']) . '
</div>';
    if (isset($_GET['login_error']) && !empty($_GET['login_error']))
      echo '<div class="alert alert-danger alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Snap!</strong>   ' . htmlspecialchars($_GET['login_error']) . '    
</div>';
    if (isset($_GET['googleError']) && !empty($_GET['googleError']))
      echo '<div class="alert alert-danger alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Snap!</strong>' . htmlspecialchars($_GET['googleError']) . '
</div>';
    if (isset($_GET['ban']) && !empty($_GET['ban']))
      echo '<div class="alert alert-danger alert-top" role="alert">
    <button type="button" class="close" id="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Snap!</strong>' . htmlspecialchars($_GET['ban']) . '
</div>';

    ?>
    <div class="background">
      <div class="left">
        <h2 class="back-header">Dont have an account yet?</h2>
        <p class="back-p">Well doggonit you should sign up today!</p>
        <button class="back-btn signup-but">SIGN UP</button>
      </div>
      <div class="right">
        <h2 class="back-header">Do you already have an account?</h2>
        <p class="back-p">Well doggonit let's get you logged in!</p>
        <button class="back-btn login-but">LOGIN</button>
      </div>
    </div>
    <div class="form-container">
      <div class="sign-up ">
        <form action="../../controller/adduser.php" method="post" id="form">
          <div class="kemel">
            <div class="common">
              <h2 class="form-header">SIGN UP</h2>
              <div class="fullname">
                <input type="text" name="firstname" id="login-name" placeholder="Firstname"></input>
                <div class="ln"><input type="text" name="lastname" id="login-lastname" placeholder="Lastname"><i class="fa fa-user"></i></input></div>

              </div>
              <div>
                <p id="firstname-controle"></p>
              </div>
              <input type="text" name="username" id="login-username" placeholder="Username"><i class="fa fa-user-plus"></i></input>
              <p id="username-controle"></p>
              <div class="sex_choice">
                <div class="choice">
                  <label for="male">Male</label>
                  <input type="radio" name="sex" id="male" value="male" class="radio">
                </div>
                <div class="choice">
                  <label for="female">Female</label>
                  <input type="radio" name="sex" id="female" value="female" class="radio">
                </div>
                <div class="choice">
                  <label for="other">Other</label>
                  <input type="radio" name="sex" id="other" value="other" class="radio">
                </div>
              </div>
              <p id="radio-controle"></p>
              <input type="date" name="DoB" id="login-DateOfBirth"><i class="fa fa-calendar"></i></input>
              <p id="date-controle"></p>
              <input type="text" name="email" id="login-email" placeholder="Email"><i class="fa fa-envelope-o"></i></input>
              <p id="email-controle"></p>
              <input type="password" name="password" id="login-password" placeholder="Password"><i class="fa fa-lock"></i></input>
              <?php if (isset($_GET['signup_error']) && !empty($_GET['signup_error'])) : ?>
                <div class="error-message"><?php echo htmlspecialchars($_GET['signup_error']); ?></div>
              <?php endif; ?>
              <div class="boutonet">
                <button class="form-btn" id="sgnup">SIGN UP</button>
                <button id="doctorRegistrationBtn"><i class="rt-icon2-user-md"></i></button>
              </div>
            </div>


            <!-- Add an additional form for doctor registration -->
            <div class="doctor-registration hide">
              <h2 class="form-header">Doctor Registration</h2>
              <select class="form-control" name="speciality" id="lang">
                <option value="" disabled selected>Select a Speciality</option>
                <option value="psychologue">Psychologue</option>
                <option value="coach">Coach</option>
                <option value="psychothérapeute">Psychothérapeute</option>
                <option value="psychiatre">Psychiatre</option>
                <option value="psychanalyste">Psychanalyste</option>
              </select>
              <div class="adresse">
                <input type="text" id="region" name="region" placeholder="region">
                <p id="region-controle"></p>
                <input type="text" id="city" name="city" placeholder="city">
                <p id="city-controle"></p>
                <input type="text" id="street" name="street" placeholder="street">
                <p id="street-controle"></p>
                <input type="text" id="postal_code" name="postal_code" placeholder="postal_code">
                <p id="code-controle"></p>
              </div>
              <!-- Add doctor-specific fields here -->
              <!-- For example, you can add fields like doctor's license, specialty, etc. -->
            </div>
          </div>
        </form>
      </div>
      <div class="login hide">
        <h2 class="form-header">LOGIN</h2>

        <form action="../../controller/login.php" method="post" id="form-login">
          <input type="text" name="email" id="email" placeholder="Email" value=<?php echo $emailid;; ?>><i class="fa fa-envelope-o"></i></input>
          <input type="password" name="password" id="pass" placeholder="Password" value=<?php echo $password; ?>><i class="fa fa-lock"></i></input>
          <?php
          if (isset($_GET['login_error']) && !empty($_GET['login_error'])) : ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['login_error']); ?></div>
          <?php endif; ?>

          <button class="form-btn" id="lgn">LOGIN</button>
          <a class="forgot" href="forgetpassword.html">Forgot password</a>
          <div class="rmmbr"><input type="checkbox" name="checkbox" id="checkbox" class="checkbox"><label for="checkbox">Remember me</label></div>
          <br>

          <div class="or-container">
            <div class="line"></div>
            <div class="or">OU</div>
            <div class="line"></div>
          </div>
          <a href="<?= $gclient->createAuthUrl() ?>" class="gsi-material-button-link">
            <button type="button" class="gsi-material-button">
              <div class="gsi-material-button-state"></div>
              <div class="gsi-material-button-content-wrapper">
                <div class="gsi-material-button-icon">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                    <path fill="none" d="M0 0h48v48H0z"></path>
                  </svg>
                </div>
                <span class="gsi-material-button-contents">Sign in with Google</span>
                <span style="display: none;">Sign in with Google</span>
              </div>

            </button></a>





        </form>

      </div>
    </div>
  </div>

  <!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script src="../../assets/frontoffice/script.js"></script>
  <script src="../../assets/backoffice/ControleSaisie.js"></script>
  <script src="../../assets/frontoffice/alert.js"></script>

  <?php
  // Add the provided PHP code here
  if (isset($_GET['signup_error']) && !empty($_GET['signup_error'])) {
    echo '<script>$(document).ready(function() { $(".login").fadeOut("slow").css("display", "none"); $(".sign-up").fadeIn("slow"); $(".form-container").animate({ left: "10px" }, "slow"); });</script>';
  }

  if (isset($_GET['login_error']) && !empty($_GET['login_error'])) {
    echo '<script>$(document).ready(function() {  $(".sign-up").fadeOut("slow").css("display", "none"); $(".login").fadeIn("slow"); $(".form-container").animate({ left: "400px" }, "slow"); });</script>';
  }
  ?>
</body>

</html>