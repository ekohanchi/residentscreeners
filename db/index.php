<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX,FOLLOW,NOIMAGEINDEX,NOIMAGECLICK">
<meta http-equiv="Content-Type" content="text/html; charset=encoding">
<title>DB Management</title>
</head>
    <body>
<?php
include("../login.php"); 
?>
    
    <center><h1>Database Management</h1></center>
<?php

function activeDisplay($active, $filename, $displaytext) {
	$warn_msg="<font color=\"red\"> - WARNING this script has already been ran and it should NOT be ran again</font>";
	
	if ($active == 0) {
		$hreflink = '#';
		$texttodisplay = $displaytext;
		$displaymessage = $warn_msg;
	} elseif ($active == 1) {
		$hreflink = "runQuery?$filename";
		$texttodisplay = $displaytext;
		$displaymessage = "";
	}
	echo "<a href=\"$hreflink\">$texttodisplay</a> $displaymessage";
}


?>
	<input style="color: orange font-weight: bold" type=button onclick="document.location.href='../menubar.php'" value="Admin Page">

    <br>Select which action to run:
    <ul>
	    <li><?php activeDisplay (0,"createtable_memapp.sql","Create memapp Table");?></li>
	    <li><?php activeDisplay (0,"createtable_summaryreport.sql","Create summaryreport Table");?></li>
    </ul>
<!--    <ul>-->
<!--    	<li><a href="saveTable.php?memapps">Backup Memapps Table</a></li>-->
<!--    	<li><a href="saveTable.php?summaryReport">Backup SummaryReport Table</a></li>-->
<!--    </ul>-->
    </body>
</html>