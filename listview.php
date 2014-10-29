<?php
session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['lid'])){
	if($_SESSION['lid'] != ''){
		unset($_SESSION['lid']);
	}
}
if (isset($_SESSION['item'])){
	if($_SESSION['item'] != ''){
		unset($_SESSION['item']);
	}
}
if (isset($_SESSION['id'])) {
	// Put stored session variables into local PHP variable
	$uid = $_SESSION['id'];
	$uid = strip_tags($uid);
	$uid = mysqli_real_escape_string($dbCon, $uid);
	$usname = $_SESSION['username'];
	$result = "Welcome ".$usname ;
} else {
		 ?>
		<html> 
			<head>
				<title>ExoLisT - ERROR</title>	
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header" style="background-color:green;color:white;">
  						<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - ERROR</h1>
  					</div>
  			 		<div data-role="main" class="ui-content">
  						<h2>You are not logged in yet</h2>
  						<p><a href="index.php" data-role="button">Please try again</a></p>
					</div>
				</div>
			</body>
		</html>

			<?php
}

$lid = $_GET['id'];
//function to verfiy list ownership or if list is shared
$isown = usercheck($lid, $uid, $dbCon);
if($isown == "FALSE"){
	?>
		<html>
			<head>
				<title>ExoLisT - ERROR</title>	
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header" style="background-color:green;color:white;">
						<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">Exolist</h1>
					</div>
					<div data-role="main">
						<p>You do not own the list with id <?php $lid; ?></p>
						<a href="user.php">Back to User page</a>
					</div>
			<body>
			
		</html>
	<?
}
$lid = strip_tags($lid);
$lid = mysqli_real_escape_string($dbCon, $lid);
$_SESSION['lid'] = $lid;

$getitem_sql = "SELECT * FROM lists WHERE id = '$lid'";
$items = mysqli_query($dbCon, $getitem_sql);
$row = mysqli_fetch_array($items);
$listitle = $row['title'];
$listype = get_listype($lid, $dbCon);
$getitem_sql = "SELECT * FROM list_content WHERE lid = '$lid'";
$items = mysqli_query($dbCon, $getitem_sql);
$count=0;
$item = array();
$title = get_listitle($lid, $dbCon);
$shartest_sql = "SELECT title FROM lists WHERE uid = '$uid' AND id = '$lid'";
$shartest = mysqli_query($dbCon, $shartest_sql);
$shart = mysqli_fetch_array($shartest);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>ExoLisT-<?php echo $usname ;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
<div data-role="page">

  	 <div data-role="header" style="background-color:green;color:white;">
		<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT</h1>
		<a href="user.php" class="ui-btn-right ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-role="button" data-inline="true" data-icon="back" data-theme="e">Back...</a>
	</div>
	<div data-role="main" class="ui-content">
	<h3><?php 
			echo $title;
			?>
			 
			<?php
			echo "(".$lid.")";
			?>
	</h3>
	<h4>
		<?php
		if($shart['title'] == ''){
			$sharuser = get_sharuser($lid, $uid, $dbCon);
			echo "Shared by: ".$sharuser;
		}
		?>
	</h4>
		<form id="checker" action="checker.php" method="GET" >
			<input type="hidden" name="lid" value="<?php echo $lid; ?>">
			</form>
		<ul data-role="listview" data-filter="true">    
		<?php 		
			
			while($row = mysqli_fetch_array($items)) {
				$eid = $row['eid'];
		
			?>
				<li>
					<table>
						<col style="width:16%">
        				<col style="width:80%">
       					<col style="width:4%">
						<tr>	
							<td>
								<?php 
								
									$item[$count] = $eid;
									$count++;
									$checked_item = ischecked($eid, $dbCon);
									if($listype != "Memo"){
								?>
									<input type="checkbox" name="<?php echo $eid; ?>" value="<?php echo $eid; ?>" form="checker" <?php echo $checked_item; ?> />
								<?php 
									} else {
									?>
										<h3>~</h3>
									<?php
									}
								
								?>
								
							</td>
							<td style="white-space: normal">
								<?php echo $row['content']; ?>
							</td>
							<td>
								<a href="delete_item.php?lid=<?php echo $lid."&";?>eid=<?php echo $row['eid']; ?>" data-role="button" data-icon="delete" data-iconpos="notext" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-theme="c"></a>	
							</td>
						<tr>
					</table>
							 
				</li>
	 		 	
	 		 <?php
			}
			$_SESSION['item'] = $item;
			
		 ?>
		 </ul>
		 <br>
		 <p><?php echo $count; ?> items in <?php echo $listitle; ?> </p>
		 <br>
		 <ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d"><?php
		 			if($listype != "Memo"){
		 			?>
		 			<li><input type="submit" name="submit" value='Update' form="checker" /></li>
		 			<?php
		 			}
		 			?>
		 			<li><a href="new_item.php?lid=<?php echo $lid; ?>">Add Item</a></li>
					<?php
					if($shart['title'] != ''){
					?>
		 			<li><a href="sharing.php">Sharing</a></li>
					<?php
					}
					if($shart['title'] != ''){
					?>
					<li><a href="delete_list.php?lid=<?php echo $lid; ?>">Delete List</a></li>
					<?php
					} else {
						?>
					<li><a href="unshare_lst.php">Unshare List</a></li>
						<?php
					}
					?>
					<li><a href="logout.php">Logout</a></li>
		</ul>
		<?php
		mysqli_close($dbCon);
		?>
	</div>
	</div>

</body>
</html>