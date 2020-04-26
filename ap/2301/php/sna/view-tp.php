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
$cenid = $_REQUEST['cen_id'];	
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
    <title>TP Onboarding Details :: CUTM-AMASY</title>
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
          <center><h4 class="card-title text-info">Onboarding Details</h4></center>
        </div>
        <div class="card-content ">
          <div class="card-body table-responsive">
<?php 
include ('scripts/dbcon.php');
$cenid = $_REQUEST['cen_id'];
$query = "SELECT * FROM onboarding WHERE cen_id= '$cenid'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

?>
<br>

                                    
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <div class="col-lg-12">
                                 <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Organisation Name*</label>
                                            <div class="col-md-9">
                                                <?php echo $row['org_name']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Organisation Category</label>
                                            <div class="col-md-9">
                                                <?php echo $row['org_cat']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Affiliation</label>
                                            <div class="col-md-9">
                                                <?php echo $row['affltn']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="example-email">Date Of Incorporation</label>
                                            <div class="col-md-9">
                                                <?php echo $row['doi']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Registered Address</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_add']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">District</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_distt']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">City</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_city']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">State</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_state']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Pin Code</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_pin']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Telephone</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_tel']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Mobile</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_mob']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_email']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">GST No.</label>
                                            <div class="col-md-9">
                                                <?php echo $row['ro_gst']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">SPOC Name</label>
                                            <div class="col-md-9">
                                                <?php echo $row['pc_name']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">SPOC Designation</label>
                                            <div class="col-md-9">
                                                <?php echo $row['pc_desig']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">SPOC Mobile No.</label>
                                            <div class="col-md-9">
                                                <?php echo $row['pc_mob']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">SPOC Email</label>
                                            <div class="col-md-9">
                                                <?php echo $row['pc_email']; ?>
                                            </div>
                                        </div>
                                    </div>
						</br>
					</br>
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
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>