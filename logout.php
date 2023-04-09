<?php
if(!isset($_SESSION)) {
session_start();
}
$sess_val = session_id();

include("dbconnect.php");

$qry="update users set session_id='', status='' where session_id='".$sess_val."'";
mysqli_query($con,$qry);

header('Location: index.php');
?>