<?php
session_start();
include('includes/dbconnection.php');

// Check if $_SESSION['cmssid'] is set and not empty
if (!isset($_SESSION['cmssid']) || strlen($_SESSION['cmssid']) == 0) {
    header('location:logout.php');
    exit;
} else {
    if (isset($_POST['submit'])) {
        $deptid = $_POST['deptid'];
        $emplist = $_POST['emplist'];
        $tpriority = $_POST['tpriority'];
        $ttitle = $_POST['ttitle'];
        $tdesc = $_POST['tdesc'];
        $tedate = $_POST['tedate'];
        $patientname = $_POST['patientname'];
	 
        // Insert data into database
        $sql = "INSERT INTO tbltask (DeptID, AssignTaskto, TaskPriority, TaskTitle, TaskDescription, TaskEnddate, PatientName)
                VALUES (:deptid, :emplist, :tpriority, :ttitle, :tdesc, :tedate,:patientname)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':deptid', $deptid, PDO::PARAM_STR);
        $query->bindParam(':emplist', $emplist, PDO::PARAM_STR);
        $query->bindParam(':tpriority', $tpriority, PDO::PARAM_STR);
        $query->bindParam(':ttitle', $ttitle, PDO::PARAM_STR);
        $query->bindParam(':tdesc', $tdesc, PDO::PARAM_STR);
        $query->bindParam(':tedate', $tedate, PDO::PARAM_STR);
		$query->bindParam(':patientname', $patientname, PDO::PARAM_STR);


        if ($query->execute()) {
            echo '<script>alert("Task has been added.")</script>';
            echo "<script>window.location.href ='manage-task.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
}

// Fetch patients from the database
$sql = "SELECT * FROM tblpatient";
$query = $dbh->prepare($sql);
$query->execute();
$patients = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Clinic Patient and Panel Management System  || Add Task</title>
    
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
function getemp(val) {
$.ajax({
type: "POST",
url: "get_emp.php",
data:'deptid='+val,
success: function(data){
$("#emplist").html(data);
}
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
           <?php include_once('includes/sidebar.php');?>
            <!-- end sidebar -->
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
                              <h2>Add Task</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2><strong>Add Task</strong></h2>
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
                            <div class="field">
                              <label class="label_field">Department Name</label>
                              <select type="text" name="deptid" id="deptid" onChange="getemp(this.value);" value="" class="form-control" required='true'>
                                 <option value="">Select Department</option>
                                  <?php 

$sql2 = "SELECT * from   tbldepartment ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
   
<option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->DepartmentName );?></option>
 <?php } ?>
                              </select>
                           </div>
                           <br>
                           <div class="field">
                              <div class="field">
                              <label class="label_field">Staff List</label>
                              <select type="text" name="emplist" id="emplist" value="" class="form-control" required='true'>

                              </select>
                           </div>
                           </div>
                           <br>
                          <div class="field">
                              <div class="field">
                              <label class="label_field">Task Priority</label>
                              <select type="text" name="tpriority" value="" class="form-control" required='true'>
                                 <option value="">Select Task Priority</option>
                                 <option value="Normal">Normal</option>
                                 <option value="Medium">Medium</option>
                                 <option value="Urgent">Urgent</option>
                                 <option value="Most Urgent">Most Urgent</option>
                                
                              </select>
                           </div>
                           </div>
<br>
                           <div class="field">
                              <label class="label_field">Task Title</label>
                              <input type="text" name="ttitle" value="" class="form-control" required='true'>
                           </div>
						
                           <br>
						 <label class="label_field">Patient Name</label>
 <input type="text" name="patientname" id="patientname" value="" class="form-control" required='true'>
			<br>
                           <div class="field">
                              <label class="label_field">Task Description</label>
                              <textarea type="text" name="tdesc" value="" class="form-control" required='true'></textarea>
                           </div>
                           
<br>
                            <div class="field">
                              <label class="label_field">Task End Date</label>
                              <input type="date" name="tedate" value="" class="form-control" required='true'>
                           </div>
                           <br>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt" type="submit" name="submit" id="submit">Add</button>
                           </div>
                        </fieldset>
                     </form></div>
                                            
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- funcation section -->
                     
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
	  
	  <script>
    function filterPatients(input) {
        var patientList = document.getElementById('patientList');
        var filteredPatients = <?php echo json_encode($patients); ?>;
        var html = '';

        filteredPatients = filteredPatients.filter(function(patient) {
            return patient.PatientName.toLowerCase().startsWith(input.toLowerCase());
        });

        if (filteredPatients.length > 0) {
            html += '<select name="patientname" class="form-control" required>';
            html += '<option value="">Select Patient</option>';
            filteredPatients.forEach(function(patient) {
                html += '<option value="' + patient.PatientName + '">' + patient.PatientName + '</option>';
            });
            html += '</select>';
        } else {
            html += '<p>No matching patients found.</p>';
        }

        patientList.innerHTML = html;
    }
</script>
   </body>
</html> 