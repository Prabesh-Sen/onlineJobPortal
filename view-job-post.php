<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
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
                  
        </ul>
      </div>
    </nav>
  </header>



  <div class="content-wrapper" style="margin-left: 0px;">

  <?php
  
    $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
  ?>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">          
          <div class="col-md-9 bg-white padding-2">
            <div class="pull-left">
              <h2><b><i><?php echo $row['jobtitle']; ?></i></b></h2>
            </div>
            <div class="pull-right">
              <a href="jobs.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div>
              <p><span class="margin-right-10"><i class="fa fa-location-arrow text-green"></i> <?php echo $row['city']; ?></span> <i class="fa fa-calendar text-green"></i> <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></p>              
            </div>
            <div>
              <?php echo stripcslashes($row['description']); ?>
            </div>
            <?php 
            if(isset($_SESSION["id_user"]) && empty($_SESSION['companyLogged'])) { ?>
            <div>
              <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-success btn-flat margin-top-50">Apply</a>
            </div>
            <?php } ?>
            
            
          </div>
          <div class="col-md-3">
            <div class="thumbnail">
              <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="companylogo">
              <div class="caption text-center">
                <h3><?php echo $row['companyname']; ?></h3>
                <hr>
                <div class="row">  <?php if(isset($_SESSION["id_user"]) && empty($_SESSION['companyLogged'])) { ?>
                  <div class="col-md-4"><a href="apply.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-address-card-o"></i> Apply</a></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php 
      }
    }
    ?>

    

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


  <div class="control-sidebar-bg"></div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/adminlte.min.js"></script>



</body>
</html>
