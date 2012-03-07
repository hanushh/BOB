<?php
class dbconnect
{
	private $host;
	private $user;
	private $pwd;
	private $dbname;
	function __construct()
	{
	$host	=	"mysql06.secureserverdot.com";
	$user	=	"wakarus_dev";
	$pwd	=	"expertdev";
	$dbname	=	"wakarus_attend";
		session_start();
	}

        /*
        * Function to escape dangerous characters
        */
        public function escape($string){
		if(get_magic_quotes_gpc()){
			$string = htmlentities($string);
		}else{
			$string = mysql_real_escape_string($string);
			$string = htmlentities($string);
		}
		return $string;
	}
	public function connect($host,$user,$pwd,$dbname)
	{
		$this->host	=	$host;
		$this->user	=	$user;
		$this->pwd	=	$pwd;
		$this->dbname	=	$dbname;
		try
		{
			if(!mysql_connect($this->host,$this->user,$this->pwd))
			{
				throw new Exception("Not Connected...");
			}
			else
			{
				mysql_select_db($this->dbname);
			}
		}
		catch(Exception $e)
		{
			echo "File:  ".$e->getFile()."<BR>Line Number:  ".$e->getLine()."<BR>Error:  ".$e->getMessage();
		}
	}

}


	//connect database
	$obj	=	new dbconnect();
	$host	=	"mysql06.secureserverdot.com";
	$user	=	"wakarus_dev";
	$pwd	=	"expertdev";
	$dbname	=	"wakarus_attend";

	$obj->connect($host,$user,$pwd,$dbname);

	$wpath = "http://mum.myattendance.us";
	$apath = "/public_html";


?>
