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
	$emp_id=$_GET['id'];

	$qry="delete from empl where id='".$emp_id."'";
	mysqli_query($con,$qry);
}

header("location:employee_del_status.php");
?>

