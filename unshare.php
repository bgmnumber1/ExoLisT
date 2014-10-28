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
$uid = mysqli_real_escape_string($dbCon, $uid);
$suid = $_GET['suid'];
$suid = strip_tags($suid);
$suid = mysqli_real_escape_string($dbCon, $suid);
$unshare = unshare($lid, $suid, $dbCon);
if($unshare != 'TRUE'){
	echo $unshare;
	
} else {
	header("Location: sharing.php");
}
?>