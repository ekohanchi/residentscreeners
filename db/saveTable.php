<html>
<head>
</head>
<body>

<?php
/*
 * last modified: 3/21/10
 */

include("../include/configs.php");
include("../login.php"); 

$Unixtime = time();
$datetime = date("YmdHis", $Unixtime + -3.00 * 3600);

if(isset($_GET['memapps']) || isset($_GET['summaryreport'])) {
	if(isset($_GET['memapps'])) {
		$table = $memapp_table;
		$backupFile = "backup_${table}_${datetime}.gz";
	}
	if(isset($_GET['summaryreport'])) {
		$table = $sumr_table;
		$backupFile = "backup_${table}_${datetime}.gz";
	}

	include("opendb.php");
	$query = "SELECT * INTO OUTFILE '$backupFile' FROM $table";
	//mysql_query($query) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $query . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
	$result = mysql_query($query);
	//$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpassword $database | gzip > $backupFile";
	//system($command);
	include("closedb.php");
	
	echo "<h3>Successful!</h3>";
	echo "Table saved: $table<br>";
	echo "File name of table saved: $backupFile";
	echo "<br>";
	echo "<br>Back to <a href=\"index.php\">Database Management</a>";
}
else {
	echo "Sorry, Table name not specified as parameter<br>";
	echo "<br>Back to <a href=\"index.php\">Database Management</a>";
}
?> 

</body>
</html>