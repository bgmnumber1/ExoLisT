<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");	
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	$lid=$_GET['lid'];
	$uid = $_SESSION['id'];
	//function to verfiy list ownership or if list is shared
	$isown = usercheck($lid, $uid, $dbCon);
	if($isown == "FALSE"){
		?>
			<html>
				<head>
					<title>ExoLisT - ERROR</title>	
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
					<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
					<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
				</head>
				<body>
					<div data-role="page">
	 		 			<div data-role="header">
							<h1>Exolist</h1>
						</div>
						<div data-role="main">
							<p>You do not own the list with id <?php $lid; ?></p>
							<a href="user.php">Back to User page</a>
						</div>
				<body>
			
			</html>
		<?
	}
	$lid = strip_tags($lid);
	$lid = mysqli_real_escape_string($dbCon, $lid);
	$cont = $_GET['content'];
	$uid = strip_tags($uid);
	$uid = mysqli_real_escape_string($dbCon, $uid);
	$listitle = get_listitle($lid, $dbCon);
	$submit = $_GET['submit'];
	if($submit == "Add"){
		$result = addcontent($uid, $lid, $cont, '', $dbCon);
		$submit = '';
		header("Location: new_item.php?lid=$lid");
	}elseif($submit == "No More"){
		$_SESSION['reload'] = "TRUE";
		header("Location: listview.php?id=$lid");
	}
	else {
		?>
			<html>
				<p>Unknown Error: You should definitely not be seeing this.</p>
			</html>
		
		<?php
	}

?>