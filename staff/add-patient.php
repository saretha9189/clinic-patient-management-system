<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['cmssid']) == 0) {
    header('location: picut.php');
} else {
    if (isset($_POST['submit'])) {
        $nricid = $_POST['nricid'];
        $patientname = $_POST['patientname'];
        $patientemail = $_POST['patientemail'];
        $patientcontno = $_POST['patientcontno'];
        $dateofbirth = $_POST['dateofbirth'];
        $patientadd = $_POST['patientadd'];
        $familymembername1 = $_POST['familymembername1'];
        $familymembername2 = $_POST['familymembername2'];
		$panel = $_POST['panel'];
        $dateofregister = $_POST['dateofregister'];
        $gender = $_POST['gender'];
        $patientdescription = $_POST['patientdescription'];

        $sql = "INSERT INTO tblpatient (NricId, PatientName, PatientEmail, PatientContactNumber, Dateofbirth, PatientAddress, FamilyMemberName1, FamilyMemberName2, Panel, DateofRegister, Gender, PatientDescription) VALUES (:nricid, :patientname, :patientemail, :patientcontno, :dateofbirth, :patientadd, :familymembername1, :familymembername2, :panel, :dateofregister, :gender, :patientdescription)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nricid', $nricid, PDO::PARAM_STR);
        $query->bindParam(':patientname', $patientname, PDO::PARAM_STR);
        $query->bindParam(':patientemail', $patientemail, PDO::PARAM_STR);
        $query->bindParam(':patientcontno', $patientcontno, PDO::PARAM_INT);
        $query->bindParam(':dateofbirth', $dateofbirth, PDO::PARAM_STR);
        $query->bindParam(':patientadd', $patientadd, PDO::PARAM_STR);
        $query->bindParam(':familymembername1', $familymembername1, PDO::PARAM_STR);
        $query->bindParam(':familymembername2', $familymembername2, PDO::PARAM_STR);
		$query->bindParam(':panel', $panel, PDO::PARAM_STR);
        $query->bindParam(':dateofregister', $dateofregister, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':patientdescription', $patientdescription, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<script>alert("Patient detail has been added")</script>';
            echo "<script>window.location.href ='add-patient.php'</script>";
        } else {
            echo '<script>alert("Failed to add patient detail")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Clinic Patient and Panel Management System  || Add Patient</title>
    
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
<script type="text/javascript">
function checkempidAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability1.php",
data:'nricid='+$("#nricid").val(),
type: "POST",
success:function(data){
$("#nricid-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
// FOr email
function checkemailidAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability1.php",
data:'patientemail='+$("#patientemail").val(),
type: "POST",
success:function(data){
$("#patientemail-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}


// For Mobile
function checkmobileAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability1.php",
data:'patientcontno='+$("#patientcontno").val(),
type: "POST",
success:function(data){
$("#patientcontno-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

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
<body class="inner_page general_elements">
<div class="full_container">
    <div class="inner_container">
        <!-- Sidebar  -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- end sidebar -->
        <!-- right content -->
        <div id="content">
            <!-- topbar -->
            <?php include_once('includes/header.php'); ?>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                        <div class="col-md-12">
                            <div class="page_title">
                                <h2>Add Patient</h2>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row column8 graph">
                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0">
                                        <h2><strong>Add Patient</strong></h2>
                                    </div>
                                </div>
                                <div class="full progress_bar_inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="full">
                                                <div class="padding_infor_info">
                                                    <div class="alert alert-primary" role="alert">
                                                        <form method="post">
                                                            <fieldset>
                                                                <!-- Replace field names and IDs according to your table structure -->
                                                                <div class="field">
                                                                    <label class="label_field">NRIC</label>
                                                                    <input type="text" name="nricid" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Patient Name</label>
                                                                    <input type="text" name="patientname" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Patient Email</label>
                                                                    <input type="email" name="patientemail" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Patient Contact Number</label>
                                                                    <input type="text" name="patientcontno" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Date of Birth</label>
                                                                    <input type="date" name="dateofbirth" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Patient Address</label>
                                                                    <textarea name="patientadd" class="form-control" required></textarea>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Family Member Name 1</label>
                                                                    <input type="text" name="familymembername1" class="form-control">
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Family Member Name 2</label>
                                                                    <input type="text" name="familymembername2" class="form-control">
                                                                </div>
                                                                <br>
																 <div class="field">
                                                                    <label class="label_field">Panel</label>
                                                                    <input type="text" name="panel" class="form-control">
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Date of Register</label>
                                                                    <input type="date" name="dateofregister" class="form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Gender</label>
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Patient Description</label>
                                                                    <textarea name="patientdescription" class="form-control"></textarea>
                                                                </div>
                                                                <br>
                                                                <div class="field margin_0">
                                                                    <button class="main_bt" type="submit" name="submit">Add</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- funcation section -->
                </div>
                <!-- footer -->
                <?php include_once('includes/footer.php'); ?>
            </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
    
      </div>
      <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
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
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
