<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	if (isset($_SESSION['id'])) {
		// Put stored session variables into local PHP variable
		$uid = $_SESSION['id'];
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
				<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header">
  						<h1>ExoLisT - ERROR</h1>
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
	?>
			<html> 
				<head>
					<title>ExoLisT - Success</title>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
					<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
					<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
				</head>
				<body>
					<div data-role="page">
					<div data-role="header">
							<h1>ExoLisT - Add Items</h1>
						</div>
						<div data-role="main" class="ui-content"> 
							<p>Adding items to <?php echo $_SESSION['title'];?></p>
							<p>Add an item below</p>
							<form id="add_item" action="addnew.php" method="post">
								Item: <input type="text" name="content" /> <br />
								<input type="SUBMIT" value="Add" name="submit" />
								<input type="SUBMIT" value="No More" name="submit" />
							</form>
						</div>
					</div>
				</body>
			</html>
		<?php 

?>