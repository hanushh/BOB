<?php
require_once "config.php";
date_default_timezone_set("US/Central");
$date = date("Y-m-d");
$k=0;
$ampm = date('a', time());
$q="SELECT * FROM `attendanceTime` WHERE date='$date' ";
$res=mysql_query($q)or die(mysql_error());
while($row = mysql_fetch_array($res)){

$color =array("red",'green',"blue");
$k++;
if($k==2){
$k=0;
}
	$fn=$row['firstName'];
	$ln=$row['lastName'];
	$i=$row['i'];
	$j=$row['j'];
	$inAM=$row['inAM'];
	$inPM=$row['inPM'];
	$greeting= array("Jai Guru Dev",
			"Life is bliss",
			"TM in the AM & PM",
			"Every hop is a cosmic smile",
			"No one has the right to suffer",
			"Welcome to group program",
			"Glad you made it today",
			"Thanks for coming",
			"Have a blissful,
			 deep program");
	$logmsg= array("Your attendance scan time is",
			"We've recorded your scan time as",
			"The time of your scan is",
			"This is your scan time",
			"You're in the database at");
			$ap=strtoupper($ampm);
	if($ampm == "am")
	{
		echo "<br /><p style=\"color:$color[$k]\">$greeting[$i], $fn $ln. $logmsg[$j] $inAM $ap</p>" ;
	}
	elseif($ampm == "pm")
	{
		echo "<br /><p style=\"color:$color[$k]\">$greeting[$i], $fn $ln. $logmsg[$j] $inPM $ap</p>" ;
	}
}

?>


