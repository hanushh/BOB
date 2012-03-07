<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
  <meta name="keywords" content="" />

  <meta name="description" content="" />
  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MUM.MyAttendance.US - Friction Free Attendance Tracking - Change Password</title>
  
  <script type="text/javascript" src="js/jquery.js"></script>
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" /></head><body>
<div id="wrapper">
</div>
<div id="header">
<div id="page">
<?php
require_once "logcheck.php";
$uid = $_SESSION['userName'];
require_once "login.class.php";
$message           =   "";
$log               =   new Login();
$path		   =  $_SERVER['SERVER_NAME'] .(( isset($_GET['path']) )?urldecode( $_GET['path'] ):'/Tasks/task.php');

if(isset($_POST['submit']))
{

	$curpass		=	trim($_POST['curpass']);
	$newpass		=	trim($_POST['newpass']);
	$conpass		=	trim($_POST['conpass']);
	if(!$curpass || !$conpass || !$newpass)
	{
		$message	=	"Please fill the required fields";

	}
        elseif($newpass !=  $conpass ){
		$message	= "Passwords are not matching";
    	}
	else
	{

		$message	=	$log->changepass($uid,$curpass,$conpass);
	}
}
?>

<body>
<div style="clear: both; font-weight: bold;"><big>&nbsp;</big></div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the Change Password page<br />
</big>Changing your password frequently is good security. Be sure to choose a strong password:<br />One with at least 6 characters, at least one capital, and at least one number
</div>


<table align="center" width="100%" cellpadding="0" cellspacing="1">
	<TR><TD width="100%" height="400" valign="middle" align="center">
		<form action="" method="POST"  style="margin-bottom: 24px;">
		<table class="form" width="40%" cellpadding="0" cellspacing="5" style="border:1px solid #BCBCBC">
			<TR><TD colspan="2" class="pageTitle"><b><center>Change password<br /></center></b></TD></TR>
			<TR><TD class="addFieldTitle">Current Password *</TD>
			    <TD><input type="password" name="curpass" class="txtbox"></TD></TR>
			<TR><TD class="addFieldTitle">New Password *</TD>
			    <TD><input type="password" name="newpass" class="txtbox"></TD></TR>
			<TR><TD class="addFieldTitle">Confirm Password *</TD>
			    <TD><input type="password" name="conpass" class="txtbox"></TD></TR>
			<TR>
			    <TD colspan="2" align="center">
			      <input type="submit" name="submit" value="submit">
			    </TD>
			</TR>
		</table>
		</form>
	<?php if($message != ""){ ?>
	<p class="msgbox" style="color: red; border-top-width: 0px; margin-top: -91px;"><?php echo "&nbsp;".$message;?></p>
	<?php }else{ ?> <TR><TD colspan="2" >&nbsp;</TD></TR><?php } ?>
</table>
<div style="clear: both;">&nbsp;</div>		
	</TD>
	</TR>
<a href="logout.php">Logout</a>
<!-- end #page -->
<div id="footer">
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
<!-- end #footer -->
</div>






</body></html>
