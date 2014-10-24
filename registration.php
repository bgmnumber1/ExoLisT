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
					<p><?php echo "Failed to connect to MySQL: " . mysqli_connect_error(); ?></p>
				</div>
			</div>
		</body>
	</html>

	<?php
  
}
// escape variables for security
	$usname = mysqli_real_escape_string($dbCon, strtolower($_POST['username']));
	$paswd = password_hash(mysqli_real_escape_string($dbCon, $_POST['password']), PASSWORD_DEFAULT);
	$paswd2 = password_hash(mysqli_real_escape_string($dbCon, $_POST['password2']), PASSWORD_DEFAULT);
	$fname = mysqli_real_escape_string($dbCon, $_POST['fname']);
	$lname = mysqli_real_escape_string($dbCon, $_POST['lname']);
	$email = strtolower($_POST['email']);
	$isdup = dupcheck($usname, $dbCon);
	$emailisdup = dupcheck_email($email, $dbCon);
	if ($isdup != '0') {
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
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	</head>
	<body>
		<div data-role="page">
  			<div data-role="header">
  				<h1>ExoLisT - Success!</h1>
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