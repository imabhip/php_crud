<html>
<head>
<title>PHP Project - Employee Details</title>

</head>

<body>

<?php
if(!isset($_SESSION)) {
session_start();
}
$sess_val = session_id();

include("dbconnect.php");

$usrnm=$_POST['usernm'];
$passw=$_POST['passw'];

//echo $usrnm.", ".$passw;

$qry="Select * from users where user_id='".$usrnm."' and passw='".$passw."'";
$usr_dat = mysqli_query($con,$qry);
if(($row_user = mysqli_fetch_array($usr_dat))!=null){
	//echo $row_user['full_name'].", ".$row_user['mode'];
	$qry1="update users set session_id='".$sess_val."', status='in' where user_id='".$usrnm."' and passw='".$passw."'";
	mysqli_query($con,$qry1);
	
	header('Location: index.php');
	exit;
}else{
?>

<table width="500" cellpadding="5" cellspacing="1" align="center" style="margin-top:100px;background-color:#ccc">
	<tr>
		<td style="background-color:#fff;color:red;text-align:center;height:100px">Invalid Username or Password.</td>
	</tr>
	
	<tr>
		<td style="background-color:#fff;text-align:center">
			<input type="button" name="try" id="try" value="Try Again" style="height:25px;padding-left:5px" onClick="history.back(-1);">&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="Cancel" style="height:25px;padding-left:5px" onClick="window.open('index.php','_parent');">
		</td>
	</tr>
</table>

</body>
</html>
<?php } ?>