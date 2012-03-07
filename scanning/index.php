<?php
error_reporting(E_ALL | E_STRICT);
require_once "config.php";
require_once "login.class.php";
$message = "";
$log = new Login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>MUM.MyAttendance.us - Friction Free Attendance Tracking and Reporting</title>
		<link href="style1.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
			var imageclock = new Object()
			//Enter path to clock digit images here, in order of 0-9, then "am/pm", then colon image:
			imageclock.digits = ["clockimages/c0.gif", "clockimages/c1.gif", "clockimages/c2.gif", "clockimages/c3.gif", "clockimages/c4.gif", "clockimages/c5.gif", "clockimages/c6.gif", "clockimages/c7.gif", "clockimages/c8.gif", "clockimages/c9.gif", "clockimages/cam.gif", "clockimages/cpm.gif", "clockimages/colon.gif"]
			imageclock.instances = 0
			var preloadimages = []
			for(var i = 0; i < imageclock.digits.length; i++) {//preload images
				preloadimages[i] = new Image()
				preloadimages[i].src = imageclock.digits[i]
			}

			imageclock.imageHTML = function(timestring) {//return timestring (ie: 1:56:38) into string of images instead
				var sections = timestring.split(":")
				if(sections[0] == "0")//If hour field is 0 (aka 12 AM)
					sections[0] = "12"
				else if(sections[0] >= 13)
					sections[0] = sections[0] - 12 + ""
				for(var i = 0; i < sections.length; i++) {
					if(sections[i].length == 1)
						sections[i] = '<img src="' + imageclock.digits[0] + '" />' + '<img src="' + imageclock.digits[parseInt(sections[i])] + '" />'
					else
						sections[i] = '<img src="' + imageclock.digits[parseInt(sections[i].charAt(0))] + '" />' + '<img src="' + imageclock.digits[parseInt(sections[i].charAt(1))] + '" />'
				}
				return sections[0] + '<img src="' + imageclock.digits[12] + '" />' + sections[1] + '<img src="' + imageclock.digits[12] + '" />' + sections[2]
			}

			imageclock.display = function() {
				var clockinstance = this
				this.spanid = "clockspan" + (imageclock.instances++)
				document.write('<span id="' + this.spanid + '"></span>')
				this.update()
				setInterval(function() {
					clockinstance.update()
				}, 1000)
			}

			imageclock.display.prototype.update = function() {
				var dateobj = new Date()
				var currenttime = dateobj.getHours() + ":" + dateobj.getMinutes() + ":" + dateobj.getSeconds()//create time string
				var currenttimeHTML = imageclock.imageHTML(currenttime) + '<img src="' + ((dateobj.getHours() >= 12) ? imageclock.digits[11] : imageclock.digits[10]) + '" />'
				document.getElementById(this.spanid).innerHTML = currenttimeHTML
			}
		</script>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript">
		
		
			function error_sound(soundObj) {
				var sound = document.getElementById(soundObj);
				sound.Play();
			}

			function scanUser() 
			{
				
				$("#message p").html("<img src='ajax/AjaxLoader.gif' /> Registering your Attendence..");
				var barcode = $("#userTB").val();
				//$("#userTB").attr('disabled','true');
				$.ajax({
					type 		: 'POST',
					url 		: "ajax/barcodeScan.php",
					data 		: "uidLogin=true&user=" + barcode,
					dataType 	: "text",
					async 		: false,
					success 	: function(data) {
						var jsonObj = $.parseJSON(data);
						//$("#message p").html(jsonObj.scanData);
						$("#message p").html("");
						
						if(data != "Please scan your barcode" && data != "Invalid username or barcode" && data != "Invalid Barcode") {
							getScanned(jsonObj.DbData);
						}
						else
						{
							$("#message p").html(data);
						}
					},
					error 	: function(xhr, textStatus, errorThrown) {
						if(textStatus !== null) {
							alert("Network Error: " + textStatus);
							$("#message p").html("");
						} else if(errorThrown !== null) {
							alert("Network Error: " + errorThrown.message);
							$("#message p").html("");
						} else {
							alert("Network Error");
							$("#message p").html("");
						}
					}
				});
				FocusUserTB();
			}

			function getScanned(data) 
			{	
				$("#ScannedList").prepend(data);	
				$("#ScannedList li:gt(3)").hide('slow', function() {
					$("#ScannedList li:gt(3)").remove();
				});
				
			}

			function FocusUserTB() {
				var user = $("#userTB");
				user.focus()
			}

			function setScanningTimeout() {
				var t = setTimeout("scanningTimeOut()", 6000);
			}

			function scanningTimeOut() {
				
				$("#ScannedList").prepend("<li class='white'>-- Time Out --</li>");
				$("#ScannedList li:gt(3)").hide('slow', function() {
					$("#ScannedList li:gt(3)").remove();
				});
				
				setScanningTimeout();
				FocusUserTB();
			}


			$(document).ready(function() {
				FocusUserTB();
				setScanningTimeout();

				$("#userTB").keyup(function(event) {
					if(event.keyCode == 13) {
						scanUser();
						$("#userTB").val("");
					}
				});
			});
			// -->
		</script>
	</head>
	<body>
		<div id="wrapper">
			<br />
			<!-- Note: This page has minimal design and formatting. We are waiting on a
			decision about who will be responsible for designing the MUM attendance
			pages<br />
			<span style="font-style: italic;">For an example of a page with similar function, but designed and formatted see <a href="http://myattendance.us/">http://myattendance.us/</a></span>
			-->
			<!n-- end #header -->
			<div id="sidebar">
				<?	date_default_timezone_set("US/Central");

				$date = date("Y-m-d");
				$ampm = date('a', time());
				$time = date('h:i:s', time());
				$ap = strtoupper($ampm);
				if ($ampm == "am")
					$wish = "Good Morning,";
				if ($ampm == "pm")
					$wish = "Good Afternoon,";
				?>

				<div id="clock" style="float: left;">
					<script type="text/javascript">
						/*
						 Display date
						 */
						var mydate = new Date()
						var year = mydate.getYear()
						if(year < 1000)
							year += 1900
						var day = mydate.getDay()
						var month = mydate.getMonth()
						var daym = mydate.getDate()
						if(daym < 10)
							daym = "0" + daym
						var dayarray = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")
						var montharray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")
						document.write("<small><font color='#484895' face='Arial' size='6'><b>" + dayarray[day] + ", " + montharray[month] + " " + daym + ", " + year + "</b></font></small>")
					</script>
					<br />
					<script>new imageclock.display()</script>
				</div>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<div id="message" style="color: rgb(130, 158, 217); font-size: 20px; text-align: left; width: 978px;">
					<?php
					echo "<p>$wish Please scan your Barcode</p>";
					?>
				</div>
				<!--form action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post" name="f1"-->
				<table style="width: 978px; height: 50px;" border="0" cellpadding="3" cellspacing="1" align="left">
					<tbody>
						<tr>
							<td>
							<input type="text" maxlength="40" size="16" name="user" id="userTB" style="background-color: white; border: medium none; color: white;">
							</td>
						</tr>
						<tr>
							<td>
							<input name="uidLogin" value="true" type="hidden" />
							<input type="submit" value="Submit" name="submit" style="visibility: hidden;">
							</td>
						</tr>
					</tbody>
				</table>
				<!--/form-->
			</div>
			<div id="div1" style="width:92%; height:0px;">
				<div id="ScannedText">
					<ul id="ScannedList"></ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">
					&nbsp;
				</div>
				<div id="footer">
					<p>
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						Copyright (c) 2011 wakarusa river, A Fairfield, IA Company. All
						rights reserved.
						<br />
					</p>
				</div>
				<!-- end #footer -->
			</div>
			<embed src="success.wav" autostart="false" width="0" height="0" id="error_sound"
			enablejavascript="true" />
	</body>
</html>
