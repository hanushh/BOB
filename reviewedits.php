<?php 
require_once('config.php'); 
require_once("logcheckadmin.php");
$_SESSION['LAST_ACTIVITY'] = time();
require_once('User/user.class.php');

$obj_user 		=	new User();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


  
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking - Review Edits</title>

  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />
  
  </head><body>
<div id="wrapper">

<div style="clear: both;">&nbsp;</div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the Review Edits page<br />
</big><big>All edits made to the database of users and administrators are shown here. The list is sorted by date - most recent edits first. Every edited record includes a comment explaining why the edit was made and the name of the administrator who made the change:</big><br />
<br /><br />
<?php 

if(isset($_GET['sort'])){
$sort=$_GET["sort"];
switch($sort){
case 'date':
	$sql= "SELECT * FROM review LEFT JOIN user ON 
					review.serialNumber=user.serialNumber ORDER BY date";
	break;
case 'lastname':
	$sql= "SELECT * FROM review LEFT JOIN user ON 
					review.serialNumber=user.serialNumber ORDER BY lastName";
	break;

case 'editor':
	$sql= "SELECT * FROM review LEFT JOIN user ON 
					review.serialNumber=user.serialNumber ORDER BY editor";
	break;
default:
	$sql= "SELECT * FROM review LEFT JOIN user ON 
					review.serialNumber=user.serialNumber ORDER BY date";
}
}
else{
$sql= "SELECT * FROM review LEFT JOIN user ON 
					review.serialNumber=user.serialNumber ORDER BY date";
}
$result = mysql_query($sql);
echo "<table style=text-align:center border='0'>
<tr>
<th><a href=$_SERVER[PHP_SELF]?sort=date>Date and Time of Edit</a></th>
<th><a href=$_SERVER[PHP_SELF]?sort=lastname >Last name</a></th>
<th>First name</th>
<th>Comments</th>
<th><a href=$_SERVER[PHP_SELF]?sort=editor>Editor</a></th>
</tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['date'] . "</td>";
echo "<td>" . $row['lastName'] . "</td>";
echo "<td>" . $row['firstName'] . "</td>";
echo "<td>" . $row['comments'] . "</td>";
echo "<td>" . $row['editor'] . "</td>";

}
echo "</table>";

mysql_close($con);
?><br /><br /><br /><br /><br />
<a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">home page</a>
<!-- end #page -->
<div id="footer">
<br />
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
</div>

</body></html>
