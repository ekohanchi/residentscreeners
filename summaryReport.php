<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX,FOLLOW,NOIMAGEINDEX,NOIMAGECLICK">
<title>Summary Report for Resident Screeners</title>
<script language="javascript" src="include/externalfuncs.js"></script>
<script language="javascript" src="include/jsvars.js"></script>
<style TYPE="text/css">
	.style1 {
		font-size: 17px;
		font-weight: bold }
	.charcounter_style {
		font-size: 12px;
		color: gray }
</style>
</head>
<?php 
	$curdate = date("m/d/Y");
?>
<body onload="document.sumrform.reset()">
<?php
include("include/configs.php");
include("login.php"); 

function createDropdown($array) {
	foreach($array as $key => $value) {
		echo "<option value=\"$key\">$value</option>\n";
	}
}
?>
<h1>Summary Report Form for Resident Screeners</h1>

<?php include("menubar.php"); ?>

<form name="sumrform" method="post" action="storeSRF.php" onsubmit="return validateSRF(sumrform);">
<!--<form name="sumrform" method="post" action="storeSRF.php">-->
	<?php 
		if (isset ($userloggedin)) {
			switch ($userloggedin) {
				case "ekohanchi":
					$full_userloggedin = "test, user";
					break;
				case "mvannalom":
					$full_userloggedin = "Vannalom, Melisa";
					break;
				case "spulvers":
					$full_userloggedin = "Pulvers, Sue";
					break;
				case "dscott":
					$full_userloggedin = "Scott, Debbie";
					break;
				default:
					$full_userloggedin = "N/A";
			}
		}
		else {
			$full_userloggedin = "N/A";
		}
	?>
	
	Date: <input name="curdate" type ="text" style="background-color: rgb(211, 211, 211);" readonly="readonly" size="12" value="<?php echo "$curdate"?>" /> <br/> <br/>
	<center>Name: <input name="aplname" type="text" size="25" maxlength="25" value="Last Name" onfocus="clearText(this);" />,
				<input name="apfname" type="text" size="25" maxlength="25" value="First name" onfocus="clearText(this);"/></center>
	
	<br/><span class="style1">CREDIT REPORT:</span><br/>
	<table>
		<tr>
			<td>LINES: <input name="crlines" id="idcrlines" type="text" size="2" maxlength="2" onblur="isalldigits(this.id);"/> </td>
			<td width="10px"></td>
			<td>GOOD: <input name="crgood" id="idcrgood" type="text" size="2" maxlength="2" onblur="isalldigits(this.id);"/> </td>
			<td width="10px"></td>
			<td>NEGATIVE: <input name="crneg" id="idcrneg" type="text" size="2" maxlength="2" onblur="isalldigits(this.id);"/> </td>
			<td width="10px"></td>
			<td>EVICTIONS: <input name="crevictions" id="idcrevictions" type="text" size="2" maxlength="2" onblur="isalldigits(this.id);"/> </td>
			<td width="10px"></td>
			<td>INQUIRIES: <input name="crinquires" id="idcrinquires" type="text" size="2" maxlength="2" onblur="isalldigits(this.id);"/> </td>
			<td width="10px"></td>
		</tr>
	</table>
	<br/>
	<span class="style1">FICO SCORE: </span> <input name="creditscore" id="idcreditscore" type="text" size="3" maxlength="3"/>
	<span class="charcounter_style">Enter "n/a" for "Not Scored"</span>
	<br/> <br/>
	<table border="0">
		<tr>
			<td> <span class="style1">CIVIL JUDGEMENTS: </span> </td>
			<td width="10px"></td>
			<td>
				<input type="radio" name="civiljudgements" value="YES" onClick="SetToggle('cjblock',true)"/> YES
				<input type="radio" name="civiljudgements" value="NO" onClick="SetToggle('cjblock',false)"/> NO
			</td>
			<td width="20px"></td>
			<td>
				<span id="cjblock" style="display:none">
				How many: <input name="cjcount" id="idcjcount" type="text" size="3" maxlength="3" onblur="isalldigits(this.id);"/>
				<img alt="" src="images/spacer.gif" width="20px" height="5px"/>
				
				Date filed: <select name="cjdfmonth" size="1"> <?php echo createDropdown($monthsArray); ?>  </select>
				<input name="cjdfyear" id="idcjdfyear" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
				</span>
			</td>
		</tr>
		<tr> <td height="10px"></td></tr>
		<tr>
			<td> <span class="style1">TAX LIENS: </span></td>
			<td width="10px"></td>
			<td>
				<input type="radio" name="taxliens" value="YES" onClick="SetToggle('tlblock',true)"/> YES
				<input type="radio" name="taxliens" value="NO" onClick="SetToggle('tlblock',false)"/> NO
			</td>
			<td width="20px"></td>
			<td>
				<span id="tlblock" style="display:none">
				How many: <input name="tlcount" id="idtlcount" type="text" size="3" maxlength="3" onblur="isalldigits(this.id);"/>
				<img alt="" src="images/spacer.gif" width="20px" height="5px"/>

				Released:
				<input type="hidden" name="taxliens_released" value=""/> 
				<input type="radio" name="taxliens_released" value="YES"/> YES
				<input type="radio" name="taxliens_released" value="NO"/> NO
				</span>
			</td>
		</tr>
		<tr> <td height="10px"></td></tr>
		<tr>
			<td><span class="style1">BANKRUPTCY: </span> </td>
			<td width="10px"></td>
			<td>
				<input type="radio" name="bankruptcy" value="YES" onClick="SetToggle('bankruptcyblock',true)"/> YES
				<input type="radio" name="bankruptcy" value="NO" onClick="SetToggle('bankruptcyblock',false)"/> NO
			</td>
			<td width="20px"></td>
		<td>
			<span id="bankruptcyblock" style="display:none">
				Type: <select name="bankruptcyType" size="1"> <?php echo createDropdown($bankruptcytypeArray); ?> </select>
				<img alt="" src="images/spacer.gif" width="20px" height="5px"/>
				
				Date filed: <input type="text" name="bankruptcydf" size="10" maxlength="7" value="MM/YYYY" onfocus="clearText(this);"/>
				<img alt="" src="images/spacer.gif" width="20px" height="5px"/>
				
				<!-- Open:  --><input type="hidden" name="bankruptcy_open" size="10" maxlength="7" value="MM/YYYY" onfocus="clearText(this);"/>
				<img alt="" src="images/spacer.gif" width="20px" height="5px"/>

				Closed: <input type="text" name="bankruptcy_closed" size="10" maxlength="7" value="MM/YYYY" onfocus="clearText(this);"/>
			</span>
		</td>
	</table>
	<br/>
	<span class="style1">TELECHECK: </span> <select name="telecheckType" size="1"> <?php echo createDropdown($telecheckArray); ?> </select>
	<br/><br/>
	<span class="style1">Social Security Number: </span> <select name="ssnstatus" size="1"> <?php echo createDropdown($ssnstatusArray); ?> </select>
	<br/><br/>
	<table>
		<tr>
			<td valign="top"><span class="style1">Comments: </span></td>
			<td>
				<textarea name="comments" rows="5" cols="45"
				onKeyDown="textCounter(document.sumrform.comments,document.sumrform.charcounter,200)"
				onKeyUp="textCounter(document.sumrform.comments,document.sumrform.charcounter,200)"></textarea>
				<input readonly type="text" name="charcounter" size="3" maxlength="3" value="200"> <span class="charcounter_style">out of 200 characters left</span>
			</td>
		</tr>
	</table>
	<br/>
	<table width="70%" border="0">
		<tr>
			<td>MGR/AGENT/OWNER:</td><td> <input type="text" name="mgrAgentOwner" size="30" maxlength="25"/></td><td width="5px"></td>
			<td>PHONE:</td><td> <input type="text" name="mgrPhone" size="17" maxlength="15"/></td>
		</tr>
		<tr><td height="10px"></td></tr>
		<tr>
			<td>PROPERTY MGT. CO:</td><td> <input type="text" name="propMgtCo" size="30" maxlength="25"/></td><td width="5px"></td>
			<td>FAX:</td><td> <input type="text" name="propMgtCoFax" size="17" maxlength="15"/></td>
		</tr>
		<tr><td height="10px"></td></tr>
		<tr>
			<td>APARTMENT COMPLEX:</td><td> <input type="text" name="aptComplex" size="30" maxlength="25"/></td>
		</tr>
		<tr><td height="10px"></td></tr>
		<tr>
			<td>RESIDENT SCREENER AGENT:</td><td> <input name="acctholder" type="text" readonly="readonly" style="background-color: rgb(211, 211, 211);" value="<? echo "$full_userloggedin"; ?>"/></td><td width="5px"></td>
			<td>Number of Pages:</td><td> <input type="text" name="numOfPages" id="idnumOfPage" size="3" maxlength="2" onblur="isalldigits(this.id);"/></td>
		</tr>
		<tr><td height="10px"></td></tr>
	</table>
	
<!--	Resident Screener Agent: <input name="acctholder" type="text" readonly="readonly" style="background-color: rgb(211, 211, 211);" value="<? echo "$full_userloggedin"; ?>"/>-->
<!--	<br/>-->
	
	<br>
	<input type="submit" value="Submit" />
	<input type="reset" value="Reset" />
	
</form>

</body>
</html>






