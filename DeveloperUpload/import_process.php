<?php
function getSerialNumber($barcode) {
	$q = "SELECT serialNumber FROM `user` WHERE barcode='{$barcode}'";
	$res = mysql_query($q) or die(mysql_error());
	$arr = mysql_fetch_array($res);
	return $arr['serialNumber'];
}
?>
<html>
	<head>
		<title>Upload csv</title>
		<script>
			function open_win() {
				window.open('Upload_results.txt');
			}
		</script>
	</head>
	<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once ('config.php');
	function getcommunityID($community_name) {

		$q = "SELECT commId FROM `community` WHERE community='{$community_name}'";

		$res = mysql_query($q) or die(mysql_error());
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_array($res);
			return $row['commId'];
		} else {
			return FALSE;
		}
	}

	$message = "";
	$i = 0;
	$tot_rows = 0;
	$source = file_get_contents("Upload_results.txt");
	$file = fopen("Upload_results.txt", "r+");
	$t = time();
	$time = (date("D F d Y h:i:s A", $t));
	fwrite($file, "\n______________\n");
	fwrite($file, $time);
	fwrite($file, "\n_______________\n");

	if (isset($_FILES)) {// print_r($_FILES);
		$f = $_FILES["csvfile"]["type"];

		if ((($_FILES["csvfile"]["type"] == "text/csv") || ($_FILES["csvfile"]["type"] == "text/comma-separated-values") || ($_FILES["csvfile"]["type"] == "application/csv") || ($_FILES["csvfile"]["type"] == "application/excel") || ($_FILES["csvfile"]["type"] == "application/vnd.ms-excel") || ($_FILES["csvfile"]["type"] == "application/vnd.msexcel") || ($_FILES["csvfile"]["type"] == "application/vnd.msexcel")) && ($_FILES["csvfile"]["size"] < 50000)) {

			if ($_FILES["csvfile"]["error"] > 0) {
				$message = "Error:" . $_FILES["csvfile"]["error"];
			} else {
				echo "<h4  style='text-align: center;'>Upload Details</h4>";
				echo "<table style='margin-left: 404px;'>";
				echo "<tr><td> Upload:</td><td>    " . $_FILES["csvfile"]["name"] . "</td></tr>";
				echo "<tr><td >Type:</td><td>      " . $_FILES["csvfile"]["type"] . "</td></tr>";
				echo "<tr><td >Size:</td><td>      " . ($_FILES["csvfile"]["size"] / 1024) . " Kb</td></tr>";
				//echo "<tr><td >Temp file:</td><td> " . $_FILES["csvfile"]["tmp_name"] . "</td></tr>";
				echo "</table>";

				$file_handle = fopen($_FILES["csvfile"]['tmp_name'], "rb");

				$r = 0;
				while (!feof($file_handle)) {
					$r++;
					$contents = fgetcsv($file_handle, 1024);

					if (count(array_values($contents)) > 0) {

						$barcode = dbconnect::escape($contents[0]);
						$serialno = getSerialNumber($barcode);
						
						require_once ('evalbarcode.php');
					
						///////////////end///////////

						$error_missing = false;
						for ($j = 0; $j < 5; $j++) {

							if (!$contents["$j"]) {
								$error_missing = true;
							}
						}
						if ($contents[0]) {
							$error_missing = false;
							if (!evalbarcode($barcode)) {
								$message = "Error: row $r-Invalid barcode\n";
								fwrite($file, $message);
							} else {
								
								$q = "INSERT INTO `attendanceTime`(
								serialNumber, 
								date, 
								inAM, 
								inPM,  
								SCID
								) 
								VALUES (
								'" . $serialno . "', 
								'" . dbconnect::escape($contents[1]) . "',
								'" . dbconnect::escape($contents[2]) . "',
								'" . dbconnect::escape($contents[3]) . "',
								'" . dbconnect::escape($contents[4]) . "',
								'" . dbconnect::escape($contents[5]) . "'
								)";	

								if (mysql_query($q)) {
									$timeId = mysql_insert_id();
										if (!mysql_query($q2)) {
											$message = mysql_error();
										} else {
											$i++;
											$message = "Sucess: row $r-Sucessfully updated\n";
										}
									
								} else {
									$message = mysql_error();
								}
								fwrite($file, $message);
							}

							continue;

						}

					}
					$tot_rows++;
				}

			}

		} else {
			echo "<big>File format $f is not supported. </big><big>Please upload Files in csv format</big>";
		}

	}
	$tot_rows--;
	echo "<p style='text-align: center;'>$i of $tot_rows rows inserted.</p>";
	fwrite($file, $source);
	fclose($file);

	echo "<p style='text-align: center;'>check <a href='javascript:void(0);' onclick='open_win();'>Upload Results</a> for more details</p>";
?>
	<br />
	<br />
	<br />
	<br />
	<br />
	<a href="logout.php">Logout</a> or return to the Administrator's <a href="admin.php">Home Page</a>
	<!-- end #page -->
	<div id="footer">
		<br />
		<p>
			Copyright (c) 2011 Wakarusa river, A Fairfield, IA Company. All
			rights reserved.
		</p>
	</div>
	</div>
	</body>
</html>
