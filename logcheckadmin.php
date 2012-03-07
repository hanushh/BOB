<?php
ob_start();
require_once "config.php";
if ( !isset($_SESSION['userName']) || isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600000)  ) {

	
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
    header('location:'.$wpath.'/index.php?path='.urlencode( $_SERVER['REQUEST_URI'] ) );
    exit;

}
if ($_SESSION['role'] != 1)
{ 
	//die("Unauthorized Entry!");
	//echo "role=".$_SESSION['role'];
	//echo "last=".(time() - $_SESSION['LAST_ACTIVITY']);
	//echo "uname=".$_SESSION['userName'];
	header("locaton:index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
