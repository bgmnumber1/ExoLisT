<?php
session_start();
include("includes/dbConnect.php");
include("includes/functions.php");
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
$lid = $_SESSION['lid'];
$lid = strip_tags($lid);
$lid = mysqli_real_escape_string($dbCon, $lid);
$uid = $_SESSION['id'];
$suid = $_GET['suid'];
$suid = strip_tags($suid);
$suid = mysqli_real_escape_string($dbCon, $suid);
if($_GET['suid'] == $uid){
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
						<h1>Exolist</h1>
					</div>
					<div data-role="main">
						<p>UID <?php echo $uid; ?> is also the current user. You may not share lists with yourself.</p>
						<a href="sharing.php">Back To Sharing</a>
					</div>
			<body>
			
		</html>
	<?php
} else {
	$setshare = set_share($uid, $lid, $suid, $dbCon);
	if($setshare != 'TRUE'){
		echo $setshare;
	} else {
		header("Location: sharing.php");
	}
	
	
}
?>