<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php 
require_once ('config.php'); 
require_once('User/user.class.php');
require "logcheckadmin.php";
$obj_user 		=	new User();
$communities 	= 	$obj_user->ListCommunities();

if(isset($_POST['Submit'])){

	$email		=	isset($_POST['uname'])?trim($_POST['uname']):'';
	$pass		=	isset($_POST['pass1'])?trim($_POST['pass1']):'';
	$pass1		=	isset($_POST['pass2'])?trim($_POST['pass2']):'';
	$barcode	=	isset($_POST['bar_code'])?trim($_POST['bar_code']):'';
	//validation checking
	if(!$email || !$pass1 || !$barcode){
		$errormissing=true;	
	}
	if(!eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",$email)) $errormail=true;
	require_once('evalbarcode.php');
	if(!evalbarcode($barcode)) $errorbar=true;
	$rs_duplicates1 = mysql_query("select userName from user where barcode='".dbconnect::escape($barcode)."'");
	$duplicates1 = mysql_num_rows($rs_duplicates1);
	$rs_lostbar = mysql_query("SELECT * FROM `lostBarcodes` WHERE lostBarcode='".dbconnect::escape($barcode)."'");
	$lost_bar = mysql_num_rows($rs_lostbar);
	if ($lost_bar > 0) $err_lost_bar=1;
	if ($duplicates1 > 0)	$errorlogin1=1;
	$rs_duplicates = mysql_query("select barcode from user where userName='".dbconnect::escape($_POST[uname])."'");
	$duplicates = mysql_num_rows($rs_duplicates);
	
	if ($duplicates > 0)
	{
		$errorlogin=1;
	} 

	if($errormissing || $errormail||$errorpass||$errorlogin||$errorbar||$errorlogin1 || $err_lost_bar)
	{
		if($erroremail) $errortext="*The e-mail you entered is invalid. <br />";
		if($errorpass) $errortext="*The passwords do not match!<br />";
		if($errorlogin) $errortext= "*Invalid username.<br />The username you entered already exists in the database.<br /> Please enter a valid username.<br />";
		if($errorlogin1) $errortext= "*Invalid barcode number. <br />The number you entered already exists in the database.<br /> Please enter a valid number.<br />";
		if($errorbar) $errortext="*The barcode you entered is invalid.<br />Please enter a 13-digit valid barcode number.<br />";	
		if($errormissing) $errortext="*Required field(s) are missing<br /> <br />";
		if($err_lost_bar) $errortext="Lost Barcode ! Not valid <br />";
		if (isset($errortext)) { $msg= $errortext ; } 
			echo'';
	}
	else
	{	
		$reg_status = $obj_user->register($barcode,$pass1,$email,$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"], $_SESSION['community_id'], $_POST["gender"],$_POST["subscribe"],$_POST["startDate"],$_POST['role']);
		$msg = "1 record Successfully added";
		//header("location: ".$wpath."/addnewuser.php");
		//exit;
	}

	
}


?>

  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MUM.MyAttendance.US - Friction Free Attendance Tracking - Add New User</title>
  

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" /></head><body>
<div id="wrapper">
<div id="page">
<div id="page-bgtop">
<div id="page-bgbtm">
<div id="content">
<div class="post">
<div class="entry">
<big><big>Welcome <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, to the Add New User page</big></big><br />Note: required fields are marked with an <font color="red">*</font><br />
<form name="form1" method="post" action="addnewuser.php" enctype="multipart/form-data">
  <div style=""> </div>
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="18">
    <tbody>
<?php if(isset($msg)) echo "<tr><td colspan=2 style=\"color: red;\"><p><i>$msg</i></p></td></tr>"; ?>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>First
name</big></big> <input name="first_name" id="first_name" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter actual <span style="font-weight: bold;">first name</span></big>
        </td>
      </tr>
	     <!--<tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Middle Name</big></big> <input name="middle_name" id="middle_name" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter actual <span style="font-weight: bold;">middle name</span> or leave blank</big>
        </td>
      </tr>-->
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>Last
name</big></big> <input name="last_name" id="last_name" type="text" /></td>
        <td style="vertical-align: top;"><big>Enter actual <span style="font-weight: bold;">last name</span></big><br />
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>User
name </big></big><input name="uname" id="uname" type="text" /></td>
        <td style="vertical-align: top;"><big><span style="font-weight: bold;">User name</span>
should ALWAYS be a valid,
working e-mail address. Exception: if a person
does not use e-mail, an alternative user name
may be entered</big> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>Password
        </big></big><input name="pass2" id="pass2" type="password" /></td>
        <td style="vertical-align: top;"><big><span style="font-weight: bold;">Password</span> is entered here. After logging in for the first time, each
person is required to change their password to one of their own choosing - one only they will know. Note: You may wish to
use <a href="/http://strongpasswordgenerator.com/">this</a> password
generator or <a href="http://www.freepasswordgenerator.com/">this</a>
one. Be sure to choose a strong password - one with at least 6 characters, at least one capital, and at least one number
        </big> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><font color="red">* </font>Barcode
        </big></big><input name="bar_code" id="bar_code" maxlength="13" type="text" /></td>
        <td style="vertical-align: top;"><big><span style="font-weight: bold;">Barcode</span> number is entered
here. Be sure to
only enter a unique barcode number with 13 digits.
Each person must have one and only one, unique
barcode number </big></td>
      </tr>
      
	  <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><input name="status" checked="checked" value="1" type="radio" /> MUM Active</big></big><br />
        <big><big> <input name="status" value="0" type="radio" /> MUM Inactive</big></big> </td>
        <td style="vertical-align: top;"><big>Select MUM Active or MUM Inactive
to
record <span style="font-weight: bold;">status</span> of new user</big>
        </td>
      </tr>
	  
	  <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><input name="gender" value="M" type="radio" /> Male</big></big><br />
        <big><big> <input name="gender" value="F" checked="checked" type="radio" /> Female</big></big> </td>
        <td style="vertical-align: top;"><big>Select Male or Female
to
record <span style="font-weight: bold;">gender</span> of new user</big>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><input name="role" value="0" checked="checked" type="radio" /> User</big></big><br />
        <big><big> <input name="role" value="1" type="radio" /> Admin</big></big> </td>
        <td style="vertical-align: top;"><big>Select
Admin or User to set the <span style="font-weight: bold;">level of access</span> granted. Users may see only their
own attendance records. Administrators may see everyone's
attendance data and may update and edit records, as well<span style="font-weight: bold;" /></big> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"> <big><big><input name="subscribe" value="Y" checked="checked" type="radio" /> E-mail -
Yes</big></big><br />
        <big><big> <input name="subscribe" value="N" type="radio" />E-mail
- No<br />
        </big></big> </td>
        <td style="vertical-align: top;"><big>The default for <span style="font-weight: bold;">daily e-mail</span> of attendance
results is 'Yes.' If
new attendee does not use e-mail or does not want to
receive e-mail, select 'No'</big>
        </td>
      </tr>
    </tbody>
  </table>
  <big><big> </big></big>
  <div style="text-align: center;"><big><big><input name="Submit" id="mysubmit" value="Add New User" type="submit" /></big></big><br />
  </div>
  <big> <br />
  </big> </form>  
 <a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">home page</a>
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
