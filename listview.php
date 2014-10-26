<?php
session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['page'])){
	if($_SESSION['page'] != ''){
		$_SESSION['page'] = '';
	}
}
if (isset($_SESSION['lid'])){
	if($_SESSION['lid'] != ''){
		unset($_SESSION['lid']);
	}
}
if (isset($_SESSION['url'])){
	if($_SESSION['url'] != ''){
		unset($_SESSION['url']);
	}
}
if (isset($_SESSION['title'])){
	if($_SESSION['title'] != ''){
		unset($_SESSION['title']);
	}
}
$_SESSION['url'] = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
if (isset($_SESSION['id'])) {
	// Put stored session variables into local PHP variable
	$uid = $_SESSION['id'];
	$usname = $_SESSION['username'];
	$result = "Welcome ".$usname ;
} else {
	error_reporting(E_ERROR | E_PARSE);
		 ?>
		<html> 
			<head>
				<title>ExoLisT - ERROR</title>	
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header">
  						<h1>ExoLisT - ERROR</h1>
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
error_reporting(E_ALL ^ E_NOTICE);
	$_GET['submit'] = $form;
	$form = strip_tags($form);
	$form = mysqli_real_escape_string($dbCon, $form);
	$_SESSION['title'] = $form;
  
//function to verfiy list ownership or if list is shared
//if test fails show error - do not have ascces to lsit
//if pass execute the following code:
	

$lid = $_GET['id'];
$_SESSION['lid'] = $lid;

$getitem_sql = "SELECT * FROM lists WHERE id = '$lid'";
$items = mysqli_query($dbCon, $getitem_sql);
$row = mysqli_fetch_array($items);
$listitle = $_SESSION['title'] = $row['title'];
$listype = get_listype($lid, $dbCon);
$getitem_sql = "SELECT * FROM list_content WHERE lid = '$lid'";
$items = mysqli_query($dbCon, $getitem_sql);
$count=0;
$item = array();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>ExoLisT-<?php echo $usname ;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
<div data-role="page">

  	 <div data-role="header">
		<h1 class="ui-title" role="heading" aria-level="1">ExoLisT</h1>
		<a href="user.php" class="ui-btn-right ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-role="button" data-inline="true" data-icon="back" data-theme="e">Back...</a>
	</div>
	<div data-role="main" class="ui-content">
	<h3><?php 
			echo $_SESSION['title']; 
			?>
			 
			<?php
			echo "(".$lid.")";
			?>
	</h3>
		
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
								<form id="checker" action="checker.php" method="GET" >
									<input type="checkbox" name="<?php echo $eid; ?>" value="<?php echo $eid; ?>" form="checker" <?php echo $checked_item; ?> />
								</form>
								<?php 
									} else {
									?>
										<h3>~</h3>
									<?php
									}
								
								?>
								
							</td>
							<td>
								<?php echo $row['content']; ?>
							</td>
							<td>
								<form id="delete_item" action="delete_item.php" method="GET">
									<input type="submit" value="<?php echo $row['eid']; ?>" name="submit" form="delete_item" data-role="button" data-icon="delete" data-iconpos="notext" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-theme="c" title="Delete" class="ui-btn ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext ui-btn-up-c" />
								</form>
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
					$shartest_sql = "SELECT title FROM lists WHERE uid = '$uid' AND id = '$lid'";
					$shartest = mysqli_query($dbCon, $shartest_sql);
					$shart = mysqli_fetch_array($shartest);
		 			?>
		 			<li><a href="new_item.php">Add Item</a></li>
					<?php
					if($shart['title'] != ''){
					?>
		 			<li><a href="sharing.php">Sharing</a></li>
					<?php
					}
					if($shart['title'] != ''){
					?>
					<li><a href="delete_list.php">Delete List</a></li>
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