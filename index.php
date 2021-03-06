<?php
session_start();
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//Contains code copied from Peter Entwistile's Tutorial See links on References Page
//Edited to fit my needs ~Alec Sokso
if (isset($_SESSION['id'])){
	if($_SESSION['id'] != ''){
		$_SESSION['reload'] = "TRUE";
		header("Location: user.php");
	}
}
if (isset($_POST['username'])) {
	
	include("includes/dbConnect.php");
	
	// Set the posted data from the form into local variables
	$usname = strip_tags(strtolower($_POST['username']));
	$paswd = strip_tags($_POST['password']);
	
	$usname = mysqli_real_escape_string($dbCon, $usname);
	$paswd = mysqli_real_escape_string($dbCon, $paswd);
	//database interface
	$sql = "SELECT id, username, password FROM user WHERE username = '$usname' AND active = '1' LIMIT 1";
	$query = mysqli_query($dbCon, $sql);
	$row = mysqli_fetch_row($query);
	$uid = $row[0];
	$dbUsname = $row[1];
	$dbPassword = $row[2];
	//password verification
	$isValid = password_verify($paswd, $dbPassword);
	// Check if the username and the password they entered was correct
	if ($usname == $dbUsname && $isValid == '1') {
		// Set session 
		$_SESSION['username'] = $usname;
		$_SESSION['id'] = $uid;
		//close database connection
		mysqli_close($dbCon);
		// Now direct to users feed
		$_SESSION['reload'] = "TRUE";
		header("Location: user.php", true, 303);
	} else {
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
  							<h2>Oops that username or password combination was incorrect.</h2>
  							<p><a href="javascript:history.go(0)" data-role="button">Try Again</a></p>
						</div>
					</div>
				</body>
			</html>

			<?php
	}
}
?>
 
<!DOCTYPE html>
<html>
<head>
	<title>ExoLisT-Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
	<div data-role="page">

  		<div data-role="header" style="background-color:green;color:white;">
    		<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Login</h1>
  		</div>
	<div data-role="main" class="ui-content">
		<form id="form" action="index.php" method="post" enctype="multipart/form-data">
			<input type="text" name="username" placeholder="Username" required="required"="true" /> <br />
			<input type="password" name="password" placeholder="Password" required="required" /> <br />
			<input type="submit" value="Login" name="Submit" />
		</form>
		<a href="register.php" data-role="button">Register</a>
		<a href="contact.php" data-role="button">Contact</a>
		<a href="includes/Exolist_guide.pdf" data-role="button" target="_blank">Help</a>
	</div>
	<div data-role="footer" data-position="fixed" class="ui-content" style="background-color:green;color:white">
		
	</div>
	</div>
</body>
</html>