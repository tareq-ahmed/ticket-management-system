<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['buy']))
{
$tdata1=$_POST['ac1st'];
$tdata2=$_POST['1st'];
$tdata3=$_POST['2nd'];
$today=date("Y-m-d");
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>RailManager</title>
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">

<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">

</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header contactus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Book Tickets</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Book Tickets</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Contact-us-->

<section class="contact_us section-padding">
<div class="container">
<div  class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading" style='background-color:#4FAC03'>Ticket Details</div>
    <div class="panel-body" style='background-color:#b3ffb3'>

<?php 
if (($tdata1+$tdata2+$tdata3)==0) {
echo "<h5 style='color:darkred'>You Need To Select At Least One Ticket!</h5>";
}
elseif (($tdata1+$tdata2+$tdata3)>4) {
  echo "<h5 style='color:darkred'>You Cannot Buy More Than 4 Tickets!</h5>";
  }
else{ ?>
<div class="table-responsive">
    <table class="display table table-bordered table-hover" cellspacing="0" width="100%">
<?php
    $sql = "SELECT * from  tblschedule where Schedule_Number='$schedule_number'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    { ?>
                  <thead style='background-color:#4FAC03'>
                    <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Arrival</th>
                    <th>Departure</th>
                    <th>Date</th>
                    <th>Tickets</th>
                    </tr>
                  </thead>
                  <tbody>
   <?php                 
foreach($results as $result)
{   $fromdata=($result->ST_From);
    $todata=($result->ST_To);
   ?>        
  
                    <tr>
                      <td><?php echo htmlentities($result->ST_From);?></td>
                      <td><?php echo htmlentities($result->ST_To);?></td>
                      <td><?php echo htmlentities($result->Arrival_Time);?></td>
                      <td><?php echo htmlentities($result->Departure_Time);?></td>
                      <td><?php echo htmlentities($result->JR_Date);?></td>
                      <td><?php echo htmlentities($tdata1+$tdata2+$tdata3);?></td>
                      
                    <?php }}?>

                    </tbody>
                    </table>
                  </div>

      <div class="table-responsive">
    <table class="display table table-bordered table-hover" cellspacing="0" width="100%">
<?php
echo $fromdata;
echo $todata;

    $sql = "SELECT * from  tblfares ST_1='$fromdata' and ST_2='$todata'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    { ?>
                  <thead style='background-color:#4FAC03'>
                    <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>AC First Class Fare</th>
                    <th>First Class Fare</th>
                    <th>Seccond Class Fare</th>
                    </tr>
                  </thead>
                  <tbody>
    <?php foreach($results as $result)
            { ?> 
                <tr>
                  <td><?php echo htmlentities($result->ST_1);?></td>
                  <td><?php echo htmlentities($result->ST_2);?></td>
                  <td><?php echo htmlentities($result->AC_First_Class_Fare);?></td>
                  <td><?php echo htmlentities($result->First_Class_Fare);?></td>
                  <td><?php echo htmlentities($result->Seccond_Class_Fare);?></td>
                      
                    <?php}}
else{
  $sql = "SELECT * from  tblfares where ST_1='$todata' and ST_2='$fromdata'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    { ?>
                  <thead style='background-color:#4FAC03'>
                    <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>AC First Class Fare</th>
                    <th>First Class Fare</th>
                    <th>Seccond Class Fare</th>
                    </tr>
                  </thead>
                  <tbody>
    <?php foreach($results as $result)
            { ?> 
                <tr>
                  <td><?php echo htmlentities($result->ST_2);?></td>
                  <td><?php echo htmlentities($result->ST_1);?></td>
                  <td><?php echo htmlentities($result->AC_First_Class_Fare);?></td>
                  <td><?php echo htmlentities($result->First_Class_Fare);?></td>
                  <td><?php echo htmlentities($result->Seccond_Class_Fare);?></td>
                  <?php }}}?>

                    </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
  
    </div>

  </div>
</section>
<!-- /Contact-us--> 


<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
<?php }?>