<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	$uid = $_SESSION['id'];
	$listitle = $_SESSION['title'];
	$lid = $_GET['lid'];
	$eid = $_GET['submit'];
	$eid = strip_tags($eid);
	$eid = mysqli_real_escape_string($dbCon, $eid);
	$result = delete_listitem($eid, $dbCon);
	if($result == 'TRUE'){
		header("Location: listview.php?id=$lid");
	}
	else {
				?>
					<html>
						<head>
							<title>ExoLisT - ERROR</title>	
							<meta charset="UTF-8">
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
							<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
							<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
						</head>
						<body>
							<div data-role="page">
			 		 			<div data-role="header">
									<h1>Exolist</h1>
								</div>
								<div data-role="main">
									<p><? echo $itemcontent; ?> not deleted!</p>
									<a href="listview.php?id=<? echo $lid; ?>">List View</a>
								</div>
						<body>
						
					</html>
				<?
	}
?>