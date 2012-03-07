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
function confirm_delete(user,status)
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
	var url="del_user.php?user="+user+"&stat="+status;
	xmlhttp.open("GET",url,true);
	//alert(url);
	xmlhttp.send();
  
  }

}
</script>
  
  </head><body>
<div id="wrapper">
<div style="clear: both;"></div>
<NOBR>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>,</big>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
if(isset($_REQUEST["max_rows"])){
$max_rows=$_REQUEST["max_rows"];
$_SESSION["max_rows"]=$max_rows;
}
//else 
$end_limit=$_SESSION["max_rows"];
$start_from = ($page-1) * $end_limit;

// $commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
$commid=1;
$community=$obj_user->getCommunityName($commid);
if($commid==1) $com2=2;
elseif($$commid==2) $com2=1;
$community2=$obj_user->getCommunityName($com2);
 $com_stat='mum_stat';
 $com2_stat='iag_stat';
 $inMum="mumCommunity";
 $inIag="iagCommunity";
 //search by keyword
 
 if(isset($_POST['search_term'])){
 $searchterm = $_POST['search_term'];
trim ($searchterm);
//if (!get_magic_quotes_gpc())
//{
//$searchterm = addslashes($searchterm);
//}
$search_option=$_POST[search_option];
$sql= "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `$search_option` LIKE '%".$searchterm."%' ORDER BY `lastname` ";
		$title="Search Results";
		$selfURL="";
}
 //end
elseif(isset($_GET['search'])){
	$search=$_GET['search'];
	switch($search){
	case 'all':
	$sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber ORDER BY `lastname` ";
	$title="Everyone in the Database";
	$selfURL="?search=all";
	break;
	case 'active':
		$sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber  WHERE `$com_stat`=1 OR `$com2_stat`=1 ORDER BY `lastname`";
		$title="All Active Users";
		$selfURL="?search=active";
	 break;
	 case 'inactive':
	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `$com_stat`=0 OR `$com2_stat`=0 ORDER BY `lastname`";
		$title="All Inactive  Users";
		$selfURL="?search=inactive";		
	 break;
	 case 'current':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `$inMum`='1' ORDER BY `lastname`";
		$title="All Active and Inactive $community";
		$selfURL="?search=current";
	 break;
	 case 'curr_active':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `mum_stat`='1' AND `$inMum`='1' ORDER BY `lastname`";
		$title="All Active $community";
		$selfURL="?search=curr_active";
	 break;
	 	 case 'curr_inactive':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `mum_stat`='0' AND `$inMum` ='1' ORDER BY `lastname`";
		$title="All Inactive $community ";
		$selfURL="?search=curr_inactive";
	 break;
	 //
	 case 'other':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `$inIag`='1' ORDER BY `lastname`";
		$title="All Active and Inactive $community2";
		$selfURL="?search=other";
	 break;
	 case 'other_active':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `iag_stat`='1' AND `$inIag`='1' ORDER BY `lastname`";
		$title="All Active $community2";
		$selfURL="?search=other_active";
	 break;
	 	 case 'other_inactive':
	 	 $sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `iag_stat`='0' AND `$inIag`='1' ORDER BY `lastname`";
		$title="All Inactive $community2 ";
		$selfURL="?search=other_inactive";
	 break;
	 //
	default:
	echo "default";
	$sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `mum_stat`='1' AND `$inMum`='1' ORDER BY `lastname`";
		$title="All Active $community";
		$selfURL="?search=curr_active";
		
	break;
	}
}
else{
$sql = "SELECT * FROM user LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber WHERE `mum_stat`='1' AND `$inMum`='1' ORDER BY `lastname`";

		$title="All Active $community";
		$selfURL="";
		
}
$sSql			=		$sql." LIMIT $start_from, $end_limit";
$result			=		mysql_query($sSql) or die("Error 1:Database Error");
$result1 		=		mysql_query($sql) or die("Error 2:Database Error");
$count			=		mysql_num_rows ($result);
$totalrecords   	=		mysql_num_rows ($result1);
$total_pages 		=		ceil($totalrecords/ $end_limit);





echo "<big>you are viewing <span style='color:#ff0000'> $title</span></big><br />There are a total of $totalrecords names in this category. This is page $page of $total_pages total page(s) <br /><small>Note: Either MUM Status or IAG Status may shown as<a href=dna.php> DNA </a>, which stands for Does Not Apply</small>
<br /><br />
<a href='logout.php'>Logout</a> or return to the Administrator's <a href='admin.php'>home page</a>

</NOBR>
<table>
<td>&nbsp;</td>
<tr>
<th>To change view select from the following:</th>
</tr>
<tr>
<td><a href='$_SERVER[PHP_SELF]?search=curr_active'>$community Active</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=curr_inactive'>$community Inactive&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=current'>All $community&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=other_active'>$community2 Active&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=other_inactive'>$community2 Inactive&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=other'>All $community2&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=active'>All Active&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=inactive'>All Inactive&nbsp;&nbsp;&nbsp;</a> &nbsp
<a href='$_SERVER[PHP_SELF]?search=all'>Everyone in the Database</a></td></tr></table><br />";


echo "<br />";
$query=$sql;
$res=mysql_query($query) or die("Error 1:Database Error");

while($ro=mysql_fetch_assoc($res)){

$product[]=$ro;
}
$new_page=1;
for($i=0;$i<count($product);$i++){

    $string=   strtoupper(substr($product[$i]['lastName'],0,1));
    $alphabet[$string]='page='.$new_page.'#'.$string;
    if($i%$end_limit==0 and $i!=0){
            $new_page++;            
    }
   

}
$alphabet=array_unique($alphabet);
foreach(range('A','Z') as $letter)
{
   if(isset($_REQUEST['search'])) $search=$_REQUEST['search'];
   else $_REQUEST['search']= "";
  $string_url= $_SERVER['PHP_SELF'].'?search='.$search."&".$alphabet[$letter];
   echo "<a href='{$string_url}' style=\"text-decoration: none; color: blue;\"> $letter </a>";
}





echo "<br>";
echo "<div style='float:right'>";
$url="http://mum.myattendance.us/browseoredit.php";
if(!isset($_GET["search"])) $url.=$selfURL."?page=";
else $url.=$selfURL."&page=";
echo "<br />";
echo "Page ";
if($page>1){
$prev=$page-1;
echo "<a href='".$url.$prev."'>"."<- prev "."</a> ";
}
for ($i=1; $i<=$total_pages; $i++) { 
			if($page==$i) echo "<a href='".$url.$i."' style='color:red'>". $i ."</a> ";
            else echo "<a href='".$url.$i."'>". $i ."</a> "; 
}
if($page<$total_pages){
$next=$page+1;
echo "<a href='".$url.$next."'>". " next-> " ."</a> ";
} 

echo "</div><br/><br />";




$max=$_SESSION["max_rows"];
$options =array(15, 25,50,100,200);
$selected ="";
?>
<div style='float:left; margin-top: 20px;'>
	<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method='post'>
	  Set number of names per page
		<select name='max_rows'>
<?php
		foreach($options as $option){
		if($option==$max) $selected="selected='selected'";
		else $selected="";
		echo "<option value=$option $selected>$option</option>";
	}
?>
		</select>
	  <input type='submit' name='submitrow' value='save' />
	  </form>
</div>

<?php

echo "<div style='float: right;  margin-top: 20px;'>
		<form action='$_SERVER[PHP_SELF]' method='post'>
		Search by <select name='search_option'>
						<option value='lastName'>Last name</option>
						<option value='userName'>User name</option>
						<option value='barcode'>Barcode</option></select>
				<input type='text' name=search_term />
				<input type='submit' name='submit' value='Search' />
				</form></div>
		";
echo "<br>";

echo "<table style=text-align:center border='0'><br /><br />
<tr>
<th>Last name</th>
<th>First name</th>
<th>User name</th>
<!--<th>Password (encrypted)</th>-->
<th>Barcode</th>
<!--<th>Start date</th>-->
<th>Gender</th>
<th>E-Mail</th>
<th>Role</th>
<th>MUM Community</th>
<th>MUM Status</th>
<th>IAG Community</th>
<th>IAG Status</th>
<!--<th>Comments</th>-->
</tr>";
$c=1;
//$commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
$commid=1;
$count=0;
while($row = mysql_fetch_array($result))
{
$count++;

$rol=$row['role'];
$res2= mysql_query("SELECT * FROM roles WHERE id='$rol'");
$row2 = mysql_fetch_array($res2);
$role=$row2['role'];
$l=strtoupper(substr($row['lastName'],0,1));
//if(echo "<big>$l</big>";
if($c!=$l){ 
echo "<tr><td style=\"color: blue;\"><a name=\"$l\"><b> $l </b><a></td></tr>";
}

if($row[$com_stat]) $status="Deactivate";
else $status="Activate";
if($row['mum_stat']) $stat_mum="Active";
else $stat_mum="Inactive";
if($row['iag_stat']) $stat_iag="Active";
else $stat_iag="Inactive";

if($row['mumCommunity']) $mumCom="Yes";
else{
 $mumCom="No";
 $stat_mum="DNA";
 }
if($row['iagCommunity']) $iagCom="Yes";
else{ 
$iagCom="No";
$stat_iag="DNA";
}

$act_deact_link="<a onClick='confirm_delete({$row['serialNumber']},{$row[$com_stat]})' href='javascript:void(0);'>$status</a>";

if($row['mum_stat'] ==0 AND $row['iag_stat']!=0) echo "<tr class='fade'>";
else echo "<tr>";
$c=$l;
echo "<td><b>".strtoupper(substr($row['lastName'],0,1))."</b>".substr($row['lastName'],1)."</td>";
echo "<td> " . $row['firstName'] . " </td>";
echo "<td> " . $row['userName'] . " </td>";
echo "<td> " . $row['barcode'] . " </td>";
echo "<td> " . $row['gender'] . " </td>";
echo "<td> " . $row['subscribe'] . " </td>";
echo "<td> " . $role . " </td>";
echo "<td> " . $mumCom ." </td>";
echo "<td> " . $stat_mum. " </td>";
echo "<td> " . $iagCom ." </td>";
echo "<td> " . $stat_iag. " </td>";
//$commid=$obj_user->getCommunityid($_SESSION['serialNumber']);
if($row['mum_stat']==1 OR $row["iag_stat"]!=1){
$edit_profile_link="<a href='editprofile.php?serial=$row[serialNumber]'>Edit Profile</a>";
$browse_edit_link="<a href='edit_atte_srch.php?user=$row[barcode]'>Browse or Edit Attendance</a>";
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
echo "<div style='float:right'>";
$url="http://mum.myattendance.us/browseoredit.php";
if(!isset($_GET["search"])) $url.=$selfURL."?page=";
else $url.=$selfURL."&page=";
echo "<br>";
echo "Page ";
if($page>1){
$prev=$page-1;
echo "<a href='".$url.$prev."'>"."<- prev "."</a> ";
}
for ($i=1; $i<=$total_pages; $i++) { 
			if($page==$i) echo "<a href='".$url.$i."' style='color:red'>". $i ."</a> ";
            else echo "<a href='".$url.$i."'>". $i ."</a> "; 
}
if($page<$total_pages){
$next=$page+1;
echo "<a href='".$url.$next."'>". " next-> " ."</a> ";
} 

echo "</div>";
			
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
