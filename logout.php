<?php
class Logout
{
	function __construct()
	{
                include "config.php";
		session_start();
                ob_start();

		session_unset('userName');
		session_unset('barcode');
		session_unset('firstName');
		session_unset('lastName');
		session_unset('gender');
                session_destroy();
				$expire=time()-60*60*24*30;
				setcookie("Barcode","", $expire);
				setcookie("Password","", $expire);
		header("location:index.php?verification=logout");
		exit;
	}
}
$obj	=	new Logout();
?>
