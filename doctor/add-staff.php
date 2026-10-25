<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cmssid'] == 0)) {
    header('location:picut.php');
} else {
    if (isset($_POST['submit'])) {

        $cmssid = $_SESSION['cmssid'];
        $deptname = $_POST['deptname'];
        $empid = $_POST['empid'];
        $empname = $_POST['empname'];
		$username = $_POST['username'];
        $empemail = $_POST['empemail'];
        $empcontno = $_POST['empcontno'];
        $designation = $_POST['designation'];
        $empdob = $_POST['empdob'];
        $empadd = $_POST['empadd'];
        $empdoj = $_POST['empdoj'];
        $password = md5($_POST['password']);
        $pic = $_FILES["pic"]["name"];
        $extension = substr($pic, strlen($pic) - 4, strlen($pic));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

        $sql = "SELECT ID FROM tblstaff WHERE StaffId=:empid OR MobileNumber=:empcontno OR Email=:empemail";
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':empemail', $empemail, PDO::PARAM_STR);
        $query->bindParam(':empcontno', $empcontno, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            echo "<script>alert('Staff Id or Email or Contact number already registered with another staff');</script>";
        } else {

            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {

                $pic = md5($pic) . time() . $extension;
                move_uploaded_file($_FILES["pic"]["tmp_name"], "images/" . $pic);

                $sql = "INSERT INTO tblstaff (StaffName, UserName, MobileNumber, Email, Password, StaffRegdate, StaffId, Position, StaffDateOfBirth, StaffAddress, DateOfJoining, ProfilePic) VALUES (:empname, :empid, :empcontno, :empemail, :password, NOW(), :empid, :designation, :empdob, :empadd, :empdoj, :pic)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':empname', $empname, PDO::PARAM_STR);
				$query->bindParam(':username', $username, PDO::PARAM_STR);
                $query->bindParam(':empid', $empid, PDO::PARAM_STR);
                $query->bindParam(':empcontno', $empcontno, PDO::PARAM_INT);
                $query->bindParam(':empemail', $empemail, PDO::PARAM_STR);
                $query->bindParam(':password', $password, PDO::PARAM_STR);
                $query->bindParam(':designation', $designation, PDO::PARAM_STR);
                $query->bindParam(':empdob', $empdob, PDO::PARAM_STR);
                $query->bindParam(':empadd', $empadd, PDO::PARAM_STR);
                $query->bindParam(':empdoj', $empdoj, PDO::PARAM_STR);
                $query->bindParam(':pic', $pic, PDO::PARAM_STR);

                $query->execute();

                $LastInsertId = $dbh->lastInsertId();
                if ($LastInsertId > 0) {
                    echo '<script>alert("Staff detail has been added.")</script>';
                    echo "<script>window.location.href ='manage-staff.php'</script>";
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again")</script>';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clinic Patient and Panel Management System  || Add staff</title>

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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        function checkempidAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'empid=' + $("#empid").val(),
                type: "POST",
                success: function (data) {
                    $("#empid-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                }
            });
        }

        // For email
        function checkemailidAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'empemail=' + $("#empemail").val(),
                type: "POST",
                success: function (data) {
                    $("#empemail-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                }
            });
        }

        // For Mobile
        function checkmobileAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'empcontno=' + $("#empcontno").val(),
                type: "POST",
                success: function (data) {
                    $("#empcontno-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
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
                                <h2>Add Staff</h2>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row column8 graph">

                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0">
                                        <h2><strong>Add Staff</strong></h2>
                                    </div>
                                </div>
                                <div class="full progress_bar_inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="full">
                                                <div class="padding_infor_info">
                                                    <div class="alert alert-primary" role="alert">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <fieldset>

                                                                <div class="field">
                                                                    <label class="label_field">Department Name</label>
                                                                    <select type="text" name="deptname" value=""
                                                                            class="form-control"
                                                                            required='true'>
                                                                        <option value="">Select Department</option>
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
                                                                    <input type="text" name="empid" id="empid"
                                                                           value="" class="form-control"
                                                                           required='true'
                                                                           onBlur="checkempidAvailability()">

                                                                </div>
                                                                <span id="empid-status"></span>

                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Staff Name</label>
                                                                    <input type="text" name="empname" value=""
                                                                           class="form-control"
                                                                           required='true'>
                                                                </div>


                                                                <br>
																<div class="field">
    <label class="label_field">User Name</label>
    <input type="text" name="username" value="" class="form-control" required='true'>
</div>
<BR>
                                                                <div class="field">
                                                                    <label class="label_field">Staff Email</label>
                                                                    <input type="email" name="empemail" id="empemail"
                                                                           value="" class="form-control"
                                                                           required='true'
                                                                           onBlur="checkemailidAvailability()">
                                                                </div>
                                                                <span id="empemail-status"></span>

                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Staff Contact
                                                                        Number</label>
                                                                    <input type="text" name="empcontno"
                                                                           id="empcontno" value=""
                                                                           class="form-control" required='true'
                                                                           maxlength="10" pattern="[0-9]+"
                                                                           onBlur="checkmobileAvailability()">
                                                                </div>
                                                                <span id="empcontno-status"></span>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Position</label>
                                                                    <input type="text" name="designation"
                                                                           value="" class="form-control"
                                                                           required='true'>
                                                                </div>

                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Employee Date of
                                                                        Birth</label>
                                                                    <input type="date" name="empdob" value=""
                                                                           class="form-control"
                                                                           required='true'>
                                                                </div>


                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Staff
                                                                        Address</label>
                                                                    <textarea type="text" name="empadd"
                                                                              value=""
                                                                              class="form-control"
                                                                              required='true'></textarea>
                                                                </div>


                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field"> Date of
                                                                        Joining</label>
                                                                    <input type="date" name="empdoj" value=""
                                                                           class="form-control"
                                                                           required='true'>
                                                                </div>


                                                                <br>
                                                               
                                                                <div class="field">
                                                                    <label class="label_field">Password</label>
                                                                    <input type="text" name="password" value=""
                                                                           class="form-control"
                                                                           required='true'>
                                                                </div>
                                                                <br>
                                                                <div class="field">
                                                                    <label class="label_field">Staff Pic</label>
                                                                    <input type="file" name="pic" value=""
                                                                           class="form-control"
                                                                           required='true'>
                                                                </div>

                                                                <br>
                                                                <div class="field margin_0">
                                                                    <label class="label_field hidden">hidden
                                                                        label</label>
                                                                    <button class="main_bt" type="submit"
                                                                            name="submit" id="submit">Add
                                                                    </button>
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

