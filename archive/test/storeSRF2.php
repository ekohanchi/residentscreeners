<?php
foreach (array_keys($_REQUEST) as $k) {
	echo "$k: $_REQUEST[$k];";
	echo "<br>";
	
}
?>