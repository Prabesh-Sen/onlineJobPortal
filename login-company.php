<?php
  session_start(); 

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online Job Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<header class="main-header">

<a href="index.php" class="logo logo-bg">
  <span class="logo-mini">O<b>J</b>P</span>
  <span class="logo-lg">Online<b> Job</b> Portal</span>
</a>

<nav class="navbar navbar-static-top">
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li>
        <a href="jobs.php">Jobs</a>
      </li>
      <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
      <li>
        <a href="login.php">Login</a>
      </li>
      <li>
        <a href="sign-up.php">Sign Up</a>
      </li>  
      <?php } else { 

        if(isset($_SESSION['id_user'])) { 
      ?>        
      <li>
        <a href="user/index.php">Dashboard</a>
      </li>
      <?php
      } else if(isset($_SESSION['id_company'])) { 
      ?>        
      <li>
        <a href="company/index.php">Dashboard</a>
      </li>
      <?php } ?>
      <li>
        <a href="logout.php">Logout</a>
      </li>
      <?php } ?>          
    </ul>
  </div>
</nav>
</header>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Job</b> Portal</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Company Login</p>

    <form method="post" action="checkcompanylogin.php">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="#">I forgot my password</a>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <div class="col-xs-12">
        <?php 
              if(isset($_SESSION['registerCompleted'])) {
                ?>
                <div>
                  <p class="text-center">You Have Registered Successfully! Your Account Approval Is Pending By Admin</p>
                </div>
              <?php
               unset($_SESSION['registerCompleted']); }
              ?>   
              <?php 
              if(isset($_SESSION['loginError'])) {
                ?>
                <div>
                  <p class="text-center">Invalid Email/Password! Try Again!</p>
                </div>
              <?php
               unset($_SESSION['loginError']); }
              ?>   
              <?php 
              if(isset($_SESSION['companyLoginError'])) {
                ?>
                <div>
                  <p class="text-center"><?php echo $_SESSION['companyLoginError'] ?></p>
                </div>
              <?php
               unset($_SESSION['companyLoginError']); }
              ?>  
          </div>          
      </div>
    </form>

    <br>

  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  });
</script>
</body>
</html>
