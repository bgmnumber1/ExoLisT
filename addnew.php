<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	
	
	$cont = $_POST['content'];
	$uid = $_SESSION['id'];
	$listitle = $_SESSION['title'];
	$submit = $_POST['submit'];
	if($_SESSION['lid'] == ''){	
		$lid = get_lid($uid, $listitle, $dbCon);
		$_SESSION['lid'] = $lid;
	}
	$lid=$_SESSION['lid'];
	if($submit == "Add"){
		$result = addcontent($uid, $lid, $cont, '', $dbCon);
		$submit = '';
		header("Location: new_item.php");
	}elseif($submit == "No More"){
		$_SESSION['title'] = '';
		if (basename($_SESSION['page']) == "listview.php"){
			header("Location: listview.php?id=$lid");
		 } else {
			$_SESSION['reload'] = "TRUE";
			header("Location: user.php");
		 }
	}
	else {
		?>
			<html>
				<p>Unknown Error: You should definitely not be seeing this.</p>
			</html>
		
		<?php
	}

?>