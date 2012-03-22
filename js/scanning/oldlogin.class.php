<?php
class Login
{
	function __construct()
	{
		require_once "config.php";
	}

	function barcode_Scanning($barcode)
	{
		$this->barcode		=	dbconnect::escape($barcode);
		$this->query		=	"SELECT * FROM user WHERE `barcode`='".$this->barcode."'";
		$this->res		=	mysql_query($this->query) or die(mysql_error());
				
		if(mysql_num_rows($this->res) > 0)
		{ 	date_default_timezone_set("US/Central");
			$date = date("Y-m-d");
			$ampm = date('a', time());
		    $time = date('h:i:s', time());
			$row1=mysql_fetch_array($this->res);
			
			
			$q1= "SELECT * FROM `attendanceTime` WHERE `barcode`='$barcode' AND `date`='$date'";
			$resu=mysql_query($q1);
			if(mysql_num_rows($resu) > 0){
				$row=mysql_fetch_array($resu);
				$update=true;
				$inampre=$row['inAM'];
				$inpmpre=$row['inPM'];
			}
			
			$fn=$row1['firstName'];
			$ln=$row1['lastName'];
			$greeting= array("Jai Guru Dev",
					"Life is bliss",
					"TM in the AM and PM",
					"Every hop is a cosmic smile",
					"No one has the right to suffer",
					"Welcome to group program",
					"Glad you made it today",
					"Thanks for coming",
					"Have a blissful,
					 deep program");

			$logmsg= array("Your attendance time is recorded as",
					"We've recorded your scan time as",
					"The time of your scan is",
					"This is your scan time",
					"You're in the database at");
			
			$ap=strtoupper($ampm);
			$i=rand(0,(count($greeting)-1));
			$j=rand(0,(count($logmsg)-1));
			if($ampm == "am")
			{	if($update==true){
				 $this->message = "$greeting[$i], $row1[firstName] $row1[lastName]. You are already scanned in at $inampre $ap";
				 return $this->message;				
				}
				$INam = $time;
				$INpm = "00:00:00";
				$q = "INSERT INTO `attendanceTime`(barcode,firstName,lastName, date, inAM, inPM,i,j ) VALUES ('".$this->barcode."','$fn','$ln','$date', '$INam', '$INpm',$i,$j)";
			}
			else if($ampm == "pm")
			{      
				$INpm = $time;
				$INam = "00:00:00";
								
				if($update==true){
					if($inpmpre!="00:00:00"){
						$this->message = "$greeting[$i], $row1[firstName] $row1[lastName]. You are already logged in at $inpmpre $ap";
				 		return $this->message;		
					}
				$q = "UPDATE `attendanceTime` SET inPM='$INpm',i=$i,j=$j WHERE `barcode`='$barcode' AND `date`='$date'";
				
				}
				else{
				$q = "INSERT INTO `attendanceTime`(barcode,firstName,lastName, date, inAM, inPM,i,j ) VALUES ('".$this->barcode."','$fn','$ln','$date', '$INam', '$INpm',$i,$j)";
				}
				
			}
			
			mysql_query($q) or die(mysql_error());

             $this->message="" ;       
		}
		else
		{
			$this->message = "Invalid Barcode";
			
		}
		return $this->message;		
	}
}
