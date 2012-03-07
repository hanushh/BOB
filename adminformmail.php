<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en"><head>
  
  <meta content="text/html; charset=iso-8859-1" http-equiv="content-type">
  <title>MUM.MyAttendance.US E-mail Form</title>

  
  
  <link media="screen" href="stylesheet3.css" rel="stylesheet">

  
  <link media="print" href="print.css" rel="stylesheet">

  
  <script type="text/javascript">
  </script>
  
  <link rel="shortcut icon" href="/favicon.ico">

</head><body>
<div style="clear: both; font-weight: bold;"><big>&nbsp;</big></div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the e-mail form page<br />
</big>Please use this form to contact the FrictionFree Attendance System Company
</div>
<div id="container"><br>
<div id="contents">
<div class="blogentry">
<form method="post" enctype="multipart/form-data" action="formmail.php">
  <div style="text-align: right;"><input name="MAX_FILE_SIZE" value="1000000" type="hidden"><input name="path_to_file" value="/var/www/php" type="hidden"><input name="require" value="2e-mail,1name,3topic,4Comment" type="hidden"><input name="recipient" value="" type="hidden"><input name="sort" value="alphabetic" type="hidden"><input name="ar_file" value="/www/formmail_path/autoresponder.txt" type="hidden"><input name="ar_subject" value="from administrator at MUM.MyAttendance.US" type="hidden"><input name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT" type="hidden">
  <!-- <input name="redirect" value="http://www.fixyourbusinessyourself.com/thankyou.html" type="hidden"> --></div>
<!-- Note: This page has minimal design and formatting. We are waiting on a
decision about who will be responsible for designing the MUM attendance
pages<br>
<span style="font-style: italic;">For an example of a page with similar function, but designed and formatted see <a href="http://myattendance.us/">http://myattendance.us/</a><br>
-->
  <br>
  <br>
</span>
  <div id="table">
  <table align="center">
    <tbody>
      <tr>
        <td style="text-align: right;">Your name:</td>
        <td> <input name="1name" type="text"> </td>
      </tr>
      <tr>
        <td style="text-align: right;">Your e-mail
address:</td>
        <td> <input name="2e-mail" type="text"> </td>
      </tr>
      <tr>
        <td style="text-align: right;">Subject (select
one):</td>
        <td> <input name="3topic" value="Change request" type="radio">Request
change or customization<br>
        <input name="3topic" value="Error report" type="radio">Report
error in content or function<br>
        <input name="3topic" value="Other" type="radio">Other </td>
      </tr>
      <tr>
        <td style="text-align: right;">Comment or question:</td>
        <td> <textarea name="4Comment" cols="40" rows="7"></textarea> </td>
      </tr>
      <tr>
        <td>&nbsp;<br>
        </td>
        <td>&nbsp;<br>
        </td>
      </tr>
      <tr>
        <td colspan="2"> <input value="Send" type="submit"> <input type="reset"> </td>
      </tr>
    </tbody>
  </table>
  </div>
</form><br><br>
<a href="logout.php">Logout</a> or return to the <br />Administrator's <a href="admin.php">Home Page</a>
</div>
</div>
<div id="footer"> </div>
</div>

</body></html>