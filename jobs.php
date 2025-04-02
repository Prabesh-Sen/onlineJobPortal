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
          <div class="row">
            <div class="col-md-12 latest-job margin-top-50 margin-bottom-20">
            <h1 class="text-center">Latest Jobs</h1>  
              <div class="input-group input-group-lg">
                  <input type="text" id="searchBar" class="form-control" placeholder="Search job">
                  <span class="input-group-btn">
                    <button id="searchBtn" type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Filters</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked tree" data-widget="tree">
                    <li class="treeview menu-open">
                      <a href="#"><i class="fa fa-plane text-red"></i> City <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                      <ul class="treeview-menu">
                        <li><a href=""  class="citySearch" data-target="Kathmandu"><i class="fa fa-circle-o text-yellow"> Kathmandu</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Chitwan"><i class="fa fa-circle-o text-yellow"> Chitwan</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Biratnagar"><i class="fa fa-circle-o text-yellow"> Biratnagar</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Dharan"><i class="fa fa-circle-o text-yellow"> Dharan</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Janakpur"><i class="fa fa-circle-o text-yellow"> Janakpur</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Birgunj"><i class="fa fa-circle-o text-yellow"> Birgunj</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Syangja"><i class="fa fa-circle-o text-yellow"> Syangja</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Pokhara"><i class="fa fa-circle-o text-yellow"> Pokhara</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Butwal"><i class="fa fa-circle-o text-yellow"> Butwal</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Dang"><i class="fa fa-circle-o text-yellow"> Dang</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Birendranagar"><i class="fa fa-circle-o text-yellow"> Birendranagar</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Dhangadhi"><i class="fa fa-circle-o text-yellow"> Dhangadhi</i> </a></li>
                        <li><a href=""  class="citySearch" data-target="Baitadi"><i class="fa fa-circle-o text-yellow"> Baitadi</i> </a></li>
                        <li><a href="" class="citySearch" data-target="Banepa"><i class="fa fa-circle-o text-yellow"> Banepa</i> </a></li>
                      </ul>
                    </li>
                    <li class="treeview menu-open">
                      <a href="#"><i class="fa fa-plane text-red"></i> Experience <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                      <ul class="treeview-menu">
                        <li><a href="" class="experienceSearch" data-target='1'><i class="fa fa-circle-o text-yellow"></i> > 1 Years</a></li>
                        <li><a href="" class="experienceSearch" data-target='2'><i class="fa fa-circle-o text-yellow"></i> > 2 Years</a></li>
                        <li><a href="" class="experienceSearch" data-target='3'><i class="fa fa-circle-o text-yellow"></i> > 3 Years</a></li>
                        <li><a href="" class="experienceSearch" data-target='4'><i class="fa fa-circle-o text-yellow"></i> > 4 Years</a></li>
                        <li><a href="" class="experienceSearch" data-target='5'><i class="fa fa-circle-o text-yellow"></i> > 5 Years</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9">

            <?php

            $limit = 4;

            $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
              $row = $result->fetch_assoc();
              $total_records = $row['id'];
              $total_pages = ceil($total_records / $limit);
            } else {
              $total_pages = 1;
            }

            ?>

            
              <div id="target-content">
                
              </div>
              <div class="text-center">
                <ul class="pagination text-center" id="pagination"></ul>
              </div> 



            </div>
          </div>
        </div>
      </section>
            <!-- Job Recommendations Based on Search History (Only visible to logged-in users) -->
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
  <script src="js/jquery.twbsPagination.min.js"></script>

  <script>
    function Pagination() {
      $("#pagination").twbsPagination({
        totalPages: <?php echo $total_pages; ?>,
        visible: 5,
        onPageClick: function (e, page) {
          e.preventDefault();
          $("#target-content").html("loading....");
          $("#target-content").load("jobpagination.php?page="+page);
        }
      });
    }
  </script>

  <script>
    $(function () {
        Pagination();
    });
  </script>

  <script>
    $("#searchBtn").on("click", function(e) {
      e.preventDefault();
      var searchResult = $("#searchBar").val();
      var filter = "searchBar";
      if(searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    $(".experienceSearch").on("click", function(e) {
      e.preventDefault();
      var searchResult = $(this).data("target");
      var filter = "experience";
      if(searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    $(".citySearch").on("click", function(e) {
      e.preventDefault();
      var searchResult = $(this).data("target");
      var filter = "city";
      if(searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    function Search(val, filter) {
      $("#pagination").twbsPagination({
        totalPages: <?php echo $total_pages; ?>,
        visible: 5,
        onPageClick: function (e, page) {
          e.preventDefault();
          val = encodeURIComponent(val);
          $("#target-content").html("loading....");
          $("#target-content").load("search.php?page="+page+"&search="+val+"&filter="+filter);
        }
      });
    }
  </script>


  </body>
  </html>
