<?php
session_start();
include("includes/dbConnect.php");
include("includes/functions.php");
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
$lid = $_SESSION['lid'];
$uid = $_SESSION['id'];
$setshare = set_share($uid, $lid, $_GET['submit'], $dbCon);
if($setshare != 'TRUE'){
	echo $setshare;
} else {
	header("Location: sharing.php");
}
	
?>