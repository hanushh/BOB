<?php
class User
{

	function __construct()
	{
	
	
	
	}
	public function getUser($username)
	{
		$query = "SELECT * FROM `user` WHERE userName='".$username."'";
		$result = mysql_query($query) or die(mysql_error());
		
		$row = mysql_fetch_array($result);
		
		return $row;
		

	}

	public function register($random,$pass2,$uname,$first_name,$middle_name,$last_name,$com,$gender,$sub,$date,$role)
	{
		$this->random		=	dbconnect::escape($random);
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

		mysql_query("INSERT INTO `user`
	              (`barcode`, `password` , `userName`, `firstName` , `midName` , `lastName` , `community`, `startDate`, `gender` , `subscribe`,`role`)
				  VALUES
				  ('".$this->random."','".$this->pass2."','".$this->uname."','".$this->first_name."','".$this->middle_name."','".$this->last_name."','".$this->com."','".$this->date."','".$this->gender."','".$this->sub."','".$this->role."')") or die(mysql_error());
				  
			
				return (mysql_insert_id())?true:false;
			
	
	
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

	public function update($barcode,$uname,$pass2,$first_name,$middle_name,$last_name,$com,$gender,$sub,$role)
	{
		$this->barcode		=	dbconnect::escape($barcode);
		$this->uname		=	dbconnect::escape($uname);
		$this->pass2		=	md5(dbconnect::escape($pass2));
		$this->first_name	=	dbconnect::escape($first_name);
		$this->middle_name	=	dbconnect::escape($middle_name);
		$this->last_name	=	dbconnect::escape($last_name);
		$this->com		=	dbconnect::escape($com);
		$this->gender		=	dbconnect::escape($gender);
		$this->sub		=	dbconnect::escape($sub);
		$this->role		=	dbconnect::escape($role);
if(!($this->pass2) || !$this->pass2=="" || !$this->pass2==NULL){

	mysql_query("UPDATE `user`  SET `barcode`='".$this->barcode."',`firstName`='".$this->first_name."' , `midName`='".$this->middle_name."' , `lastName`='".$this->last_name."' , `community`='".$this->com."', `gender`='".$this->gender."' , `subscribe`='".$this->sub."',`role`='".$this->role."' WHERE `userName`='".$this->uname."'") or die(mysql_error());
}
else{

	mysql_query("UPDATE `user`  SET `barcode`='".$this->barcode."',`password`='".$this->pass2."',`firstName`='".$this->first_name."' , `midName`='".$this->middle_name."' , `lastName`='".$this->last_name."' , `community`='".$this->com."', `gender`='".$this->gender."' , `subscribe`='".$this->sub."',`role`='".$this->role."' WHERE `userName`='".$this->uname."'") or die(mysql_error());

}			  
			
				return (mysql_insert_id())?true:false;
}	
	
}

?>
