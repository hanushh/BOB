<?php
require_once ('config.php'); 
require "logcheckadmin.php";

if(!isset($_REQUEST['chk'])){
header("location:delete_users.php");
}
$users=$_REQUEST['chk'];
$i=0;
if(isset($_POST['attendance']) && $_POST['attendance']=="delete"){
foreach($users as $serial){
$values=explode(",",$serial);
$result = mysql_query("DELETE  FROM `attendanceTime` WHERE `serialNumber`='$values[0]' AND `date`='$values[1]'") or die(mysql_error());
$i++;
}
header("location:delete_attendance.php?result=deleted&rows=$i");
exit();
}else{
foreach($users as $serial){
$result = mysql_query("DELETE  FROM `attendanceTime` WHERE `serialNumber`='$serial'") or die(mysql_error());
$result = mysql_query("DELETE  FROM `review` WHERE `serialNumber`='$serial'") or die(mysql_error());
$result = mysql_query("DELETE  FROM `userCommunity` WHERE `serialNumber`='$serial'") or die(mysql_error());
$result = mysql_query("DELETE  FROM user WHERE `serialNumber`='$serial'") or die(mysql_error());
$i++;

}
header("location:delete_users.php?result=deleted&rows=$i");
exit();
}
?> 
