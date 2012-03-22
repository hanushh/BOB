<?php
class Login
{
	public $message;
	function __construct()
	{
		require_once "config.php";
		$message = array();
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
					"TM in the AM & PM",
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
			{	if($update==true)
				{
					$this->message['scanData'] = "$greeting[$i], $row1[firstName] $row1[lastName]. You already scanned at $inampre $ap";
				 
				 	$this->message['DbData'] = "<li><p class='greeting'>$greeting[$i], <span class=\"name\"> $row1[firstName] $row1[lastName]</span><br />. You already scanned at <span class=\"name\">$inampre $ap</span></p></li>";

				 
					//$DbData= "<li><p class='greeting'>{$greeting[$i]},<span class=\"name\"> $fn $ln</span><br /> $logmsg[$j] <span class=\"name\">$inAM $ap</span></p></li>" ;

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
						$this->message['scanData'] = "$greeting[$i], $row1[firstName] $row1[lastName]. You are already logged in at $inpmpre $ap";
						$this->message['DbData'] = "<li><p class='greeting'>$greeting[$i], <span class=\"name\"> $row1[firstName] $row1[lastName]</span><br />. You already scanned at <span class=\"name\">$inpmpre $ap</span></p></li>";
				 		return $this->message;		
					}
				$q = "UPDATE `attendanceTime` SET inPM='$INpm',i=$i,j=$j WHERE `barcode`='$barcode' AND `date`='$date'";
				
				}
				else{
				$q = "INSERT INTO `attendanceTime`(barcode,firstName,lastName, date, inAM, inPM,i,j ) VALUES ('".$this->barcode."','$fn','$ln','$date', '$INam', '$INpm',$i,$j)";
				}
				
			}
			
			mysql_query($q) or die(mysql_error());

            //$this->message['scanData']="" ;     
			//$this->message['DbData']=""; 
		}
		else
		{
			$this->message['scanData'] = "Invalid Barcode";
			$this->message['DbData']="Invalid Barcode";
			
		}
		return $this->message;		
	}
}
