<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");	
	$lid=$_GET['lid'];
	$lid = strip_tags($lid);
	$lid = mysqli_real_escape_string($dbCon, $lid);
	$cont = $_GET['content'];
	$uid = $_SESSION['id'];
	$listitle = get_listitle($lid, $dbCon);
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