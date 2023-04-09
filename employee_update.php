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

if($stat=='in' && $m=='A'){
	$emp_id=$_POST['emp_id'];
	$emp_nm=$_POST['emp_nm'];
	$emp_city=$_POST['emp_city'];
	$emp_mob=$_POST['emp_mob'];
	$emp_age=$_POST['emp_age'];
	$emp_sex=$_POST['emp_sex'];

	$qry="update empl set name='".$emp_nm."', age='".$emp_age."', gender='".$emp_sex."', phone='".$emp_mob."', city='".$emp_city."' where id='".$emp_id."'";

	mysqli_query($con,$qry);
}

header("location:employee_update_status.php");
?>

