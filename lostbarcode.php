<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php require_once ('config.php'); 
require_once('User/user.class.php');
require "logcheckadmin.php";
$obj_user 		=	new User();

if(isset($_POST['Submit'])){

	
	$lost_barcode	=	isset($_POST['new_barcode'])?trim($_POST['lost_barcode']):'';
	$new_barcode	=	isset($_POST['new_barcode'])?trim($_POST['new_barcode']):'';
	//validation checking
	if(!$lost_barcode || !$new_barcode){
		$errormissing=true;	
	}
	require_once('evalbarcode.php');
	if(!evalbarcode($lost_barcode)) $errorbar1=true;
	if(!evalbarcode($new_barcode)) $errorbar2=true;
	
	$rs_lostbar = mysql_query("SELECT * FROM `lostBarcodes` WHERE lostBarcode='".dbconnect::escape($new_barcode)."'");
	$lost_bar = mysql_num_rows($rs_lostbar);
	if ($lost_bar > 0) $err_lost_bar=1;
	
	$rs_duplicates1 = mysql_query("select `barcode` from user where barcode='".dbconnect::escape($lost_barcode)."'");
	$duplicates1 = mysql_num_rows($rs_duplicates1);
	
	if ($duplicates1 <= 0)
	{	
		$err_lost_not_exist=1;
	}
	$rs_duplicates = mysql_query("select `barcode` from user where `barcode`='".dbconnect::escape($new_barcode)."'");
	$duplicates = mysql_num_rows($rs_duplicates);
	
	if ($duplicates > 0)
	{
		$err_dup=1;
	} 

	if($errorbar1 || $errorbar2 || $err_lost_not_exist || $err_dup || $err_lost_bar)
	{
		if($errorbar1) $errortext="*The lost barcode you entered is invalid. <br />";
		if($errorbar2) $errortext="*The new barcode you entered is invalid!<br />";
		if($err_dup) $errortext="*The new barcode you entered is already exist. <br />";
		if($err_lost_not_exist) $errortext="*The lost barcode you entered is not found!<br />";	
		if($err_lost_bar) $errortext="Lost Barcode ! Not valid <br />";
		if (isset($errortext)) { $msg= $errortext ; } 
		else $msg="";
	}
	else
	{	
		$reg_status = $obj_user->lostbarcode($lost_barcode,$new_barcode);
		if($reg_status) $msg = "Sucessfully assigned new Barcode";
		else $msg="Barcode not changed! Some error occured";
		//echo $msg;
		//header("location: ".$wpath."/lostbarcode.php.php");
		//exit;
	}

	
}


?>
  
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>MUM.MyAttendance.US - Friction Free Attendance Tracking - Invalidate Lost Badge</title>

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />

</head><body>
<div id="wrapper">
<div id="page">
<div id="page-bgtop">
<div id="page-bgbtm">
<div id="content">
<div class="post">
<div class="entry"><big><big>Welcome <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, to the Invalidate Lost Badge page</big></big><br />
Note: required fields are marked with an <font color="red">*</font><br />
<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
  <div style=""> </div>
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="18">
    <tbody>
<?php if(isset($msg)) echo "<tr><td colspan=2 style=\"color: red;\"><p><i>$msg</i></p></td></tr>"; ?>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>Lost barcode</big></big> <input name="lost_barcode" id="lost_bacode" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter barcode from the <span style="font-weight: bold;">lost badge</span></big> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>New barcode</big></big> <input name="new_barcode" id="new_barcode" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter replacement barcode
for the <span style="font-weight: bold;">new badge</span></big><br />
        </td>
      </tr>
    </tbody>
  </table>
  <big><big> </big></big>
  <div style="text-align: center;"><big><big><input name="Submit" id="mysubmit" value="Invalidate lost barcode and Merge records" type="submit" /></big></big><br />
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