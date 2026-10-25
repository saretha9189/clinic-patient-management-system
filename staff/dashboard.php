<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cmssid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>Clinic Patient and Panel Management System||Dashboard</title>
      
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
  <style>

        body {
            background-color: purple; /* Purple background */
            color: black; /* Text color */
        }
        
        .counter_section {
            background-color: purple; /* Purple background */
            border: 2px solid #d3adf7; /* Light purple border */
            border-radius: 10px; /* Rounded corners */
        }
        
        .total_no {
            color: white; /* Text color */
        }
        
        .head_couter {
            color: white; /* Text color */
        }
    </style>
      
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
             <?php include_once('includes/header.php');?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont" style="background-color: #6a0dad;">
                  <div class="container-fluid" style="background-color: #6a0dad;" >
                     <div class="row column_title" style="background-color: #6a0dad;">
                        <div class="col-md-12" style="background-color: #6a0dad;" >
                           <div class="page_title" >
                              <h2>Dashboard</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-4">
                           <div class="full counter_section margin_bottom_30 purple_bg">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-files-o white_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <?php 
                        $sql1 ="SELECT * from  tbldepartment";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totdept=$query1->rowCount();
?><a href="manage-Department.php" >
                                    <p class="total_no" style="color: black"><?php echo htmlentities($totdept);?></p>
                                    <p class="head_couter" style="color:#fff !important">Total Department</p>
                                 </a>
                                 </div>
                              </div>
                           </div>
                        </div>
						
						
                        <div class="col-md-7 col-lg-4">
                          <div class="full counter_section margin_bottom_30 purple_bg">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-users white_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <?php 
                        $sql2 ="SELECT * from  tblstaff";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totemp=$query2->rowCount();
?><a href="manage-staff.php">
                                   <p class="total_no"style="color: black"><?php echo htmlentities($totemp);?></p>
                                    <p class="head_couter" style="color:#fff">Total Staff</p>
                                 </a>
                                 </div>
                              </div>
                           </div>
                        </div>
						
						
                        <div class="col-md-6 col-lg-4">
                          <div class="full counter_section margin_bottom_30 purple_bg">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-users white_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <?php 
                        $sql2 ="SELECT * from  tblpatient";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totpat=$query2->rowCount();
?><a href="manage-patient.php">
                                   <p class="total_no"style="color: black"><?php echo htmlentities($totpat);?></p>
                                    <p class="head_couter" style="color:#fff">Total Patient</p>
                                 </a>
                                 </div>
                              </div>
                           </div>
                        </div>
												
						
						
					



                     </div>
                   
                   
                 
                  </div>
				  <br>
				  <br>
				  <br>
				  <br>
                  <!-- footer -->
                  <?php include_once('includes/footer.php');?>
               </div>

               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <script src="js/chart_custom_style1.js"></script>
   </body>
</html><?php } ?>