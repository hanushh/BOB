<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php 
require_once ('config.php'); 
require_once('User/user.class.php');
require "logcheckadmin.php";
$obj_user 		=	new User();
$communities 	= 	$obj_user->ListCommunities();
$admin= $_SESSION['firstName']." ".$_SESSION['lastName'];


if(isset($_POST['Submit'])){

$serial	=	isset($_POST['serial'])?trim($_POST['serial']):'';
if(!$serial) $errormissing=true;

$barcode	=	isset($_POST['bar_code'])?trim($_POST['bar_code']):'';
if(!$barcode) $errormissing=true;
require_once('evalbarcode.php');
if(!evalbarcode($barcode)) $errorbar=true;
//validation checking
	$rs_duplicates1 = mysql_query("select * from user where serialNumber='".dbconnect::escape($serial)."'");
	$duplicates1 = mysql_num_rows($rs_duplicates1);
	
	$rs_lostbar = mysql_query("SELECT * FROM `lostBarcodes` WHERE lostBarcode='".dbconnect::escape($barcode)."'");
	$lost_bar = mysql_num_rows($rs_lostbar);
	if ($lost_bar > 0) $err_lost_bar=1;
	
	if ($duplicates1 > 1)
	{	
		$errorlogin1=1;
	}
	

	$email		=	isset($_POST['uname'])?trim($_POST['uname']):'';
	$pass		=	isset($_POST['pass1'])?trim($_POST['pass1']):'';
	$pass1		=	isset($_POST['pass2'])?trim($_POST['pass2']):'';
	//$serial		=	$obj_user->getSerialNumber($barcode);
	$comments	=	$_POST['comment'];

	if($errormissing || $errorpass||$errorlogin||$errorbar||$errorlogin1 || $err_lost_bar)
	{
		if($erroremail)$errortext="*The e-mail you entered is invalid. <br />";
		if($errorpass)$errortext="*The passwords do not match!<br />";
		if($errorlogin)$errortext= "*Invalid username.<br />The username you entered already exists in the database.<br /> Please enter a valid username.<br />";
		if($errorlogin1)$errortext= "*Invalid barcode number. <br />The number you entered already exists in the database.<br /> Please enter a valid number.<br />";
		if($errorbar)$errortext="*The barcode you entered is invalid.<br />Please enter a 13-digit valid barcode number.<br />";	
		if($errormissing)$errortext="*Required field(s) are missing<br /> <br />";
		if($err_lost_bar) $errortext="Lost Barcode ! Not valid<br /> ";
		if (isset($errortext)) { $msg= $errortext ; } 
			echo'';
	}
	else
	{	
		if(trim($_POST['comment']) != trim($_POST['previousComment']))
		{
			if(isset($_REQUEST['barcode_rad'])){
				$barcode_rad = $_REQUEST['barcode_rad'];

				if($barcode_rad=='upgrade'){

					$reg_status = $obj_user->upgrade($serial,$barcode,$_POST['uname'],$pass1,$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["gender"],$_POST["subscribe"],$_POST['role'],$comments,$admin);
					if($reg_status) $msg = "Barcode sucessfully upgraded";
					else $msg="Barcode not upgraded! Some error occured";
				}
				elseif($barcode_rad=='lostbadge'){
					$row = mysql_fetch_array($rs_duplicates1);
					$lost_barcode=$row['barcode'];
					$new_barcode=$barcode;
					
					$rs_duplicates = mysql_query("select `barcode` from user where `barcode`='".dbconnect::escape($new_barcode)."'");
					$duplicates = mysql_num_rows($rs_duplicates);
					
					$rs_duplicates1 = mysql_query("select `barcode` from user where barcode='".dbconnect::escape($lost_barcode)."'");
					$duplicates1 = mysql_num_rows($rs_duplicates1);
					
					if($duplicates > 0){
						$msg="*The new barcode you entered is already exist. <br />";
					}
					else{	
						$comment.="\n ($lost_barcode changed to $new_barcode)";
						$reg_status = $obj_user->lostbarcode($lost_barcode,$new_barcode,$comment);
						if($reg_status) $msg = "Sucessfully assigned new Barcode";
						else $msg="Barcode not changed! Some error occured";
						
					}
				}
			}
			else{
				$reg_status = $obj_user->update($serial,$_POST['uname'],$pass1,$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["gender"],$_POST["subscribe"],$_POST['role'],$comments,$admin);
				$msg = "1 record Successfully changed";
				//header("location: ".$wpath."/editprofile.php?user=$_POST[uname]");
				//exit;
			}
		}
		else
		{	
			$msg="Please put a new comment for the edit!";
		
		}
	}

}
?>


  
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MyAttendance.us - Friction Free Attendance Tracking</title>
  

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" /></head><body>
<div id="wrapper">

<div id="page">
<div id="page-bgtop">
<div id="page-bgbtm">
<div id="content">
<div class="post">
<div class="entry">
<?php 
if(isset($_REQUEST['serial'])){
$serial=$_REQUEST['serial'];
}
else header("location:editpage.php");
$result = mysql_query("SELECT * FROM user  WHERE `serialNumber`='$serial'");
$row = mysql_fetch_array($result);

$result1 = mysql_query("SELECT `comments` FROM `review` WHERE `serialNumber`='$serial'");
$row1 = mysql_fetch_array($result1);

$result2= mysql_query("SELECT * FROM `userCommunity` WHERE `serialNumber`='$serial'");
$row2 = mysql_fetch_array($result2);
?>
  <script type="text/javascript" >
function barcode_type(id){
document.getElementById("bar_code").value="";
document.getElementById("barcode_label").innerHTML="New Barcode";
	document.getElementById("current_bar").style.display="none";
	document.getElementById("upgrade_bar").style.display="none";
	document.getElementById("lost_bar").style.display="none";
	document.getElementById("typo_bar").style.display="none";
	document.getElementById(id).style.display="block";
}
  </script>
<big><big>Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, you may edit the User Profile for <font color="blue"><? echo $row['firstName']." ".$row['lastName'] ?></font> using the following form</big></big><br /><br />Note a comment is required for every edit<br /></ br>Please explain the reason for your edit in the comment field<br /><br />
<form name="form1" method="post" action="editprofile.php" enctype="multipart/form-data">
  <div style=""> </div>
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="18">
    <tbody>
<?php
if(isset($msg)) echo "<tr><td colspan=2 style=\"color: red;\"><p><i>$msg</i></p></td></tr>"; ?>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>First
name<br /></big></big><?php echo "<input name='first_name' id='first_name' type='text' value='$row[firstName]'/>"; ?></td>
        <td style="vertical-align: top;"><big>Change <span style="font-weight: bold;">first name</span> or leave as is</big>
        </td>
      </tr>
	     
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Last
name<br /></big></big><?php echo "<input name='last_name' id='last_name' type='text' value='$row[lastName]' />"; ?></td>
        <td style="vertical-align: top;"><big>Change <span style="font-weight: bold;">last name</span> or leave as is</big>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>User
name<br /></big></big><?php echo "<input name='uname' id='uname' type='text' value='$row[userName]' />" ?></td>
        <td style="vertical-align: top;"><big><span style="font-weight: bold;">User name</span>
not editable</big> </td>
      </tr>
 
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big id="barcode_label">Current Barcode<br />
        </big></big><?php echo "<input name='bar_code' id='bar_code' maxlength='13' type='text' value='$row[barcode]' />"; ?>
		
	<span style="vertical-align: top; text-align: center;"><br /><br />
	<big><input id="upgrade_rad" name="barcode_rad"  type="radio" value='typo' onclick="barcode_type('typo_bar');" /> Typo</big><br />
		<big><input id="upgrade_rad" name="barcode_rad"  type="radio" value='upgrade' onclick="barcode_type('upgrade_bar');" /> Upgrade</big><br />
        <big> <input id="lost_rad" name="barcode_rad" value="lostbadge"  type="radio" onclick="barcode_type('lost_bar');"/> Lost Badge</big> </span>	
		
		</td>
		
        <td style="vertical-align: top;">
		<div id="current_bar" ><big>The user's current <span style="font-weight: bold;">barcode</span> is shown. If there is no barcode change required, simply leave the barcode number as it is. Be careful that neither the Typo, the Upgrade, nor the Lost Badge buttons are selected. If you accidently select the buttons "reload the page" to start over. Selecting a button will change the "Current Barcode" to "New Barcode" and the field will become empty so the new barcode can be entered.</big></div>
		
		<div id="typo_bar" style="display:none"><big>If a mistake was made when the barcode was originally entered, check the <span style="font-weight: bold;">Typo</span> button, replace the incorrect barcode with the correct number. The user's previous attendance record will be merged with the new barcode</big></div>
		
		<div id="upgrade_bar" style="display:none"><big>If the user has become a Sidha, check the <span style="font-weight: bold;">Upgrade</span> button, replace the 11001 prefix barcode with a 19001 prefix. The user's previous attendance record will be merged with the new barcode</big></div>
		<div id="lost_bar" style="display:none"><big>If the user has lost his or her badge, replace the old barcode with a new barcode. Then check the <span style="font-weight: bold;">Lost Badge</span> button,  The user's previous attendance record will be merged with the new barcode and the old barcode will be made permanently invalid</big></div></td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big><input name="gender" <?php if($row['gender'] == 'M'){ echo 'checked="checked"';} ?> value="M" type="radio" /> Male</big></big><br />
        <big><big> <input name="gender" value="F" <?php if($row['gender'] == 'F'){ echo 'checked="checked"';} ?> type="radio" /> Female</big></big> </td>
        <td style="vertical-align: top;"><big>Select Male or Female
to
record <span style="font-weight: bold;">gender</span> of new user</big>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>
		<input name="role" value="0"  <?php if($row['role'] == 0){ echo 'checked="checked"';} ?> type="radio" /> User</big></big><br />
        <big><big> <input name="role" <?php if($row['role'] == 1){ echo 'checked="checked"';} ?> value="1" type="radio" /> Admin</big></big> </td>
        <td style="vertical-align: top;"><big>Select
Admin or User to set the <span style="font-weight: bold;">level of access</span> granted. Users may see only their
own attendance records. Administrators may see everyone's
attendance data and may update and edit records, as well<span style="font-weight: bold;" /></big> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; text-align: center;"> <big><big>
		<input name="subscribe" <?php if($row['subscribe'] == 'Y'){ echo 'checked="checked"';} ?> value="Y" type="radio" /> E-mail -
Yes</big></big><br />
        <big><big> <input name="subscribe" <?php if($row['subscribe'] == 'N'){ echo 'checked="checked"';} ?> value="N" type="radio" />E-mail
- No<br />
        </big></big> </td>
        <td style="vertical-align: top;"><big>The default for <span style="font-weight: bold;">daily e-mail</span> of attendance
results is 'Yes.' If
new attendee does not use e-mail or does not want to
receive e-mail, select 'No'</big>
        </td>
      </tr>
	  
	  <?php
	  if($row2['mum_stat']){
		$curr_status="Active";
		$opp_status="Deactivate";
		}
		else{
			$curr_status="Inactive";
			$opp_status="Activate";
		}
	  ?>
	  <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Current MUM status<br /></big></big></td>
       <td style="vertical-align: top;"><big>The user is currently <span style="font-weight: bold;"><?php echo $curr_status; ?></span>, check the box to <span style="font-weight: bold;"><?php echo $opp_status; ?></span> the user.</big>
        </td>
	  </tr>
	  
	  <tr>
        <td style="vertical-align: top; text-align: center;"> <big><big>
		<input name="mum_status" <?php if($row2['mum_stat']){ echo 'checked="checked"';} ?> value="Active" type="radio" /> Active</big></big><br />
        <big><big> <input name="mum_status" <?php if(!$row2['mum_stat']){ echo 'checked="checked"';} ?> value="Inactive" type="radio" />Inactive<br />
        </big></big> </td>
        <td style="vertical-align: top;"><big>If the user is currently <span style="font-weight: bold;">active</span>, check the box to <span style="font-weight: bold;">deactivate</span> the user. If the user is currently <span style="font-weight: bold;">Inactive</span>, check the box to activate the user. If there is no change required in the user's status, simply leave the box unchecked"</big>
        </td>
      </tr>
	  
	  
	  <tr><td><textarea name='comment' rows='10' cols='30'><?php echo trim($row1[comments]); ?></textarea>
	  <input type="hidden" name="previousComment" value="<?php echo trim($row1[comments]); ?>" />
	  </td><td><big>Your <span style="font-weight: bold;">Comments</span> here</big></td></tr>
	  <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Today's Date<br />
		<?php $d=date("d/m/Y"); ?>
        </big></big><?php echo "<input name='editDate' id='editDate' maxlength='13' type='text' value='$d' />"; ?></td>
        <td style="vertical-align: top;"><big><span style="font-weight: bold;">Today's date</span> should automatically appear here. Every edit is documented with the date the change was made </big></td>
      </tr>
	   <tr>
        <td style="vertical-align: top; text-align: center;"><big><big>Edited by<br />
        </big></big><?php echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></td>
        <td style="vertical-align: top;"><big>The name of the <span style="font-weight: bold;">Administrator</span> who makes a change in the data becomes part of the revised record. Your name should automatically appear here </big></td>
      </tr>
    </tbody>
  </table>
  <big><big> </big></big>
  <input type="hidden" name="serial" value="<? echo $row[serialNumber]; ?>" />
  <div style="text-align: center;"><big><big><input name="Submit" id="mysubmit" value="Click Here to Update record for <? echo $row['firstName']." ".$row['lastName'] ?>" type="submit" /></big></big><br />
  </div>
  <big> <br />
  </big> </form>  
  Return to the Administrator's <a href="admin.php">home page</a>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end #content -->
<div style="clear: both;">&nbsp;</div>
<!-- end #page -->
<div id="footer">
<p>Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
rights reserved.</p>
</div>
<!-- end #footer -->
</div>

</body></html>
