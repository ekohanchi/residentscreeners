<html>
<head>
<title>Manage Applications</title>
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

function runQuery($stmt, $option) {
	//option=values: displays values for sql statment
	//option=count: displays count for sql statement
	$query = $stmt;
	$result = mysql_query($query);
	$num=mysql_numrows($result);
	$i=0;
	while ($i < $num) {
		//$id=mysql_result($result,$i,"id");
		$appid=mysql_result($result,$i,"appid");
		if ($option == "values") {
			echo "<a href=\"viewApp.php?appid=$appid\">$appid</a><br>";
		}
		$i++;
	}
	if ($option == "count") {
		echo "$i";
	}
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

$query_all = "Select appid from $memapp_table;";
$query_test = "Select appid from $memapp_table where appstatus=10";
$query_submitted = "Select appid from $memapp_table where appstatus=100";

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
?>

<table width="100%" align="center" border="1" cellpadding="2" cellspacing="2">
	<tr>
		<td bgcolor="#cccccc" width="180" align="center"><b>All applications (<?php runQuery("$query_all", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Test applications (<?php runQuery("$query_test", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Submitted applications (<?php runQuery("$query_submitted", "count"); ?>)</b></td>
	</tr>
	<tr>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_all", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_test", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_submitted", "values"); ?></td>
	</tr>
</table>

<?php
include("db/closedb.php");
?>
</body>
</html>
