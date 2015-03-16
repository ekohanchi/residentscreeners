<HTML>
  <HEAD>
    <TITLE>Hello World</TITLE>
    <SCRIPT type="text/javascript">
    function addElement() {
    	  var ni = document.getElementById('myDiv');
    	  var numi = document.getElementById('theValue');
    	  var num = (document.getElementById('theValue').value -1)+ 2;
    	  numi.value = num;
    	  var newdiv = document.createElement('div');
    	  var divIdName = 'my'+num+'Div';
    	  newdiv.setAttribute('id',divIdName);
    	  newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
    	  ni.appendChild(newdiv);
    	}
    function removeElement(divNum) {
    	  var d = document.getElementById('myDiv');
    	  var olddiv = document.getElementById(divNum);
    	  d.removeChild(olddiv);
    	}
    </SCRIPT>
    
    <!--  original js code from memapp.php -->
    <script type="text/javascript">
	var counter = 0;
	function init() {
		document.getElementById('moreFields').onclick = moreFields;
		moreFields();
	}
	function moreFields() {
		counter++;
		var newFields = document.getElementById('readroot').cloneNode(true);
		newFields.id = '';
		newFields.style.display = 'block';
		var newField = newFields.childNodes;
		for (var i=0;i<newField.length;i++) {
			var theName = newField[i].name
			if (theName)
				newField[i].name = theName + counter;
		}
		var insertHere = document.getElementById('writeroot');
		insertHere.parentNode.insertBefore(newFields,insertHere);
	}
	</script>

  </HEAD>

  <BODY>


<input type="hidden" value="0" id="theValue" />
<p><a href="javascript:;" onclick="addElement();">Add Some Elements</a></p>
<div id="myDiv"> </div>


	<div id='rentaladd' style="display: none">
		*Street address: <input name="raddress" type="text" size="25"/>
		Suite/apt: <input name="rsuite" type="text" size="5"/><br/>
		*City: <input name="rcity" type="text" size="20"/>
	  	*State: <select name="rstate" size="1"><?php echo createDropdown($statesArray); ?> </select>
	  	*Zip: <input name="rzip" id="idrzip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/> <br>
	</div>
  </BODY>
</HTML>
<?php
?>