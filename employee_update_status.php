<html>
<head>
<title>PHP Project - Update Employee Status</title> 

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
?>
</head>

<body>

<?php if($stat=='in' && $m=='A'){ ?>

<br><br>
<h2 style="text-align:center">Employee Data Updated Successfully</h2>
<br><br>
<center>
<input type="button" name="back_btn" id="back_btn" onClick="window.open('index.php','_parent');" value="Back to List" title="Back to Employee List">
</center>

<?php }else{ ?>

<table width="500" cellpadding="5" cellspacing="1" align="center" style="margin-top:100px;background-color:#ccc">
	<tr>
		<td style="background-color:#fff;color:red;text-align:center;height:100px">You are not authorised to access this page.</td>
	</tr>
	
	<tr>
		<td style="background-color:#fff;text-align:center">
			<input type="button" name="try" id="try" value="Try Again" style="height:25px;padding-left:5px" onClick="history.back(-1);">&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="Cancel" style="height:25px;padding-left:5px" onClick="window.open('index.php','_parent');">
		</td>
	</tr>
</table>

<?php } ?>

</body>

</html>