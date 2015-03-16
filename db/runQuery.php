<?php
include("../include/configs.php");
//include("../login.php");

if(isset($_GET['querytorun'])) {
	$sqlfilename=$_GET['querytorun'];
	if (file_exists($sqlfilename)) {
		ob_start(); // start buffer
		include ("$sqlfilename");
		$content = ob_get_contents(); // assign buffer contents to variable
		ob_end_clean(); // end buffer and remove buffer contents
		$fileexists=true;
	}
	else {
		$content= "ERROR file name <i>$sqlfilename</i> was NOT found";
		$fileexists=false;
	}
	
	if (isset($_POST['confirm'])) {
		if (($_POST['confirm'] == "OK") && ($fileexists)) {
			include("opendb.php");
			//$dropquery="DROP TABLE IF EXISTS $table;";
			//mysql_query($content) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $content . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());		
	
			echo "<br>Successful!<br>";
			echo "<br>Done running query with the following credentials...<br>";
			echo "<b>Database Host:</b> $dbhost <br>";
			echo "<b>Database Name:</b> $database <br>";
			include("closedb.php");
			
			echo "<br>Back to <a href=\"index.php\">Database Management</a>";
		}
		else {
			echo "<br>ERROR!<br>";
			echo "Can't run query if file: <i>$sqlfilename</i> does not exists";
			echo "<br>Back to <a href=\"index.php\">Database Management</a>";
		}
	}
	else {
		$action_script = "runQuery.php?querytorun=$sqlfilename";
		?>
		<form method="post" action="<?php $action_script?>">
		<br>This script will run the Query below with the following credentials:<br>
		<?php
			echo "<li>Database Host: $dbhost</li>";
			echo "<li>Database Username: $dbuser</li>";
			echo "<li>Database Name: $database</li>";
			//echo "<li>Database Table: $table</li>";
			echo "<li>Query: <pre>$content</pre></li>";
		?>
		<p><input type="submit" name="confirm" value="OK">
		<input type=button onclick="document.location.href='index.php'" value="Cancel">
		</form> 
		<?php
	}
}
else {

	echo "No query file was specified to be run";
	echo "<br>Back to <a href=\"index.php\">Database Management</a>";
}
?>