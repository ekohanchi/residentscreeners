		// Functions for summaryReport.php
function clearText(thefield) {
	if (thefield.defaultValue==thefield.value) {
		thefield.value = "";
	}
}

function textCounter(field,cntfield,maxlimit) {
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
	// otherwise, update 'characters left' counter
	else
		cntfield.value = maxlimit - field.value.length;
}

function SetToggle(idInfo,flag) {
	var CState = document.getElementById(idInfo);
	if (flag == true) { CState.style.display = 'block'; }
	else { CState.style.display = 'none'; }
	// can also be initialize as ".visibility = 'visible';"
	// and as ".visibility = 'hidden';", but uses screen space even if 'hidden'
}

		// Functions for memapp.php
function ShowOptions(num, menu, max) {
	var disp = menu + num;
	document.getElementById(disp).style.display = 'block';
	for(i=1; i<=max; i++) {
		if(i!=num){
			disp2=menu+i;
			document.getElementById(disp2).style.display = 'none';
		}
	}
}

function isalldigits(id){
   inputval=document.getElementById(id).value;
   if(isNaN(inputval)){
   	alert('Value must be all digits');
   }
}
function validatezip(id){
   inputval=document.getElementById(id).value;
   if(isNaN(inputval) || inputval.length!=5){
   	if(inputval!=""){
   		alert('Zip must be a 5 DIGIT number');
   	}
   }
}

function validateSRF (sumrform) {
	valid = true;
	
	if ((document.sumrform.civiljudgements[0].checked == false) && (document.sumrform.civiljudgements[1].checked == false)) {
		alert("Please make sure one of the civil judgments options is selected.");
		document.sumrform.civiljudgements[0].focus();
		valid = false
	}
	else if ((document.sumrform.taxliens[0].checked == false) && (document.sumrform.taxliens[1].checked == false)) {
		alert("Please make sure one of the tax liens options is selected.");
		document.sumrform.taxliens[0].focus();
		valid = false
	}
	else if ((document.sumrform.bankruptcy[0].checked == false) && (document.sumrform.bankruptcy[1].checked == false)) {
		alert("Please make sure one of the bankruptcy options is selected.");
		document.sumrform.bankruptcy[0].focus();
		valid = false
	}
	
	return valid;
}

function validateForm (mainform) {
	valid = true;
	zipRegex = /^\d{5}$/;
	twonumRegex = /^\d{2}$/;
	threenumRegex = /^\d{3}$/;
	fournumRegex = /^\d{4}$/;
	emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	ccRegex = /^\d{16}$/;
	spaceRegex = /^\s*$/;
	singRegex = /^\d{1}$/;
	curdate = new Date();
	currentyear = curdate.getFullYear();
	currentmonth = curdate.getMonth() + 1;
	currentdayofmonth = curdate.getDate();
	
	//document.mainform.write("ppacn value: " + document.mainform.prepopulatedACN.value + " flname: " + document.mainform.aciflname.value);
	if((null != spaceRegex.exec(document.mainform.fname.value)) || (null != spaceRegex.exec(document.mainform.lname.value))) {
		alert("Please make sure the following fields are filled:\n\n" +
				"First name\n" +
				"Last name");
		document.mainform.fname.focus();
		valid = false;
	}		// DOB verification
	else if ((document.mainform.dobmonth.value == "0") ||
	(document.mainform.dobday.value == "DD") ||
	(document.mainform.dobyear.value == "YYYY") ||
	(null != spaceRegex.exec(document.mainform.dobday.value)) ||
	(null == twonumRegex.exec(document.mainform.dobday.value)) ||
	(null != spaceRegex.exec(document.mainform.dobyear.value)) ||
	(null == fournumRegex.exec(document.mainform.dobyear.value))) {
		alert("Please make sure all of the fields for DOB are filled in correctly.");
		document.mainform.dobmonth.focus();
		valid = false;
	}		// if ack check box is not checked
	else if (document.mainform.ack.checked == 0) {
		alert("Please make sure you have checked off the acknowledge check box");
		document.mainform.ack.focus();
		valid = false;
	}		// if at least one radio button required doc is not checked
	else if ((document.mainform.rd[1].checked == 0) &&
			(document.mainform.rd[2].checked == 0) &&
			(document.mainform.rd[3].checked == 0)) {
		alert("Please make sure you have checked off at least one of the required documents");
		document.mainform.rd[1].focus();
		valid = false;
	}		// Current address verification
	else if ((null != spaceRegex.exec(document.mainform.curaddress.value)) ||
			(null != spaceRegex.exec(document.mainform.curcity.value)) ||
			(document.mainform.curstate.value == "00") ||
			(null != spaceRegex.exec(document.mainform.curzip.value))) {
		alert("Please make sure you have filled in your current address info.");
		document.mainform.curaddress.focus();
		valid = false;
	}		// Rental number selection
	else if (document.mainform.rentalnum.value >= "0") {
		if (document.mainform.rentalnum.value == "0") {
			alert("At least one rental property address must be selected and entered.");
			document.mainform.rentalnum.focus();
			valid = false; }
		else {
			maxrentalnum = document.mainform.rentalnum.value
			for (i=1; i<= maxrentalnum; i++) {
			    if ((null != spaceRegex.exec(document.mainform["raddress" + i].value)) ||
						(null != spaceRegex.exec(document.mainform["rcity" + i].value)) ||
						(document.mainform["rstate" + i].value == "00") ||
						(null != spaceRegex.exec(document.mainform["rzip" + i].value))) {
			    	valid = false;
			    	//break;
			    }
			}
			if (! valid) {
				alert("Please make sure you have completely filled in your rental property rental address(es)");
			}
		}
	}		// Other information verification
	if (valid) {
		if (null != spaceRegex.exec(document.mainform.email.value)) {
			alert("Please make sure you have filled in your email addresss");
			document.mainform.curaddress.focus();
			valid = false;
		}
		else if ((null != spaceRegex.exec(document.mainform.rescode.value)) ||
				(null == threenumRegex.exec(document.mainform.rescode.value)) ||
				(null != spaceRegex.exec(document.mainform.res3.value)) ||
				(null == threenumRegex.exec(document.mainform.res3.value)) ||
				(null != spaceRegex.exec(document.mainform.res4.value)) ||
				(null == fournumRegex.exec(document.mainform.res4.value))) {
			alert("Please make sure you have filled in your current phone number");
			document.mainform.rescode.focus();
			valid = false;
		}
	}
	return valid;
}