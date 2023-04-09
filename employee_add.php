<html>
<head>
<title>PHP Project - Add Employee</title>

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

<?php if($stat=='in'){ ?>

<br><br>
<h2 style="text-align:center">Add Employee</h2>
<br><br>

<form name="f1" id="f1" action="employee_save.php" method="post">
<table width="40%" cellpadding="5" cellspacing="1" align="center">
	<tr>
		<td>Employee Name</td>
		<td><input type="text" name="emp_nm" id="emp_nm" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>City/Location</td>
		<td><input type="text" name="emp_city" id="emp_city" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>Mobile No.</td>
		<td><input type="text" name="emp_mob" id="emp_mob" value="" style="width:60%"></td>
	</tr>
	<tr>
		<td>Age</td>
		<td><input type="text" name="emp_age" id="emp_age" value="" style="width:30%"></td>
	</tr>
	<tr>
		<td>Gender</td>
		<td>
			<select name="emp_sex" id="emp_sex">
				<option value="--">Select Gender</option>
				<option value="M">Male</option>
				<option value="F">Female</option>
				<option value="O">Others</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="save_btn" id="save_btn" value="Save" title="Save record to Database" style="margin-top:30px">&nbsp;
			<input type="button" name="cancel_btn" id="cancel_btn" value="Cancel" onClick="history.back(-1);" title="Cancel and return to List" style="margin-top:30px">&nbsp;
		</td>
	</tr>
</table>
</form>

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
