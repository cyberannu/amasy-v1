<?php

//Start Session
session_start();


//Connect to the Database
include "scripts/db-connect.php";

//Declare Variables
$email = "";
$role = "";
$name ="";
$id = "";
$scheme="";

//check if session is already set
if(!isset($_SESSION['pleiades'])) { //If yes

    //Redirect to dashboard
    header('Location:login.php');


} else {

    //get data from Session
    $email = $_SESSION['bazooka'];
    $role = $_SESSION['role'];
    $name = $_SESSION['name'];
    $id = $_SESSION['id'];
	$scheme = $_SESSION['scheme'];

}

if($role = "State Nodal Agency") {

    //Get User Information from database
    	$username = $_SESSION['username'];
        $selectUserQuery = "SELECT * FROM `state_agency` WHERE `username` = '$username'";
        $selectUserQueryResult = $conn->query($selectUserQuery);
        $assessorData = $selectUserQueryResult->fetch_assoc();
		$name = $assessorData['name'];
		$scheme = $assessorData['scheme'];
}


?>
<?php
$centid = $_REQUEST['centre_id'];	
?>
<html lang="en" class="loading">
  <!-- BEGIN : Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Centre Actions :: CUTM-AMASY</title>
    <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/toastr.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <div data-active-color="white" data-background-color="man-of-steel" data-image="app-assets/img/sidebar-bg/01.jpg" class="app-sidebar">
        <?php

        //Select Navbar as per the role
        if($role == "State Nodal Agency") {

            include "scripts/navbar-state.php";

        } 
        ?>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
           
          <div class="content-wrapper"><!-- Add rows table -->
<section id="file-export">
  <div class="row"> 
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-info">Centre Actions For Centre ID <?=$centid;?></h4>
          <p class="card-text">
          </p>
        </div>
        <div class="card-content ">
          <div class="card-body table-responsive">
 <?php
include ('scripts/dbcon.php');
$center_id = $_GET['center_id'];
$result ="SELECT * FROM centers where center_id ='$center_id'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Amasy UID</th><th>PRN No</th><th>Center Name</th><th>Scheme</th><th>Status</th><th>Go Ahead Letter</th><th>Actions</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
          switch ($row['cen_status']) {
			  case "Approved":
			   $verify_btn=  "<td><a class='btn btn-danger btn-raised btn-block' id='slide-toast' href='scripts/reject-center.php?center_id=".$row["center_id"]."' onclick='return checkReject()'>Reject</a></td>";
				break;
				
				case "Rejected":
			   $verify_btn=  "<td><a class='btn btn-success btn-raised btn-block' id='slide-toast' href='scripts/approve-center.php?center_id=".$row["center_id"]."' onclick='return checkApprove()'>Approve</a></td>";
				break;
				  
				case "Pending":
				$verify_btn= "<td><a class='btn btn-success btn-raised btn-block' href='scripts/approve-center.php?center_id=".$row["center_id"]."' onclick='return checkApprove()'>Approve</a></br><a class='btn btn-danger btn-raised btn-block' href='scripts/reject-center.php?center_id=".$row["center_id"]."' onclick='return checkReject()'>Reject</a></td>";
				
				break;

			default:
				$verify_btn= "<td style='background-color: green;'><a style='color: #fff;' href='view-certificate.php?pr_abn_no=".$row["pr_abn_no"]."'>Download Certificate</a></td><td style='background-color: green;'><a style='color: #fff;' href='view-result-sheet.php?pr_abn_no=".$row["pr_abn_no"]."'>Download Result Sheets</a></td>";
		  }
        echo "<tr><td>".$row["cen_id"]."</td><td>".$row["prn"]."</td><td>".$row["cen_name"]."</td><td>".$row["scheme"]."</td><td>".$row["cen_status"]."</td><td>"."<img src='https://tn.cutmams.in/124/".$row['go_ahead']."' width='100' height='120'/>"."</br><center><a href='https://tn.cutmams.in/124/".$row['go_ahead']."' target='_blank'>View</a></center></td>$verify_btn</tr>";
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please upload data first to view!</h4></center>";
}
mysqli_close($con);
?>
													</br>
													</br>
													<center><h5>Projects(Affiliation / Accreditation)</h5></center>
													</br>
													

<?php
include ('scripts/dbcon.php');
$center_id = $_GET['center_id'];
$result ="SELECT * FROM centers where center_id ='$center_id'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Center ID</th><th>Project ID</th><th>Affiliation / Accreditation</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
        echo "<tr><td>".$row["center_id"]."</td><td>".$row["cen_pr_id"]."</td><td>".$row["affltn"]."</td></tr>";
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please upload data first to view!</h4></center>";
}
mysqli_close($con);
?>
</br>
													</br>
													<center><h5>Courses</h5></center>
													</br>
													

<?php
include ('scripts/dbcon.php');
$center_id = $_GET['center_id'];
$result ="SELECT * FROM course where center_id ='$center_id'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Course Name</th><th>Course Code</th><th>Course Sector</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
        echo "<tr><td>".$row["cou_name"]."</td><td>".$row["cou_code"]."</td><td>".$row["cou_sec"]."</td></tr>";
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please upload data first to view!</h4></center>";
}
mysqli_close($con);
?>
</br>
													</br>
													<center><h5>Batches Created</h5></center>
													</br>
													

<?php
include ('scripts/dbcon.php');
$center_id = $_GET['center_id']; 
$result ="SELECT *, COUNT(a.id) as total, COUNT(CASE WHEN a.btch_status = 'Pending' THEN 1 ELSE NULL END) as pending, COUNT(CASE WHEN a.btch_status = 'Approved' THEN 1 ELSE NULL END) as approved, COUNT(CASE WHEN a.btch_status = 'Rejected' THEN 1 ELSE NULL END) as rejected FROM btch_1 a INNER JOIN centers b ON a.cen_id = b.cen_id WHERE a.cnf_status = 'Yes' AND b.center_id ='$center_id'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Total Batches Enrolled</th><th>Total Batches Approved</th><th>Total Batches Pending</th><th>Total Batches Rejected</th></tr></thead>";
             while($row = mysqli_fetch_array($result))  { 
echo "<tr><td><a style='color:#1a9aa7' href='view-all-batch.php?scheme=DDUGKY'>".$row["total"]."</a></td><td><a style='color:#1a9aa7' href='view-approved-batch.php?scheme=DDUGKY'>".$row["approved"]."</a></td><td><a style='color:#1a9aa7' href='view-pending-batch.php?scheme=DDUGKY'>".$row["pending"]."</a></td><td><a style='color:#1a9aa7' href='view-rejected-batch.php?scheme=DDUGKY'>
".$row["rejected"]."</a></td></tr>";
}
    echo "</div></table>";
		
} else {
    echo "<center><h4>No Centres in Queue For Approval</h4></center>";
}
mysqli_close($con);
?>
</br>
													</br>
													<center><h5>Courses</h5></center>
													</br>
													

<?php
include ('scripts/dbcon.php');
$center_id = $_GET['center_id'];
$result ="SELECT * FROM course where center_id ='$center_id'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Course Name</th><th>Course Code</th><th>Course Sector</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
        echo "<tr><td>".$row["cou_name"]."</td><td>".$row["cou_code"]."</td><td>".$row["cou_sec"]."</td></tr>";
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please upload data first to view!</h4></center>";
}
mysqli_close($con);
?>

 <?php 
include ('scripts/dbcon.php');
$center_id = $_REQUEST['center_id'];
$query = "SELECT * FROM centers WHERE center_id= '$center_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

?>
               
               </table>
               <!--Tab Ends -->
                </div> <br>
                                    
                                    <center><h5>Center Contact Details</h5></center><br>
                                    <form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Address</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cen_add" value="<?php echo $row['cen_add']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">District</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cen_distt" value="<?php echo $row['cen_distt']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">City</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cen_city" value="<?php echo $row['cen_city']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">State/UT</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" name="cen_state" value="<?php echo $row['cen_state']; ?>">  
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Pin Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cen_pin" value="<?php echo $row['cen_pin']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Telephone</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="cen_tel" value="<?php echo $row['cen_tel']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Mobile</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="cen_mob" value="<?php echo $row['cen_mob']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Fax</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="cen_fax" value="<?php echo $row['cen_fax']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="email" name="cen_email" value="<?php echo $row['cen_email']; ?>">
                                        </div>
                                    </div>
                                </div>
					</ul>
                               
                                
                                <br>
                                   <br>
                                   <br>
                                    <center><h5>Particulars of Center Contact Person</h5></center><br>
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <div class="col-lg-12">
                                 <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Name*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_name" value="<?php echo $row['poc_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Designation*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_desig" value="<?php echo $row['poc_desig']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Citizenship*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_citz" value="<?php echo $row['poc_citz']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="example-email">Date Of Birth*</label>
                                            <div class="col-md-9">
                                                <input type="date"  name="poc_dob" class="form-control" value="<?php echo $row['poc_dob']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Resident Address*</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="5" name="poc_resadd"><?php echo $row['poc_resadd']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Permanent Address*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_peradd" value="<?php echo $row['poc_resadd']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Mobile Number*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  name="poc_mob" value="<?php echo $row['poc_mob']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Alt. Mobile Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_alt_mob" value="<?php echo $row['poc_alt_mob']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <label class="col-md-3 col-form-label">Email*</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="email" name="poc_email" value="<?php echo $row['poc_email']; ?>">
                                            </div>
                                        </div>
                                    </div>
						</br>
					</br>
                                   
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Educational Qualification*</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_equal" value="<?php echo $row['poc_equal']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="example-email">Total Work Experience</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_wrk" value="<?php echo $row['poc_wrk']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">PAN Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_pan" value="<?php echo $row['poc_pan']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Aadhar Number (Optional)</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poc_adhar" value="<?php echo $row['poc_adhar']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </ul>
                    <!--Tab Ends -->
                    <input type="hidden" class="form-control" value="<?=$cen_id ?>" name="cen_id" disabled="disabled">
                    <input type="hidden" class="form-control" value="Waiting For Go Letter" name="cen_status" disabled="disabled">
                <input type="hidden" name="tmstmp" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date("y/m/d h:i:s a");?>" />
                <div class="submit mt-3 mb-3">
                                                    
												</div>
		</form>
                </div>
            </div>
        </div>
    </div>
</section>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="file-export">
  <div class="row"> 
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-info">Batch Detail For ABN <?=$prabn;?></h4>
          <p class="card-text">These are the batches pending for approval from State Nodal Agency of SEEDAP-AYS, Post approval the batches will be eligible for assessment process completion.
          </p>
        </div>
        <div class="card-content ">
          <div class="card-body table-responsive">
<?php
include ('scripts/dbcon.php');
$prabn = $_REQUEST['pr_abn_no'];					
$result ="SELECT * FROM btch_2 where pr_abn_no ='$prabn'";
$result=mysqli_query($con,$result);
$serial = 0;
    if ($result->num_rows > 0) {
		
    echo "<div style='overflow:auto;'><table class='table table-striped table-bordered text-center file-export'><thead><tr><th>SL No.</th><th>Candidate Photo</th><th>Registration ID</th><th>Name</th><th>Guardian Name</th><th>Birth Year</th><th>Adhaar No</th><th>Candidate Details</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  {
          $serial+=1;
        echo "<tr><td>$serial</td><td>"."<img class='media-object round-media' src='https://ap.cutmams.in/2301/angular/v1/snas/scripts/uploads/candidatePhotos/".$row['uid'].".jpg' style='height: 75px;'/>"."</td><td>".$row["mprId"]."</td><td>".$row["candidateName"]."</td><td>".$row["fathersName"]."</td><td>".$row["dob"]."</td><td>".$row["uid"]."</td><td><a href='view-can-details.php?mprId=".$row["mprId"]."'>View</a></td></tr>";
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please contact Admin!</h4></center>";
}
mysqli_close($con);
?>    
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--/ Search API (regular expressions) table -->

          </div>
        </div>
        <!-- END : End Main Content-->

        <!-- BEGIN : Footer-->
        <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2013-2019 <a href="https://cutm.ac.in" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">AMASY</a> - Centurion University. All rights reserved. </span></p>
          <p class="clearfix text-muted text-sm-center px-2"><span>Designed &amp; Developed By Assessment &amp; Certification Cell - Anuj Tiwari</span></p>
        </footer>
        <!-- End : Footer-->

      </div>
    </div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="app-assets/js/app-sidebar.js" type="text/javascript"></script>
    <script src="app-assets/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="app-assets/js/customizer.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/data-tables/datatable-advanced.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/toastr.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>