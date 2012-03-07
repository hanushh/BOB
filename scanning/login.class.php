<?php
class Login {
	public $message;
	public static $namecolor;
	function __construct() {

		$message = array();
	}

	function barcode_Scanning($barcode) 
	{
			
		$this -> barcode 	= 	dbconnect::escape($barcode);
		$serialNumber 		= 	$this->getSerialNumber( $this -> barcode );
		$namecolor 			=  	$this->getNameColor();
		
		if($this->is_lost_barcode($this->barcode))
		{
			$this -> message['scanData'] 	= "Lost Barcode: Not Valid.";
			$this -> message['DbData'] 		= "<li style='color:".$this->getErrorColor()."'>Lost Barcode: Not Valid.</li>";
			return $this -> message;
		}
		
		
		$this -> query 	= 	"SELECT * FROM  `user` 
							LEFT JOIN  `userCommunity` ON 
							user.serialNumber = userCommunity.serialNumber  
							WHERE `barcode`='" . $this -> barcode . "'";

		$this -> res = mysql_query($this -> query) or die(mysql_error());

		if (mysql_num_rows($this -> res) > 0) 
		{
			
			$row1 = mysql_fetch_array($this -> res);

			if ($row1['mum_stat'] == 1) :
				date_default_timezone_set("US/Central");
				$date = date("Y-m-d");
				$ampm = date('a', time());
				$time = date('h:i:s', time());

				$q1 = "SELECT * FROM user
						LEFT JOIN  `attendanceTime` ON 
						user.serialNumber = attendanceTime.serialNumber 
						WHERE `barcode`='$barcode' 
						AND 
						`date`='$date'";
				
				$resu = mysql_query($q1) or die(mysql_error());
				
				if (mysql_num_rows($resu) > 0) 
				{
					$row 		= mysql_fetch_array($resu);
					$update 	= true;
					$inampre 	= $row['inAM'];
					$inpmpre 	= $row['inPM'];
				}

				
				$greeting 	= $this->getGreetingsTextArray();

				$logmsg 		= $this->getLogMessageArray();
				$ap 			= strtoupper($ampm);
				$i 				= rand(0, (count($greeting) - 1));
				$j 				= rand(0, (count($logmsg) - 1));
				$bool_newuser	= ($row1['firstName'] == '')?TRUE:FALSE;
				$fn 			= ($row1['firstName'] == '')?$this->assign_default_name($this -> barcode):$row1['firstName'];
				$ln 			= $row1['lastName'];
				if ($ampm == "am") 
				{
					if ($update == true) 
					{
						$this -> message['scanData'] = "$greeting[$i], $fn $ln. You already scanned at $inampre $ap";
						
						$this -> message['DbData'] = "<li><p class='greeting'>$greeting[$i], <span style='color:{$namecolor}'> $fn $ln</span>.<br /> You already scanned at <span style='color:{$namecolor}'>$inampre $ap</span></p></li>";

						//$DbData= "<li><p class='greeting'>{$greeting[$i]},<span class=\"name\"> $fn $ln</span><br /> $logmsg[$j] <span class=\"name\">$inAM $ap</span></p></li>" ;
						return $this -> message;
					}
					$INam = $time;
					$INpm = "00:00:00";
					$q = "INSERT INTO `attendanceTime`(serialNumber, date, inAM, inPM,i,j ) VALUES ('" . $serialNumber. "','$date', '$INam', '$INpm',$i,$j)";
				} 
				else if ($ampm == "pm") 
				{
					$INpm = $time;
					$INam = "00:00:00";

					if ($update == true) {
						if ($inpmpre != "00:00:00") {
							$this -> message['scanData'] = "$greeting[$i], $fn $ln. You are already logged in at $inpmpre $ap";
							$this -> message['DbData'] = "<li><p class='greeting'>$greeting[$i], <span style='color:{$namecolor}'> $fn $ln</span>.<br /> You already scanned at <span style='color:{$namecolor}'>$inpmpre $ap</span></p></li>";
							return $this -> message;
						}
						$q = "UPDATE `attendanceTime` SET inPM='$INpm',i=$i,j=$j WHERE `serialNumber`='$serialNumber' AND `date`='$date'";

					} else {
						$q = "INSERT INTO `attendanceTime`(serialNumber, date, inAM, inPM,i,j ) VALUES ('$serialNumber','$date', '$INam', '$INpm',$i,$j)";
					}

				}

				mysql_query($q) or die(mysql_error());
				if( $bool_newuser )
				{
					$this -> message['scanData'] = "Welcome, $fn, you are logged in at $time $ap";
				$this -> message['DbData'] = "<li><p class='greeting'>$greeting[$i], 
											<span style='color:{$namecolor}'> $fn $ln
											</span>.<br /> 
											$logmsg[$j] <span style='color:{$namecolor}'>$time $ap</span></p></li>";
					
				} else
				{
				$this -> message['scanData'] = "$greeting[$i], $fn $ln. $logmsg[$j] $time $ap";
				$this -> message['DbData'] = "<li><p class='greeting'>$greeting[$i], 
											<span style='color:{$namecolor}'> $fn $ln
											</span>.<br /> 
											$logmsg[$j] <span style='color:{$namecolor}'>$time $ap</span></p></li>";
				}
											
			elseif($row1['mum_stat'] == 0) :
				$this -> message['scanData'] = "Deactivated Barcode - Not Valid.";
				$this -> message['DbData'] = "<li style='color:".$this->getErrorColor()."'>Deactivated Barcode - Not Valid.</li>";
			endif;
			
		} else {
			$this -> message['scanData'] = "Not a Group Program Barcode: Not Valid";
			$this -> message['DbData'] = "<li style='color:".$this->getErrorColor()."'>Not a Group Program Barcode: Not Valid</li>";
		}
		return $this -> message;
	}

	private function getGreetingsTextArray()
	{
		return array(	"Jai Guru Dev", 
						"Life is bliss", 
						"TM in the AM & PM", 
						"Every hop is a cosmic smile", 
						"No one has the right to suffer", 
						"Welcome to group program", 
						"Glad you made it today", 
						"Thanks for coming", 
						"Have a blissful, deep program"
					);
	}
	
	private function getLogMessageArray()
	{
		return array(	"Your attendance time is recorded as", 
						"We've recorded your scan time as", 
						"The time of your scan is", 
						"This is your scan time", 
						"You're in the database at"
					);
				
	}
	
	private function is_lost_barcode($barcode)
	{
		$q = "SELECT * FROM `lostBarcodes` WHERE lostBarcode={$barcode} LIMIT 2";
		$res = mysql_query($q) or die(mysql_error());
		return (mysql_num_rows($res) > 0)?TRUE:FALSE;
	}
	
	static public function getErrorColor()
	{
		$_SESSION['error_color'] = (($_SESSION['error_color'])?FALSE:TRUE);
		return (($_SESSION['error_color'])?'#b608ef':'#ef08dc');
	}
	
	static public function getNameColor()
	{
		$_SESSION['name_color'] = (($_SESSION['name_color'])?FALSE:TRUE);
		return (($_SESSION['name_color'])?'red':'green');
	}
	
	/*
	 * Assigns a default name to the User.
	 * @param Barcode
	 */
	private function assign_default_name($barcode)
	{
		$q = "SELECT lastName FROM `user` WHERE firstName='In-Process' ORDER BY lastName DESC LIMIT 1";
		
		$res = mysql_query($q) or die(mysql_error());
		if(mysql_num_rows($res) >0)
		{
			$row = mysql_fetch_array($res);
			
			$lastName = ((integer)($row['lastName']));
			$lastName++;
		}
		else{
			$lastName = 1;
		}
		
		$q1 =  "UPDATE `user` SET `firstName` = 'In-Process', `lastName` = '$lastName' WHERE `user`.`barcode` = '.$barcode.'";
		mysql_query($q1) or die(mysql_error());
		
		$return_str = "New User";
		return $return_str;
	}
	public function getSerialNumber($barcode)
	{
		$q = "SELECT serialNumber FROM `user` WHERE barcode='{$barcode}'";	
		$res = mysql_query($q) or die(mysql_error());
		$arr = mysql_fetch_array($res);
		return $arr['serialNumber'];
	}
	
}
