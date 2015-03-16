<?php
/*
 * Created on Jan 1, 2010
 */
 
 if (isset($_REQUEST['fname'])) {
 	include("include/configs.php");
 	
 	$Unixtime = time();
	$uniqueid = date("YmdHis", $Unixtime + -3.00 * 3600);	//new method of uniqueid
	$appid = "${uniqueid}_00";
	
	$sql_values = "'',";		
	$sql_values = "$sql_values now(),";
	
	// if aciflname or fname1 contains "test" then set refstatus to 100, else to 200
	if (((strlen(strstr(strtolower($_REQUEST['fname']),"test"))>0)) || (((strlen(strstr(strtolower($_REQUEST['lname']),"test"))>0))))  {
		$appstatus=10;
		$appstatus_msg="Test";
	} else {
		$appstatus=100;
		$appstatus_msg="";
	}

	$sql_values = "$sql_values'$appstatus',";
	$sql_values = "$sql_values'$appid',";
		//error statement
	//$sql_values = "$sql_values$appid',";
	
		// Debugging purposes only
	$keyvaluepair_array = array();
	$keyvaluepair_array["id"] = "1";
	$keyvaluepair_array["inserted"] = "now()";
	$keyvaluepair_array["appstatus"] = "$appstatus";
	$keyvaluepair_array["appid"] = "$appid";
	$frac=1;		//full rental address count
		// Debugging purposes only end
	foreach (array_keys($_REQUEST) as $k) {		
		if (preg_match('/^raddress/', $k) || preg_match('/^rsuite/', $k) ||
			preg_match('/^rcity/', $k) || preg_match('/^rstate/', $k) || preg_match('/^rzip/', $k)) {
			if (preg_match('/^raddress/', $k)) {
				$fulladdress = "";
				$fulladdress = "$fulladdress $_REQUEST[$k], ";
			} else if (preg_match('/^rzip/', $k)) {
				$fulladdress = "$fulladdress $_REQUEST[$k]";
				$value = $fulladdress;
				$esc_value = mysql_escape_string($value);
				$sql_values = "$sql_values'$esc_value',";
					// Debugging purposes only
				$keyvaluepair_array["fullrentaladdress$frac"] = "$value";
				$frac++;
					// Debugging purposes only end
			} else {
				$fulladdress = "$fulladdress $_REQUEST[$k], ";
			}
			
		}
		else if (preg_match('/^res/', $k) || preg_match('/^cell/', $k) || preg_match('/^fax/', $k)) {
			if (preg_match('/^rescode/', $k) || preg_match('/^cellcode/', $k) || preg_match('/^faxcode/', $k)) {
				$number = "";
				$number = "$number$_REQUEST[$k]-";
			}
			else if (preg_match('/^res3/', $k) || preg_match('/^cell3/', $k) || preg_match('/^fax3/', $k)) {
				$number = "$number$_REQUEST[$k]-";
			}
			else if (preg_match('/^res4/', $k) || preg_match('/^cell4/', $k) || preg_match('/^fax4/', $k)) {
				$number = "$number$_REQUEST[$k]";
				$value = $number;
				$esc_value = mysql_escape_string($value);
				$sql_values = "$sql_values'$esc_value',";
					// Debugging purposes only
				if (preg_match('/^res4/', $k)) { $keyvaluepair_array["resphone"] = "$value"; }
				if (preg_match('/^cell4/', $k)) { $keyvaluepair_array["cellphone"] = "$value"; }
				if (preg_match('/^fax4/', $k)) { $keyvaluepair_array["faxnum"] = "$value"; }
					// Debugging purposes only ends
			}
		}
		else if ($k == "company") {
			$rentalnum = $_REQUEST["rentalnum"];
			$empty_rentaladdress = 35 - $rentalnum;		//35 is the maxium number of rental addresses if that changes this should too
			$empty_string = "";
			for ($i=1; $i<= $empty_rentaladdress; $i++) {
				$sql_values = "$sql_values'$empty_string',";
					// Debugging purposes only
				$keyvaluepair_array["fullrentaladdress$frac"] = "$empty_string";
				$frac++;
					// Debugging purposes only end
			}
			$value = $_REQUEST[$k];
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value',";
				// Debugging purposes only
			$keyvaluepair_array["$k"] = "$value";
				// Debugging purposes only end
		}
		else if ($k == "rd") {
			$value = $_REQUEST[$k];
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value',";
				// Debugging purposes only
			$keyvaluepair_array["$k"] = "$value";
				// Debugging purposes only end
		}
		else if ($k == "ref_source") {
			$refsouce = $_REQUEST['ref_source'];
			$value = "";
			while (list ($krs,$vrs) = @each ($refsouce)) {
				$value = "$value $vrs, ";
			}
			//$value = serialize($_REQUEST['ref_source']);
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value'";
				// Debugging purposes only
			$keyvaluepair_array["$k"] = "$value";
				// Debugging purposes only end
			break;
		}
		else if ($k == "lastfield") {
			if (! isset($_POST['ref_source'])) {
				$value = "";
				$esc_value = mysql_escape_string($value);
				$sql_values = "$sql_values'$esc_value'";
			}
			else {
				$value = "";
			}
				// Debugging purposes only
			$keyvaluepair_array["ref_source"] = "$value";
				// Debugging purposes only end
			break;
		}
		else if ($k != "PHPSESSID" && $k != "__utma" && $k != "__utmz") {
			$v = $_REQUEST[$k];
			$value = $v;
	
			$esc_value = mysql_escape_string($value);
			$sql_values = "$sql_values'$esc_value',";
				// Debugging purposes only
			$keyvaluepair_array["$k"] = "$value";
				// Debugging purposes only end
		}
	}
//	if (! isset($_POST['ref_source'])) {
//		$value = "";
//		$esc_value = mysql_escape_string($value);
//		$sql_values = "$sql_values'$esc_value'";
//			// Debugging purposes only
//		$keyvaluepair_array["ref_source"] = "$value";
//			// Debugging purposes only end
//	}
		// Debugging purposes only
//	echo "<br>sql_values Value: [$sql_values]<br>";
//	$j=1;
//	foreach($keyvaluepair_array as $key => $value) {
//		print "$j - $key: $value<br>";
//		$j++;
//	}
		// Debugging purposes only end

	
		// initilizing DB connectivity
	include("db/opendb.php");
	$dbfields = "id,inserted,appstatus,appid,fname,mname,lname,sname,dobmonth,dobday,dobyear,ack,rd,curaddress,cursuite,curcity,curstate,curzip,rentalnum,fullrentaladdress1,fullrentaladdress2,fullrentaladdress3,fullrentaladdress4,fullrentaladdress5,fullrentaladdress6,fullrentaladdress7,fullrentaladdress8,fullrentaladdress9,fullrentaladdress10,fullrentaladdress11,fullrentaladdress12,fullrentaladdress13,fullrentaladdress14,fullrentaladdress15,fullrentaladdress16,fullrentaladdress17,fullrentaladdress18,fullrentaladdress19,fullrentaladdress20,fullrentaladdress21,fullrentaladdress22,fullrentaladdress23,fullrentaladdress24,fullrentaladdress25,fullrentaladdress26,fullrentaladdress27,fullrentaladdress28,fullrentaladdress29,fullrentaladdress30,fullrentaladdress31,fullrentaladdress32,fullrentaladdress33,fullrentaladdress34,fullrentaladdress35,company,email,resphone,cellphone,faxnum,ref_source";

	$insertquery = "INSERT INTO $memapp_table VALUES ($sql_values)";
	
		//$insertstatus value equals 1 when the query is successfull
	$insertstatus = mysql_query($insertquery);
	$insert_errmsg=("<b>A MySQL error occured for appid: $appid</b><br><br><b>Query:</b> " . $insertquery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br><br><br>");
	$insert_errmsg_fileformatted=("A MySQL error occured for appid: $appid\nQuery: " . $insertquery . " \nError: (" . mysql_errno() . ") " . mysql_error() . "\n***********************\n");
	
	if ($insertstatus != 1) {
		$sqlerrors_hndlr = fopen($sqlerrors, 'a');
		fwrite($sqlerrors_hndlr, $insert_errmsg_fileformatted);
		fclose($sqlerrors_hndlr);
	}
	
	//refstatus statistics
	$query_all = "Select count(*) from $memapp_table;";
	$query_test = "Select count(*) from $memapp_table where appstatus=10";
	
	$all_count=mysql_result(mysql_query($query_all),0);
	$test_count=mysql_result(mysql_query($query_test),0);

	include("db/closedb.php");
	
	// Emailing appid notification START
	$ip = getenv('REMOTE_ADDR');					// get ip address 
	
	if ($appstatus == 10) {
		$subject = "Resident Screeners Test Application Processed";
	} else {
		$subject = "Resident Screeners Application Processed";
	}
	if ($insertstatus != 1) {
		$to = "$error_emailnotify";
		$message = "A $appstatus_msg referral has been processed WITH ERRORS<br>";
		$message .= "User's IP Address: $ip<br>";
		$message .= "Appid NOT stored: $appid<br>";
		$message .= "Mysql Insert ERROR message stored in: $sqlerrors";
	} else {
		$to = "$emailnotify";
		$message = "An $appstatus_msg app has been processed<br>";
		$message .= "User's IP Address: $ip<br>";
		$message .= "Appid stored:<a href=\"www.residentscreeners.com/application/viewApp.php?appid=$appid\"> $appid</a>";
		$message .= "<br><br><u>Applications Status Summary</u><br>";
		$message .= "Total applications: $all_count<br>";
		$message .= "Test applications: $test_count";
				
	}
	$headers = "From: residentscreenres@noreply.com\r\n";
	$headers .= "Reply-To: residentscreenres@noreply.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail( $to, $subject, $message, $headers );
	//Emailing appid notification DONE
	
	echo "<h1> Thank you!! </h1>";
	if ($insertstatus == 1) {
		echo "<h3> Your application has been submitted successfully! </h3>";
	}
	echo "<h4> Your Unique ID for this application is: $appid </h4>";
	if ($insertstatus != 1) {
		echo "<font color=\"red\"><b>There was an error processing your applications. Please try again later.<br>A report of this error message has been recorded</b></font>";
	}
	
?>
<html>
<body>
</body>
</html>
<?php
 }
 ?>
