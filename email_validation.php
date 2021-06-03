<?php 
require_once("includes/config.php");

if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "<span style='color:red'>Invalid Email Address!</span>";
	}
	else {
		$sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'>Email Address Already Registered!</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'>Email Valid For Registration, Please Proceed!</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
?>
