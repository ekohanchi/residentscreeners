<html>
<head>
<title>Edit Summary Report</title>
<script language="javascript" src="include/externalfuncs.js"></script>
<script language="javascript" src="include/jsvars.js"></script>
<style TYPE="text/css">
	.smfont {
		font-size: 13px;
		text-align: center; }
	.charcounter_style {
		font-size: 12px;
		color: gray }
</style>
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
//		$curdate = mysql_result($result,0,"curdate");
//		$aplname = mysql_result($result,0,"aplname");
//		$apfname = mysql_result($result,0,"apfname");
//		$acctholder = mysql_result($result,0,"acctholder");
//		$comments = mysql_result($result,0,"comments");
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
?>
		Update the fields you wish to change/edit/update for:<br/>
	
		<table border="0" style="font-style: italic">
			<tr>
				<td width="15"></td>
				<td>ReportID: </td>
				<td>&nbsp;</td>
				<td><?php echo $srfid ?></td>
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
		<br/>
		<form name="editform" action="editSummaryReport.php">
			<table border="1">
				<tr bgcolor="#00CC66">
					<td width="170px"><b>Field Name</b></td>
					<td width="170px"><b>Current Value</b></td>
					<td width="170px"><b>Value to update to</b></td>
				</tr>
				<tr>
					<td>Applicant last name</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"aplname") ?></td>
					<td><input name="aplname" type="text" size="25" maxlength="25" value="<?php displayValue($sumr_table,$srfid,"aplname") ?>" /></td>
				</tr>
				<tr>
					<td>Applicant first name</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"apfname") ?></td>
					<td><input name="apfname" type="text" size="25" maxlength="25" value="<?php displayValue($sumr_table,$srfid,"apfname") ?>"/></td>
				</tr>
				<tr>
					<td><b>Credit Report:</b> Lines</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"crlines") ?></td>
					<td><input name="crlines" id="idcrlines" type="text" size="2" maxlength="2" value="<?php displayValue($sumr_table,$srfid,"crlines") ?>" onblur="isalldigits(this.id);"/></td>
				</tr>
				<tr>
					<td>Good</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"crgood") ?></td>
					<td><input name="crgood" id="idcrgood" type="text" size="2" maxlength="2" value="<?php displayValue($sumr_table,$srfid,"crgood") ?>" onblur="isalldigits(this.id);"/></td>
				</tr>
				<tr>
					<td>Negative</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"crneg") ?></td>
					<td><input name="crneg" id="idcrneg" type="text" size="2" maxlength="2" value="<?php displayValue($sumr_table,$srfid,"crneg") ?>" onblur="isalldigits(this.id);"/></td>
				</tr>
				<tr>
					<td>Evictions</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"crevictions") ?></td>
					<td><input name="crevictions" id="idcrevictions" type="text" size="2" maxlength="2" value="<?php displayValue($sumr_table,$srfid,"crevictions") ?>" onblur="isalldigits(this.id);"/></td>
				</tr>
				<tr>
					<td>Inquiries</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"crinquires") ?></td>
					<td><input name="crinquires" id="idcrinquires" type="text" size="2" maxlength="2" value="<?php displayValue($sumr_table,$srfid,"crinquires") ?>" onblur="isalldigits(this.id);"/></td>
				</tr>
				<tr>
					<td>Fico Score</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"creditscore") ?></td>
					<td><input name="creditscore" id="idcreditscore" type="text" size="3" maxlength="3" value="<?php displayValue($sumr_table,$srfid,"creditscore") ?>"/></td>
				</tr>
				<tr>
					<td>Comments</td>
					<td class="smfont">&nbsp;<?php displayValue($sumr_table,$srfid,"comments")?></td>
					<td valign="top" align="left">
						<textarea name="comments" rows="5" cols="45" style="text-align: left"
						onKeyDown="textCounter(document.editform.comments,document.editform.charcounter,200)"
						onKeyUp="textCounter(document.editform.comments,document.editform.charcounter,200)">
						<?php displayValue($sumr_table,$srfid,"comments")?>
						</textarea>
						<input readonly type="text" name="charcounter" size="3" maxlength="3" value="200"> <span class="charcounter_style">out of 200 characters left</span>
					</td>
				</tr>
			</table>
			<input type="hidden"  name="reportid" value="<?php echo $srfid ?>"></input>
			<br/>
			<input type="button" value="Reset All Values" onClick="window.location.href=window.location.href">
			<input type="submit" value="Update Values">
		</form>
<?php
	}
	else {
		echo "<br>";
		echo "<font color=\"red\">ERROR ReportID (srfid) not found for editing</font><br>"; ?>
		<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
		<?php
	}
}
elseif (isset($_GET['reportid'])) {
	echo "<br>";
	$aplname = $_GET['aplname'];
	$apfname = $_GET['apfname'];
	$crlines = $_GET['crlines'];
	$crgood = $_GET['crgood'];
	$crneg = $_GET['crneg'];
	$crevictions = $_GET['crevictions'];
	$crinquires = $_GET['crinquires'];
	$creditscore = $_GET['creditscore'];
	$comments = $_GET['comments'];
	$charcounter = $_GET['charcounter'];
	$srfid = $_GET['reportid'];
	
	if (((strlen(strstr(strtolower($aplname),"test"))>0)) || (((strlen(strstr(strtolower($apfname),"test"))>0))))  {
		$srfstatus=10;
	} else {
		$srfstatus=100;
	}
	

	//charcounter not updated as even when the comments field is not edited the it gets set to 200		
	$updatequery = "Update $sumr_table set
		srfstatus='$srfstatus',
		aplname='$aplname',
		apfname='$apfname',
		crlines='$crlines',
		crgood='$crgood',
		crneg='$crneg',
		crevictions='$crevictions',
		crinquires='$crinquires',
		creditscore='$creditscore',
		comments='$comments'
	 where srfid='$srfid'";
	
	$updatestatus = mysql_query($updatequery);
	
	$insert_errmsg=("<b>A MySQL error occured for srfid: $srfid</b> while updating values<br><br><b>Query:</b> " . $updatequery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br><br><br>");
	$insert_errmsg_fileformatted=("A MySQL error occured for srfid: $srfid while updating values\nQuery: " . $updatequery . " \nError: (" . mysql_errno() . ") " . mysql_error() . "\n***********************\n");
		
	if ($updatestatus != 1) {
		$sqlerrors_hndlr = fopen($sqlerrors, 'a');
		fwrite($sqlerrors_hndlr, $insert_errmsg_fileformatted);
		fclose($sqlerrors_hndlr);
		echo "$insert_errmsg";
		
		$to = "$error_emailnotify";
		$subject = "Resident Screeners - Summary Report Update Error message";
		$message = "A summary report with srfid: $srfid has been updated but with errors<br>";
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
		 <h3 style="color:green;">Summary Report Updated and stored Successfully!!</h3>
		 
		 <table border="0" style="font-style: italic">
			<tr>
				<td width="15"></td>
				<td>ReportID: </td>
				<td>&nbsp;</td>
				<td><?php echo $srfid ?></td>
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

		// Debugging output starts	
//	$j=1;
//	foreach (array_keys($_REQUEST) as $k) {
//		$value = $_REQUEST[$k];
//		echo "$j. $k: $value <br>";
//		$j++;
//
//	}
		// Debugging output ends
}
else {
	echo "<br>";
	echo "<font color=\"red\">ERROR ReportID (srfid) not specified for editing</font><br>"; ?>
	<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
	<?php
}

include("db/closedb.php");
?>


</body>
</html>
