<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php require_once ('config.php'); 
require_once('User/user.class.php');
require "logcheckadmin.php";
$obj_user 		=	new User();

if(isset($_POST['Submit'])){

	$barcode	=	isset($_POST['barcode'])?trim($_POST['barcode']):'';
	//validation checking
	if(!$barcode){
		$errormissing=true;	
	}
	require_once('evalbarcode.php');
	if(!evalbarcode($barcode)) $errorbar1=true;
	
	$rs_barcode = mysql_query("SELECT * FROM `user` WHERE `barcode`='".dbconnect::escape($barcode)."'");
	$bar_dup = mysql_num_rows($rs_barcode);
	if ($bar_dup <= 0) $err_bar=1;
	else{
	$row = mysql_fetch_array($rs_barcode);
	
	$serial=$row["serialNumber"];
	$rs_barcode1 = mysql_query("SELECT * FROM `userCommunity` WHERE `serialNumber`='".dbconnect::escape($serial)."'");
	$row = mysql_fetch_array($rs_barcode1);
	
	if ($row["mum_stat"] > 0) $err_bar2=2;
	}
	
	$rs_lostbar = mysql_query("SELECT * FROM `lostBarcodes` WHERE lostBarcode='".dbconnect::escape($barcode)."'");
	$lost_bar = mysql_num_rows($rs_lostbar);
	if ($lost_bar > 0) $err_lost_bar=1;
	
	if($errormissing || $errorbar1 || $err_bar || $err_lost_bar ||$err_bar2 )
	{
		if($errorbar1) $errortext="*The barcode you entered is invalid. <br />";
		if($err_bar) $errortext="*The barcode you entered does not exist in the database. <br />";
		if($err_bar2) $errortext="*The barcode you entered is already active in the Mum community. <br />";
		if($err_lost_bar) $errortext="Lost Barcode ! Not valid <br />";
		if($errormissing) $errortext="*Required field is missing<br />";
	
		if (isset($errortext)) { $msg= $errortext ; } 
		else $msg="";
	}
	else
	{	
		$act_status = $obj_user->reactivate($barcode);
		if($act_status) $msg = "Sucessfully reactivated the User";
		else $msg="Barcode not activated! An error occured";

	}

	
}


?>
  
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>MUM.MyAttendance.US - Friction Free Attendance Tracking - Reactivate MUM User</title>

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />

</head><body>
<div id="wrapper">
<div id="page">
<div id="page-bgtop">
<div id="page-bgbtm">
<div id="content">
<div class="post">
<div class="entry"><big><big>Welcome <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, to the Reactivation page</big></big><br /><br />
<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
  <div style=""> </div>
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="18">
    <tbody>
<?php if(isset($msg)) echo "<tr><td colspan=2 style=\"color: red;\"><p><i>$msg</i></p></td></tr>"; ?>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Barcode to Reactivate: </big></big> 
		<input name="barcode" id="bacode" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter barcode of a formerly Inactive MUM user, who is approved for <span style="font-weight: bold;">reactivation</span> of their attendance tracking in group program</big></td>
      </tr>

    </tbody>
  </table>
  <big><big> </big></big>
  <div style="text-align: center;"><big><big>
  <input name="Submit" id="mysubmit" value="Reactivate User" type="submit" /></big></big><br />
  </div>
  <big> <br />
  </big> </form>
<a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">Home Page</a>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end #content -->
<div style="clear: both;">&nbsp;</div>
<!-- end #page -->
<div id="footer">
<p>Copyright (c) 2011 wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
<!-- end #footer -->
</div>

</body></html>
