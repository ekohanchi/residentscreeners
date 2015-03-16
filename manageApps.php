<html>
<head>
<title>Manage Applications</title>
<style type='text/css'>
	tr.rowhighlight:hover { background:#BDEDFF; }
</style>
</head>
<body>
<?php
include("login.php"); 
?>
<center>
<h1>Manage Applications</h1>
</center>
<?php
include("include/configs.php");
include("menubar.php");

function displayFields($table,$fields2display) {
	$query = "Select $fields2display from $table where appstatus=100 order by inserted desc;";
	$result = mysql_query($query);
	if (!$result) {
	    die("<br>Query to show fields from table FAILED - Database may not have been set up!");
	}
	$numof_fields = mysql_num_fields($result);
	echo "<table width=\"50%\" align=\"center\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">";
	echo "<tr>";
		// printing table headers
	echo "<td bgcolor=\"#3BB9FF\" align=\"center\"><b>Date & Time when application was inserted</b></td>";
	echo "<td bgcolor=\"#3BB9FF\" align=\"center\"><b>Submitted applications</b></td>";
//	for($i=0; $i<$numof_fields; $i++) {
//		$field = mysql_fetch_field($result);
//		echo "<td bgcolor=\"#ACB356\" align=\"center\"><b>{$field->name}</b></td>";
//	}
//	echo "</tr>\n";
		// printing table rows
	$i=0;
	$j=1;
	while($row = mysql_fetch_row($result)) {
		echo "<tr class=\"rowhighlight\">";
		$queryall = "Select * from $table where appstatus=100 order by inserted desc;;";
		$resultall = mysql_query($queryall);
		$appid = mysql_result($resultall,$i,"appid");
		$i++;
		foreach($row as $cell) {
			if ($j%2 ==0 ) {
				echo "<td><center><a href=\"viewApp.php?appid=$appid\">$cell</a></center></td>";
			} else {
				echo "<td><center>$cell</center></td>";
			}
			$j++;
			
		}
		echo "</tr>\n";
	}
	mysql_free_result($result);
	echo "</table";
}

function changeRefstatus($newappstatus, $appid, $memapp_table) {
	$query="Select appstatus from $memapp_table where appid='$appid'";
	$result=mysql_query($query);
	$org_appstatus=mysql_result($result,0,"appstatus");
	
		//check if app id exists, if not exit
	$query="Select appid from $memapp_table where appid='$appid' limit 1";
	$result=mysql_query($query);
	$num_rows=mysql_numrows($result);
//		echo "<br>num rows value: $num_rows<br>";
//		echo "Query: $query<br>";
	
	if ($num_rows == 1) {
		if ($org_appstatus != $newappstatus) {
			if ($newappstatus == 10 && $org_appstatus == 100) {
				$query="Update $memapp_table set appstatus='$newappstatus' where appid='$appid'";
				mysql_query($query);
				echo "<font color=\"green\">Update completed! The status of $appid has been changed from $org_appstatus to $newappstatus</font>";
			}
			else {
				echo "<font color=\"red\">ERROR In order for a appid's status to be changed to test, its current status must be a submitted app.</font>";
			}
			
		}
		else {
			echo "<font color=\"red\">ERROR new appstatus is the same as current one. No change was done.</font>";
		}
	}
	else {
		echo "<font color=\"red\">ERROR appid '$appid' does not exist.</font>";
	}
}

include("db/opendb.php");


?>
<form name="appstatusChangeForm" method="post" action="manageApps.php">
	Enter the appid of the application you wish to change its status to <b>test</b>:
	<input type="text" name="txt_appid" size="25" maxlength="20">
	<input type="hidden" name="hdn_status" value="statusTotest">
	<input type="submit" value="Submit"><br>
</form>
<?php
if (isset($_REQUEST['hdn_status'])) {
	if (isset($_REQUEST['txt_appid']))  {
		$appid=trim($_REQUEST['txt_appid']);
		if ($appid == '') {
			echo "<font color=\"red\">ERROR An appid must be entered, before it can be processed. No appid status was changed.</font>";
		}
		else {
			changeRefstatus(10, $appid, $memapp_table);
		}
	}
}

echo "<b>NOTE</b>: Displaying only submitted real applications. Changing the appid of an application to test, will NOT show as part of this list.<br><br>";

displayFields($memapp_table,'inserted, appid');

include("db/closedb.php");
?>
</body>
</html>
