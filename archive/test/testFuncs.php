<?php
function runQuery($stmt, $option) {
		//option=values: displays values for sql statment
		//option=count: displays count for sql statement
	$query = $stmt;
	$result = mysql_query($query);
	$num=mysql_numrows($result);
	$i=0;
	while ($i < $num) {
		//$id=mysql_result($result,$i,"id");
		$appid=mysql_result($result,$i,"appid");
		if ($option == "values") {
			echo "<a href=\"viewApp.php?appid=$appid\">$appid</a><br>";
		}
		$i++;
	}
	if ($option == "count") {
		echo "$i";
	}
}

function displayAll() {
	$query = "Select * from $sumr_table;";
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	$i=0;
	while ($i < $num) {
		$id=mysql_result($result,$i,"id");
		$inserted=mysql_result($result,$i,"inserted");
		$srfstatus=mysql_result($result,$i,"srfstatus");
		$srfid=mysql_result($result,$i,"srfid");
		$acctholder=mysql_result($result,$i,"acctholder");
		$curdate=mysql_result($result,$i,"curdate");
		$aplname=mysql_result($result,$i,"aplname");
		$apfname=mysql_result($result,$i,"apfname");
		$crlines=mysql_result($result,$i,"crlines");
		$crgood=mysql_result($result,$i,"crgood");
		$crneg=mysql_result($result,$i,"crneg");
		$crevictions=mysql_result($result,$i,"crevictions");
		$crinquires=mysql_result($result,$i,"crinquires");
		$creditscore=mysql_result($result,$i,"creditscore");
		$civiljudgements=mysql_result($result,$i,"civiljudgements");
		$cjcount=mysql_result($result,$i,"cjcount");
		$cjdfmonth=mysql_result($result,$i,"cjdfmonth");
		$cjdfyear=mysql_result($result,$i,"cjdfyear");
		$taxliens=mysql_result($result,$i,"taxliens");
		$tlcount=mysql_result($result,$i,"tlcount");
		$bankruptcy=mysql_result($result,$i,"bankruptcy");
		$bankruptcyType=mysql_result($result,$i,"bankruptcyType");
		$bankruptcydf=mysql_result($result,$i,"bankruptcydf");
		$bankruptcy_open=mysql_result($result,$i,"bankruptcy_open");
		$bankruptcy_closed=mysql_result($result,$i,"bankruptcy_closed");
		$telecheckType=mysql_result($result,$i,"telecheckType");
		$comments=mysql_result($result,$i,"comments");
		$charcounter=mysql_result($result,$i,"charcounter");
	}
}

function displayTableVals() {
	// sending query
	$result = mysql_query("SELECT * FROM $sumr_table");
	if (!$result) {
	    die("Query to show fields from table failed");
	}
	
	$fields_num = mysql_num_fields($result);
	
	echo "<h1>Table: $sumr_table</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++)
	{
	    $field = mysql_fetch_field($result);
	    echo "<td>{$field->name}</td>";
	}
	echo "</tr>\n";
	// printing table rows
	while($row = mysql_fetch_row($result))
	{
	    echo "<tr>";
	
	    // $row is array... foreach( .. ) puts every element
	    // of $row to $cell variable
	    foreach($row as $cell)
	        echo "<td>$cell</td>";
	
	    echo "</tr>\n";
	}
	mysql_free_result($result);
	echo "</table>";
}

?>