<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php require "logcheckadmin.php"; ?>
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>MUM.MyAttendance.US - Friction Free Attendance Tracking -
Administrator Reports</title>

  
  
  <link href="style1.css" rel="stylesheet" type="text/css" media="screen" />

</head><body>
<div id="wrapper">
<!--
<div id="menu">
<ul>
  <li class="current_page_item"><a href="#">Welcome</a></li>
  <li><a href="#">Portfolio</a></li>
  <li><a href="#">About</a></li>
  <li><a>Contact</a></li>
</ul>
</div>
--><!--Note: This page has minimal design and formatting. We are waiting on a
decision about who will be responsible for designing the MUM attendance
pages<br /><span style="font-style: italic;">For an example of a page with formatting and design see</span> <a href="http://myattendance.us">http://myattendance.us/</a><br /><br /> -->
<!-- end #menu -->
<div style="clear: both; font-weight: bold;"><big>&nbsp;</big></div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the report page
</big><br />Select from the following reports or use the <a href="adminformmail.php">e-mail</a> form to request a <br />custom report if you do not see what you are looking for</big><br />
<br />
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="vertical-align: top;">1. <a href="#">
Attendance</a> - staff, student, and faculty attendance totals<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">2. <a href="#">Power Outages</a>
- power interruptions that affected attendance results<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">3. <a href="#">Celebrations</a> - sessions when celebrations ran long and affected entrance times<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">4. <a href="#">Violations</a>
- program hall use by the wrong gender or by inappropriate program for location<br /><br />
      </td>
    </tr>
    <!-- <tr>
      <td style="vertical-align: top;">5. <a href="browseoredit.php">Edit</a>
individual
records to correct errors in the attendance record or to update user
profiles<br /><br />
      </td>
    </tr>
	 <tr>
      <td style="vertical-align: top;">6. <a href="reviewedits.php">Review</a>
edited records - all edited records listed by date with comments<br /><br />
      </td>
    </tr>
	 <tr>
      <td style="vertical-align: top;">7. Make <a href="#">adjustments</a>
due to power outages or late program start due
to celebrations running long, and other exceptions<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">8. <a href="changepass.php">Change
</a>password - frequent replacement of adminstrator passwords is
essential for good security<br /><br />
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">9. <a href="adminformmail.php">E-mail</a>
the Wakarusa River Company, developer of this attendance system, to
report an error, request changes, or for other issues<br /><br />
      </td>
    </tr>
	 <tr>
      <td style="vertical-align: top;">10. <a href="reports.php">Reports</a> - several commonly used reports are available by simply clicking the appropriate links on the reports page<br /><br /><br /><br />
      </td>
    </tr> -->
    <tr>
      <td style="vertical-align: top;" id="logout"> <a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">home page</a>
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
