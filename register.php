<?php
$error = $_GET['err'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>ExoLisT - Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
	<div data-role="page">

  	<div data-role="header" style="background-color:green;color:white;">
  		<h1 style="font-weight:normal">ExoLisT - Registration</h1>
  	</div>
	<div data-role="main" class="ui-content">
		<h3 style="color:red;font-weight:normal"><?php echo $error; ?></h3>
		<form id="register" action="registration.php" method="post">
			<input type="text" name="username" placeholder="Username" required="required" /> <br />
			<input type="password" name="password" placeholder="Password" required="required" /> <br />
			<input type="password" name="password2" placeholder="Re-enter Password" required="required" /> <br />
			<input type="text" name="fname" placeholder="First Name" required="required" /> <br />
			<input type="text" name="lname" placeholder="Last Name" required="required" /> <br />
			<input type="email" name="email" placeholder="Email" required="required" /> <br />
			<input type="submit" value="Submit" name="Submit" />
		</form>
		<p>By submitting this form you are agreeing to the following policies: </p>
		<ul>
			<li><a href="includes/AUP.pdf" target="_blank">Acceptable Use</a></li>
			<li><a href="includes/PRI.pdf" target="_blank">Privacy</a></li>
		</ul>
		<p>Already registered?</p> <a href="index.php" data-role="button">Login Here</a></p>
	</div>
	<div data-role="footer" data-position="fixed" class="ui-content" style="background-color:green;color:white">
		
	</div>
</div>
</body>
</html>