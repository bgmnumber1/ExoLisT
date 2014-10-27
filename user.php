<?php
include("includes/dbConnect.php");
include("includes/functions.php");
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();


//ensuring that important session variables are clear for use
if (isset($_SESSION['title'])){
	if ($_SESSION['title'] != ''){
		unset($_SESSION['title']);
	}
}
if (isset($_SESSION['url'])){
	if($_SESSION['url'] != ''){
		unset($_SESSION['url']);
	}
}
if (isset($_SESSION['item'])){
	if($_SESSION['item'] != ''){
		unset($_SESSION['item']);
	}
}

$_SESSION['url'] = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
if (isset($_SESSION['id'])) {
	// Put stored session variables into local PHP variable
	$uid = $_SESSION['id'];
	$usname = $_SESSION['username'];
	$result = "Welcome ".$usname." (".$uid.")" ;
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
  						<h1 class="ui-title" role="heading" aria-level="1">ExoLisT - ERROR</h1>
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

$getlist_sql = "SELECT * FROM lists WHERE uid = '$uid'";
$userlists = mysqli_query($dbCon, $getlist_sql);
$sharedlist_sql = "SELECT * FROM list_share WHERE suid = '$uid'";
$sharedlists = mysqli_query($dbCon, $sharedlist_sql);

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
    		<h1 class="ui-title" role="heading" aria-level="1">ExoLisT</h1>
    		<a href="#popupMenu" class="ui-btn-right ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-rel="popup" data-role="button" data-inline="true" data-transition="slidedown" data-icon="gear" data-theme="e">Actions...</a>
			<div data-role="popup" id="popupMenu" data-theme="d">
					<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d">
						<li data-role="divider" data-theme="e">Choose an action</li>
						<li><a href="newlst.php">New List</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
			</div>
  		</div>
	<div data-role="main" class="ui-content">
	<h3><?php 
			error_reporting(E_ERROR | E_PARSE);
			echo $result; 
			?>
	</h3>
		<ul data-role="listview">
		<?php 		
			
			while($row = mysqli_fetch_array($userlists)) {
			?>
			
				<li><a href="listview.php?lid=<?php echo $row['id']?>"> <?php echo $row['title']; ?> </a></li>
	 		 	
	 		 <?php
			}
			?>
		</ul>
			<br><h3>Shared with me</h3>
			<ul data-role="listview">
			<?php
			
			while($row0 = mysqli_fetch_array($sharedlists)) {
				$sharlid = $row0['lid'];
				$share_sql = "SELECT * FROM lists WHERE id = '$sharlid'";
				$share = mysqli_query($dbCon, $share_sql);
				$shar = mysqli_fetch_array($share);
				?>
				<li><a href="listview.php?lid=<?php echo $shar['id']?>"> <?php echo $shar['title']; ?> </a></li>
				<?php
				
			}
			mysqli_close($dbCon);
			if($_SESSION['reload'] == "TRUE"){
				$_SESSION['reload'] = "FALSE";

			}
		 ?>
		 </ul>
		 <br>
	</div>
	</div>

</body>
</html>