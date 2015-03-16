<?php
$k = raddress3;
echo "the value of k is $k<br>";

if (preg_match('/^raddress/', $k)) {	
	echo "the string starts with raddress<br>";
} else {
	echo "the string does NOT start with raddress<br>";
}
?>