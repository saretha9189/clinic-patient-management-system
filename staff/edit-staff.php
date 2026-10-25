<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['cmssid']) == 0) {
    header('location: logout.php');
} else {
    if (isset($_POST['submit'])) {
        $deptname = $_POST['deptname'];
        $empid = $_POST['empid'];
        $empname = $_POST['empname'];
        $empemail = $_POST['empemail'];
        $empcontno = $_POST['empcontno'];
        $designation = $_POST['designation'];
        $empdob = $_POST['empdob'];
        $empadd = $_POST['empadd'];
        $empdoj = $_POST['empdoj'];
        $sid = $_GET['editid'];

        $sql = "UPDATE tblstaff SET DepartmentID=:deptname, StaffId=:empid, StaffName=:empname, Email=:empemail, MobileNumber=:empcontno, Position=:designation, StaffDateOfBirth=:empdob, StaffAddress=:empadd, DateOfJoining=:empdoj WHERE ID=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':deptname', $deptname, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':empname', $empname, PDO::PARAM_STR);
        $query->bindParam(':empemail', $empemail, PDO::PARAM_STR);
        $query->bindParam(':empcontno', $empcontno, PDO::PARAM_STR);
        $query->bindParam(':designation', $designation, PDO::PARAM_STR);
        $query->bindParam(':empdob', $empdob, PDO::PARAM_STR);
        $query->bindParam(':empadd', $empadd, PDO::PARAM_STR);
        $query->bindParam(':empdoj', $empdoj, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<script>alert("Staff detail has been updated")</script>';
        } else {
            echo '<script>alert("Failed to update staff detail")</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clinic Patient and Panel Management System || Update Staff</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- site css -->
    <link rel="stylesheet" href="style.css"/>
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css"/>
    <!-- color css -->
    <link rel="stylesheet" href="css/colors.css"/>
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css"/>
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css"/>
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css"/>
    <!-- calendar file css -->
    <link rel="stylesheet" href="js/semantic.min.css"/>
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
                                <h2>Update Staff</h2>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row column8 graph">
                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0">
                                        <h2><strong>Update Staff</strong></h2>
                                    </div>
                                </div>
                                <div class="full progress_bar_inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="full">
                                                <div class="padding_infor_info">
                                                    <div class="alert alert-primary" role="alert">
                                                        <form method="post">
                                                            <?php
                                                            $sid = $_GET['editid'];
                                                            $sql = "SELECT tbldepartment.ID as did, tbldepartment.DepartmentName, tblstaff.ID as sid, tblstaff.DepartmentID, tblstaff.StaffName, tblstaff.StaffId, tblstaff.Email, tblstaff.MobileNumber, tblstaff.Position, tblstaff.StaffDateOfBirth, tblstaff.StaffAddress, tblstaff.DateOfJoining, tblstaff.ProfilePic, tblstaff.CreationDate FROM tblstaff JOIN tbldepartment ON tbldepartment.ID=tblstaff.DepartmentID WHERE tblstaff.ID=:sid";
                                                            $query = $dbh->prepare($sql);
                                                            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $row) {
                                                                    ?>
                                                                    <fieldset>
                                                                        <div class="field">
                                                                            <label class="label_field">Department Name</label>
                                                                            <select type="text" name="deptname" value=""
                                                                                    class="form-control" required='true'>
                                                                                <option
                                                                                    value="<?php echo htmlentities($row->DepartmentID); ?>"><?php echo htmlentities($row->DepartmentName); ?></option>
                                                                                <?php
                                                                                $sql2 = "SELECT * FROM tbldepartment";
                                                                                $query2 = $dbh->prepare($sql2);
                                                                                $query2->execute();
                                                                                $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                                                foreach ($result2 as $row2) {
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo htmlentities($row2->ID); ?>"><?php echo htmlentities($row2->DepartmentName); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <br>

                                                                        <div class="field">
                                                                            <label class="label_field">Staff ID</label>
                                                                            <input type="text" name="empid"
                                                                                   value="<?php echo ($row->StaffId); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Name</label>
                                                                            <input type="text" name="empname"
                                                                                   value="<?php echo htmlentities($row->StaffName); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Email</label>
                                                                            <input type="email" name="empemail"
                                                                                   value="<?php echo htmlentities($row->Email); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Contact Number</label>
                                                                            <input type="text" name="empcontno"
                                                                                   value="<?php echo htmlentities($row->MobileNumber); ?>"
                                                                                   class="form-control" required='true'
                                                                                   maxlength="10" pattern="[0-9]+">
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Position</label>
                                                                            <input type="text" name="designation"
                                                                                   value="<?php echo htmlentities($row->Position); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Date of Birth</label>
                                                                            <input type="date" name="empdob"
                                                                                   value="<?php echo htmlentities($row->StaffDateOfBirth); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Address</label>
                                                                            <textarea type="text" name="empadd"
                                                                                      class="form-control"
                                                                                      required='true'><?php echo htmlentities($row->StaffAddress); ?></textarea>
                                                                        </div>
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Date of Joining</label>
                                                                            <input type="date" name="empdoj"
                                                                                   value="<?php echo htmlentities($row->DateOfJoining); ?>"
                                                                                   class="form-control" required='true'>
                                                                        </div>
                                                                        <br>
 
                                                                        <br>
                                                                        <div class="field">
                                                                            <label class="label_field">Staff Pic</label>
                                                                            <img src="images/<?php echo $row->ProfilePic; ?>"
                                                                                 width="100" height="100"
                                                                                 value="<?php echo $row->ProfilePic; ?>">
                                                                            <a href="changeimage.php?editid=<?php echo $row->sid; ?>">
                                                                                &nbsp; Edit Image</a>
                                                                        </div>
                                                                        <br>
                                                                    </fieldset>
                                                                <?php }
                                                            } ?>
                                                            <br>
                                                            <div class="field margin_0">
                                                                <label class="label_field hidden">hidden label</label>
                                                                <button class="main_bt" type="submit" name="submit"
                                                                        id="submit">Update
                                                                </button>
                                                            </div>
                                                        </form>
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
</html>
