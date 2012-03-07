<?php 
error_reporting(E_ALL | E_STRICT);
require_once "config.php";
require_once "login.class.php";


$message           =   "";
$log               =   new Login();

//$path		   =  $_SERVER['SERVER_NAME'] .(( isset($_GET['path']) )?urldecode( $_GET['path'] ):'/home.php');
$path		   =  (( isset($_GET['path']) )?urldecode( $_GET['path'] ):($wpath .'/myattendancerecord.php'));

$log->checkCookie($path);

if(isset($_POST['uidLogin']))
{

	$user		=	trim($_POST['user']);
	$password	=	trim($_POST['password']);
	$path1		=	trim($_POST['path']);
	if(!$_POST['user'] || !$_POST['password'])
	{
		$message	=	"Please Enter Your Username or Password";

	}
    else{ 
		if(eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",$user)){
			$message	=	($_POST['autologin']=="true")?$log->login_check($user,$password, $path1,true):$log->login_check($user,$password, $path1);
			
		}elseif(eregi('[0-9]{13}',$user)){
			$barcode	=	$user;
			$message	=	($_POST['autologin']=="true")?$log->barcode_login_check($barcode,$password, $path1,true):$log->barcode_login_check($barcode,$password, $path1);
		}
		else{
			$message="Invalid username or barcode";
		}
	}
	
	

}

	if(isset($_GET['verification']) ) 
	{
		if($_GET['verification'] == 'reg' )
		{
			$message	=	"Sucessfully registered!";

		}
		if($_GET['verification'] == 'logout' )
		{
			$message	=	"Sucessfully logged out!";

		}
		else if($_GET['verification'] == 'false' )
		{
			$message	=	"Email/Password incorrect!";

		}
	}
	(isset($_GET['msg']))?$message=urldecode($_GET['msg']):"";
?>


  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MUM.MyAttendance.us - Friction Free Attendance Tracking - Home Page</title>
  
<link href="styles.css" rel="stylesheet" type="text/css">
  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" /></head><body>
<div id="wrapper">


<div id="sidebar">

  <h2 align="left">Log-in<br />
  </h2>
  <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post">
    <table style="width: 259px; height: 157px;" border="0" cellpadding="3" cellspacing="1">
      <tbody>
        <tr>
          <td style="font-size: 13px;" align="right" width="100%">Username
          <br />
or Barcode #</td>
          <td><input name="user" size="16" maxlength="40" type="text" /></td>
        </tr>
        <tr>
          <td style="font-size: 13px;" align="right" width="100%">Password:</td>
          <td><input name="password" size="16" maxlength="32" type="password" /></td>
        </tr>
        <tr class="txtbox" align="right">
          <td colspan="2" style="font-size: 13px;" align="right">Log
me on
automatically each visit: <input name="autologin" checked="true" type="checkbox" value="true" /></td>
        </tr>
        <tr align="right">
        </tr>
        <tr>
          <td colspan="2" align="right"><input name="uidLogin" value="true" type="hidden" /> <input name="path" value="<?php echo $path; ?>" type="hidden" /><a href="forgotpass.php" class="normalLink" style="font-size: 13px;">Forgot
Password</a> | <input name="submit" value="Login" type="submit" /> </td>
        </tr>
<?php if($message != "") echo "<tr><p style=\"color: red;\" font-size: 13px;>$message<p></tr>";
		 else echo "<tr>&nbsp</tr>";
		?>
      </tbody>
    </table>
  </form>


</div>
<!-- end #sidebar -->
<div style="clear: both;">&nbsp;</div>

<div id="footer">
<br /><br /><br /><br /><br /><br />Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.<br />
</p>
</div>
<!-- end #footer -->
</div>

</body></html>
