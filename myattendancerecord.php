<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><?php error_reporting(E_ALL ^ E_NOTICE);
require_once("logcheck.php");
require_once ('config.php'); 
?>



  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>MUM.MyAttendance.US - My Attendance Record</title>
  
<style type="text/css">
td.yellow{ background-color: #FFFF9A; text-align: center;}
td.pink{ background-color: #FFCC9A; text-align: center;}
</style></head><body>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">

  <tbody>
    <!-- <tr>
      <td style="vertical-align: top;">Note: This page has minimal
design and formatting. We are waiting on a decision about who will be
responsible for designing the MUM attendance pages<br>

For an example of a designed and
formatted page see <a href="http://myattendance.us/">http://myattendance.us/</a><br>
      <br>
      </td>
    </tr> -->
<tr align="left"><th><big>Welcome <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font></big></th></tr>
			
<tr align="left"><td><a href="logout.php">Logout</a></td></tr>
<tr align="center"><th>December</th></tr>
</tbody>
</table>
<table id="atten" align="center" border="0" width="40%">
  <tbody><tr>
    <th><br>
</th>
    <th><br>
</th>
    <th>Time In</th>
    <th>Result</th>
  </tr>
<?php $barcode=$_SESSION['barcode'];
$sql="SELECT * FROM attendanceTime WHERE `barcode`='$barcode'";
$res=mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)):
?>
  <tr>
<?php if($i%2==0)
echo "<td rowspan=\"2\" style=\"background-color: rgb(255, 203, 1); height: 75px; text-align:center;\">$row[date]</td>";
else
echo "<td rowspan=\"2\" style=\"background-color: #FF9801; height: 75px; text-align:center;\">$row[date]</td>";
?>
    <td class="yellow">AM</td>
    <td class="yellow"><? echo $row['inAM']; ?> <br>
</td>
    <td class="yellow"><b style="color: rgb(0, 128, 0);">P </b></td>
  </tr>
  <tr>
    <td class="pink">PM</td>
    <td class="pink"><? echo $row['inPM']; ?><br>
</td>
    <td class="pink"><b style="color: rgb(0, 128, 0);">P </b></td>
  </tr>
<?php $i++;
endwhile; 
?>
</tbody></table>

<table>
<tbody>
    <tr>
      <td style="vertical-align: top; text-align: center;">
	  <br> <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
<br>
	  Copyright
(c) 2011 Wakarusa
river, A Fairfield, IA Company. All rights reserved.<br>
      </td>
    </tr>
  </tbody>
</table>

<br>

<br>


</body></html>
