<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking</title> 
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
td.yellow{ background-color: #FFFF9A; text-align: center;}
td.pink{ background-color: #FFCC9A; text-align: center;}
div#box1  {
    background-color: #FFCC9A;
    color: green;
    height: 75px;
    margin-left: 298px;
    padding-top: 45px;
    text-align: center;
    width: 439px;
    border: 1px solid;
    margin-top: 13px;
-moz-border-radius: 15px;
}
</style>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<?php
require_once ('config.php'); 
require_once('User/user.class.php');
require_once('User/attendance.class.php');
require "logcheckadmin.php";
$obj_user 		=	new User();
$obj_attendance =	new Attendance();
//background script starts
if(isset($_POST['Submit'])){
$j=$_POST['i'];
for($k=$j-1;$k>=0;$k--){
	$obj_attendance->updateAttendenceLoginTime(trim($_POST['barcode']), trim($_POST["date$k"]), trim($_POST["inAM$k"]), trim($_POST["inPM$k"]));
header("location:edit_atte_srch.php?user=$_POST[barcode]");
	//echo trim($_POST['barcode'])." ".trim($_POST["date$k"])." ". trim($_POST["inAM$k"])." ". trim($_POST["inPM$k"])."<br>" ;
}
}

//background script ends
if(isset($_GET['user'])){
   $barcode=$_GET['user'];
   }
elseif(isset($_POST['barcode'])){
$barcode=$_POST['barcode'];
}
else header("location:editpage.php");
?>
<body>
<div id="wrapper">
<?php
$result = mysql_query("SELECT * FROM attendanceTime WHERE `barcode`='$barcode'");
$row = mysql_fetch_array($result);
?>
<!--
<big><big>Dear <? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?>, you may edit the Attendance details for <? echo $row['firstName']." ".$row['lastName'] ?> using the following form. </big></big><br /><br /><br />
-->

<?php
if(isset($_GET['date1']) && $_GET['date2']){
$date1=$_GET['date1'];
$date2=$_GET['date2'];
	if($date1=="0000-00-00" || $date2=="0000-00-00"){
		
		$sql="SELECT * FROM attendanceTime WHERE `barcode`='$barcode'";
	}else{
		
		$sql="SELECT * FROM attendanceTime WHERE `barcode`='$barcode' AND `date` >= '$date1' AND `date` <= '$date2'";
	}
}
else{
$sql="SELECT * FROM attendanceTime WHERE `barcode`='$barcode'";

}
$res=mysql_query($sql);
if(mysql_num_rows($res)<=0){
echo "<big><big><center>No data available</center></big>";
}
else{
?>
<form name="form1" method="post" action="editattendance.php" >
<table id="atten" align="center" border="0" width="40%">
  <tbody>
<tr>
</tr>
<tr>
    <th><br>
</th>
    <th><br>
</th>
    <th>Time In</th>
    <th>Result</th>
  </tr>
<?
	$i=0;
	while($row = mysql_fetch_array($res)):
?>
  <tr>
<?php if($i%2==0)
echo "<td rowspan=\"2\" style=\"background-color: rgb(255, 203, 1); height: 75px; text-align:center;\">$row[date]</td>";
else
echo "<td rowspan=\"2\" style=\"background-color: #FF9801; height: 75px; text-align:center;\">$row[date]</td>";
?>
<?
$date="date$i"; 
$inAM="inAM$i";
$inPM="inPM$i";
?>
    <td class="yellow">AM<input type="hidden" name="<? echo $date; ?>" value="<?php echo $row[date];?>" /></td>
    <td class="yellow"><input name="<? echo $inAM; ?>" id='inAM' type='text' value="<? echo $row['inAM'] ?>" /><br>
</td>
    <td class="yellow"><b style="color: rgb(0, 128, 0);">P </b></td>
  </tr>
  <tr>
    <td class="pink">PM</td>
    <td class="pink"><input name="<? echo $inPM; ?>" id='inPM' type='text' value="<? echo $row['inPM'] ?>" /><br>
</td>
    <td class="pink"><b style="color: rgb(0, 128, 0);">P </b></td>
  </tr>
<?php $i++;
endwhile; 
?>
</tbody></table>
<input type="hidden" name="barcode" value="<?php echo $barcode;?>" />
<input type="hidden" name="i" value="<?php echo $i; ?>" />
  <div style="text-align: center;"><big><big><input name="Submit" id="mysubmit" value="Update" type="submit" /></big></big><br />
</form>
<?php } ?>
<p><br />
</p>
<p><br />
</p>
<p><br />
</p>
<p><br />
</p>
<p><br />
</p>
<p>Copyright (c) 2011 Wakarusa River, a Fairfield, IA Company. All
rights reserved.<br />
</p>
</div>
</body>
</html>
