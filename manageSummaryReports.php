<html>
<head>
<title>Manage Summary Reports</title>
<style type='text/css'>
	tr.rowhighlight:hover { background:#ECF3E1; }
</style>
</head>
    <body>
    <?php
    include("login.php");
	?>
	<center>
		<h1>Manage Summary Reports</h1>
	</center>
	<?php
include("include/configs.php");
include("menubar.php");

function displayFields($table,$fields2display) {
	$query = "Select $fields2display from $table where srfstatus != 0 order by inserted desc;";
	$result = mysql_query($query);
	if (!$result) {
	    die("<br>Query to show fields from table FAILED - Database may not have been set up!");
	}
	$numof_fields = mysql_num_fields($result);
	echo "<br><b>Actions</b>: GSR = <b>G</b>enerate <b>S</b>ummary <b>R</b>eport";
	echo " | Delete = <font color=\"red\">Choosing to delete a summary report is currently NOT easily reversable</font>";
	echo "<table width=\"100%\" align=\"center\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">";
	echo "<tr>";
		// printing table headers
	echo "<td bgcolor=\"#ECF3E1\" align=\"center\"><b>Actions</b></td>";
	for($i=0; $i<$numof_fields; $i++) {
		$field = mysql_fetch_field($result);
		echo "<td bgcolor=\"#ACB356\" align=\"center\"><b>{$field->name}</b></td>";
	}
	echo "</tr>\n";
		// printing table rows
	$i=0;
	while($row = mysql_fetch_row($result)) {
		echo "<tr class=\"rowhighlight\">";
		$queryall = "Select * from $table where srfstatus != 0 order by inserted desc;";
		$resultall = mysql_query($queryall);
		$srfid = mysql_result($resultall,$i,"srfid");
		$i++;
		echo "<td><input style=\"color: #400000; font-weight: bold\" type=button onclick=\"window.open('viewSummaryReport.php?srfid=$srfid','View Summary Report - $srfid',config='height=600,width=800, toolbar=no, menubar=no, scrollbars=yes, resizable=yes,location=no, directories=no, status=no')\" value=\"GSR\">";
		echo "<input style=\"color: #347C17; font-weight: bold\" type=button onclick=\"document.location.href='editSummaryReport.php?srfid=$srfid'\" value=\"Edit\">";
		echo "<input style=\"color: #FF0000; font-weight: bold\" type=button onclick=\"document.location.href='deleteSummaryReport.php?srfid=$srfid'\" value=\"Delete\"></td>";
		//echo "<td>$srfid</td>";
		foreach($row as $cell) {
			echo "<td>&nbsp;$cell</td>";
		}
		echo "</tr>\n";
	}
	mysql_free_result($result);
	echo "</table";
}
?>
<form name="filterform" method="post" action="manageSummaryReports.php">
	Select which fields you wish to display: 
	<select name="filteroptionMenu">
	<!--	<option value="selectOption">Select a Filter Option</option>-->
		<option value="showall">Show All Fields</option>
		<option value="showset1">ID, Inserted, ReportID, Account Holder, Applicant LastName, Applicant Firstname</option>
		<option value="showset2">ID, Date report inserted, Account Holder, Applicant LastName, Applicant Firstname</option>
	</select>
	<input type="hidden" name="hdn_filteropt" value="statusFilteropt"></input>
	<input type="submit" value="Update Table"></input>
</form>

<?php
include("db/opendb.php");

if (isset($_REQUEST['hdn_filteropt'])) {
	$filterchoice=$_REQUEST['filteroptionMenu'];
	//echo "request[filteroptionMenu]: [$filterchoice]";
	if ($filterchoice == "showall") {
		echo "<b>Display Fields</b>: All <i>except deleted</i> ordered by inserted descending";
		displayFields($sumr_table,'*');
	}
	elseif ($filterchoice == "showset1") {
		echo "<b>Display Fields</b>: ID, Inserted, ReportID, Account Holder, Applicant LastName, Applicant Firstname ordered by inserted descending";
		displayFields($sumr_table,'id, inserted, srfid, acctholder, aplname, apfname');
	}
	elseif ($filterchoice == "showset2") {
		echo "<b>Display Fields</b>: ID, Date report inserted, Account Holder, Applicant LastName, Applicant Firstname ordered by inserted descending";
		displayFields($sumr_table,'id, curdate, acctholder, aplname, apfname');
	}
}
else {
	echo "<b>Display Fields</b>: All <i>except deleted</i> ordered by inserted descending";
	displayFields($sumr_table,'*');
}

include("db/closedb.php");
	
	?>
	</body>
</html>