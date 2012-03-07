<?php
require_once('calendar/classes/tc_calendar.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script language="javascript">
function alertdate(date1,date2,user){
loadpage('results',date1,date2,user);

}
</script>
<style type="text/css">
body { font-size: 11px; font-family: "verdana"; }

pre { font-family: "verdana"; font-size: 10px; background-color: #FFFFCC; padding: 5px 5px 5px 5px; }
pre .comment { color: #008000; }
pre .builtin { color:#FF0000;  }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<table border="0" cellspacing="8" cellpadding="4">
<div id="calander">
<form name="form" id=form method="POST" >
              
                <tr><td>
				 <div style="float: left; padding-right: 3px; line-height: 18px;">from:&nbsp;</div>
                 <?php					
      $date3_default = "2012-01-23";
      $date4_default = "2012-01-29";
      
	  $myCalendar = new tc_calendar("date3", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date3_default))
            , date('Y', strtotime($date3_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date4_default);
	  $myCalendar->writeScript();	  
	 echo "<div style=\"float: left; padding-left: 3px; padding-right: 3px; line-height: 18px;\">&nbsp;&nbsp;&nbsp;&nbsp;to:&nbsp; </div>";
	  $myCalendar = new tc_calendar("date4", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date4_default))
           , date('m', strtotime($date4_default))
           , date('Y', strtotime($date4_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date3_default);
	  $myCalendar->writeScript();	  
	  ?>
	<?php echo "<td><input type=\"button\" name=\"button\" id=\"button\" value=\"Search\" onClick=\"alertdate(this.form.date3.value,this.form.date4.value,$barcode)\"></td>"; ?>
              </td></tr>
              </table>
</form>
</div>
