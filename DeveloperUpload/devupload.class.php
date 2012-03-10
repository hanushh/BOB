<?php

class Devupload{
	
	public function getSerialNumber($barcode)
	{
		$q = "SELECT serialNumber FROM `user` WHERE barcode='{$barcode}'";	
		$res = mysql_query($q) or die(mysql_error());
		$arr = mysql_fetch_array($res);
		return $arr['serialNumber'];
	}
}




?>