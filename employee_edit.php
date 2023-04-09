<html>
<head>
<title>PHP Project - Edit Employee</title>

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
<h2 style="text-align:center">Edit Employee</h2>
<br><br>

<?php 
include ("dbconnect.php");
$emp_id=$_GET['id'];

$qry = "select * from empl where id='".$emp_id."'";
$empl_dat = mysqli_query($con,$qry);
$empl_rw = mysqli_fetch_array($empl_dat);
?>


<form name="f1" id="f1" action="employee_update.php" method="post">
<table width="40%" cellpadding="5" cellspacing="1" align="center">
	<tr>
		<td>Employee Name</td>
		<td>
			<input type="text" name="emp_nm" id="emp_nm" value="<?php echo $empl_rw['name']; ?>" style="width:100%">
			<input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>" style="width:100%">
		</td>
	</tr>
	<tr>
		<td>City/Location</td>
		<td><input type="text" name="emp_city" id="emp_city" value="<?php echo $empl_rw['city']; ?>" style="width:100%"></td>
	</tr>
	<tr>
		<td>Mobile No.</td>
		<td><input type="text" name="emp_mob" id="emp_mob" value="<?php echo $empl_rw['phone']; ?>" style="width:60%"></td>
	</tr>
	<tr>
		<td>Age</td>
		<td><input type="text" name="emp_age" id="emp_age" value="<?php echo $empl_rw['age']; ?>" style="width:30%"></td>
	</tr>
	<tr>
		<td>Gender</td>
		<td>
			<select name="emp_sex" id="emp_sex">
				<option value="--" <?php if($empl_rw['gender']=='--'){ ?>selected<?php } ?>>Select Gender</option>
				<option value="M" <?php if($empl_rw['gender']=='M'){ ?>selected<?php } ?>>Male</option>
				<option value="F" <?php if($empl_rw['gender']=='F'){ ?>selected<?php } ?>>Female</option>
				<option value="O" <?php if($empl_rw['gender']=='O'){ ?>selected<?php } ?>>Others</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="updt_btn" id="updt_btn" value="Update" title="Update record to Database" style="margin-top:30px">&nbsp;
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
