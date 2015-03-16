<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX,FOLLOW,NOIMAGEINDEX,NOIMAGECLICK">
</head>
<body>

<?php
/*
 * last modified: 3/21/10
 */
include("../include/configs.php");
include("../login.php"); 
// 60 fields

$createquery_sr="CREATE TABLE $sumr_table
(
	id int NOT NULL AUTO_INCREMENT,
	inserted Datetime NOT NULL,
	srfstatus int(3),
	srfid varchar(25) NOT NULL,
	curdate varchar(15),
	aplname varchar(25),
	apfname varchar(25),
	crlines varchar(3),
	crgood varchar(3),
	crneg varchar(3),
	crevictions varchar(3),
	crinquires varchar(3),
	creditscore varchar(3),
	civiljudgements varchar(3),
	cjcount  varchar(3),
	cjdfmonth varchar(2),
	cjdfyear varchar(4),
	taxliens varchar(3),
	tlcount varchar(3),
	taxliens_released varchar(3),
	bankruptcy varchar(3),
	bankruptcyType varchar(3),
	bankruptcydf varchar(10),
	bankruptcy_open varchar(10),
	bankruptcy_closed varchar(10),
	telecheckType varchar(10),
	ssnstatus varchar(15),
	comments varchar(215),
	charcounter varchar(3),
	mgrAgentOwner varchar(30),
	mgrPhone varchar(20),
	propMgtCo varchar(30),
	propMgtCoFax varchar(20),
	aptComplex varchar(30),
	acctholder varchar(25),
	numOfPages varchar(3),
	UNIQUE KEY id (id)
);";

$createquery_ma="CREATE TABLE $memapp_table
(
	id int NOT NULL AUTO_INCREMENT,
	inserted Datetime NOT NULL,
	appstatus int(3),
	appid varchar(25) NOT NULL,
	fname varchar(50),
	mname varchar(50),
	lname varchar(50),
	sname varchar(5),
	dobmonth varchar(2),
	dobday varchar(2),
	dobyear varchar(4),
	ack varchar(20),
	rd varchar(20),
	curaddress varchar(50),
	cursuite varchar(10),
	curcity varchar(50),
	curstate varchar(25),
	curzip varchar(20),
	rentalnum varchar(3),
	fullrentaladdress1 varchar(150),
	fullrentaladdress2 varchar(150),
	fullrentaladdress3 varchar(150),
	fullrentaladdress4 varchar(150),
	fullrentaladdress5 varchar(150),
	fullrentaladdress6 varchar(150),
	fullrentaladdress7 varchar(150),
	fullrentaladdress8 varchar(150),
	fullrentaladdress9 varchar(150),
	fullrentaladdress10 varchar(150),
	fullrentaladdress11 varchar(150),
	fullrentaladdress12 varchar(150),
	fullrentaladdress13 varchar(150),
	fullrentaladdress14 varchar(150),
	fullrentaladdress15 varchar(150),
	fullrentaladdress16 varchar(150),
	fullrentaladdress17 varchar(150),
	fullrentaladdress18 varchar(150),
	fullrentaladdress19 varchar(150),
	fullrentaladdress20 varchar(150),
	fullrentaladdress21 varchar(150),
	fullrentaladdress22 varchar(150),
	fullrentaladdress23 varchar(150),
	fullrentaladdress24 varchar(150),
	fullrentaladdress25 varchar(150),
	fullrentaladdress26 varchar(150),
	fullrentaladdress27 varchar(150),
	fullrentaladdress28 varchar(150),
	fullrentaladdress29 varchar(150),
	fullrentaladdress30 varchar(150),
	fullrentaladdress31 varchar(150),
	fullrentaladdress32 varchar(150),
	fullrentaladdress33 varchar(150),
	fullrentaladdress34 varchar(150),
	fullrentaladdress35 varchar(150),
	company varchar(50),
	email varchar(40),
	resphone varchar(15),
	cellphone varchar(15),
	faxnum varchar(15),
	ref_source varchar(100),
    UNIQUE KEY id (id)
);";

if(isset($_GET['memapps']) || isset($_GET['summaryreport'])) {
	if(isset($_GET['memapps'])) {
		$table = $memapp_table;
		$createquery = $createquery_ma;
		$param = memapp;
	}
	if(isset($_GET['summaryreport'])) {
		$table = $sumr_table;
		$createquery = $createquery_sr;
		$param = summaryreport;
	}
		
	if (isset($_POST['confirm'])) {
		include("opendb.php");
		$dropquery="DROP TABLE IF EXISTS $table;";
		mysql_query($dropquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $dropquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());

		mysql_query($createquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $createquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
		
		echo "<br>Successful!<br>";
		echo "<br>Done creating (and populating) table with the following credentials...<br>";
		echo "<b>Table name:</b> $table <br>";
		echo "<b>DB:</b> $database <br>";
		include("closedb.php");
		
		echo "<br>Back to <a href=\"index.php\">Database Management</a>";
	}
	else {
		$action_script = "createTable.php?$param";
		?>
		<form method="post" action="<?php $action_script ?>">
		<br>This script will drop then create the Table with the following credentials:<br>
		<?php
			echo "<li>Database Host: $dbhost</li>";
			echo "<li>Database Username: $dbuser</li>";
			echo "<li>Database Name: $database</li>";
			echo "<li>Database Table: $table</li>";
			echo "<li>Create Query: <pre>$createquery</pre></li>";
		?>
		<p><input type="submit" name="confirm" value="OK">
		<input type=button onclick="document.location.href='index.php'" value="Cancel">
		</form> 
	<?php
	}
}
else {
	echo "<br>Back to <a href=\"index.php\">Database Management</a>";
//	header('Location: index.php');
}?>

</body>
</html>