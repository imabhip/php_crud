<?php
if(!isset($_SESSION)) {
session_start();
}
$sess_val = session_id();

include("dbconnect.php"); 

$qry="Select * from users where session_id='".$sess_val."' and status='in'";
$usr_dat = mysqli_query($con,$qry);
if(($row_user = mysqli_fetch_array($usr_dat))!=null){
	$cur_user=$row_user['full_name'];
	$m=$row_user['mode'];
	$stat="in";
}else{
	$cur_user="GUEST";
	$m="G";
	$stat="out";
}

if($stat=='in'){
	$emp_nm=$_POST['emp_nm'];
	$emp_city=$_POST['emp_city'];
	$emp_mob=$_POST['emp_mob'];
	$emp_age=$_POST['emp_age'];
	$emp_sex=$_POST['emp_sex'];

	$qry="INSERT INTO empl VALUES (NULL, '".$emp_nm."', '".$emp_age."', '".$emp_sex."', '".$emp_mob."', '".$emp_city."')";

	mysqli_query($con,$qry);
}

//echo $qry;
header("location:employee_save_status.php");
?>

