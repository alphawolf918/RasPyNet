<?php
	ob_start();
	$con = mysqli_connect("localhost",
			      "root",
			      "",
			      "PyNet");
	if(mysqli_connect_error()){
		$strErr = mysqli_connect_error();
		exit($strErr);
	}

	function sql($query){
		global $con;
		$q = mysqli_query($con, $query) OR exit(mysqli_error($con));
		return mysqli_fetch_assoc($q);
	}
?><!DOCTYPE html>
<html lang="en_US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<style type="text/css">
		<!--
		body {
			margin: 1% 1% 1% 1%;
			font-family: Verdana;
			font-size: 12px;
			background: #eee;
		}

		.container {
			width: 85%;
			margin: 0% auto;
			border: 1px solid #000000;
			border-radius: 5px;
			text-align: center;
			background: #fff;
			padding: 2%;
		}

		table {
			margin: 0px auto;
			width: 100%;
			border: 1px solid #444;
			border-radius: 5px;
			background: #555;
		}

		th {
			text-align: center;
		}

		th.main {
			font-size: 14px;
		}

		th.main, th.colhead {
			background: linear-gradient(#888, #444);
			color: #eee;
			font-weight: bold;
			padding: 0.5%;
		}

		td, th {
			border: 1px solid #000;
		}

		.bg1 {
			background: #ddd;
		}

		.bg2 {
			background: #fff;
		}
		-->
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="http://www.w3schools.com/appml/2.0.3/appml.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		<!--
			$.ajaxSetup({ type : "POST" });
		// -->
		</script>
		<title>PyNet Web UI</title>
	</head>
	<body>
		<div class="container">
		<?php
			$sql = "SELECT PN.ID
					  ,PN.WifiName
					  ,PN.DownloadSpeed
					  ,PN.UploadSpeed
					  ,PN.LoggedDate
				FROM (SELECT PN.ID			AS ID
						,PN.WifiName		AS WifiName
						,PN.DownloadSpeed	AS DownloadSpeed
						,PN.UploadSpeed		AS UploadSpeed
						,PN.LoggedDate		AS LoggedDate
					  FROM VIEW_PyNet PN) PN
					  WHERE (DAYOFYEAR(NOW()) - DAYOFYEAR(PN.LoggedDate)) <= 7
				ORDER BY PN.ID DESC;";
			$query = mysqli_query($con, $sql) OR exit(mysqli_error($con));
			$numRows = mysqli_num_rows($query);
		?>
		<div style="text-align: justify;"><strong>Rows:</strong> <?php echo $numRows; ?></div>
			<table cellspacing="2" cellpadding="4" id="tblMain">
				<tr>
					<th class="main" colspan="4">PyNet Speeds</th>
				</tr>
				<tr>
					<th class="colhead">WiFi Name</th>
					<th class="colhead">Download Speed</th>
					<th class="colhead">Upload Speed</th>
					<th class="colhead">Date Logged</th>
				</tr>
			<?php
				$cls = "bg1";
				while($c = mysqli_fetch_assoc($query)){
					$date = new DateTime($c["LoggedDate"]);
					$cls = ($cls == "bg1") ? "bg2" : "bg1";
					?>
					<tr class="<?php echo $cls; ?>">
						<td><?php echo $c["WifiName"]; ?></td>
						<td><?php echo $c["DownloadSpeed"]; ?></td>
						<td><?php echo $c["UploadSpeed"]; ?></td>
						<td><?php echo $date->format("M jS, Y H:i:s"); ?></td>
					</tr>
					<?php
				}
			?>
			</table>
		</div>
	</body>
</html>
<?php
	mysqli_close($con);
	ob_end_flush();
?>