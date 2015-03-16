<html>
<head>
<title>Toggle Display</title>
<script type="text/javascript">
function SetToggle(idInfo,flag) {
var CState = document.getElementById(idInfo);
if (flag == true) { CState.style.display = 'block'; }
else { CState.style.display = 'none'; }
// can also be initialize as ".visibility = 'visible';"
// and as ".visibility = 'hidden';", but uses screen space even if 'hidden'
}
</script>
</head>
<body>
<h1>Toggle Display</h1>
Show the field now?
<input type="radio" name="RBtn1" value="No" onClick="SetToggle('RBfld1',false)"> No
<input type="radio" name="RBtn1" value="Yes" onClick="SetToggle('RBfld1',true)"> Yes
<span id="RBfld1" style="display:none">
Field #1 contents: <input type="text" id="Fld1" value="">
</span>
<p />
How about this one?
<input type="radio" name="RBtn2" value="No" onClick="SetToggle('RBfld2',false)"> No
<input type="radio" name="RBtn2" value="Yes" onClick="SetToggle('RBfld2',true)"> Yes
<span id="RBfld2" style="display:none">
Field #2 contents: <input type="text" id="Fld2" value="">
</span>

</body>
</html>