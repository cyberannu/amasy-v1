<?php
//start Session
session_start();

//connect to the database
include "scripts/db-connect.php";

$cen_name = "";

$getBatchQuery = "SELECT * FROM `btch_3` WHERE `pr_abn_no` = '$abn'";
    $getBatchResult = $conn->query($getBatchQuery);

?>
<?php 
include ('scripts/dbcon.php');
$abn = $_REQUEST['pr_abn_no'];
$query = "SELECT *, b.id as idd, count(b.id) as ttl, a.cen_name as centname, a.cen_name as vtpp FROM btch_1 a INNER JOIN btch_2 b ON a.pr_abn_no = b.pr_abn_no INNER JOIN course c ON a.pr_crcode = c.cou_code INNER JOIN centers e ON e.cen_pr_id = a.cen_pr_id WHERE a.pr_abn_no = '$abn'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$pr_abn = $row['pr_abn_no'];
$cen_id = $row['cen_id'];
$cen_name = $row['centname'];
$vtp = $row['vtpp'];
$tp_code= substr($row['cen_id'],7,10 );
$center_id = $row['center_id'];
$cou_sec = $row['cou_sec'];
$cou_name = $row['cou_name'];
$cou_code = $row['cou_code'];
$pr_dt = $row['dt'];
$btchno = $row['pr_btchid'];
$scheme = $row['scheme'];
$ttl=$row['ttl'];
$ab=$row['ab'];
$reg=$row['regd_id'];
$fl_as_dt=$row['fl_as_dt'];
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <title>Result Sheet :: CUTM-AMASY</title>
    <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
</head>

<body class="container" onload="window.print()">
<div class="row">
    <div class="col-md-2">
        <center><img src="https://amasy.cutmams.in/assets/img/cutm.png" height="100px;"></center>
    </div>
    <div class="col-md-8">
        <center>
            <br/>
            <h6>CENTURION UNIVERSITY OF TECHNOLOGY AND MANAGEMENT</h6>
            <h6>AWARDING BODY</h6>
            <h6>AMASY PORTAL</h6>
            <h6>Result Sheet</h6>
        </center>
    </div>
    <div class="col-md-2">
        <?php


switch ($scheme) {
    case "SEEDAP-AYS":
      
        echo "<center><img src='https://amasy.cutmams.in/assets/img/seedap.png' style='height: 100px;'></center>";
        break;
    default:
        echo "<center><img src='https://amasy.cutmams.in/assets/img/brand/logo.png'></center>";
}
?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <center>
            <h6>SCHEME : <?=$scheme;?></h6>
        </center>
    </div>
</div>

<div class="row" style="padding: 30px;">
    <table class="table table-bordered">
        <tr>
            <td>
                ABN NO. :
            </td>
            <td colspan="3">
                <?=$abn;?>
            </td>
        </tr>
        <tr>
            <td>VTP NAME :</td>
            <td><?=$cen_name;?></td>
            <td>VTP CODE :</td>
            <td><?=$tp_code;?></td>
        </tr>
        <tr>
            <td>CENTRE NAME :</td>
            <td><?=$cen_name;?></td>
            <td>CENTER CODE :</td>
            <td><?=$center_id;?></td>
        </tr>
        <tr>
            <td>SECTOR NAME :</td>
            <td><?=$cou_sec;?></td>
            <td>SECTOR CODE :</td>
            <td><?=$cou_code;?></td>
        </tr>
        <tr>
            <td>COURSE NAME :</td>
            <td><?=$cou_name;?></td>
            <td>COURSE CODE :</td>
            <td><?=$cou_code;?></td>
        </tr>
        <tr>
            <td>EXAM DATE :</td>
            <td><?=$fl_as_dt;?></td>
            <td>BATCH NO. :</td>
            <td><?=$btchno;?></td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <th>
                SL. NO
            </th>
            <th>
                REGD. NO.
            </th>
            <th>
                CANDIDATE NAME
            </th>
            <th>
                GUARDIAN'S NAME
            </th>
            <th>
                THEORY
            </th>
            <th>
                PRACTICAL
            </th>
            <th>
                VIVA
            </th>
            <th>
				MARK SECURED OUT OF </br>TOTAL MARK (200)
            </th>
            <th>
                GRADE
            </th>
            <th>
                RESULT
            </th>
        </tr>
        <?php
include ('scripts/dbcon.php');
$prabn = $_REQUEST['pr_abn_no'];					
$result ="SELECT *,(CASE WHEN b.total BETWEEN '110' AND '200' THEN 'PASS' WHEN b.total = ' ' THEN 'ABSENT' ELSE 'FAIL' END) as result, (CASE WHEN b.total BETWEEN '175' AND '200' THEN 'A' WHEN b.total BETWEEN '150' AND '174' THEN 'B' WHEN b.total BETWEEN '125' AND '149' THEN 'C'  ELSE 'D' END) as grade FROM btch_2 a INNER JOIN btch_3 b ON a.mprId = b.mprId where b.pr_abn_no ='$prabn' GROUP BY a.mprId ";
$serialNumber=1;
$can_id = '321';
$can_sno = $row['id'];		
$result=mysqli_query($con,$result);
    if ($result->num_rows > 0) {
            echo'';
				while($row = mysqli_fetch_array($result))  {
					echo "<tr><td>".$serialNumber++."</td><td>".$row["uid"]."</td><td>".$row["candidateName"]."</td><td>".$row["fathersName"]."</td><td>".$row["theory"]."</td><td>".$row["practical"]."</td><td>".$row["viva"]."</td><td>".$row["total"]."</td><td>".$row["grade"]."</td><td>".$row["result"]."</td></tr>";
}
    echo "</div></table>";
} else {
    echo "<center><h4>Data Not Uploaded! Please contact Admin!</h4></center>";
}
mysqli_close($con);
?>    
            <?php
            $serialNumber++;
        
        ?>
    </table>
</div>
</body>
</html>