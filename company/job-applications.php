<?php

session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/custom.css">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
    .logo-container {
      display: flex;
      justify-content: center; 
      align-items: center;     
      height: 120px;            
      margin-bottom: 15px;    
    }
    .logo-container img {
      max-width: 100px;     
      max-height: 100px;       
      border: 3px solid black; 
      border-radius: 50%;      
    }
  </style>
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

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
            <div class="box-header with-border">
                <div class="logo-container text-center">
                  <?php
                  $sql = "SELECT logo FROM company WHERE id_company = '$_SESSION[id_company]'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $logo = $row['logo'];
                      
                      if ($logo != '') {
                          echo '<img src="../uploads/logo/' . $logo . '" class="img-responsive">';
                      } else {
                          echo '<img src="../uploads/logo/placeholder.png" class="img-responsive" alt="Company Logo">';
                      }
                  } else {
                      echo '<p>Company not found in the database.</p>';
                  }
                  ?>
                </div>
                <h3 class="box-title text-center">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                  <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a></li>
                  <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
                  <li class="active"><a href="job-applications.php"><i class="fa fa-file-o"></i> Job Application</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                  <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Recent Applications</i></h2>

            <?php
             $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost  INNER JOIN users ON users.id_user=apply_job_post.id_user WHERE apply_job_post.id_company='$_SESSION[id_company]'";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {     
            ?>
            <div class="attachment-block clearfix padding-2">
                <h4 class="attachment-heading"><a href="user-application.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle'].' @ ('.$row['firstname'].' '.$row['lastname'].')'; ?></a></h4>
                <div class="attachment-text padding-2">
                  <div class="pull-left"><i class="fa fa-calendar"></i> <?php echo $row['createdat']; ?></div>  
                  <?php 

                  if($row['status'] == 0) {
                    echo '<div class="pull-right"><strong class="text-orange">Pending</strong></div>';
                  } else if ($row['status'] == 1) {
                    echo '<div class="pull-right"><strong class="text-red">Rejected</strong></div>';
                  } else if ($row['status'] == 2) {
                    echo '<div class="pull-right"><strong class="text-green">Accepted</strong></div> ';
                  }
                  ?>
                                
                </div>
            </div>

            <?php
              }
            }
            ?>
            
          </div>
      </div>
    </section>

    

  </div>

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
    <a>Online Job Portal</a>.</strong> 
    </div>
  </footer>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/adminlte.min.js"></script>
</body>
</html>
