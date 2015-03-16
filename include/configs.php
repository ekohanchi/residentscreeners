<?php
/*
 * last modified: 1/1/10 
 */

	// Global variable configs
$carmakeArray = array('0'=>"Select a Car",'1'=>"Acura",'2'=>"Aston Martin",'3'=>"Audi",'4'=>"BMW",'5'=>"Buick",'6'=>"Cadillac",'7'=>"Chevrolet",'8'=>"Chrysler",'9'=>"Dodge",'10'=>"Ferrari",'11'=>"Ford",'12'=>"GMC",'13'=>"Honda",'14'=>"HUMMER",'15'=>"Hyundai",'16'=>"Infiniti",'17'=>"Isuzu",'18'=>"Jaguar",'19'=>"Jeep",'20'=>"Kia",'21'=>"Land Rover",'22'=>"Lexus",'23'=>"Lincoln",'24'=>"Lotus",'25'=>"Maserati",'26'=>"Mazda",'27'=>"Mercedes-Benz",'28'=>"Mercury",'29'=>"MINI",'30'=>"Mitsubishi",'31'=>"Nissan",'32'=>"Pontiac",'33'=>"Porsche",'34'=>"Rolls-Royce",'35'=>"Saab",'36'=>"Saturn",'37'=>"Scion",'38'=>"Smart",'39'=>"Subaru",'40'=>"Suzuki",'41'=>"Toyota",'42'=>"Volkswagen",'43'=>"Volvo");
$yearArray = array('2009' => "2009", '2010' => "2010");
$monthsArray = array('0' => "Month", '1' => "January", '2' => "February", '3' => "March", '4' => "April", '5' => "May", '6' => "June", '7' => "July", '8' => "August", '9' => "September", '10' => "October", '11' => "November", '12' => "December");
$workweekdayArray = array('1' => "Monday", '2' => "Tuesday", '3' => "Wednesday", '4' => "Thursday", '5' => "Friday");
$statesArray = array('00'=>"Select a State",'AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii",'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa",  'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");
$monthdaysArray = array('0'=>"0",'1'=>"1",'2'=>"2",'3'=>"3",'4'=>"4",'5'=>"5",'6'=>"6",'7'=>"7",'8'=>"8",'9'=>"9",'10'=>"10",'11'=>"11",'12'=>"12",'13'=>"13",'14'=>"14",'15'=>"15",'16'=>"16",'17'=>"17",'18'=>"18",'19'=>"19",'20'=>"20",'21'=>"21",'22'=>"22",'23'=>"23",'24'=>"24",'25'=>"25",'26'=>"26",'27'=>"27",'28'=>"28",'29'=>"29",'30'=>"30",'31'=>"31");
$cctypeArray = array('visa'=>"Visa",'mastercard'=>"Mastercard");
$rentalnumArray = array('0'=>"Select a number",'1'=>"1",'2'=>"2",'3'=>"3",'4'=>"4",'5'=>"5",'6'=>"6",'7'=>"7",'8'=>"8",'9'=>"9",'10'=>"10",'11'=>"11",'12'=>"12",'13'=>"13",'14'=>"14",'15'=>"15",'16'=>"16",'17'=>"17",'18'=>"18",'19'=>"19",'20'=>"20",'21'=>"21",'22'=>"22",'23'=>"23",'24'=>"24",'25'=>"25",'26'=>"26",'27'=>"27",'28'=>"28",'29'=>"29",'30'=>"30",'31'=>"31",'32'=>"32",'33'=>"33",'34'=>"34",'35'=>"35");
$bankruptcytypeArray = array('0'=>"Type", '7'=>"7", '11'=>"11", '13'=> "13");
$telecheckArray = array('0'=>"Select One", 'Good'=>"Good", 'Code4'=>"Code4", 'Lost'=>"Lost", 'Stolen'=>"Stolen");
$ssnstatusArray = array('0'=>"Select One", 'Confirmed'=>"Confirmed", 'Not issued'=>"Not issued");

	// DB CONFIGURATIONS
include ("dbconfigurations.php");

	// Common DB configs
$memapp_table="memapp";
$sumr_table="summaryreport";

	//mysql insert error messages file
$sqlerrors = "sqlerrors.txt";

		//application processed email notification
$emailnotify = "residentscreeners@gmail.com,melisa.vannalom@gmail.com";
//$emailnotify = "ekohanchi@gmail.com";

//$error_emailnotify = "ekohanchi@gmail.com";
$error_emailnotify = "melisa.vannalom@gmail.com";
//$error_emailnotify = "";

	// Login page credentials
//put sha1() encrypted password here - example is 'hello'
$login_info = array(
  'ekohanchi' => '9d67cd1209ff3ca2fde13fe70b1d417a623b7ac0',	//adm!np4w
  'mvannalom' => '0abbdf476412190cf0d55864aa49821bbeb349c6',
  'spulvers' =>  '8d9cae60cb2378a5766f927e0e586a9af28e0081',
  'dscott' =>	 '3b9f592cf617cdf566cf88b92659df086ed15c1a'
);

$login_credentials_decrypted = array(
	'Eli Kohanchi - ekohanchi' => 'adm!npa334rs',
	'Melisa Vannalom - mvannalom' => 'rsp4vapps',
	'Sue Pulvers - spulvers' => 'pinkfloyd1989',
	'Debbie Scott - dscott' => 'p4ds4r3h'
);

?>