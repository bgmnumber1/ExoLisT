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
			if($submit == "Add"){
				$lidsql = "SELECT id FROM lists WHERE uid = '$uid' AND title = '$listitle'";
				$lid_query = mysqli_query($dbCon, $lidsql);
				$lid_array=mysqli_fetch_assoc($lid_query);
				$lid=$lid_array['id'];
				$result = addcontent($uid, $lid, $cont, '', $dbCon);
				$submit = '';
				header("Location: new_item.php");
			}
			elseif($submit == "No More"){
				$_SESSION['title'] = '';
				if (basename($_SESSION['page']) == "listview.php"){
					header("Location: listview.php?submit=$listitle");
				 } else {
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