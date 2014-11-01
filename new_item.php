<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	//Contains code copied from Peter Entwistile's Tutorial See links on References Page
	//Edited to fit my needs ~Alec Sokso
	if (isset($_SESSION['id'])) {
		// Put stored session variables into local PHP variable
		$uid = $_SESSION['id'];
		$uid = strip_tags($uid);
		$uid = mysqli_real_escape_string($dbCon, $uid);
		$usname = $_SESSION['username'];
		$result = "Welcome ".$usname ;
	} else {
		error_reporting(E_ERROR | E_PARSE);
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
 		 			<div data-role="header" style="background-color:green;color:white;">
  						<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - ERROR</h1>
  					</div>
  			 		<div data-role="main" class="ui-content">
  						<h2>You are not logged in yet</h2>
  						<p><a href="index.php" data-role="button">Please try again</a></p>
					</div>
				</div>
			</body>
		</html>

			<?php
	}
	$lid = $_GET['lid'];
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
	 		 			<div data-role="header" style="background-color:green;color:white;">
							<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">Exolist</h1>
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
	$title = get_listitle($lid, $dbCon);
	
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
							<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Add Items</h1>
						</div>
						<div data-role="main" class="ui-content"> 
							<p>Adding items to <?php echo $title;?></p>
							<p>Add an item below</p>
							<form id="add_item" action="addnew.php" method="GET">
								Item: <input type="text" name="content" /> <br />
								<input type="hidden" value="<?php echo $lid; ?>" name="lid" />
								<input type="SUBMIT" value="Add" name="submit" />
								<input type="SUBMIT" value="No More" name="submit" />
							</form>
						</div>
					</div>
				</body>
			</html>
		<?php 

?>