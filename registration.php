<?php
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	$sql = '';
	// Check connection
if (mysqli_connect_errno()) {
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
					<p><?php echo "Failed to connect to MySQL: " . mysqli_connect_error(); ?></p>
				</div>
			</div>
		</body>
	</html>

	<?php
  
}
// escape variables for security
	$usname = mysqli_real_escape_string($dbCon, strtolower($_POST['username']));
	if($usname == ''){
		header("Location: register.php?err=You%20must%20input%20a%20username%0A");
	}
	$paswd = password_hash(mysqli_real_escape_string($dbCon, $_POST['password']), PASSWORD_DEFAULT);
	if($paswd == ''){
		header("Location: register.php?err=You%20must%20input%20a%20password%0A");
	}
	$paswd2 = password_hash(mysqli_real_escape_string($dbCon, $_POST['password2']), PASSWORD_DEFAULT);
	if($paswd2 == ''){
		header("Location: register.php?err=You%20must%20input%20a%20password%0A");
	}
	$fname = mysqli_real_escape_string($dbCon, $_POST['fname']);
	if($fname == ''){
		header("Location: register.php?err=You%20must%20input%20a%20first%20name%0A");
	}
	$lname = mysqli_real_escape_string($dbCon, $_POST['lname']);
	if($lname == ''){
		header("Location: register.php?err=You%20must%20input%20a%20last%20name%0A");
	}
	$email = strtolower($_POST['email']);
	if($email == ''){
		header("Location: register.php?err=You%20must%20input%20an%20email%0A");
	}
	$isdup = dupcheck($usname, $dbCon);
	$emailisdup = dupcheck_email($email, $dbCon);
	if ($isdup != '0') {
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
											<p>This username is already in use.</p>
											<a href="register.php" data-role="button">Try Again</a>
									</div>
								</div>
				 			</body>
					
				</html>
		<?php
	} else {
		if ($emailisdup != '0') {
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
												<p>This email address is already in use.</p>
												<a href="register.php" data-role="button">Try Again</a>
										</div>
									</div>
					 			</body>
					
					</html>
			<?php
		} else {
			if (mysqli_real_escape_string($dbCon, $_POST['password']) == mysqli_real_escape_string($dbCon, $_POST['password2'])) {										
				$sql = "INSERT INTO user (id, username, password, fname, lname, email, active)
				VALUES ('', '$usname', '$paswd', '$fname', '$lname', '$email', '1')";
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
									<p>Passwords do not match.</p>
									<a href="register.php" data-role="button">Try Again</a>
								</div>
							</div>
						</body>
					</html>

					<?php
				}
		}
}

if (mysqli_query($dbCon,$sql) == '') {
  $dberror = "Database cannot connect";
  die('$dberror' . mysqli_error($dbCon));
}
else { ?>
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
  				<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Success!</h1>
  			</div>
  			<div data-role="main" class="ui-content"> 
				<p>Record added Successfully.</p>
				<a href="index.php" data-role="button">Login</a>
			</div>
		</div>
	</body>
</html>

<?php }

?>