<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	$lid = $_SESSION['lid'];
	$lid = strip_tags($lid);
	$lid = mysqli_real_escape_string($dbCon, $lid);
	$uid = $_SESSION['id'];
	$uid = strip_tags($uid);
	$uid = mysqli_real_escape_string($dbCon, $uid);
	$list = get_listitle($lid, $dbCon);
	if($_POST['Yes']){
		delete_list($lid, $dbCon);
		?>
			<html> 
				<head>
					<title>ExoLisT - Success</title>	
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
					<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
					<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
				</head>
				<body>
					<div data-role="page">
	 		 			<div data-role="header" style="background-color:green;color:white;">
	  						<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT</h1>
	  					</div>
	  			 		<div data-role="main" class="ui-content">
	  						<h2><? echo $list; ?> was sucessfully deleted</h2>
								<a href="user.php" data-role="button">Back to Lists</a>
						</div>
					</div>
				</body>
			</html>
		<?
	}

	
			 ?>
		<html> 
			<head>
				<title>ExoLisT - Success</title>	
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header" style="background-color:green;color:white;">
  						<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT</h1>
  					</div>
  			 		<div data-role="main" class="ui-content">
  						<h2>Are you sure you want to delete <? echo $list; ?></h2>
						<form id="delist" action="delete_list.php" method="post">
  							<input type="submit" value="Yes" name="Yes"/>
							<a href="listview.php?id=<? echo $lid; ?>" data-role="button">No</a>
						</form>
					</div>
				</div>
			</body>
		</html>

			<?php


?>