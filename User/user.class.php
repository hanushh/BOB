<?php
class User
{

	function __construct()
	{
	
	
	
	}

	public function getUser($username)
	{
		$query = 	"SELECT 
					user.serialNumber, 
					user.barcode, 
					user.password, 
					user.userName, 
					user.firstName, 
					user.midName, 
					user.lastName, 
					userCommunity.startDate,
					user.gender, 
					user.subscribe, 
					user.role, 
					FROM `user` 
					LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber
					WHERE userName='".$username."'";
					
		$result = mysql_query($query) or die(mysql_error());
		
		$row = mysql_fetch_array($result);
		
		return $row;
		

	}
	public function getSerialNumber($barcode){
		
		$q = "SELECT serialNumber FROM `user` WHERE barcode='{$barcode}'";
		
		$res = mysql_query($q) or die(mysql_error());
		
		$arr = mysql_fetch_array($res);
		
		return $arr['serialNumber'];
		
	}

	public function getbarcode($serial){
		
		$q = "SELECT `barcode` FROM `user` WHERE `serialNumber`='{$serial}'";
		
		$res = mysql_query($q) or die(mysql_error());
		
		$arr = mysql_fetch_array($res);
		
		return $arr['barcode'];
		
	}

	public function register($barcode,$pass2,$uname,$first_name,$middle_name,$last_name,$com=1,$gender,$sub,$date,$role)
	{
		$this->barcode		=	dbconnect::escape($barcode);
		$this->pass2		=	md5(dbconnect::escape($pass2));
		$this->uname		=	dbconnect::escape($uname);
		$this->first_name	=	dbconnect::escape($first_name);
		$this->middle_name	=	dbconnect::escape($middle_name);
		$this->last_name	=	dbconnect::escape($last_name);
		$this->com		=	dbconnect::escape($com);
		$this->gender		=	dbconnect::escape($gender);
		$this->sub		=	dbconnect::escape($sub);
		$this->role		=	dbconnect::escape($role);
		$this->date		=	$date;
		
			$commid=$_SESSION['community_id'];
			if($commid==1){
				$com_stat='mum_stat';
			}
			elseif($commid==2){
				$com_stat='iag_stat';
			}
		mysql_query("INSERT INTO `user`
	              (`barcode`, `password` , `userName`, `firstName` , `midName` , `lastName` , `gender` , `subscribe`,`role`)
				  VALUES
				  ('".$this->barcode."',
				  '".$this->pass2."',
				  '".$this->uname."',
				  '".$this->first_name."',
				  '".$this->middle_name."',
				  '".$this->last_name."',
				  '".$this->gender."',
				  '".$this->sub."',
				  '".$this->role."')") or die(mysql_error());
				  
		$serial_number = mysql_insert_id();
		if($serial_number > 0){
			
		$sql =	"INSERT INTO `userCommunity` (serialNumber,mum_stat,mumCommunity) 
						VALUES ('".$serial_number."','1','1')";
						//echo $sql;
				mysql_query($sql) or die(mysql_error());
		}
		return (mysql_insert_id())?true:false;
	
	
	}
	public function reactivate($barcode){
		$this->barcode		=	dbconnect::escape($barcode);
		$serial=$this->getSerialNumber($barcode);
		$sql3="UPDATE `user`  SET `barcode`='".$this->new_barcode."' WHERE `serialNumber`='".$this->serialNumber."'";
		
		$sql =	"UPDATE `userCommunity` SET `mum_stat`='1',`mumCommunity`='1' WHERE `serialNumber`='".$serial."'";
		$res=mysql_query($sql) or die(mysql_error());
		return $res?true:false;
	}
//lost barcode	
		public function lostbarcode($lost_barcode,$new_barcode,$comment="lostbarcode:")
	{

		$this->lost_barcode		=	dbconnect::escape($lost_barcode);
		$this->new_barcode		=	dbconnect::escape($new_barcode);
		$this->comment			=       $comment;

		$sql="SELECT * FROM `user` WHERE `barcode`='".$this->lost_barcode."'";
		
		$res=mysql_query($sql);
		$row = mysql_fetch_array($res);

 
		$this->serialNumber 		=		$row['serialNumber'];
		$this->admin 			=		$_SESSION['firstName']." ".$_SESSION['lastName'];
		$sql2="INSERT INTO `lostBarcodes` (`serialNumber`,`lostBarcode`,`newBarcode`)
				  VALUES
				  ('".$this->serialNumber."',
				  '".$this->lost_barcode."',
				  '".$this->new_barcode."')";
		$sql3="UPDATE `user`  SET `barcode`='".$this->new_barcode."' WHERE `serialNumber`='".$this->serialNumber."'";
		$sql4= "INSERT INTO `review` (`serialNumber`,`comments`,`editor`)
				  VALUES
				  ('".$this->serialNumber."','".$this->comment."',
				  '".$this->admin."')";



		$res2=mysql_query($sql2) or die(mysql_error());
		$res3=mysql_query($sql3) or die(mysql_error());
		$res4=mysql_query($sql4) or die(mysql_error());
		
		return $res4?true:false;
	
	
	}
	
//end*/
	public function ListUsers(){
		
				$query = 	"SELECT 
					user.serialNumber, 
					user.barcode, 
					user.password, 
					user.userName, 
					user.firstName, 
					user.midName, 
					user.lastName, 
					userCommunity.startDate,
					user.gender, 
					user.subscribe, 
					user.role, 
					userCommunity.communityID as community, 
					userCommunity.status 
					FROM `user` 
					LEFT JOIN userCommunity ON 
					user.serialNumber=userCommunity.serialNumber";
					
		$result = mysql_query($query) or die(mysql_error());
		$arr = array();
		$counter = 0;
		
		
		while($row = mysql_fetch_array($result)){
			
			$arr[$counter]['serialNumber'] 	=	$row['serialNumber'];
			$arr[$counter]['barcode'] 		=	$row['barcode'];
			$arr[$counter]['password'] 		=	$row['password'];
			$arr[$counter]['userName'] 		=	$row['userName'];
			$arr[$counter]['firstName'] 	=	$row['firstName'];
			$arr[$counter]['midName'] 		=	$row['midName'];
			$arr[$counter]['lastName'] 		=	$row['lastName'];
			$arr[$counter]['startDate'] 	=	$row['startDate'];
			$arr[$counter]['gender'] 		=	$row['gender'];
			$arr[$counter]['subscribe'] 	=	$row['subscribe'];
			$arr[$counter]['role'] 			=	$row['role'];
			$arr[$counter]['community'] 	=	$row['community'];
			$arr[$counter]['status'] 		=	$row['status'];
			$counter++;
		}
		
		return $arr;
		
	}
	public function ListCommunities()
	{
		$query 		= 	"SELECT * FROM `community` WHERE mum=1";
		$result 	= 	mysql_query($query) or die(mysql_error());
		$arr 		= 	array();
		$counter 	= 	0;
		while($row = mysql_fetch_array($result))
		{
			$arr[$counter]['commId']	=	$row['commId'];
			$arr[$counter]['community']	=	$row['community'];
			
			$counter++;
		}
		
		return $arr;
	
	
	}
	public function getCommunityName($id)
	{

		$this->id = dbconnect::escape($id);

		$query = "SELECT community FROM `community` WHERE commId = '$this->id'";
		
		$res = mysql_query($query) or die(mysql_error());
		
		$row = mysql_fetch_array($res);

		return $row["community"];


	}
	/*public function getCommunityid($serial)
	{
		$this->serial = dbconnect::escape($serial);
		$res_com="SELECT * FROM userCommunity WHERE `serialNumber`='$serial'";
		$res1 = mysql_query($res_com) or die(mysql_error());
		$row1= mysql_fetch_array($res1);
		return $row1['communityID'];
	}*/
	public function upgrade($serial,$barcode, $uname,$pass2,$first_name,$middle_name,$last_name,$gender,$sub,$role,$comment,$admin)
	{
		$this->barcode		=	dbconnect::escape($barcode);
		$this->uname		=	dbconnect::escape($uname);
		$this->first_name	=	dbconnect::escape($first_name);
		$this->middle_name	=	dbconnect::escape($middle_name);
		$this->last_name	=	dbconnect::escape($last_name);
		$this->com		=	dbconnect::escape($com);
		$this->gender		=	dbconnect::escape($gender);
		$this->sub		=	dbconnect::escape($sub);
		$this->role		=	dbconnect::escape($role);






			mysql_query("UPDATE `user`  SET `barcode`='".$this->barcode."',
											`firstName`='".$this->first_name."' , 
											`midName`='".$this->middle_name."' , 
											`lastName`='".$this->last_name."' , 								 
											`gender`='".$this->gender."' , 
											`subscribe`='".$this->sub."',
											`role`='".$this->role."',
											`userName`='".$this->uname."'
											 WHERE `serialNumber`='$serial'") or die(mysql_error());
													
					
			
			$res=mysql_query("INSERT INTO `review`
	              (`serialNumber`, `comments`, `editor`)
				  VALUES
				  ('".$serial."','".$comment."','".$admin."')") or die(mysql_error());
			
		return $res?true:false;
}	

public function update($serial,$uname,$pass2,$first_name,$middle_name,$last_name,$gender,$sub,$role,$comment,$admin)
	{	
		$this->uname		=	dbconnect::escape($uname);
		$this->first_name	=	dbconnect::escape($first_name);
		$this->middle_name	=	dbconnect::escape($middle_name);
		$this->last_name	=	dbconnect::escape($last_name);
		$this->com		=	dbconnect::escape($com);
		$this->gender		=	dbconnect::escape($gender);
		$this->sub		=	dbconnect::escape($sub);
		$this->role		=	dbconnect::escape($role);
		$this->barcode		=	$this->getbarcode($serial);



			mysql_query("UPDATE `user`  SET `firstName`='".$this->first_name."' , 
											`midName`='".$this->middle_name."' , 
											`lastName`='".$this->last_name."' , 								 
											`gender`='".$this->gender."' , 
											`subscribe`='".$this->sub."',
											`role`='".$this->role."',
											`userName`='".$this->uname."'
											 WHERE `serialNumber`='$serial'") or die(mysql_error());
													
					
			
			mysql_query("INSERT INTO `review`
	              (`serialNumber`, `comments`, `editor`)
				  VALUES
				  ('".$serial."','".$comment."','".$admin."')") or die(mysql_error());
			
		return (mysql_insert_id())?true:false;
}	
	
}
?>
