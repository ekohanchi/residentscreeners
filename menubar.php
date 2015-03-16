<?php
/*
 * Created on Mar 31, 2010
 *
 */
?>
<html>
<head>
</head>
<body>

<form>
	<input style="color: blue; font-weight: bold" type=button onclick="document.location.href='manageApps.php'" value="Mange Client Sign ups">
	<input style="color: Chocolate; font-weight: bold" type=button onclick="document.location.href='summaryReport.php'" value="Start A New Summary Report">
	<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
	<?php
	if ($_SESSION['user'] == "mvannalom" || $_SESSION['user'] == "ekohanchi") { ?>
		<input style="color: Maroon; font-weight: bold" type=button onclick="document.location.href='manageUsers.php'" value="Manage Users">
	<?php
	}
	if ($_SESSION['user'] == "ekohanchi") { ?>
		<input style="color: Maroon; font-weight: bold" type=button onclick="document.location.href='db/index.php'" value="DB Management">
		<input style="color: Maroon; font-weight: bold" type=button onclick="document.location.href='sessionmanager.php'" value="Session Management">	
	<?php
	}?>
	<br>
</form>

</body>
</html>