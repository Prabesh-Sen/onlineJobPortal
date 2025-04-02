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
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

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

  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header">
      <div class="container">
        <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
          <h1 class="text-center margin-bottom-20">CREATE YOUR PROFILE</h1>
          <form method="post" id="registerCandidates" action="adduser.php" enctype="multipart/form-data">
            <div class="col-md-6 latest-job ">
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="fname" name="fname" placeholder="First Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="lname" name="lname" placeholder="Last Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="email" name="email" placeholder="Email *" required>
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="aboutme" name="aboutme" placeholder="Brief intro about yourself *" required></textarea>
              </div>
              <div class="form-group">
                <label>Date Of Birth</label>
                <input class="form-control input-lg" type="date" id="dob" min="1960-01-01" max="2003-01-31" name="dob" placeholder="Date Of Birth">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="age" name="age" placeholder="Age" readonly>
              </div>
              <div class="form-group">
                <label>Passing Year</label>
                <input class="form-control input-lg" type="date" id="passingyear" name="passingyear" placeholder="Passing Year">
              </div>       
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="qualification" name="qualification" placeholder="Highest Qualification">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="stream" name="stream" placeholder="Stream">
              </div>                    
              <!-- <div class="form-group checkbox">
                <label><input type="checkbox"> I accept terms & conditions</label>
              </div> -->
              <div class="form-group">
                <button class="btn btn-flat btn-success">Register</button>
              </div>
              <?php 
              if(isset($_SESSION['registerError'])) {
                ?>
                <div class="form-group">
                  <label style="color: red;">Email Already Exists! Choose A Different Email!</label>
                </div>
              <?php
               unset($_SESSION['registerError']); }
              ?> 

              <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="form-group">
                  <label style="color: red;"><?php echo $_SESSION['uploadError']; ?></label>
              </div>
              <?php unset($_SESSION['uploadError']); } ?>     

            </div>            
            <div class="col-md-6 latest-job ">
              <div class="form-group">
                <input class="form-control input-lg" type="password" id="password" name="password" placeholder="Password *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="password" id="cpassword" name="cpassword" placeholder="Confirm Password *" required>
              </div>
              <div id="passwordError" class="btn btn-flat btn-danger hide-me" >
                    Password Mismatch!! 
                  </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="contactno" name="contactno" minlength="10" maxlength="10" onkeypress="return validatePhone(event);" placeholder="Phone Number">
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="address" name="address" placeholder="Address"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="city" name="city" placeholder="City">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="state" name="state" placeholder="State">
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="skills" name="skills" placeholder="Enter Skills"></textarea>
              </div>              
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="designation" name="designation" placeholder="Designation">
              </div>

              <div class="form-group">
                <label style="color: red;">File Format PDF Only!</label>
                <input type="file" name="resume" class="btn btn-flat btn-danger" required>
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </section>

    

  </div>

  <footer class="main-footer" style="margin-left: 0px;">
  <div class="container py-5">
                <div class="row g-5">
             
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Kathmandu, Nepal</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+977 9876543210</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>onlinejobportal@gmail.com</p>
                    </div>
                   
                </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class=" text-center">
                            &copy; <a class="border-bottom" href="./index.php">ONLINE JOB Portal</a>, <a class="border-bottom" href="">Code By Prabesh & Pawan</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
  </footer>

    </div>
  </footer>


  <div class="control-sidebar-bg"></div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/adminlte.min.js"></script>

<script type="text/javascript">
      function validatePhone(event) {

        var key = window.event ? event.keyCode : event.which;

        if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {

          return true;
        } else if( key < 48 || key > 57 ) {

          return false;
        } else return true;
      }
</script>

<script type="text/javascript">
  $('#dob').on('change', function() {
    var today = new Date();
    var birthDate = new Date($(this).val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();

    if(m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    $('#age').val(age);
  });
</script>
<script>
  $("#registerCandidates").on("submit", function(e) {
    e.preventDefault();
    if( $('#password').val() != $('#cpassword').val() ) {
      $('#passwordError').show();
    } else {
      $(this).unbind('submit').submit();
    }
  });
</script>
</body>
</html>
