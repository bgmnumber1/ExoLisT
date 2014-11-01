<?php
session_start();
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['id'])){
	if($_SESSION['id'] != ''){
		$_SESSION['reload'] = "TRUE";
		$uid = $_SESSION['id'];
		$usname = $_SESSION['username'];
		include("includes/dbConnect.php");
		include("includes/functions.php");
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
	<title>ExoLisT - Account Settings</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
	<div data-role="page">

  		<div data-role="header" style="background-color:green;color:white;">
    		<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - <?php echo $usname?></h1>
  		</div>
	<div data-role="main" class="ui-content">
		<h3>Account Settings</h3>

		<form id="change" action="account_mod.php" method="POST">
			<label> Choose which setting you would like to change and press the &quot;Select&quot; button... <select name="changetype" id="changetype">
			  <option value="fname">First Name</option>
			  <option value="lname">Last Name</option>
			  <option value="email">Email</option>
			  <option value="password">Password</option>
			</select></label>
			<input type="SUBMIT" name="go" value="Select"/>
		</form>
		<br>
		<?
		if(isset($_POST['changetype'])){
			if($_POST['changetype'] == "fname"){
				$fname = get_fname($uid, $dbCon);
				echo "<h3>"."Current First Name: ".$fname."</h3>";
				?>
					
					<form id="change_fname" action="change.php" method="POST">
						<input type="text" name="new_fname" placeholder="Enter new first name" required="required"/>
						<input type="submit" name="submit" value="Change"/>
						</form>
				<?php
			}
			if($_POST['changetype'] == "lname"){
				$lname = get_lname($uid, $dbCon);
				echo "<h3>"."Current Last Name: ".$lname."</h3>";
				?>
					<form id="change_lname" action="change.php" method="POST">
						<input type="text" name="new_lname" placeholder="Enter new last name" required="required"/>
						<input type="submit" name="submit" value="Change"/>
						</form>
				<?php
			}
			if($_POST['changetype'] == "email"){
				$email = get_email($uid, $dbCon);
				echo "<h3>"."Current Email: ".$email."</h3>";
				?>
					<form id="change_email" action="change.php" method="POST">
						<input type="email" name="new_email" placeholder="Enter new email" required="required"/>
						<input type="email" name="new_email2" placeholder="Re-enter new email" required="required"/>
						<input type="submit" name="submit" value="Change"/>
						</form>
				<?php
			}
			if($_POST['changetype'] == "password"){
				?>
					<form id="change_pass" action="change.php" method="POST">
						<input type="password" name="current_pass" placeholder="Enter current password" required="required"/>
						<input type="password" name="new_pass" placeholder="Enter new password" required="required"/>
						<input type="password" name="new_pass2" placeholder="Enter new password" required="required"/>
						<input type="submit" name="submit" value="Change"/>
						</form>
				<?php
			}
		
		}
		?>
		<p>ExoList Policies for your reference:</p>
		<ul>
			<li><a href="includes/AUP.pdf" target="_blank">Acceptable Use Policy</a></li>
			<li><a href="includes/PRI.pdf" target="_blank">Privacy Policy</a></li>
		</ul>
		<a href="user.php" data-role="button">Back to User Page</a>
	</div>
	<div data-role="footer" data-position="fixed" class="ui-content" style="background-color:green;color:white">
		
	</div>
	</div>
</body>
</html>