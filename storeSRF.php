<html>
<head>
<title>Storing Summary Report</title>
</head>
<body>
<?php
/*
 * Created on Mar 20, 2010
 */
 
 if (isset($_REQUEST['aplname'])) {
 	include("include/configs.php");
 	
 	$Unixtime = time();
	$uniqueid = date("YmdHis", $Unixtime + -3.00 * 3600);
	$srfid = "${uniqueid}";
	
	$sql_values = "'',";		
	$sql_values = "$sql_values now(),";
	
	// if aciflname or fname1 contains "test" then set refstatus to 100, else to 200
	if (((strlen(strstr(strtolower($_REQUEST['aplname']),"test"))>0)) || (((strlen(strstr(strtolower($_REQUEST['apfname']),"test"))>0))))  {
		$srfstatus=10;
		$srfstatus_msg="Test";
	} else {
		$srfstatus=100;
		$srfstatus_msg="";
	}

	$sql_values = "$sql_values'$srfstatus',";
	$sql_values = "$sql_values'$srfid',";
		//to force an error statement
	//$sql_values = "$sql_values$srfid',";
	
		// Debugging purposes only
	$keyvaluepair_array = array();
	$keyvaluepair_array["id"] = "1";
	$keyvaluepair_array["inserted"] = "now()";
	$keyvaluepair_array["srfstatus"] = "$srfstatus";
	$keyvaluepair_array["srfid"] = "$srfid";
		// Debugging purposes only end
	foreach (array_keys($_REQUEST) as $k) {
		if ($k == "numOfPages") {
			$value = $_REQUEST[$k];
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value'";
				// Debugging purposes only
			$keyvaluepair_array["$k"] = "$value";
				// Debugging purposes only end
			break;
		}
		else {
			$value = $_REQUEST[$k];
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value',";
		}
		
			// Debugging purposes only
		$keyvaluepair_array["$k"] = "$value";
			// Debugging purposes only end
	}
	
		// Display Debugging purposes only
//	echo "sql_values Value: [$sql_values]<br><br>";
//	$j=1;
//	foreach($keyvaluepair_array as $key => $value) {
//		print "$j - $key: $value<br>";
//		//print "$key<br>";
//		$j++;
//	}
		// Debugging purposes only end
		
		// Storing report to DB
	include("db/opendb.php");
	$insertquery = "INSERT INTO $sumr_table VALUES ($sql_values)";
	
		//$insertstatus value equals 1 when the query is successfull
	$insertstatus = mysql_query($insertquery);
	$insert_errmsg=("<b>A MySQL error occured for srfid: $srfid</b><br><br><b>Query:</b> " . $insertquery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br><br><br>");
	$insert_errmsg_fileformatted=("A MySQL error occured for srfid: $srfid\nQuery: " . $insertquery . " \nError: (" . mysql_errno() . ") " . mysql_error() . "\n***********************\n");
	
	include("db/closedb.php");
	
	if ($insertstatus != 1) {
		$sqlerrors_hndlr = fopen($sqlerrors, 'a');
		fwrite($sqlerrors_hndlr, $insert_errmsg_fileformatted);
		fclose($sqlerrors_hndlr);
		echo "$insert_errmsg";
		
		$to = "$error_emailnotify";
		$subject = "Resident Screeners - Summary Report Error message";
		$message = "A summary report with srfid: $srfid has been submitted<br>";
		$message .= "sql error statement: $insert_errmsg";
		$headers = "From: residentscreenres@noreply.com\r\n";
		$headers .= "Reply-To: residentscreenres@noreply.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
		mail( $to, $subject, $message, $headers );
		//Emailing srfid notification DONE
		
		?>
		A report of this error message has been emailed to the administrator.<br/><br/>
		<input style="color: Chocolate; font-weight: bold" type=button onclick="document.location.href='summaryReport.php'" value="Do another summary report">
		<?php
	}
	else {
		?>
		 <br><h3 style="color:green;">Summary Report Form submitted and stored Successfully!!</h3>
		 What do you want to do next?<br/>
		 <input style="color: #400000; font-weight: bold" type=button onclick="window.open('viewSummaryReport.php?srfid=<?php echo "$srfid"; ?>','View Summary Report - <?php echo "$srfid"; ?>',config='height=600,width=800, toolbar=no, menubar=no, scrollbars=yes, resizable=yes,location=no, directories=no, status=no')" value="View & Print THIS Summary Report">
		 <br/> 
		<?php include("menubar.php"); ?>
		 
<!--		 <input style="color: blue; font-weight: bold" type=button onclick="document.location.href='summaryReport.php'" value="Do another summary report">-->
<!--		 <input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage summary reports">-->
		<?php 
	}

	
}
?>
</body>
</html>
