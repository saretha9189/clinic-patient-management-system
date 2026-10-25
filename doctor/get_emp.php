<?php
require_once("includes/dbconnection.php");
if(!empty($_POST["deptid"])) 
{
$deptid=$_POST["deptid"];
$sql=$dbh->prepare("SELECT * FROM tbldoctor WHERE DepartmentID=:deptid");
$sql->execute(array(':deptid' => $deptid));	
?>
<option value="">Select</option>
<?php
while($row =$sql->fetch())
{
?>
<option value="<?php echo $row["ID"]; ?>"><?php echo $row["DocName"]; ?></option>
<?php
}
}
?>