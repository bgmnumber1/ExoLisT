<?php
session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//ensuring that important session variables are clear for use
if (isset($_SESSION['title'])){
	if ($_SESSION['title'] != ''){
		$_SESSION['title'] = '';
	}
}
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
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>ExoLisT-<?php echo $usname ;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
<div data-role="page">

  		<div data-role="header">
    		<h1>ExoLisT - New</h1>
  		</div>
	<div data-role="main" class="ui-content">
		<form id="newlist_title" action="new.php" method="GET">
			<legend><h3>Create a new List</h3></legend>
			<label for="nlist_title">Title: </label>
			<input type="text" id="nlist_title" name="nlist_title" />
			<label>List Type: </label>
					<label for="Memo">Memo </label><input type="radio" name="listype" id="Memo" value="Memo"/>
					<label for="Checklist">Checklist </label><input type="radio" name="listype" id="Checklist" value="Checklist"/>
			<input type="submit" value="Create" name="submit" />
			<input type="submit" value="Cancel" name="submit" />
		</form>
	</div>
	</div>

</body>
</html>