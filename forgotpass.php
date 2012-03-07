<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
  <meta name="keywords" content="" />

  <meta name="description" content="" />
  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MUM.MyAttendance.US - Friction Free Attendance Tracking</title>
  
  <script type="text/javascript" src="js/jquery.js"></script>
  
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
<div id="header">
<!--<div id="logo">
<h1><a href="#">Friction<span>Free!</span></a></h1>
<p>fast, easy IAA attendance <a href="#">by laser scanner<br />
</a></p>
</div>
</div>
<!-- end #header -->
<div id="page">
<!-- Forgot.php-->
<?php


error_reporting(E_ALL ^ E_NOTICE);
require_once "config.php";
require_once "login.class.php";
echo'<link href="styles.css" rel="stylesheet" type="text/css">';

$message           =   "";
$log               =   new Login();
$path		   =  $_SERVER['SERVER_NAME'] .(( isset($_GET['path']) )?urldecode( $_GET['path'] ):'/Tasks/task.php');

if(isset($_POST['submit']))
{

	$uid		=	trim($_POST['uid']);
	if(!$_POST['uid'] )
	{
		$message	=	"Please Enter Your Username";

	}
        else
	{

		$message	=	$log->forgotpass($uid);
	}
}
?>

<body>
<table align="center" width="80%" cellpadding="0" cellspacing="1">
	<TR><TD width="83%" height="400" valign="middle" align="center">
		<form action="" method="POST"  style="margin-bottom: 174px;">
		<table class="form" width="30%" cellpadding="0" cellspacing="5" style="border:1px solid #BCBCBC">
			<TR><TD colspan="2" class="pageTitle">Forgot password</TD></TR>
			<TR><TD class="addFieldTitle">User Name</TD>
			    <TD><input type="text" name="uid" class="txtbox"></TD></TR>
		
			<TR>
			    <TD colspan="2" align="center">
			      <input type="submit" name="submit" value="submit">
			    </TD>
			</TR>
		</table>
		</form>
	<?php if($message != ""){ ?>
	<p class="msgbox" style="color: red; border-top-width: 0px; margin-top: -151px;"><?php echo "&nbsp;".$message;?></p>
	<?php }else{ ?> <TR><TD colspan="2" >&nbsp;</TD></TR><?php } ?>
</table>
<div style="clear: both;">&nbsp;</div>		
	</TD>
	</TR>

<!-- end #page -->
<div id="footer">
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
<!-- end #footer -->
</div>






</body></html>