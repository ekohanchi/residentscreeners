<html>
<head>
<title>Delete Summary Report</title>
</head>
<body>
<?php
include("login.php"); 
include("include/configs.php");
echo "<br>";
include("menubar.php");

function displayValue ($sumr_table,$keyfield,$field) {
	$table=$sumr_table;
	$srfid=$keyfield;
	
	$query = "Select * from $table where srfid='$srfid'";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	if ($num == 1) {
		$value = mysql_result($result,0,"$field");
	}
	if ($field=="srfid") {
		return $num;
	}
	else {
		echo $value;
	}
	
}

include("db/opendb.php");

if(isset($_GET['srfid'])) {
	$srfid = $_GET['srfid'];
	$found = displayValue($sumr_table,$srfid,"srfid");
		
	if ($found == 1) {
		$deletequery = "Update $sumr_table set srfstatus='0' where srfid='$srfid'";
		
		$deletestatus = mysql_query($deletequery);
		$insert_errmsg=("<b>A MySQL error occured for srfid: $srfid</b> while summary report status <br><br><b>Query:</b> " . $deletequery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br><br><br>");
		$insert_errmsg_fileformatted=("A MySQL error occured for srfid: $srfid while summary report status\nQuery: " . $deletequery . " \nError: (" . mysql_errno() . ") " . mysql_error() . "\n***********************\n");
			
		if ($deletestatus != 1) {
			$sqlerrors_hndlr = fopen($sqlerrors, 'a');
			fwrite($sqlerrors_hndlr, $insert_errmsg_fileformatted);
			fclose($sqlerrors_hndlr);
			echo "$insert_errmsg";
			
			$to = "$error_emailnotify";
			$subject = "Resident Screeners - Summary Report Delete Error message";
			$message = "A summary report with srfid: $srfid has been deleted but with errors<br>";
			$message .= "sql error statement: $insert_errmsg";
			$headers = "From: residentscreenres@noreply.com\r\n";
			$headers .= "Reply-To: residentscreenres@noreply.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
			mail( $to, $subject, $message, $headers );
			//Emailing srfid notification DONE
			
			?>
			A report of this error message has been emailed to the administrator.<br/><br/>
			<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
			<?php
		}
		else {
			?>
			 <h3 style="color:green;">Summary Report Status changed to Deleted!!</h3>
			 
			 <table border="0" style="font-style: italic">
				<tr>
					<td width="15"></td>
					<td>ReportID: </td>
					<td>&nbsp;</td>
					<td><?php echo $srfid ?></td>
				</tr>
				<tr>
					<td width="15"></td>
					<td>ID: </td>
					<td>&nbsp;</td>
					<td><?php displayValue($sumr_table,$srfid,"id") ?></td>
				</tr>
				<tr>
					<td width="15"></td>
					<td>Entered into system: </td>
					<td>&nbsp;</td>
					<td><?php displayValue($sumr_table,$srfid,"curdate") ?></td>
				</tr>
				<tr>
					<td width="15"></td>
					<td>By resident screener agent: </td>
					<td>&nbsp;</td>
					<td><?php displayValue($sumr_table,$srfid,"acctholder") ?></td>
				</tr>
			</table>
		<?php	 
		}
	}
	else {
		echo "<br>";
		echo "<font color=\"red\">ERROR ReportID (srfid) not found for deleting</font><br>"; ?>
		<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
		<?php
	}
}
else {
	echo "<br>";
	echo "<font color=\"red\">ERROR ReportID (srfid) not specified for deleting</font><br>"; ?>
	<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
	<?php
}

include("db/closedb.php");
?>


</body>
</html>
