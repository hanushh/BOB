<?php
class Attendance
{
	public function insertAttendenceLoginTime($barcode)
	{
		$this->barcode = dbconnect::escape($barcode);
		
		$date = date("Y-m-d");

		$ampm = date('a', time());
		$time = date('h:i:s', time());
		$q1= "SELECT * FROM `attendanceTime` WHERE `barcode`='$barcode' AND `date`='$date'";
		$res=mysql_query($q1);
		$row=mysql_fetch_array($res);
		if($ampm == "am")
		{	
			//if($row['inAM']!='00:00:00' or $row['inAM']!= NULL)
			$INam = $time;
			$INpm = "00:00:00";
		}
		else if($ampm == "pm")
		{       //if($row['inPM'] != '00:00:00'  or $row['inPM']!= NULL) 
			$INpm = $time;
			$INam = "00:00:00";
		}

		$q = "INSERT INTO `attendanceTime`(barcode, date, inAM, inPM ) VALUES ('".$this->barcode."', '$date', '$INam', '$INpm')";
	mysql_query($q) or die(mysql_error());
	return mysql_insert_id();

	}
	public function updateAttendenceLoginTime($barcode,$date, $inAM, $inPM)
	{
		$this->barcode 	= 	dbconnect::escape($barcode);
		$this->date 	=	dbconnect::escape($date);
		$this->inAM 	=	dbconnect::escape($inAM);
		$this->inPM 	=	dbconnect::escape($inPM);

		$q = "UPDATE`attendanceTime` SET inAM='{$this->inAM}', inPM='{$this->inPM}' WHERE barcode='{$this->barcode}' AND date ='{$this->date}'";
		mysql_query($q) or die($q. mysql_error());
		return mysql_insert_id();

	}




}

?>


