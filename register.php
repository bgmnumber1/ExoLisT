
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

  	<div data-role="header">
  		<h1>ExoLisT - Registration</h1>
  	</div>
	<div data-role="main" class="ui-content">
		<form id="register" action="registration.php" method="post">
			<input type="text" name="username" placeholder="Username" required /> <br />
			<input type="password" name="password" placeholder="Password" required /> <br />
			<input type="password" name="password2" placeholder="Re-enter Password" required /> <br />
			<input type="text" name="fname" placeholder="First Name" required /> <br />
			<input type="text" name="lname" placeholder="Last Name" required /> <br />
			<input type="email" name="email" placeholder="Email" required /> <br />
			<input type="submit" value="Submit" name="Submit" />
		</form>
		<p>Already registered?</p> <a href="index.php" data-role="button">Login Here</a></p>
	</div>
</body>
</html>