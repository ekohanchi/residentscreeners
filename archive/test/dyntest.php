<html>
<head>
<title>Dynamic Form</title>
<script type="text/javascript" >
function CreateTextbox()
{
var i = 1;
//createTextbox.innerHTML = createTextbox.innerHTML +"<input type=text name='mytext'+ i/>"
//createTextbox.innerHTML = createTextbox.innerHTML +"<input type=text name='mytext'"+ i +"/>"
for (i=1; i<=10; i++) {
    unique_street= "street" + i;
    unique_city= "city" + i;
    createTextbox.innerHTML = createTextbox.innerHTML +"Street <input type='text' name='" + unique_street + "'/>"
    createTextbox.innerHTML = createTextbox.innerHTML +"City <input type='text' name='" + unique_city + "'/><br>"
}

}
</script>
</head>
<body>

<form name="form" action="post" method="">
<input type="button" value="clickHere" onClick="CreateTextbox()">
<div id="createTextbox"></div>
</form>
</body>
</html>
<?php
?>