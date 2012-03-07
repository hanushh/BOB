<?php
error_reporting(E_ALL ^ E_NOTICE);
class Login
{
	function __construct()
	{
		require_once "config.php";
	}


        /*
        * Check user login
        * param: username, password,path
        */
	function login_check($user,$password, $path1,$cookie=false)
	{
		$this->user		=	dbconnect::escape($user);
	//	$this->password		=	dbconnect::escape($password);
		$this->password		=	md5(dbconnect::escape($password));
		$this->path1		=	$path1;
		
		$this->query		=	"SELECT * FROM user WHERE userName='".$this->user."'AND password='".$this->password."'";
	
		$this->res		=	mysql_query($this->query) or die(mysql_error());
		

		if(mysql_num_rows($this->res) > 0)
		{

			$this->row    			    =   	mysql_fetch_array($this->res);
            $_SESSION['userName']   	=       $this->user;
			$_SESSION['serialNumber']   =       $this->row['serialNumber'];
            $_SESSION['barcode']   		=       $this->row['barcode'];
			$_SESSION['firstName']    	=       $this->row['firstName'];
			$_SESSION['lastName']    	=       $this->row['lastName'];
			$_SESSION['gender']    		=       $this->row['gender'];
			$_SESSION['role']    		=       $this->row['role'];
			$_SESSION['community_id']	=		$this->getCommunityid($this->row['serialNumber']);
			$commid=$this->getCommunityid($this->row['serialNumber']);
			$_SESSION["max_rows"]		=		25;
			//echo "<script>alert('$commid')</script>";
			
			if($commid ==1 || $commid ==3){
								
				echo "<script>alert('$commid');</alert>";
			if($cookie)
			{
				$expire=time()+60*60*24*30;
				setcookie("Barcode",$this->row['barcode'], $expire);
				setcookie("Password",sha1($this->row['password']), $expire);
			}
			if($this->row['role']==0)
			{  
                header("location: ".$path1);
                exit();
		    }
            elseif($this->row['role']==1){  
                        header("location:admin.php");
                        exit();
		      }
			else{
				$this->message = "Invalid role assigned";
				exit();
			}
		}
		else
		{
			
			$this->message = "You are not currently activated for MUM attendance tracking.<br />
Contact the Department for the Development of Consciousness: phandel@mum.edu<br />";
		}
		}else{
			$this->message = "Incorrect Username or Password";
		}
		return $this->message;		
	}

        /*
        * Check barcode user login
        * param: barcode,password,path
        */
	function barcode_login_check($barcode, $pass,$path1,$cookie=false)
	{
		$this->barcode		=	dbconnect::escape($barcode);

		$this->password		=	md5(dbconnect::escape($pass));
		$this->query		=	"SELECT * FROM user WHERE barcode='".$this->barcode."'AND password='".$this->password."'";


		$this->res		=	mysql_query($this->query) or die(mysql_error());
				
		if(mysql_num_rows($this->res) > 0)
		{
            $this->row    =   mysql_fetch_array($this->res);
            $_SESSION['barcode']   		=       $this->barcode;
            $_SESSION['serialNumber']   =       $this->row['serialNumber'];
			$_SESSION['userName']   	=       $this->row['userName'];
			$_SESSION['firstName']    	=       $this->row['firstName'];
			$_SESSION['lastName']    	=       $this->row['lastName'];
			$_SESSION['gender']    		=       $this->row['gender'];
			$_SESSION['role']    		=       $this->row['role'];
			$_SESSION['community_id']	=		$this->getCommunityid($this->row['serialNumber']);
			$_SESSION["max_rows"]		=		25;
			if($cookie)
			{
				$expire=time()+60*60*24*30;
				setcookie("Barcode",$this->row['barcode'], $expire);
				setcookie("Password",sha1($this->row['password']), $expire);
			}
            if($this->row['role']==0)
			{  
				header("location: ".$path1);
                exit();
		    }
            elseif($this->row['role']==1){  
                        header("location:admin.php");
                        exit();
		    }
			else{
				$this->message = "Invalid role assigned";
				exit();
			}
		}
		else
		{
			$this->message = "Invalid Barcode";
			
		}
		return $this->message;		
	}

	function checkCookie($path)
	{
		if(isset($_COOKIE['Barcode']) && isset($_COOKIE['Password']))
		{
			$barcode 			= 	$_COOKIE['Barcode'];
			$password 			= 	$_COOKIE['Password'];
			$this->query		=	"SELECT * FROM user WHERE barcode='".$barcode."'";

			$this->res		=	mysql_query($this->query) or die(mysql_error());
					
			if(mysql_num_rows($this->res) > 0)
			{
				$this->row = mysql_fetch_array($this->res);
				if(sha1($this->row['password']) == $password)
				{
					
					$_SESSION['barcode']   		=       $barcode;
					$_SESSION['userName']   	=       $this->row['userName'];
					$_SESSION['serialNumber']   =       $this->row['serialNumber'];
					$_SESSION['firstName']    	=       $this->row['firstName'];
					$_SESSION['lastName']    	=       $this->row['lastName'];
					$_SESSION['gender']    		=       $this->row['gender'];
					$_SESSION['role']    		=       $this->row['role'];
					$_SESSION["max_rows"]		=		25;
					if($this->row['role']==0)
					{  
						header("location: ".$path);
						exit();
					}
					elseif($this->row['role']==1){  
						header("location:admin.php");
						exit();
					}
					return TRUE;
				}
				else
					return FALSE;
			}
			else
				return FALSE;
		}
		else
			return FALSE;
	}

	function forgotpass($uid)
	{
	    $this->username	=	dbconnect::escape($uid);
	    $this->query 		=	"SELECT * FROM user WHERE userName='".$this->username."'";
		$resu = mysql_query($this->query) or die($this->query);
		echo $resu;
	    //$this->res 			= 	mysql_query($this->query) or die($this->query);
		if(mysql_num_rows($resu )<=0){
		header("Location:index.php?verification=false");
		}
		$r=rand(100000,999999);
		$md=md5($r);
	
		$to = $this->username;
		$subject = "Password retrieval";
		$message = "Your password has been successfully reset. Your new password is : ".$r;
		$from = "admin@myattendance.com";
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers) or die ("error in sending mail");
		$query1="update user set password='".$md."' where userName='".$this->username."'";
		$resu = mysql_query($query1) or die($query1);
		echo "Mail Sent.";
		exit( header('Location:index.php?verification=true') );
		
        }

	function changepass($uid,$curpass,$newpass)
	{ 
	    $this->username	=	dbconnect::escape($uid);
	    $this->query 		=	"SELECT * FROM user WHERE userName='".$this->username."'";
		$this->resu = mysql_query($this->query) or die($this->query);
		if(mysql_num_rows($this->resu )<=0){
			return "Some error has occured! Please try again later";
		//header("Location:index.php?verification=false");
		}
		$mdcur= md5($curpass);
		$this->row    =   mysql_fetch_array($this->resu);
		if($this->row['password'] != $mdcur){
			return "Incorrect Password";
		}
		$md=md5($newpass);
	
		$to = $this->username;
		$subject = "Password retrieval";
		$message = "Your password has been successfully reset. Your new password is : ".$newpass;
		$from = "admin@myattendance.com";
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers) or die ("error in sending mail");
		$query1="update user set password='".$md."' where userName='".$this->username."'";
		$resu = mysql_query($query1) or die($query1);
		echo "Mail Sent.";
		exit( header('Location:index.php?verification=true') );
		
        }

	public function getCommunityid($serial)
	{
		$this->serial = dbconnect::escape($serial);
		$res_com="SELECT * FROM userCommunity WHERE `serialNumber`='$serial'";
		$res1 = mysql_query($res_com) or die(mysql_error());
		$row1= mysql_fetch_array($res1);
		if($row1['mum_stat']==1 && $row1['iag_stat']==0)  return 1;
		elseif($row1['iag_stat']==1 && $row1['mum_stat']==0) return 2;
		elseif($row1['iag_stat']==1 && $row1['mum_stat']==1) return 3;
		elseif($row1['iag_stat']==0 && $row1['mum_stat']==0) return 4;
		
	}

}
?>
