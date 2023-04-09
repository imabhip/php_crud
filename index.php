<html>

<head>
	<title>PHP Project - Employee Details</title>

	<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	$sess_val = session_id();

	include("dbconnect.php");

	$qry = "Select * from users where session_id='" . $sess_val . "' and status='in'";
	$usr_dat = mysqli_query($con, $qry);
	if (($row_user = mysqli_fetch_array($usr_dat)) != null) {
		$cur_user = $row_user['full_name'];
		$m = $row_user['mode'];
		$stat = "in";
	} else {
		$cur_user = "GUEST";
		$m = "G";
		$stat = "out";
	}
	?>

	<script language="JavaScript">
		function setSearchFld() {
			if (document.getElementById('srch_opt').value == 'All') {
				document.getElementById('srch_val').disabled = true;
				document.getElementById('srch_val').placeholder = "";
			} else {
				document.getElementById('srch_val').disabled = false;
				if (document.getElementById('srch_opt').value == 'By Name Start' || document.getElementById('srch_opt').value == 'By Name Having') {
					document.getElementById('srch_val').placeholder = "Enter Name Srting";
				} else if (document.getElementById('srch_opt').value == 'By Phone') {
					document.getElementById('srch_val').placeholder = "Enter Phone No.";
				} else if (document.getElementById('srch_opt').value == 'By City') {
					document.getElementById('srch_val').placeholder = "Enter City";
				}
			}
		}
	</script>

</head>

<body>

	<?php
	if (isset($_POST['srch_opt'])) {
		$srch_opt = $_POST['srch_opt'];
	} else {
		$srch_opt = 'All';
	}
	if (isset($_POST['srch_val'])) {
		$srch_val = $_POST['srch_val'];
	} else {
		$srch_val = '';
	}
	if (isset($_POST['srch_sex'])) {
		$srch_sex = $_POST['srch_sex'];
	} else {
		$srch_sex = '';
	}
	if (isset($_POST['srch_agegrp'])) {

		$srch_agegrp = $_POST['srch_agegrp'];
		if ($srch_agegrp == "All") {
			$min_age = 0;
			$max_age = 1000;
		} elseif ($srch_agegrp == "Minor") {
			$min_age = 0;
			$max_age = 17;
		} elseif ($srch_agegrp == "18-29") {
			$min_age = 18;
			$max_age = 29;
		} elseif ($srch_agegrp == "30-44") {
			$min_age = 30;
			$max_age = 44;
		} elseif ($srch_agegrp == "45-59") {
			$min_age = 45;
			$max_age = 59;
		} elseif ($srch_agegrp == "Senior") {
			$min_age = 60;
			$max_age = 1000;
		}
	} else {
		$srch_agegrp = 'All';
		$min_age = 0;
		$max_age = 1000;
	}
	if (isset($_POST['page_rows'])) {
		$page_rows = $_POST['page_rows'];
	} else {
		$page_rows = "5";
	}
	if (isset($_POST['cur_pg'])) {
		$cur_pg = $_POST['cur_pg'];
	} else {
		$cur_pg = 1;
	}

	$strt_rw = $page_rows * ($cur_pg - 1);
	?>

	<br><br>
	<form name="f1" id="f1" action="index.php" method="post">

		<table width="70%" cellpadding="0" cellspacing="1" align="center">
			<tr>
				<td colspan="2" style="font-weight:normal;text-align:right">
					User: <?php echo $cur_user; ?> &nbsp;&nbsp;
					<?php if ($stat == "in") { ?>
						<input type="button" name="logout" id="logout" value="Logout" style="height:25px" onClick="window.open('logout.php','_parent');">
					<?php } else { ?>
						<input type="button" name="login" id="login" value="Login" style="height:25px" onClick="window.open('login.php','_parent');">
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-weight:bold;text-align:center;font-size:25px;padding-top:30px;padding-bottom:30px">Employee Details</td>
				0
			</tr>
			<tr>
				<td width="80%">
					<select name="srch_opt" id="srch_opt" style="height:25px;padding:3px;margin-bottom:20px" onChange="setSearchFld();">
						<option value="All" <?php if ($srch_opt == "All") { ?> selected <?php } ?>>Show All</option>
						<option value="By Name Start" <?php if ($srch_opt == "By Name Start") { ?> selected <?php } ?>>Search by Name starts with</option>
						<option value="By Name Having" <?php if ($srch_opt == "By Name Having") { ?> selected <?php } ?>>Search by Name having anywhere</option>
						<option value="By Phone" <?php if ($srch_opt == "By Phone") { ?> selected <?php } ?>>Search by Phone</option>
						<option value="By City" <?php if ($srch_opt == "By City") { ?> selected <?php } ?>>Search by City</option>
					</select>
					&nbsp;&nbsp;
					<input type="text" name="srch_val" id="srch_val" value="<?php echo $srch_val; ?>" placeholder="" style="height:25px;margin-bottom:20px;padding-left:5px" <?php if ($srch_opt == "All") { ?> disabled <?php } ?>>
					&nbsp;&nbsp;
					<select name="srch_sex" id="srch_sex" style="height:25px;padding:3px;margin-bottom:20px">
						<option value="" <?php if ($srch_sex == "") { ?> selected <?php } ?>>All Genders</option>
						<option value="M" <?php if ($srch_sex == "M") { ?> selected <?php } ?>>Male</option>
						<option value="F" <?php if ($srch_sex == "F") { ?> selected <?php } ?>>Female</option>
						<option value="O" <?php if ($srch_sex == "O") { ?> selected <?php } ?>>Others</option>
					</select>
					&nbsp;&nbsp;
					<select name="srch_agegrp" id="srch_agegrp" style="height:25px;padding:3px;margin-bottom:20px">
						<option value="All" <?php if ($srch_agegrp == "All") { ?> selected <?php } ?>>All Ages</option>
						<option value="Minor" <?php if ($srch_agegrp == "Minor") { ?> selected <?php } ?>>Minrors</option>
						<option value="18-29" <?php if ($srch_agegrp == "18-29") { ?> selected <?php } ?>>18 - 29 Yrs</option>
						<option value="30-44" <?php if ($srch_agegrp == "30-44") { ?> selected <?php } ?>>30 - 44 Yrs</option>
						<option value="45-59" <?php if ($srch_agegrp == "45-59") { ?> selected <?php } ?>>45 - 59 Yrs</option>
						<option value="Senior" <?php if ($srch_agegrp == "Senior") { ?> selected <?php } ?>>Seniors</option>
					</select>
					&nbsp;&nbsp;
					<input type="submit" name="srch_btn" id="srch_btn" value="Search" style="height:25px;margin-bottom:20px">
				</td>
				<td align="right">
					<?php if ($stat == 'in') { ?>
						<input type="button" name="add_rec" id="add_rec" value="Add Record" onClick="window.open('employee_add.php','_parent');" title="Add new record" style="height:25px;margin-bottom:20px">
					<?php } ?>
				</td>
			</tr>
		</table>

		<table width="70%" cellpadding="5" cellspacing="1" align="center" style="background-color:#ccc">
			<tr>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">ID</td>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">Name</td>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">Gender</td>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">Age</td>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">Phone No</td>
				<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">City</td>
				<?php if ($stat == 'in' && $m == 'A') { ?>
					<td style="background-color:#006699;color:#ffffff;text-align:center;font-weight:bold">Action</td>
				<?php } ?>
			</tr>

			<script language="Javascript">
				function delRec(id) {
					var result = confirm("Are you sure to delete record No. " + id + "?");
					if (result) {
						//alert("You opted to delete record No."+id);
						window.open('employee_del.php?id=' + id, '_parent');
					}
				}
			</script>

			<?php
			$c = 0;
			if ($srch_opt == 'All') {
				$qry = "select * from empl where gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . " limit " . $strt_rw . ", " . $page_rows . "";

				$rec_cnt = "select count(id) as r_cnt from empl where gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . "";
			} elseif ($srch_opt == 'By Name Start') {
				$qry = "select * from empl where name like '" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . " limit " . $strt_rw . ", " . $page_rows . "";

				$rec_cnt = "select count(id) as r_cnt from empl where name like '" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . "";
			} elseif ($srch_opt == 'By Name Having') {
				$qry = "select * from empl where name like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . " limit " . $strt_rw . ", " . $page_rows . "";

				$rec_cnt = "select count(id) as r_cnt from empl where name like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . "";
			} elseif ($srch_opt == 'By Phone') {
				$qry = "select * from empl where phone like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . " limit " . $strt_rw . ", " . $page_rows . "";

				$rec_cnt = "select count(id) as r_cnt from empl where phone like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . "";
			} elseif ($srch_opt == 'By City') {
				$qry = "select * from empl where city like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . " limit " . $strt_rw . ", " . $page_rows . "";
				
				$rec_cnt = "select count(id) as r_cnt from empl where city like '%" . $srch_val . "%' and gender like '%" . $srch_sex . "%' and age between " . $min_age . " and " . $max_age . "";
			}

			$row_cnt = mysqli_query($con, $rec_cnt);
			$row_cnt_val = mysqli_fetch_array($row_cnt);
			$tot_rows = $row_cnt_val['r_cnt'];

			$tot_pgs = ceil($tot_rows / $page_rows);

			$empl_dat = mysqli_query($con, $qry);
			while (($empl_rw = mysqli_fetch_array($empl_dat)) != null) {
				$c++;
			?>

				<tr>
					<td style="background-color:#fff;color:#444;text-align:center"><?php echo $empl_rw['id']; ?></td>
					<td style="background-color:#fff;color:#444"><?php echo $empl_rw['name']; ?></td>
					<td style="background-color:#fff;color:#444;text-align:center"><?php echo $empl_rw['gender']; ?></td>
					<td style="background-color:#fff;color:#444;text-align:center"><?php echo $empl_rw['age']; ?></td>
					<td style="background-color:#fff;color:#444;text-align:center"><?php echo $empl_rw['phone']; ?></td>
					<td style="background-color:#fff;color:#444"><?php echo $empl_rw['city']; ?></td>
					<?php if ($stat == 'in' && $m == 'A') { ?>
						<td style="background-color:#fff;color:#444;text-align:center">
							<input type="button" name="edit<?php echo $c; ?>" id="edit<?php echo $c; ?>" onclick="window.open('employee_edit.php?id=<?php echo $empl_rw['id']; ?>','_parent');" value="Edit" title="Edit this Employee data">&nbsp;
							<input type="button" name="del<?php echo $c; ?>" id="del<?php echo $c; ?>" onClick="delRec(<?php echo $empl_rw['id']; ?>);" value="Delete" title="Delete this Employee data">
						</td>
					<?php } ?>
				</tr>

			<?php } ?>

			<tr>
				<td colspan="7" style="text-align:right;background-color:#eee">Showing <b><?php echo $c; ?></b> records of total <b><?php echo $tot_rows; ?></b></td>
			</tr>
		</table>

		<table width="70%" cellspadding="0" cellspacing="1" align="center" style="margin-top:10px">
			<tr>
				<td>
					<select name="page_rows" id="page_rows" style="width:50px;height:25px" onChange="document.getElementById('srch_btn').click();">
						<option value="2" <?php if ($page_rows == "2") { ?>selected<?php } ?>>2</option>
						<option value="5" <?php if ($page_rows == "5") { ?>selected<?php } ?>>5</option>
						<option value="25" <?php if ($page_rows == "25") { ?>selected<?php } ?>>25</option>
						<option value="50" <?php if ($page_rows == "50") { ?>selected<?php } ?>>50</option>
					</select> &nbsp; per page
				</td>

				<script language="JavaScript">
					function setPrev() {
						document.getElementById('cur_pg').value = parseInt(document.getElementById('cur_pg').value) - 1;
						document.getElementById('srch_btn').click();
					}

					function setNext() {
						document.getElementById('cur_pg').value = parseInt(document.getElementById('cur_pg').value) + 1;
						document.getElementById('srch_btn').click();
					}
				</script>

				<td style="text-align:right">
					<?php if ($cur_pg > 1) { ?>
						<input type="button" name="prev" id="prev" value="Previous" onClick="setPrev();" style="height:25px"> &nbsp;&nbsp;&nbsp;
					<?php } ?>

					Page <input type="text" name="cur_pg" id="cur_pg" value="<?php echo $cur_pg; ?>" style="width:30px;text-align:right;height:25px"> / <?php echo $tot_pgs; ?>

					<?php if ($cur_pg < $tot_pgs) { ?>
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="next" id="next" value="Next" onClick="setNext();" style="height:25px">
					<?php } ?>
				</td>
		</table>
	</form>
</body>

</html>