<?php
error_reporting(E_ALL);

require_once "../config.php";
require_once "../login.class.php";
$log               =   new Login();
$out_array = array();

	if(isset($_POST['uidLogin']))
	{

		$user		=	trim($_POST['user']);
		if(!$_POST['user'])
		{
			$message	=	"Please scan your barcode";
			$out_array['scanData'] = $message ;
			$out_array['DbData'] = "<li style='color:".getErrorColor()."'>Please enter a barcode</li>" ;
		}
		else{ 
			
			if(eregi('[0-9]{13}',$user)){
				$barcode	=	$user;
				$message	=	$log->barcode_Scanning($barcode);
				$out_array	=	$message;
			}
			else{
				$message="Invalid username or barcode";
				$out_array['scanData'] = $message ;
				$out_array['DbData'] = "<li style='color:".getErrorColor()."'>Not a Group Program Barcode: Not Valid</li>" ;
			}
		}
		

		echo json_encode($out_array);
	}
function getErrorColor()
	{
		$_SESSION['error_color'] = (($_SESSION['error_color'])?FALSE:TRUE);
		return (($_SESSION['error_color'])?'#b608ef':'#ef08dc');
	}
?>
