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
$uid = strip_tags($uid);
$uid = mysqli_real_escape_string($dbCon, $uid);	$uid = strip_tags($uid);
$uid = mysqli_real_escape_string($dbCon, $uid);
$unshare = unshare($lid, $uid, $dbCon);
if($unshare != 'TRUE'){
	echo $unshare;
	
} else {
	$_SESSION['reload'] = "TRUE";
	header("Location: user.php");

}
?>