<html>
<head>
<title>Membership Application for Resident Screeners</title>
<script language="javascript" src="include/externalfuncs.js"></script>
<script language="javascript" src="include/jsvars.js"></script>
<script type="text/javascript" >
function AddRentalAddress(max) {
	addRentalAddress.innerHTML = "";
	var i = 1;
	for (i=1; i<=max; i++) {
	    unique_address= "raddress" + i;
	    unique_suite= "rsuite" + i;
	    unique_city= "rcity" + i;
	    unique_state= "rstate" + i;
	    unique_zip= "rzip" + i;

	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "<b>Rental Address " + i + "</b><br>"
	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "*Street address: <input name='" + unique_address +"' type=\"text\" size=\"25\" maxlength=\"25\"/> "
	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "Suite/apt: <input name='" + unique_suite +"' type=\"text\" size=\"5\" maxlength=\"5\"/><br/>"
	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "*City: <input name='" + unique_city +"' type=\"text\" size=\"20\" maxlength=\"20\"/> "
	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "*State: <select name='" + unique_state +"' size=\"1\">" + StatesDropDown +"</select> "
	    addRentalAddress.innerHTML = addRentalAddress.innerHTML + "*Zip: <input name='" + unique_zip +"' id=\"idrzip\" type=\"text\" size=\"5\" maxlength=\"5\" onclick=\"return false;\" onblur=\"validatezip(this.id); return true;\"/> <br><br>"
	}
}
</script>
</head>
<!--<body onload="document.mainform.reset()">-->
<body onload="document.mainform.reset()">
<?php
include("include/configs.php");

function createDropdown($array) {
	foreach($array as $key => $value) {
		echo "<option value=\"$key\">$value</option>\n";
	}
}
?>

Membership Application for Resident Screeners
<form name="mainform" method="post" action="storeApp.php" onsubmit="return validateForm(mainform);">
	Note: (*) Indicates required fields<br></br>
	*First name: <input name="fname" type="text" size="40"/>
		Middle: <input name="mname" type="text" size="20"/><br>
	*Last name: <input name="lname" type="text" size="40"/>
		Suffix: <input name="sname" type="text" size="5"/><br>
	
	<h3>You are required to submit D.O.B for verification purposes</h3>
	*Date of birth: <select name="dobmonth" size="1"> <?php echo createDropdown($monthsArray); ?>  </select>
	<input name="dobday" id="iddobday" type="text" size="2" value="DD" maxlength="2" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<input name="dobyear" id="iddobyear" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/><br>
	
	<br>*<input type="checkbox" name="ack" value="acknowledge"> I acknowledge that I must fax/email the following documents before my account with Resident Screeners can be activated.<br/>
	Please click on the appropriate link below to find out which documents are required from you:<br/><br/>
	
	<center>
		<input type="hidden" name="rd" value="">
		<input type="radio" name="rd" value="Landlord" onClick ="ShowOptions(1,'reqdocs',3);"> Landlord
		<input type="radio" name="rd" value="Realtor" onClick ="ShowOptions(2,'reqdocs',3);"> Realtor
		<input type="radio" name="rd" value="Property Manager" onClick ="ShowOptions(3,'reqdocs',3);"> Property Manager <br/>
	</center>

	<table border="0">
	<tr>
	<td bgcolor="e6e6e6">
	<div id='reqdocs1' style="display: none">
		<b>LANDLORD</b> must provide<b> ALL</b> of the following documents:<br/>
		<ol>
			<li><b>Document for current address</b></li>
			<li><b>Proof of identification</b></li>
			<ul>
				<li>Clear copy of your valid driver's license or passport.</li>
			</ul>
			<li><b>Proof of ownership for the rental property(s).</b></li>
			<b>You must provide ONE current document from the following list:</b>
			<ul>
			<li>Deed (Must show signatures or notary stamp)</li>
			<li>Insurance Declaration (Must show policy dates)</li>
			<li>Mortgage Statement</li>
			<li>Title or Transfer Papers</li>
			<li>Property Tax Bill</li>
			<li>Escrow</li>
			<li>Purchase and Sales Agreement (IF you have just purchased the rental property)</li>
			(Documents must show your name and address)
			</ul>
		</ol>
	</div>
	<div id='reqdocs2' style="display: none">
		<b>REALTOR</b> must provide<b> ALL</b> of the following documents:<br/>
		<ul>
			<li>Copy of the Listing or Management Agreement which is signed and dated by you and the Property(s) Owner</li>
			<li>Copy of a valid Real Estate License</li>
			<li>Copy of a valid Driver's License or Passport</li>
			<li>Copy of a valid Business License and website URL if one exists</li>
		</ul>
	</div>
	<div id='reqdocs3' style="display: none">
		<b>PROPERTY MANAGER</b> must provide<b> ALL</b> of the following documents:<br/>
		<ul>
			<li>Property Management Agreement which is signed and dated by you and the Property(s) Owner</li>
			<li>Clear copy of your valid Driver's License or Passport</li>
			<li>Copy of a valid Business License if applicable</li>
		</ul>
	</div>
	</td>
	</tr>
	</table>
	
	<h3>Your current address</h3>
	*Street address: <input name="curaddress" type="text" size="25"/>
	Suite/apt: <input name="cursuite" type="text" size="5"/><br/>
	*City: <input name="curcity" type="text" size="20"/>
  	*State: <select name="curstate" size="1"><?php echo createDropdown($statesArray); ?> </select>
  	*Zip: <input name="curzip" id="idzip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/> <br/>
	
	<h3>Rental Property Address or Addresses</h3>
	*Number of rental:  <select name="rentalnum" size="1" onchange="AddRentalAddress(this.value)"><?php echo createDropdown($rentalnumArray);?></select><br/>
	<div id="addRentalAddress"></div>

	<h3>Other information</h3>
	Company name: <input name="company" type="text" size="40"/><br/>
	*Email: <input name="email" type="text" size="35" /><br/>
	*Current residence phone number:
  	(<input name="rescode" id="idrescode" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/>) -
  	<input name="res3" id="idres3" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/> -
  	<input name="res4" id="idres4" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/> <br>
	Cell phone number:
  	(<input name="cellcode" id="idcellcode" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/>) -
  	<input name="cell3" id="idcell3" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/> -
  	<input name="cell4" id="idcell4" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/> <br>
	Fax number:
  	(<input name="faxcode" id="idfaxcode" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/>) -
  	<input name="fax3" id="idfax3" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/> -
  	<input name="fax4" id="idfax4" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/> <br><br/>
	
 	How did you hear about Resident Screeners?<br/>
 	<input type="checkbox" name="ref_source[]" value="friend">Friend
 	<input type="checkbox" name="ref_source[]" value="online">Online
 	<input type="checkbox" name="ref_source[]" value="yellowpages">Yellow Pages<br/><br/>
 	
 	<input type="hidden" name="lastfield" value="">

	<b>PLEASE NOTE</b> there is a $25.00 registration fee for signing up.
  	<br>
	<input type="submit" value="Submit" />
	<input type="reset" value="Clear" />
<br/>

</form>
</body>
</html>
