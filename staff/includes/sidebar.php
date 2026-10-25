 <nav id="sidebar"  style="background-color: #6a0dad">
               <div class="sidebar_blog_1" style="background-color: black" >
                  <div class="sidebar-header" >
                     <div class="logo_section">
                        <a href="dashboard.php"></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info"style="background-color: #6a0dad" >
                     <div class="icon_setting" ></div>
                     <div class="user_profle_side" >
                        <div class="user_img" ><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></div>
                        <div class="user_info" >
                           <?php
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
                           <h6><?php  echo $row->StaffName;?></h6>
                           <p><span class="online_animation"></span> <?php  echo $row->Email;?></p><?php $cnt=$cnt+1;}} ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2" >
                  <h4 style="background-color: black">General</h4>
                  <ul class="list-unstyled components">
                    
                     <li><a href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
                    
                    
                     <li class="active">
                        <a href="#dashboard1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o orange_color"></i> <span>Department</span></a>
                        <ul class="collapse list-unstyled" style="background-color: black"  id="dashboard1">
                           <li>
                              <a href="add-department.php"> <span>Add Department </span></a>
                           </li>
                           <li>
                              <a href="manage-department.php"> <span>Manage Department</span></a>
                           </li>
                        </ul>
                     </li>
                     
					 
					 
					 <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users purple_color"></i> <span>Staff</span></a>
                        <ul class="collapse list-unstyled" style="background-color: black"  id="element">
                           <li><a href="add-staff.php"> <span>Add Staff</span></a></li>
                           <li><a href="manage-staff.php"><span>Manage Staff</span></a></li>
                           
                        </ul>
                     </li>
					 
                     <li>
                        <a href="#element2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users purple_color"></i> <span>Patient</span></a>
                        <ul class="collapse list-unstyled" style="background-color: black"  id="element2">
                           <li><a href="add-patient.php"><span>Register Patient</span></a></li>
                           <li><a href="manage-patient.php"><span>Manage Patient</span></a></li>
                           
                        </ul>
                     </li>
                     
                     <li>
                        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Assign Patient</span></a>
                        <ul class="collapse list-unstyled" style="background-color: black"  id="apps">
                           <li><a href="add-task.php"> <span>Assign Patient to Doctor</span></a></li>
                           <li><a href="manage-task.php"> <span>Manage Assign Patient</span></a></li>
                          
                        </ul>
                     </li>
                   
                   
                     <li><a href="search-patient.php"><i class="fa fa-map purple_color2"></i> <span>Search Patient</span></a></li>
                    
                  </ul>
               </div>
            </nav>