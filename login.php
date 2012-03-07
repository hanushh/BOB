<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once "config.php";
require_once "login.class.php";
echo'<link href="styles.css" rel="stylesheet" type="text/css">';

$message           =   "";
$log               =   new Login();

//$path		   =  $_SERVER['SERVER_NAME'] .(( isset($_GET['path']) )?urldecode( $_GET['path'] ):'/home.php');
//$path		   =  (( isset($_GET['path']) )?urldecode( $_GET['path'] ):($wpath .'/home.php'));
$path="home.php";
echo "path $path";
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
			$message	=	$log->login_check($user,$password, $path1);
			
		}else{
			$barcode	=	$user;
			$message	=	$log->barcode_login_check($barcode,$password ,$path1);
		}
		/*else{
			$message="Invalid username or barcode";
		}*/
	}
	
	

}

	if(isset($_GET['verification']) ) 
	{
		if($_GET['verification'] == 'reg' )
		{
			$message	=	"Sucessfully registered!";

		}
		if($_GET['verification'] == 'true' )
		{
			$message	=	"Sucessfully logged out!";

		}
		else if($_GET['verification'] == 'false' )
		{
			$message	=	"Email/Password incorrect!";//$obj_translation->getTranslation(296);

		}
	}
	(isset($_GET['msg']))?$message=urldecode($_GET['msg']):"";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<TITLE>Login</TITLE>
  <link rel="stylesheet" type="text/css" href="css/validation.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>
<table align="center" width="80%" cellpadding="0" cellspacing="1">
	<TR><TD width="100%" class="head"><h1  style="color:#804000 ; padding-left:314px">Administration Panel</h1></TD></TR>
	<TR><TD width="83%" height="320" valign="middle" align="center">
		<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
		<table class="form" width="30%" cellpadding="0" cellspacing="5" style="border:1px solid #BCBCBC">
			<TR><TD class="pageTitle"><h2 style="color:#551500">Login</h2></TD></TR>
			<TR><TD class="addFieldTitle">Username <br>or Barcode #</TD><TD><input class="required email" type="text" name="user" class="txtbox"></TD></TR>
			<TR><TD class="addFieldTitle">Password</TD><TD><input class="required"type="password" name="password" class="txtbox"></TD></TR>
			<TR><TD colspan="2" align="center"><input type="hidden" name="uidLogin" value="true" /><?php echo "<input type=\"hidden\" name=\"path\" value=$path />" ?> <a href="newreg.php" class="normalLink">Register</a> | <a href="forgotpass.php" class="normalLink">Forgot Password</a> | <input type="submit" name="submit" value="Login">  </TD></TR>
		</table></form>		
		
	</TD>
	</TR>
	</table>
	<table style="width: 323px; margin-left: 505px; margin-top: -55px;">
	<?php if($message != ""){ ?>
	<TR><TD colspan="2" height="22px" width="350px"  class="msgbox"><p style="color:red"><?php echo "&nbsp;".$message;?><p></TD></TR>
	<?php }else{ ?> <TR><TD colspan="2" >&nbsp;</TD></TR><?php } ?>
</table>
</body>
</html>
