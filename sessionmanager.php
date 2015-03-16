<html>
<head>
<title>Session Management</title>
<?php
include("login.php");
?>

<SCRIPT LANGUAGE="JavaScript">
function CheckBoxes() {
	var a=document.form1['sesspath[]'];
	if(document.form1.Check_All.value=="Check All"){
		for(i=0; i<a.length; i++) {
			a[i].checked = true;
		}
		document.form1.Check_All.value="UnCheck All";
	}
	else {
		for(i=0; i<a.length; i++) {
			a[i].checked = false;
		}
		document.form1.Check_All.value="Check All";
	}
	
}
</script>
</head>
<?php
 
 function viewFiles ($directory, $option) {
	 $dir = "$directory/";
	 $filelist="";
	 $filecount=0;
	 $filelist_array = array();
	 $filemtime_array = array();
	 if (is_dir($dir)) {
	 	if ($dh = opendir($dir)) {
	 		while (($rec = readdir($dh)) != false) {
	 			if (preg_match("/^sess_/", $rec)) {
	 				$fullpath = "$dir$rec";
	 				$line = $filecount + 1;
 	 				$filelist_array[] = '<input type="checkbox" name="'.$directory.'[]" value="'.$fullpath.'"> <a href="'.$fullpath.'">'.$rec.'</a><br>';	 				
	 				$filemtime_array[] = date ("D F d Y H:i:s", filemtime($fullpath));
 	 				$filecount++;
	 			}
	 		}
	 		closedir($dh);
	 		if($option == "count") {
	 			echo "$filecount";
	 		}
	 		elseif($option == "filelist") {
	 			echo "<td valign=\"top\">";
	 			for($i=0; $i<=count($filelist_array); $i++) {
					echo "$filelist_array[$i]";
	 			}
				echo "</td>";
				echo "<td valign=\"top\">";
				for($i=0; $i<=count($filemtime_array); $i++) {
					echo "$filemtime_array[$i]<br>";
	 			}
				echo "</td>";
	 		}
	 	}
	 }
 }
?>
<body onload="document.form1.reset();">
<center><h1>Session Management</h1></center>
<?php
include("menubar.php"); 

// Delete Code Starts
  if (isset($_REQUEST['dirname'])) {
	  $directory = $_REQUEST['dirname'];
	  $filelist = array();
	  $filelist_string = "";
	  $i=0;
	  if (isset($_POST[$directory])){
		  foreach ($_POST[$directory] as $k=> $c) {
		  	$filelist[$i] = "$c ";
		  	$filelist_string = "$filelist_string $c ";
		  	$i++;
		  }
		  echo "Are you sure you want to remove the following file(s)?";
		  ?>
		  <form name="question" method="post">
		    <input type="hidden" name="dirname" value="<?=$_REQUEST['dirname']?>"/>
		    <input type="hidden" name="filelist" value="<?=$filelist_string?>"/>
		   	<input type="submit" name="doaction1" value="YES" />
		  	<input type="submit" name="doaction2" value="NO" />
		  </form>
		  <?php
		  echo "<ul>";
		  foreach ($filelist as $k => $v) {
		  	echo "<li>$v</li>";
		  }
		  echo "</ul>";
		  ?>
	<?php
	  }
	  else {
	  	if (! isset($_POST['doaction1']) && ! isset($_POST['doaction2'])) {
	  		echo "<font color=\"red\"><h4>No Files were selected for deletion!!<br>Please mark the checkbox for the files you want to delete.</h4></font>";
	  	}
	  }
  }
  if (isset($_POST['doaction1']) || isset($_POST['doaction2'])) {
  	if (isset($_POST['doaction1'])) {
  		if (isset($_REQUEST['filelist'])){
  			$filelist_string = $_REQUEST['filelist'];
  			$filelist = explode(" ", $filelist_string);
  			foreach ($filelist as $k => $v) {
		 	 	if (file_exists($v)) {
		 	 		@unlink($v);
		 	 	}
			}
			header('Location: sessionmanager.php');
  		}
  	}
  	else {
  		 header('Location: sessionmanager.php');
  	}
  }
  ?>
<!-- Delete Code Ends -->
<form name="form1" method="post" action="sessionmanager.php">
<table border="3" align="center" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top" colspan="100%" align="center">
    	<input type="button" name="Check_All" value="Check All" onClick="CheckBoxes()">
    	<input type="submit" value="Delete">
    	<input type="hidden" name="dirname" value="sesspath"/>
    	<br>List of sessions now availble (<?php viewFiles("sesspath", "count"); ?>)
    </td>
  </tr>
  <tr>
    <?php viewFiles("sesspath", "filelist"); ?>
  </tr>
</table>
</form>
</body>
</html>