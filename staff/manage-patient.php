<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cmssid']==0)) {
  header('location:logout.php');
  } else{

// Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tblpatient where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage-patient.php'</script>";     


}

  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>Clinic Patient and Panel Management System || Manage Patient</title>
   
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
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!-- fancy box js -->
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
            <style>
        body {
            background-color: #6a0dad; /* Purple background */
            color: black; /* Text color */
        }
        
        .full {
            border-radius: 15px; /* Rounded corners */
            background-color: #6a0dad; /* Purple background */
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .alert-primary {
            background-color: #d3adf7; /* Purple background */
            color: white; /* Text color */
            border: 2px solid #d3adf7; /* Light purple border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px;
        }
        
        .main_bt {
            background-color: #6a0dad; /* Purple background */
            color: white; /* Text color */
            border: 2px solid purple; /* Purple border */
            border-radius: 10px; /* Rounded corners */
            padding: 10px 20px;
        }
        
        .main_bt:hover {
            background-color: white; /* White background on hover */
            color: black; /* Purple text color on hover */
        }
    </style>   
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
              <?php include_once('includes/header.php');?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Manage Patient</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2><strong>Manage Patient</strong></h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Nric Id</th>
                                             <th>Patient Name</th>
                                             <th>Patient Email</th>
                                             <th>Patient Contact Number</th>
                                             <th>Date of Register</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         
<?php
$sql = "SELECT * FROM tblpatient";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $row) {
?>
<tr>
    <td><?php echo htmlentities($cnt); ?></td>
    <td><?php echo htmlentities($row->NricId); ?></td>
    <td><?php echo htmlentities($row->PatientName); ?></td>
    <td><?php echo htmlentities($row->PatientEmail); ?></td>
    <td><?php echo htmlentities($row->PatientContactNumber); ?></td>
    <td><?php echo htmlentities($row->DateofRegister); ?></td>
    <td><a href="edit-patient.php?editid=<?php echo htmlentities($row->ID); ?>" class="btn btn-primary">Edit</a>
        <a href="manage-patient.php?delid=<?php echo htmlentities($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger">Delete</a></td>
</tr>
<?php
        $cnt = $cnt + 1;
    }
}
?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- footer -->
                 <?php include_once('includes/footer.php');?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
       
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
      <!-- fancy box js -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
</html><?php } ?>