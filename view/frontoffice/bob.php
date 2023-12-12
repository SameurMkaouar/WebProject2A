<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Dribbble Challenge: Sign Up/Login</title>
  <link rel="stylesheet" href="../../assets/frontoffice/style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ubuntu:400,500" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
  <div class="wrapper">
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
      
      <div class="login hide">
        <h2 class="form-header">LOGIN</h2>
        <?php if (isset($_GET['error']) && !empty($_GET['error'])) : ?>
        <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
      <?php endif; ?>
        <form action="../../controller/login.php" method="post" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email"><i class="fa fa-envelope-o"></i></input>
        <input type="password" name="password" id="pass" placeholder="Password"><i class="fa fa-lock"></i></input>
        <button class="form-btn">LOGIN</button>
        <a class="forgot" href="#">Forgot password</a>
      </form>
      </div>
      <div class="sign-up">
        <form action="../../controller/adduser.php" method="post" id="form"> 
        <h2 class="form-header">SIGN UP</h2>
        <div class="fullname">
          <input type="text" name="firstname" id="login-name" placeholder="Firstname"></input>
          <div class="ln"><input type="text" name="lastname" id="login-lastname" placeholder="Lastname"><i class="fa fa-user"></i></input></div>
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
        <button class="form-btn">SIGN UP</button>
      </form>
      </div>
    </div>
  </div>
</body>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script><script  src="../../assets/frontoffice/script.js"></script>
  <script src="../../assets/backoffice/ControleSaisie.js"></script>
</body>
</html>