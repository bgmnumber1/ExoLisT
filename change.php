<?php
session_start();
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['id'])){
	if($_SESSION['id'] != ''){
		$_SESSION['reload'] = "TRUE";
		include("includes/dbConnect.php");
		include("includes/functions.php");
	}
}
$uid = $_SESSION['id'];
$uid = mysqli_real_escape_string($dbCon, strip_tags($uid));
$usname = $_SESSION['username'];
$usname = mysqli_real_escape_string($dbCon, strip_tags($usname));
if(isset($_POST['new_fname'])){
	$result = upd_fname(mysqli_real_escape_string($dbCon, strip_tags($_POST['new_fname'])), $uid, $dbCon);
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
   				<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Success</h1>
   			</div>
   	 		<div data-role="main" class="ui-content">
   				<h2>Your First Name has been updated!</h2>
   				<ul>
					<li><a href="account_mod.php" data-role="button">Back to Settings</a></li>
					<li><a href="user.php" data-role="button">Back to User Page</a></li>
				</ul>
   			</div>
   		</div>
   	</body>
   </html>

   	<?php
}
if(isset($_POST['new_lname'])){
	$result = upd_lname(mysqli_real_escape_string($dbCon, strip_tags($_POST['new_lname'])), $uid, $dbCon);
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
   				<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Success</h1>
   			</div>
   	 		<div data-role="main" class="ui-content">
   				<h2>Your Last Name has been updated!</h2>
   				<ul>
					<li><a href="account_mod.php" data-role="button">Back to Settings</a></li>
					<li><a href="user.php" data-role="button">Back to User Page</a></li>
				</ul>
   			</div>
   		</div>
   	</body>
   </html>

   	<?php
} 
if(isset($_POST['new_email'])){
	$result = upd_email(mysqli_real_escape_string($dbCon, strip_tags($_POST['new_email'])), mysqli_real_escape_string($dbCon, strip_tags($_POST['new_email2'])), $uid, $dbCon);
	if($result == "FALSE"){
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
	   				<h2>Your emails do not match!</h2>
	   				<p><a href="account_mod.php" data-role="button">Please try again</a></p>
	   			</div>
	   		</div>
	   	</body>
	   </html>

	   	<?php
	} else {
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
	   				<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Success</h1>
	   			</div>
	   	 		<div data-role="main" class="ui-content">
	   				<h2>Your email has been updated!</h2>
	   				<ul>
						<li><a href="account_mod.php" data-role="button">Back to Settings</a></li>
						<li><a href="user.php" data-role="button">Back to User Page</a></li>
					</ul>
	   			</div>
	   		</div>
	   	</body>
	   </html>

	   	<?php
	}
} 
if($_POST['new_pass'] != '' AND $_POST['current_pass'] != ''){
	$result = upd_pass($_POST['current_pass'], mysqli_real_escape_string($dbCon, strip_tags($_POST['new_pass'])), mysqli_real_escape_string($dbCon, strip_tags($_POST['new_pass2'])), $uid, $dbCon);
	if($result == "FALSE"){
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
	   				<h2>Your passwords do not match!</h2>
	   				<p><a href="account_mod.php" data-role="button">Please try again</a></p>
	   			</div>
	   		</div>
	   	</body>
	   </html>

	   	<?php
	   }
   	if($result == "TRUE"){
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
	   				<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Success</h1>
	   			</div>
	   	 		<div data-role="main" class="ui-content">
	   				<h2>Your password has been updated!</h2>
	   				<ul>
						<li><a href="account_mod.php" data-role="button">Back to Settings</a></li>
						<li><a href="user.php" data-role="button">Back to User Page</a></li>
					</ul>
	   			</div>
	   		</div>
	   	</body>
	   </html>

	   	<?php
	}
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
				<h2>You didn't enter anything!</h2>
				<p><a href="account_mod.php" data-role="button">Please try again</a></p>
			</div>
		</div>
	</body>
</html>

	<?php
}
	
?>