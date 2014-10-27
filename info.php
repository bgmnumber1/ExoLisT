<?php
	include("includes/functions.php");
	include("includes/dbConnect.php");
	$items = delete_listitems('60','1', $dbCon);
	$list = delete_list('60', $dbCon);
?>
