<?php
session_start();
session_destroy(); 

?> 
<html> 
	<head>
		<title>ExoLisT - Logout</title>
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
				<p>You are now Logged out!</p>
				<a href="index.php" data-role="button">Login</a>
			</div>
		</div>
	</body>
</html>