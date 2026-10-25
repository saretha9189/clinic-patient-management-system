<div class="topbar" style="color: white;background-color: #6a0dad;>
                  <nav class="navbar navbar-expand-lg navbar-light" >
                     <div class="full" >
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle" style="background-color: black";><i class="fa fa-bars"></i></button>
                        <div class="logo_section" style="color: white;background-color: #6a0dad;>
                           <a href="dashboard.php"><h3 style="color: white;background-color: #6a0dad;padding-top: 20px;padding-left: 10px;">Clinic Patient and Panel Management System</h3></a>
                        </div>
                        <div class="right_topbar" style="background-color: #6a0dad;" >
                           <div class="icon_info" style="background-color: #6a0dad;" >
                             
                              <ul class="user_profile_dd" style="background-color: #6a0dad;" >
                                 <li><?php
$sid=$_SESSION['cmssid'];
$sql="SELECT StaffName,Email from  tblstaff where ID=:sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <a class="dropdown-toggle" data-toggle="dropdown"  ><img class="img-responsive rounded-circle" style="background-color: #6a0dad;"  src="images/layout_img/user_img.jpg" alt="#" /><span class="name_user" ><?php  echo $row->StaffName;?></span></a><?php $cnt=$cnt+1;}} ?>
                                    <div class="dropdown-menu" style="background-color: #6a0dad;">
                                       <a class="dropdown-item" href="profile.php">My Profile</a>
                                       <a class="dropdown-item" href="change-password.php">Settings</a>
                                       <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>