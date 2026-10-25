<?php
require_once("includes/dbconnection.php");


//code check nricid
if(!empty($_POST["nricid"])) {
$nricid=$_POST["nricid"];
$sql ="SELECT NricId FROM tblpatient WHERE NricId=:nricid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':nricid', $nricid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Staff Id already assign to another staff.</span>";
else
 echo "<span style='color:green'> Staff Id avaialble for registration.</span>";
 
}

//code check Email
if(!empty($_POST["patientemail"])) {
$patientemail=$_POST["patientemail"];
$sql ="SELECT PatientEmail FROM tblpatient WHERE PatientEmail=:patientemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':patientemail', $patientemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Email id already registered with another staff.</span>";
else
 echo "<span style='color:green'> Email Id avaialble for registration.</span>";
 
}

//code check mobile
if(!empty($_POST["patientcontno"])) {
$patientcontno=$_POST["patientcontno"];
$sql ="SELECT PatientContactNumber FROM tblpatient WHERE PatientContactNumber=:patientcontno";
$query= $dbh -> prepare($sql);
$query-> bindParam(':patientcontno', $patientcontno, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Contact Number already registered with another staff.</span>";
else
 echo "<span style='color:green'> Contact Number avaialble for registration.</span>";
 
}