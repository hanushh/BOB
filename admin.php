<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php require "logcheckadmin.php"; ?>
  <meta name="keywords" content="" />

 <!--check--> 
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>MUM.MyAttendance.US - Friction Free Attendance Tracking -
Administrator's Home Page</title>

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />

</head><body>
<div id="wrapper">
<div style="clear: both; font-weight: bold;"></div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the Ideal Attendance
Administrator's home page<br />
</big><big>Please select from the following options:</big><br />
<br />
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="vertical-align: top;">1. <a href="myattendancerecord.php">
View</a> my own attendance record<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">2. <a href="addnewuser.php">Add</a>
new student,
faculty, or staff (including staff or faculty with Administrator
Privileges)<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">3. <a href="import.php">Upload</a> a batch file of
new users and/or historical attendance data (allows input of many records simultaneously rather than one at
a time)<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">4. <a href="browseoredit.php">Browse</a> list of users in the attendance database. From here you may edit a user's profile and/or the user's attendance record<br /><br />
      </td>
    </tr>
    
	 <tr>
      <td style="vertical-align: top;">5. <a href="reviewedits.php">Review</a>
edited records - all edited records listed by date with comments; also searchable by last name and name of editor<br /><br />
      </td>
    </tr>
	 <tr>
      <td style="vertical-align: top;">6. Make <a href="#">adjustments</a>
due to power outages or late program start due
to celebrations running long, and other exceptions<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">7. <a href="changepass.php">Change
</a>password - frequent replacement of adminstrator passwords is
essential for good security<br /><br />
      </td>
    </tr>
	
	 <!--<tr>
      <td style="vertical-align: top;">8. <a href="lostbarcode.php">Invalidate</a>
barcode on lost badge, issue new barcode, and merge records<br /><br />
      </td>
    </tr>
	
	    <tr>
      <td style="vertical-align: top;">9. <a href="reactivate.php">Reactivate</a>
a member of the MUM Community who has been Deactivated.<br /><br />
      </td>
    </tr>
	
  <tr>
      <td style="vertical-align: top;">9. <a href="adminformmail.php">E-mail</a>
the Wakarusa River Company, developer of this attendance system, to
report an error, request changes, or for other issues<br /><br />
      </td> -->
    </tr>
	 <tr>
      <td style="vertical-align: top;">8. <a href="reports.php">Reports</a> - several commonly used reports are available by simply clicking the appropriate links on the reports page<br /><br /><br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;" id="logout"><a href="logout.php">Logout</a>
      </td>
    </tr>
  </tbody>

</table>
<!-- end #page -->
<div id="footer">
<br />
<p>Copyright (c) 2011 Wakarusa River, a Fairfield, IA Company. All
rights reserved.
</p>
</div>
</div>

</body></html>
