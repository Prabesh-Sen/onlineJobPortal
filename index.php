<?php

session_start();


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
          <li>
            <a href="jobs.php">Jobs</a>
          </li>
          <li>
            <a href="#candidates">Candidates</a>
          </li>
          <li>
            <a href="#company">Company</a>
          </li>
          <li>
            <a href="#about">About Us</a>
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

    <section class="content-header bg-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center index-head">
            <h1>All <strong>JOBS</strong> In One Place</h1>
            <p>One search, global reach</p>
            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button">Search Jobs</a></p>
          </div>
        </div>
      </div>
    </section>


<section class="content-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 latest-job margin-bottom-20">
        <h1 class="text-center">Latest Jobs</h1>

        <?php 
        // Fetch 4 random job posts from the database
        $sql = "SELECT job_post.*, company.companyname, company.city, company.logo
                FROM job_post 
                JOIN company ON job_post.id_company = company.id_company
                ORDER BY RAND() LIMIT 4";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Display each job post
        ?>
        <div class="attachment-block clearfix">
          <?php if (!empty($row['logo'])): ?>
            <img class="attachment-img" src="uploads/logo/<?php echo $row['logo']; ?>" alt="Company Logo">
          <?php else: ?>
            <img class="attachment-img" src="img/default-logo.png" alt="Default Company Logo">
          <?php endif; ?>
          <div class="attachment-pushed">
            <h4 class="attachment-heading">
              <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a>
              <span class="attachment-heading pull-right">Rs.<?php echo $row['maximumsalary']; ?>/Month</span>
            </h4>
            <div class="attachment-text">
              <div><strong><?php echo $row['companyname']; ?> | <?php echo $row['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
            </div>
          </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No latest jobs found.</p>";
        }
        ?>

      </div>
    </div>
  </div>
</section>
 <!-- Job Recommendations Based on Search History-->
 <section class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 latest-job margin-bottom-20">
                        <h1 class="text-center">Job Recommendations </h1>
                        <?php
                        if (isset($_SESSION['id_user'])) {
                            $user_id = $_SESSION['id_user'];
                            // Fetch the last 5 search queries from the user's history
                            $sql_search = "SELECT search_query FROM search_history WHERE user_id = '$user_id' ORDER BY search_date DESC LIMIT 5";
                            $result_search = $conn->query($sql_search);
                            if ($result_search->num_rows > 0) {
                                // Loop through each search query and fetch matching jobs
                                while ($search_row = $result_search->fetch_assoc()) {
                                    $search_query = $search_row['search_query'];
                                    $sql_jobs = "SELECT * FROM job_post WHERE jobtitle LIKE '%$search_query%' ORDER BY RAND() LIMIT 4";
                                    $result_jobs = $conn->query($sql_jobs);
                                    if ($result_jobs->num_rows > 0) {
                                        while ($row = $result_jobs->fetch_assoc()) {
                                            // Get the company details
                                            $company_id = $row['id_company'];
                                            $sql_company = "SELECT * FROM company WHERE id_company = '$company_id'";
                                            $result_company = $conn->query($sql_company);
                                            if ($result_company->num_rows > 0) {
                                                $company = $result_company->fetch_assoc();
                                                $company_logo = $company['logo'];
                                                ?>
                                                <div class="attachment-block clearfix">
                                                    <!-- Show company logo -->
                                                    <?php if (!empty($company_logo)): ?>
                                                        <img class="attachment-img" src="uploads/logo/<?php echo $company_logo; ?>" alt="Company Logo">
                                                    <?php else: ?>
                                                        <img class="attachment-img" src="img/default-logo.png" alt="Default Logo">
                                                    <?php endif; ?>
                                                    <div class="attachment-pushed">
                                                        <h4 class="attachment-heading">
                                                            <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a>
                                                            <span class="attachment-heading pull-right">Rs.<?php echo $row['maximumsalary']; ?>/Month</span>
                                                        </h4>
                                                        <div class="attachment-text">
                                                            <div><strong><?php echo $company['companyname']; ?> | <?php echo $company['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    } else {
                                        echo "<p>No jobs found for '$search_query'.</p>";
                                    }
                                }
                            } else {
                                echo "<p>No search history found to recommend jobs.</p>";
                            }
                        } else {
                            echo "<p>Please log in to see job recommendations based on your search history.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Job Recommendations Near User's City -->
        <section class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 latest-job margin-bottom-20">
                        
                        <?php
                        // Display this section only if the user is logged in
                        if (isset($_SESSION['id_user'])) {
                            $user_id = $_SESSION['id_user'];
                            // Fetch the user's city
                            $sql_user = "SELECT city FROM users WHERE id_user = '$user_id'";
                            $result_user = $conn->query($sql_user);
                            if ($result_user && $result_user->num_rows > 0) {
                                $user = $result_user->fetch_assoc();
                                $user_city = $user['city'];
                                // Fetch jobs for companies located in the same city
                                $sql_jobs_city = "SELECT job_post.*, company.city AS company_city, company.companyname, company.logo
                                                  FROM job_post 
                                                  JOIN company ON job_post.id_company = company.id_company
                                                  WHERE LOWER(company.city) = LOWER('$user_city') 
                                                  ORDER BY RAND() LIMIT 4";
                                $result_jobs_city = $conn->query($sql_jobs_city);
                                if ($result_jobs_city && $result_jobs_city->num_rows > 0) {
                                    while ($row = $result_jobs_city->fetch_assoc()) {
                                        ?>
                                        <div class="attachment-block clearfix">
                                            <!-- Show the company logo -->
                                            <?php if (!empty($row['logo'])): ?>
                                                <img class="attachment-img" src="uploads/logo/<?php echo $row['logo']; ?>" alt="Company Logo">
                                            <?php else: ?>
                                                <img class="attachment-img" src="img/default-logo.png" alt="Default Logo">
                                            <?php endif; ?>
                                            <div class="attachment-pushed">
                                                <h4 class="attachment-heading">
                                                    <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a>
                                                    <span class="attachment-heading pull-right">Rs.<?php echo $row['maximumsalary']; ?>/Month</span>
                                                </h4>
                                                <div class="attachment-text">
                                                    <div><strong><?php echo $row['companyname']; ?> | <?php echo $row['company_city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "<p>No jobs found in your city.</p>";
                                }
                            } else {
                                echo "<p>Unable to fetch your city. Please update your profile.</p>";
                            }
                        } else {
                            echo "<p>Please log in to see job recommendations based on your city.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Candidates</h1>
            <p>Finding a job just got easier. Create a profile and apply with single mouse click.</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/browse.jpg" alt="Browse Jobs">
              <div class="caption">
                <h3 class="text-center">Browse Jobs</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/interviewed.jpeg" alt="Apply & Get Interviewed">
              <div class="caption">
                <h3 class="text-center">Apply & Get Interviewed</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/career.jpg" alt="Start A Career">
              <div class="caption">
                <h3 class="text-center">Start A Career</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Companies</h1>
            <p>Hiring? Register your company for free, browse our talented pool, post and track job applications</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="img/postjob.png" alt="Browse Jobs">
              <div class="caption">
                <h3 class="text-center">Post A Job</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="img/manage.jpg" alt="Apply & Get Interviewed">
              <div class="caption">
                <h3 class="text-center">Manage & Track</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="img/hire.png" alt="Start A Career">
              <div class="caption">
                <h3 class="text-center">Hire</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="statistics" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Our Statistics</h1>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Job Offers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
                  <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Registered Company</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM users WHERE resume!=''";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>CV'S/Resume</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Daily Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>About US</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="img/browse.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
         <p>The online job portal application allows job seekers and recruiters to connect.The application provides the ability for job seekers to create their accounts, upload their profile and resume, search for jobs, apply for jobs, view different job openings. The application provides the ability for companies to create their accounts, search candidates, create job postings, and view candidates applications.
            </p>
            <p>
              This website is used to provide a platform for potential candidates to get their dream job and excel in yheir career.
              This site can be used as a paving path for both companies and job-seekers for a better life .
              
            </p>
          </div>
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
                            &copy; <a class="border-bottom" href="./index.php">ONLINE JOB PORTAL</a>, <a class="border-bottom" href="">Code By Prabesh & Pawan</a>
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
