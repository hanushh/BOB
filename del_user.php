<?php
require_once ('config.php'); 
require "logcheckadmin.php";
if(isset($_GET['user'])){
  // $barcode=$_GET['user'];
  $serial=$_GET['user'];
  $status=$_GET['stat'];
  $community='mum_stat';
   }
else die("Error:username required");
//$result = mysql_query("DELETE FROM user WHERE `barcode`='$barcode'") or die(mysql_error());
//$result2 = mysql_query("DELETE FROM attendanceTime WHERE `barcode`='$barcode'") or die(mysql_error());
//$result3 = mysql_query("DELETE FROM `review` WHERE `barcode`='$barcode'") or die(mysql_error());
if($status){
$result=mysql_query("UPDATE `userCommunity`
SET `$community`='0' WHERE serialNumber='$serial' ");
if($result) echo "Sucessfully deactivated!";
else echo "Some error occured ! try again.";
}
else{
$result=mysql_query("UPDATE `userCommunity`
SET `$community`='1' WHERE serialNumber='$serial' ");
if($result) echo "Sucessfully activated!";
else echo "Some error occured ! try again.";
}

?>
