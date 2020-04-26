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
    $email = $_SESSION['pleiades'];
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
$prabn = $_REQUEST['pr_abn_no'];	
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
    <title>Batch Details :: CUTM-AMASY</title>
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
          <h4 class="card-title text-info">Batch Actions For ABN <?=$prabn;?></h4>
          <p class="card-text">
          </p>
        </div>
        <div class="card-content ">
          <div class="card-body table-responsive">
              <?php
include ('scripts/dbcon.php');
$pr_abn_no = $_REQUEST['pr_abn_no'];					
$result ="SELECT *, count(b.pr_abn_no) as ttl_stud FROM btch_1 a INNER JOIN btch_2 b ON a.pr_abn_no = b.pr_abn_no where a.pr_abn_no ='$pr_abn_no'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
		
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Center Name</th><th>ABN No.</th><th>Batch ID</th><th>Project ID</th><th>Total Candidate</th><th>Batch Status</th><th>Result Status</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
    		  
       echo "<tr><td>".$row["cen_name"]."</td><td>".$row["pr_abn_no"]."</td><td>".$row["pr_btchid"]."</td><td>".$row["cen_pr_id"]."</td><td>".$row["ttl_stud"]."</td><td>".$row["btch_status"]."</td><td>".$row["btch_status"]."</td></tr>";
       
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! </h4></center>";
}
mysqli_close($con);
?>
<div class="card-header">
<h4 class="card-title text-info">Related Documents</h4>
</div>
<?php 
include ('scripts/dbcon.php');
$pr_abn_no = $_REQUEST['pr_abn_no'];					
$result ="SELECT *, count(b.pr_abn_no) as ttl_stud FROM btch_1 a INNER JOIN btch_2 b ON a.pr_abn_no = b.pr_abn_no where a.pr_abn_no ='$pr_abn_no'";
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
		
    echo "<div style='overflow:auto;'><table class='table table-bordered mb-0'><thead><tr><th>Assessment Photos &amp; Videos</th><th>Assessor Mark Foil</th><th>Assessor Attendance Sheet</th><th>Final Result Sheet</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  { 
    	$aaspdf = str_replace('/','',$row["pr_abn_no"]);
      
       echo "<tr><td><a href='".$row["url"]."' target='_blank'>View Gallery</a></td><td><a href='https://amasy.co.in/fm/uploads/Andhra-Pradesh/AYS_RPL/Mark-Foil/$aaspdf.pdf' target='_blank'>Mark Foil</a></td><td><a href='https://amasy.co.in/fm/uploads/Andhra-Pradesh/AYS_RPL/Attendance-Sheet/$aaspdf.pdf' target='_blank'>Attendance Sheet</a></td><td><a href='result-sheet.php?pr_abn_no=".$row["pr_abn_no"]."' target='_blank'>Result Sheet</a></td></tr>";
       
    }
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! </h4></center>";
}
mysqli_close($con);
?>
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
$result ="SELECT *,(CASE WHEN b.total BETWEEN '110' AND '200' THEN 'PASS' WHEN b.total = ' ' THEN 'ABSENT' ELSE 'FAIL' END) as result, (CASE WHEN b.total BETWEEN '175' AND '200' THEN 'A' WHEN b.total BETWEEN '150' AND '174' THEN 'B' WHEN b.total BETWEEN '125' AND '149' THEN 'C'  ELSE 'D' END) as grade FROM btch_2 a INNER JOIN btch_3 b ON a.mprId = b.mprId where b.pr_abn_no ='$prabn' GROUP BY a.mprId ";
$result=mysqli_query($con,$result);
$serial = 0;
    if ($result->num_rows > 0) {
		
    echo "<div style='overflow:auto;'><table class='table table-striped table-bordered text-center file-export'><thead><tr><th>SL No.</th><th>Candidate Photo</th><th>Registration ID</th><th>Name</th><th>Guardian Name</th><th>Total Marks</br>Obtained</th><th>Grade</th><th>Result</th></tr></thead>";
      while($row = mysqli_fetch_array($result))  {
          $serial+=1;
          $prabnno = str_replace('/','',$row["pr_abn_no"]);
        echo "<tr><td>$serial</td><td>"."<img class='media-object round-media' src='https://ap.cutmams.in/2301/angular/v1/snas/scripts/uploads/candidatePhotos/".$row['uid'].".jpg' style='height: 75px;'/>"."</td><td>".$row["mprId"]."</td><td>".$row["candidateName"]."</td><td>".$row["fathersName"]."</td><td>".$row["total"]."</td><td>".$row["grade"]."</td><td>".$row["result"]."</td></tr>";
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