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
<script LANGUAGE="JavaScript">
checked=false;
function checkedAll () {
	var aa= document.getElementById('frm1');
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
      }
</script>
<style type="text/css">
td
{
   border: 0.1px dotted;
    padding: 10px;
    width: auto;
} 
 </style>
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
$end_limit=$_SESSION["max_rows"];
$start_from = ($page-1) * $end_limit;

if(isset($_POST['search_term']) && $_POST['search_term'] !=""){
 $searchterm = $_POST['search_term'];
trim ($searchterm);

$search_option=$_POST['search_option'];
$sql= "SELECT * FROM user LEFT JOIN attendanceTime ON 
					user.serialNumber=attendanceTime.serialNumber WHERE `$search_option` LIKE '%".$searchterm."%' ORDER BY `date` ";

		$title="Search Results";
		$selfURL="";
}
else{
	$sql = "SELECT * FROM attendanceTime LEFT JOIN user ON 
					attendanceTime.serialNumber=user.serialNumber ORDER BY `date` ";
	$title="Attendance Table";
}


$sSql			=		$sql." LIMIT $start_from, $end_limit";
$result			=		mysql_query($sSql) or die("Error 1:Database Error");
$result1 		=		mysql_query($sql) or die("Error 2:Database Error");
$count			=		mysql_num_rows ($result);
$totalrecords   	=		mysql_num_rows ($result1);
$total_pages 		=		ceil($totalrecords/ $end_limit);




?>
<big>you are viewing <span style='color:#ff0000'><? echo $title; ?></span></big><br />There are a total of <? echo $totalrecords; ?> names in this category. This is page <? echo $page; ?>of <? echo $total_pages; ?> total page(s) <br /><small>Note: Either MUM Status or IAG Status may show as <a href=dna.php>DNA</a> , which stands for Does Not Apply</small>
<br /><br />
<a href='logout.php'>Logout</a> or return to the Administrator's <a href='admin.php'>home page</a>

</NOBR>
<br>
<?php
echo "<div style='float:right'>";
$url="http://mum.myattendance.us/delete_attendance.php";
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



<div style='float: right;  margin-top: 20px;'>
		<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method='post'>
		Search by <select name='search_option'>
						<option value='lastName'>Last name</option>
						<option value='date'>Date</option>
						<option value='barcode'>Barcode</option></select>
				<input type='text' name=search_term />
				<input type='submit' name='submit' value='Search' />
				</form></div>
<br>
<form name='form2' id ="frm1" method='post' action='delete_single_user.php'>
<input type="hidden" name="attendance" value="delete" />
<br /><br /><input type="submit" value="Delete Selected Records" >
<table style=text-align:center border='0'><br /><br />
<tr>
<th>Select all<input type='checkbox' name='checkall' onclick='checkedAll();'></th>
<th>Date</th>
<th>Last name</th>
<th>First name</th>
<th>Barcode</th>
<th>InAm</th>
<th>InPm</th>
</tr>

<?
$c=1;
$count=0;
while($row = mysql_fetch_array($result))
{
$count++;
$l=strtoupper(substr($row['lastName'],0,1));
echo "<tr>";
echo "<td><input type='checkbox' name='chk[]' value='$row[serialNumber],$row[date]' /><br /></td>";
echo "<td> " . $row['date'] . " </td>";
echo "<td><b>".strtoupper(substr($row['lastName'],0,1))."</b>".substr($row['lastName'],1)."</td>";
echo "<td> " . $row['firstName'] . " </td>";
echo "<td> " . $row['barcode'] . " </td>";
echo "<td> " . $row['inAM'] ." </td>";
echo "<td> " . $row['inPM']. " </td>";
echo "</tr>";
}
?>
</div>
</table>
<div style='float:left'>
<br /><br /><input type="submit" value="Delete Selected Records" >
</div>
</form>
<div style='float:right'>
<?php
$url="http://mum.myattendance.us/delete_attendance.php";
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
if(isset($_GET['result']) && $_GET['result']=='deleted'){
$rows=$_GET['rows'];
echo "<script>alert('$rows records deleted')</script>";
}
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
