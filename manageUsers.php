<html>
<head>
<title>Manage Users</title>
</head>
<body>
<?php
include("include/configs.php");
include("login.php");
?>
<center>
<h1>Manage Users</h1>
</center>
<?php include("menubar.php");

echo "<table align=\"center\" border=\"1\" width=\"50%\">";
echo "<tr>";
echo "<td><b><center>Full Name - Username</center></b></td>";
echo "<td><b><center>Password</center></b></td>";
echo "</tr>";
echo "<tr>";
$i=1;
foreach ($login_credentials_decrypted as $key => $value) {
	echo "<td>$key</td>";
	$i++;
	echo "<td>$value</td>";
	
	if ($i%2 == 0) {
		echo "</tr>";
		echo "<tr>";
	}
	$i++;
}
echo "</tr>";
echo "</table>";

?>

</body>
</html>
<?php

?>