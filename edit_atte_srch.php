<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking</title> 
 <!-- <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />-->
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<style type="text/css">
td.yellow{ background-color: #FFFF9A; text-align: center;}
td.pink{ background-color: #FFCC9A; text-align: center;}

#calender{
    left: 31%;
    position: relative;
    width: 350 px;
}
</style>

</head>
<?php
require_once ('config.php'); 
require "logcheckadmin.php";
if(isset($_GET['user'])){
   $barcode=$_GET['user'];
   }
elseif(isset($_POST['barcode'])){
$barcode=$_POST['barcode'];
}
else header("location:browseoredit.php");
$result = mysql_query("SELECT * FROM user WHERE `barcode`='$barcode'");
$row = mysql_fetch_array($result);
?>
<big><big>Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, you may view or edit the Attendance results<br />for <font color="blue"><? echo $row['firstName']." ".$row['lastName'] ?></font> by selecting the date range you are interested in. </big></big><br /><br /> <br /><br />
<script>

 $(document).ready(function() {

   loadpage('results','0000-00-00','0000-00-00',"<?php echo $barcode; ?>");

 });

</script>
<div id="calender" >

<? require_once ('calender.php'); ?>
</div>
<br/><br/>
<div id="results">
</div>
</html>
