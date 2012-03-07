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

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking - View/Edit Users</title>
  

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />
  <script type="text/javascript">
function confirm_delete(user,com,status)
{
if(status) stat='deactivate';
else stat='activate';
var r=confirm("Are you really want to "+stat+" this user?");
if (r==true)
  {
  var xmlhttp;
	if (window.XMLHttpRequest){
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
				alert(xmlhttp.responseText);
    			//alert("Sucessfully deleted!");
				window.location.reload();
    		}
	}
	var url="del_user.php?user="+user+"&community="+com+"&stat="+status;
	xmlhttp.open("GET",url,true);
	//alert(url);
	xmlhttp.send();
  
  }

}
</script>
  
  </head><body>
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
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the Browse/Edit page<br />
</big>In addition to browsing all users and administrators you may edit an MUM user's or administrator's profile <br />and/or attendance record and you may inactivate or reactive an MUM user or administrator.<br />
<?php 
if(isset($_GET['search'])){
	$search=$_GET['search'];
	switch($search){
	case 'all':
	$result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber ORDER BY `lastname`");
	$title="Everyone in the Database";
	break;
	case 'active':
		$result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber  WHERE `status`=1 ORDER BY `lastname`");
		$title="All Active Users";
	 break;
	 case 'inactive':
	 $result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `status`=0 ORDER BY `lastname`");
		$title="All Inactive Users";				
	 break;
	 case 'current':
	 $commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
	 $community=$obj_user->getCommunityName($commid);
	 	 $result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `communityID`='$commid' ORDER BY `lastname`");
		$title="$community Community Only";
	 break;
	default:
	echo "default";
	$result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber ORDER BY `lastname`");
	$title="Everyone in the Database";
	break;
	}
}
else{
$result = mysql_query("SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber ORDER BY `lastname`");
	$title="Everyone in the Database";
}
echo "<h2>You are currently viewing: $title</h2>";
foreach(range('A','Z') as $letter)
{
   echo "<a href='#$letter' style=\"text-decoration: none; color: blue;\"> $letter </a>";
} 
echo"
<br /><br /><table><tr>
  <td>To view subsets of the whole list, select:&nbsp;&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?search=all'>Everyone in the Database&nbsp;&nbsp;&nbsp;</a></td>
  <td><a href='$_SERVER[PHP_SELF]?search=current'>All MUM&nbsp;&nbsp;&nbsp;</a></td>
  <td><a href='$_SERVER[PHP_SELF]?search=active'>All Active&nbsp;&nbsp;&nbsp;</a></td>
  <td><a href='$_SERVER[PHP_SELF]?search=inactive'>All Inactive</a></td></tr></table>";
echo "<table style=text-align:center border='0'><br /><br />
<tr>
<th>Last name</th>
<th>First name</th>
<th>Middle name</th>
<th>User name</th>
<!--<th>Password (encrypted)</th>-->
<th>Barcode</th>
<!--<th>Start date</th>-->
<th>Gender</th>
<th>E-Mail</th>
<th>Role</th>
<th>Community</th>
<!--<th>Comments</th>-->
</tr>";
$c=1;
$commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
while($row = mysql_fetch_array($result))
{

$rol=$row['role'];
$res2= mysql_query("SELECT * FROM roles WHERE id='$rol'");
$row2 = mysql_fetch_array($res2);
$role=$row2['role'];
$l=strtoupper(substr($row['lastName'],0,1));
//if(echo "<big>$l</big>";
if($c!=$l){ 
echo "<tr><td style=\"color: blue;\"><a name=\"$l\"><b> $l </b><a></td></tr>";
}
if($row['status']) $status="Deactivate";
else $status="Activate";

if($commid!=$row['communityID']) echo "<tr class='fade'>";
else echo "<tr>";
$c=$l;
echo "<td><b>".strtoupper(substr($row['lastName'],0,1))."</b>".substr($row['lastName'],1)."</td>";
//echo "<td>" . $row['lastName'] . "</td>";
echo "<td>" . $row['firstName'] . "</td>";
echo "<td>" . $row['midName'] . "</td>";
echo "<td>" . $row['userName'] . "</td>";
/*echo "<td>" . $row['password'] . "</td>";*/
echo "<td>" . $row['barcode'] . "</td>";
/*echo "<td>" . $row['startDate'] . "</td>";*/
echo "<td>" . $row['gender'] . "</td>";
echo "<td>" . $row['subscribe'] . "</td>";
echo "<td>" . $role . "</td>";
echo "<td>" . $obj_user->getCommunityName($row['communityID']). "</td>";
//$commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
if($commid==$row['communityID']){
$edit_profile_link="<a href='editprofile.php?user=$row[userName]'>Edit Profile</a>";
$browse_edit_link="<a href='edit_atte_srch.php?user=$row[barcode]'>Browse or Edit Attendance</a>";
$act_deact_link="<a onClick='confirm_delete({$row['serialNumber']},{$row['communityID']},{$row['status']})' href='javascript:void(0);'>$status</a>";
}
else{
$edit_profile_link="Edit Profile";
$browse_edit_link="Browse or Edit Attendance";
$act_deact_link=$status;
}
echo "<td style='border: 1px dotted; padding: 10px;'>$edit_profile_link</td>";
echo "<td style='border: 1px dotted; padding: 10px;'>$browse_edit_link</td>";
echo "<td style='border: 1px dotted; padding: 10px;'>$act_deact_link</td>";
echo "</tr>";
}
echo "</div>";
echo "</table>";

mysql_close($con);
?><br /><br /><br /><br /><br />
<a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">Home Page</a>
<!-- end #page -->
<div id="footer">
<br />
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
</div>
</body></html>
