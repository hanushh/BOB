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
			$out_array['DbData'] = "" ;
			$out_array['debug']	=	"not post user";	
		}
		else{ 
			
			if(eregi('[0-9]{13}',$user)){
				$barcode	=	$user;
				$message	=	$log->barcode_Scanning($barcode);
				$out_array	=	$message;
				$out_array['debug']	=	"inside eregi";	
			}
			else{
				$message="Invalid username or barcode";
				$out_array['scanData'] = $message ;
				$out_array['DbData'] = "" ;
				$out_array['debug']	=	"inside eregi";	
			}
		}
		

		echo json_encode($out_array);
	}

?>
