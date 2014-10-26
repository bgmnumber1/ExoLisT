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
	$list = $_SESSION['title'];
	$count = 0;
	$ismine = ismine_list($uid, $lid, $dbCon);
    $getshare_sql="SELECT suid FROM list_share WHERE lid = '$lid'";
    $getshare = mysqli_query($dbCon, $getshare_sql);
	if (isset($_POST['searchcont'])){
		$searchent = mysqli_real_escape_string($dbCon, strip_tags($_POST['searchcont']));
		$search = "%".$searchent."%";
	    $searchuser = array();
		if($_POST['searchtype'] == "name"){
	    $searchlistuser_sql="SELECT * FROM user WHERE fname LIKE '$search' OR lname LIKE '$search'";
		} 
		if($_POST['searchtype'] == "email"){
		$searchlistuser_sql="SELECT * FROM user WHERE email LIKE '$search'";	
		}
		if($_POST['searchtype'] == "id"){
		$searchlistuser_sql="SELECT * FROM user WHERE id = '$searchent'";	
		}
	    $search_query = mysqli_query($dbCon, $searchlistuser_sql);
	}
	if ($ismine == '1'){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>ExoLisT-Sharing</title>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
 
			<body>
				<div data-role="page">

					<div data-role="header">
						<h1 class="ui-title" role="heading" aria-level="1">ExoLisT - Sharing</h1>
						<a href="listview.php?submit=<? echo $list; ?>" class="ui-btn-right ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-role="button" data-inline="true" data-icon="back" data-theme="e">Back...</a>
					</div>
				<div data-role="main" class="ui-content">
					<form id="search" action="sharing.php" method="POST">
						<input type="text" name="searchcont" placeholder="Search people to share with" />
						<select name="searchtype">
						  <option value="name">Name</option>
						  <option value="email">Email</option>
						  <option value="id">ID</option>
						</select>
						<input type="submit" value="Search" name="Search" />
					</form>
					<?php
					if(isset($search_query)){
						 ?>
						<ul data-role="listview" data-filter="true">
							<?php
							while($row = mysqli_fetch_array($search_query)){
								?>
								<li>
									<table>
				        				<col style="width:5%">
				       					<col style="width:95%">
										<tr>
											<td>
												<form id="sharecs" action="share.php" method="GET">
													<input type="submit" value="<?php echo $row['id']; ?>" name="submit" data-role="button" data-icon="arrow-l" data-iconpos="notext" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-theme="c" title="Delete" class="ui-btn ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext ui-btn-up-c"/>
												</form>
											</td>
											<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </td>
										</tr>
									</table>
								</li>
								<?php
							}
							?>
						</ul>
						<?php }
					}
						?>
						<ul data-role="listview" data-filter="true">
							<?php 
							while($row1 = mysqli_fetch_array($getshare)){
								$id = $row1['suid'];
								$getsharename_sql = "SELECT id, fname, lname FROM user WHERE id = '$id'";
								$getsharename = mysqli_query($dbCon, $getsharename_sql);
								$row2 = mysqli_fetch_array($getsharename);
							
								?>
								<li>
									<table>
										<tr>
											<td>
												<form id="unsharecs" action="unshare.php" method="GET">
													<input type="submit" value="<?php echo $row2['id']; ?>" name="submit" data-role="button" data-icon="delete" data-iconpos="notext" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-theme="c" title="Delete" class="ui-btn ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext ui-btn-up-c"/>
												</form>
											</td>
											<td><?php echo $row2['fname']; ?> <?php echo $row2['lname']; ?></td>
										</tr>
									</table>
								</li>
								<?php
							}
							?>
						</ul>
				</div>
				</div>
			</body>
			</html>
		<?php


?>