<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	
	$lid = $_GET['lid'];
	$cont = $_GET['content'];
	$uid = $_SESSION['id'];
	$listitle = $_SESSION['title'];
	$submit = $_GET['submit'];
	if($submit == "Add"){
		$result = addcontent($uid, $lid, $cont, '', $dbCon);
		$submit = '';
		header("Location: new_item.php?lid=$lid");
	}elseif($submit == "No More"){
		$_SESSION['title'] = '';
		$_SESSION['reload'] = "TRUE";
		header("Location: listview.php?id=$lid");
	}
	else {
		?>
			<html>
				<p>Unknown Error: You should definitely not be seeing this.</p>
			</html>
		
		<?php
	}

?>