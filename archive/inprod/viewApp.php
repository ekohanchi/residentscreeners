<html>
<head>
<title>View Application</title>
<script language="javascript">
function printpage()
 {
  window.print();
 }
</script>
</head>
<body>
<?php
include("login.php"); 
?>
<center>
<h1>View Application</h1>
</center>
<?php
include("include/configs.php");
?>
<input style="color: Chocolate; font-weight: bold" type=button
	onclick="document.location.href='manageApps.php'"
	value="Manage Referrals">
<input type="button" value="Print" onclick="printpage();">
<?php
$appsField_array = array(
		'0' => "id",
		'1' => "inserted",
		'2' => "appstatus",
		'3' => "appid",
		'4' => "fname",
		'5' => "mname",
		'6' => "lname",
		'7' => "sname",
		'8' => "dobmonth",
		'9' => "dobday",
		'10' => "dobyear",
		'11' => "ack",
		'12' => "rd",
		'13' => "curaddress",
		'14' => "cursuite",
		'15' => "curcity",
		'16' => "curstate",
		'17' => "curzip",
		'18' => "rentalnum",
		'19' => "fullrentaladdress1",
		'20' => "fullrentaladdress2",
		'21' => "fullrentaladdress3",
		'22' => "fullrentaladdress4",
		'23' => "fullrentaladdress5",
		'24' => "fullrentaladdress6",
		'25' => "fullrentaladdress7",
		'26' => "fullrentaladdress8",
		'27' => "fullrentaladdress9",
		'28' => "fullrentaladdress10",
		'29' => "fullrentaladdress11",
		'30' => "fullrentaladdress12",
		'31' => "fullrentaladdress13",
		'32' => "fullrentaladdress14",
		'33' => "fullrentaladdress15",
		'34' => "fullrentaladdress16",
		'35' => "fullrentaladdress17",
		'36' => "fullrentaladdress18",
		'37' => "fullrentaladdress19",
		'38' => "fullrentaladdress20",
		'39' => "fullrentaladdress21",
		'40' => "fullrentaladdress22",
		'41' => "fullrentaladdress23",
		'42' => "fullrentaladdress24",
		'43' => "fullrentaladdress25",
		'44' => "fullrentaladdress26",
		'45' => "fullrentaladdress27",
		'46' => "fullrentaladdress28",
		'47' => "fullrentaladdress29",
		'48' => "fullrentaladdress30",
		'49' => "fullrentaladdress31",
		'50' => "fullrentaladdress32",
		'51' => "fullrentaladdress33",
		'52' => "fullrentaladdress34",
		'53' => "fullrentaladdress35",
		'54' => "company",
		'55' => "email",
		'56' => "resphone",
		'57' => "cellphone",
		'58' => "faxnum",
		'59' => "ref_source"

);

if(isset($_GET['appid'])) {
	$appID = $_GET['appid'];

	include("db/opendb.php");
	//echo "<br>";

	$selectQuery = "select * from $memapp_table where appid='$appID'";
	$result = mysql_query($selectQuery);
	$num = mysql_num_fields($result);

	$i=0;
	$db_field = mysql_fetch_assoc($result);
	if($db_field != '') {
		?>
		<pre>
		<table border="0" width="100%">
		<tr>
		<td>
		<table border="1">
		<?php
		while ($i < $num) { ?>
			<tr>
			<?php
			$field = $appsField_array[$i];
			$value = $db_field[$field];
			//	echo "$field: $value<br>";
			echo "<td>$field</td>";
			echo "<td>$value&nbsp;</td>";
			?>
			</tr>
			<?php
			$i++;
		}
		?>
		</table>
		</td>
		<td>
		</td>

		</tr>
		</table>
		</pre>
		<?php
	}
	else {
		echo "<font color=\"red\">ERROR application id: $appID not found.</font>";
	}

	include("db/closedb.php");
}
else {
	echo "<font color=\"red\">ERROR application id not specified</font>";
}

?>


</body>
</html>
