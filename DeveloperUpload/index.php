<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<TITLE>MUM.MyAttendance.US - Import CSV</TITLE>

</head>
<body>
<div style="clear: both; font-weight: bold;"><big>&nbsp;</big></div>
<big style="font-weight: bold;">Dear <font color="green"><? echo $_SESSION['firstName']." ".$_SESSION['lastName'] ; ?></font>, welcome to the CSV upload page<br />
</big><a href="#">How</a> to setup a CSV (Comma Separated Value) file prior to upload<br /><br /><br /><br /><br /><br />
<br />
					<form action="import_process.php" method="POST" enctype="multipart/form-data">
					<table border="0" width="54%" class="formLabel">

			      <!-- <TR>
			      <TD colspan="2" class="pageTitle" style="border-bottom:5px solid #E3E3E3;">
			      </TD>
			      </TR> -->
				<TR ID="csvContainer"><TD class='addFieldTitle'>Upload User Profiles:
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
					<TD>
						<input type='file' class='txtbox' name='csvfile'>
					</TD>
					</TR>
						<TR><TD align="right" colspan="2">

						<input type="submit" value="Upload" name="submit" ><br /><br /><br /><br /></TD></TR> 
						</form>
						<form action="import_process.php" method="POST" enctype="multipart/form-data">
					<table border="0" width="54%" class="formLabel">

			      
						<tr>
      <td style="vertical-align: top;" id="logout"><a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">home page</a>
      </td>
    </tr>
					</table>
					</form>
				<!-- </div>
			</TD>
			</TR>
		</table>
	</TD>
	</TR>
</table> -->
<div id="footer">
<br />
<br />
Copyright (c) 2011 Wakarusa River, a Fairfield, IA Company. All
rights reserved.<br />
</div>
</div>
</body>
</html>
