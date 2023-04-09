<html>
<head>
<title>PHP Project - Employee Details</title>

</head>

<body>
<form name="f1" id="f1" action="chk_user.php" method="post">

<table width="350" cellpadding="5" cellspacing="1" align="center" style="margin-top:100px;background-color:#ccc">
	<tr>
		<td colspan="2" style="background-color:#006699;text-align:center;color:#ffffff;font-weight:bold">ADMIN LOGIN</td>
	</tr>
	<tr>
		<td style="background-color:#fff">Username</td>
		<td style="background-color:#fff">
			<input type="text" name="usernm" id="usernm" value="" placeholder="Username" style="height:25px;padding-left:5px;width:100%">
		</td>
	</tr>
	<tr>
		<td style="background-color:#fff">Password</td>
		<td style="background-color:#fff">
			<input type="password" name="passw" id="passw" value="" placeholder="Password" style="height:25px;padding-left:5px;width:100%">
		</td>
	</tr>
	<tr>
		<td style="background-color:#fff">&nbsp;</td>
		<td style="background-color:#fff">
			<input type="submit" name="login" id="login" value="Login" style="height:25px;padding-left:5px">&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="Cancel" style="height:25px;padding-left:5px" onClick="history.back(-1);">
		</td>
	</tr>
</table>

</form>

</body>
</html>