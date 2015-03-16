<html>
<head>
<title>View Summary Report</title>
<script language="javascript">
function printpage()
 {
  window.print();
 }
</script>
<style type=text/css>
	p       { font-size: 90%; }
	@media print  { .noprint  { display: none; } }
</style>

</head>
<body>
<?php
include("login.php"); 
include("include/configs.php");
?>
<p class="noprint">
<br/>
<input type="button" value="Print" onclick="printpage();">
</p>
<?php

if(isset($_GET['srfid'])) {
	$srfid = $_GET['srfid'];

	include("db/opendb.php");
	
	$query = "Select * from $sumr_table where srfid='$srfid'";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
//	echo "num value: $num, result value: $result";
	if ($num == 1) {
		$curdate = mysql_result($result,0,"curdate");
		$aplname = mysql_result($result,0,"aplname");
		$apfname = mysql_result($result,0,"apfname");
		$inserted = mysql_result($result,0,"inserted");
		$srfstatus = mysql_result($result,0,"srfstatus");
		$srfid = mysql_result($result,0,"srfid");
		$acctholder = mysql_result($result,0,"acctholder");
		$crlines = mysql_result($result,0,"crlines");
		$crgood = mysql_result($result,0,"crgood");
		$crneg = mysql_result($result,0,"crneg");
		$crevictions = mysql_result($result,0,"crevictions");
		$crinquires = mysql_result($result,0,"crinquires");
		$creditscore = mysql_result($result,0,"creditscore");
		$civiljudgements = mysql_result($result,0,"civiljudgements");
		$cjcount = mysql_result($result,0,"cjcount");
		$cjdfmonth = mysql_result($result,0,"cjdfmonth");
		$cjdfyear = mysql_result($result,0,"cjdfyear");
		$taxliens = mysql_result($result,0,"taxliens");
		$tlcount = mysql_result($result,0,"tlcount");
		$taxliens_released = mysql_result($result,0,"taxliens_released");
		$bankruptcy = mysql_result($result,0,"bankruptcy");
		$bankruptcyType = mysql_result($result,0,"bankruptcyType");
		$bankruptcydf = mysql_result($result,0,"bankruptcydf");
		$bankruptcy_open = mysql_result($result,0,"bankruptcy_open");
		$bankruptcy_closed = mysql_result($result,0,"bankruptcy_closed");
		$telecheckType = mysql_result($result,0,"telecheckType");
		$ssnstatus = mysql_result($result,0,"ssnstatus");
		$comments = mysql_result($result,0,"comments");
		$mgrAgentOwner = mysql_result($result,0,"mgrAgentOwner");
		$mgrPhone = mysql_result($result,0,"mgrPhone");
		$propMgtCo = mysql_result($result,0,"propMgtCo");
		$propMgtCoFax = mysql_result($result,0,"propMgtCoFax");
		$aptComplex = mysql_result($result,0,"aptComplex");
		$numOfPages = mysql_result($result,0,"numOfPages");
	}
	
	include("db/closedb.php");


?>
	<table border="0" width="100%" align="center" cellpadding="3px">
		<tr>
			<td>
				<table border="0" width="100%" align="center" cellpadding="2px" cellspacing="2px">
					<tr>
						<!-- <td height="70px" width="70px" bgcolor="#76923C" valign="middle" align="center"><font size="7px">RS</font></td> -->
						<td height="70px" width="70px" background="images/greendot.jpg" valign="middle" align="center"><font size="7px">RS</font></td>
						<td valign="bottom" align="center" style="border-bottom:2px solid #CCCCCC"><font size="5px" color="#76923C" >Resident Screeners</font><br/><font size="4px">Summary Report</font></td>
						<td rowspan="2" width="180px"><center><img alt="house image" src="images/house.jpg" height="120px" width="179px"></center></td>
					</tr>
					<tr>
						<td></td>
						<td valign="top" align="center"><font size="2px"><i>For Owner/Manager Use Only</i></font></td>
					</tr>
				</table>
				<?php
				if ($num == 1) {
					echo "Date: $curdate";
					echo "<br><br>";
					echo "<center>NAME: $aplname, $apfname </center></br>";
					echo "<b>CREDIT REPORT:</b><br>"; ?>
					<table width="90%" border="0">
					<tr>
						<td>LINES: <?php echo $crlines ?></td>
						<td width="20px"></td>
						<td>GOOD: <?php echo $crgood ?> </td>
						<td width="20px"></td>
						<td>NEGATIVE: <?php echo $crneg ?> </td>
						<td width="20px"></td>
						<td>EVICTIONS: <?php echo $crevictions ?></td>
						<td width="20px"></td>
						<td>INQUIRIES: <?php echo $crinquires ?> </td>
						<td width="20px"></td>
					</tr>
					</table>
					<?php
					if (strtolower($creditscore) == "n/a") {
						echo "<br><b>FICO SCORE: Not Scored </b><br><br>";
					} else {
						echo "<br><b>FICO SCORE: $creditscore </b><br><br>";
					}
					?>
					<table width="90%">
					<tr>
						<td><b>CIVIL JUDGEMENTS</b>: <?php echo $civiljudgements ?></td>
						<?php if (strtoupper($civiljudgements) != "NO") {?>
						<td width="40px"></td>
						<td>HOW MANY: <?php echo $cjcount ?> </td>
						<td width="40px"></td>
						<td>DATE FILED: <?php echo "$cjdfmonth - $cjdfyear"?></td>
						<?php }?>
					</tr>
					<tr><td height="10px"></td></tr>
					<tr>
						<td><b>TAX LIENS</b>: <?php echo $taxliens ?></td>
						<?php if (strtoupper($taxliens) != "NO") {?>
						<td width="40px"></td>
						<td>HOW MANY: <?php echo $tlcount ?> </td>
						<td width="40px"></td>
						<td>RELEASED: <?php echo $taxliens_released ?></td>
						<?php }?>
					</tr>
					<tr><td height="10px"></td></tr>
					</table>
					<table width="90%" border="0">
					<tr>
						<td colspan="2"><b>BANKRUPTCY</b>: <?php echo $bankruptcy ?></td>
					</tr>
					<?php if (strtoupper($bankruptcy) != "NO") {?>
					<tr>
						<td>TYPE: <?php echo $bankruptcyType ?> <img alt="" src="images/spacer.gif" width="20px" height="5px"/> </td>
						<td>DATE FILED: <?php echo $bankruptcydf ?> <img alt="" src="images/spacer.gif" width="20px" height="5px"/> </td>
						<!--<td>OPEN: <?php echo $bankruptcy_open ?> <img alt="" src="images/spacer.gif" width="20px" height="5px"/> </td>-->
						<td>CLOSED: <?php echo $bankruptcy_closed ?> <img alt="" src="images/spacer.gif" width="20px" height="5px"/> </td>
					</tr>
					<?php }?>
					<tr><td height="10px"></td></tr>
					</table>
					<?php
					echo "<b>TELECHECK: </b> $telecheckType<br><br>";
					echo "<b>Social Security Number: </b> $ssnstatus<br><br>";
					echo "<b>Comments: </b> $comments<br><br>";
					?>
					<table width="90%">
					<tr>
						<td width="65%">MGR/AGENT/OWNER: <?php echo $mgrAgentOwner ?></td>
						<td>PHONE: <?php echo $mgrPhone ?></td>
					</tr>
					<tr><td height="10px"></td></tr>
					<tr>
						<td>PROPERTY MGT. CO: <?php echo $propMgtCo ?></td>
						<td>FAX: <?php echo $propMgtCoFax ?></td>
					</tr>
					<tr><td height="10px"></td></tr>
					<tr>
						<td>APARTMENT COMPLEX: <?php echo $aptComplex ?></td>
					</tr>
					<tr><td height="10px"></td></tr>
					<tr>
						<td>RESIDENT SCREENER AGENT: <?php echo $acctholder ?></td>
						<td>Number of Pages: <?php echo $numOfPages ?></td>
					</tr>
					<tr><td height="10px"></td></tr>
					</table>
					<font size="2px">
					Phone: 1-800-424-8786 Toll Free<br/>
					Fax: (760)741-9139<br/>
					Email: info@residentscreeners.com<br/>
					Web: http://www.residentscreeners.com/<br/><br/>
					</font>
					
					<?php
				}
				else { ?>
					<font color="red"><b>ReportID (srfid): <?php echo "$srfid"; ?> not found in database table.</b>
					<br/>
					Make sure the correct or a valud srfid value is set and/or specified.
					</font>
				<?php	
				}
				?>
				
			</td>
		</tr>
	</table>


<?php	
}
else {
	echo "<br>";
	echo "<font color=\"red\">ERROR ReportID (srfid) not specified</font>"; ?>
	<input style="color: green; font-weight: bold" type=button onclick="document.location.href='manageSummaryReports.php'" value="Manage Summary Reports">
	<?php
}
?>


</body>
</html>
