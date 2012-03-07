<?php 
include ('config.php'); 
require_once("logcheckadmin.php");
include('User/user.class.php');

$obj_user 		=	new User();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


  
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking - View/Edit Users</title>
  

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" /></head><body>
<div id="wrapper">
<!--
<div id="menu">
<ul>
  <li class="current_page_item"><a href="#">Welcome</a></li>
  <li><a href="#">Portfolio</a></li>
  <li><a href="#">About</a></li>
  <li><a>Contact</a></li>
</ul>
</div>
--><!-- end #menu -->
<!-- <span style="font-style: italic;"> <br />
Note: This page has minimal design and formatting. We are waiting on a
decision about who will be responsible for designing the MUM attendance
pages<br /><span style="font-style: italic;">For an example of a page with formatting and design see</span> <a href="http://myattendance.us">http://myattendance.us/</a><br />
<br />
</span> -->
<div style="clear: both;">&nbsp;</div>
<?php $con = mysql_connect("mysql06.secureserverdot.com","wakarus_dev","expertdev");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db("wakarus_attend", $con);

$result = mysql_query("SELECT * FROM user");

echo "<table style=text-align:center border='0'>
<tr>
<th>First name</th>
<th>Middle name</th>
<th>Last name</th>
<th>User name</th>
<!--<th>Password (encrypted)</th>-->
<th>Barcode</th>
<th>Community</th>
<!--<th>Start date</th>-->
<th>Gender</th>
<th>E-Mail</th>
<th>Role</th>
<!--<th>Comments</th>-->
</tr>";

while($row = mysql_fetch_array($result))
{

$rol=$row['role'];
$res2= mysql_query("SELECT * FROM roles WHERE id='$rol'");
$row2 = mysql_fetch_array($res2);
$role=$row2['role'];
echo "<tr>";
echo "<td>" . $row['firstName'] . "</td>";
echo "<td>" . $row['midName'] . "</td>";
echo "<td>" . $row['lastName'] . "</td>";
echo "<td>" . $row['userName'] . "</td>";
/*echo "<td>" . $row['password'] . "</td>";*/
echo "<td>" . $row['barcode'] . "</td>";
echo "<td>" . $obj_user->getCommunityName($row['community']). "</td>";
/*echo "<td>" . $row['startDate'] . "</td>";*/
echo "<td>" . $row['gender'] . "</td>";
echo "<td>" . $row['subscribe'] . "</td>";
echo "<td>" . $role . "</td>";
/*echo "<td>" . $row['comments'] . "</td>";*/
echo "</tr>";
}
echo "</table>";

mysql_close($con);
?><br />
<a href="logout.php">Logout</a> or return to the <br />Administrator's <a href="admin.php">Home Page</a>
<!-- end #page -->
<div id="footer">
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
</div>

</body></html>
