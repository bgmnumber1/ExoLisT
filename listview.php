<?php
session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	//header("Cache-control: no-store, no-cache, must-revalidate");
	//header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	//header("Pragma: no-cache");
	//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['page'])){
	if($_SESSION['page'] != ''){
		$_SESSION['page'] = '';
	}
}
if (isset($_SESSION['lid'])){
	if($_SESSION['lid'] != ''){
		$_SESSION['lid'] = '';
	}
}
if (isset($_SESSION['url'])){
	if($_SESSION['url'] != ''){
		$_SESSION['url'] = '';
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
	$currentpage = $_SERVER['PHP_SELF'];
	preg_match('/\/[a-z0-9]+.php/', $_SERVER['HTTP_REFERER'], $match);
	$page = array_shift($match);
	$_SESSION['page'] = $currentpage;
	if ($page == "/user.php"){ }
	$_SESSION['title'] = $_GET['submit'];
  

   


preg_match('/\/[a-z0-9]+.php/', $url, $match);

$page = array_shift($match);

if ($page == "/user.php"){
$_SESSION['title'] = $_GET['submit'];
}

//function to verfiy list ownership or if list is shared
//if test fails show error - do not have ascces to lsit
//if pass execute the following code:
	

$lid = $_GET['id'];
$_SESSION['lid'] = $lid;

$getitem_sql = "SELECT * FROM lists WHERE id = '$lid'";
$items = mysqli_query($dbCon, $getitem_sql);
$row = mysqli_fetch_array($items);
$_SESSION['title'] = $row['title'];

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
	</h3>
		<form id="checker" action="checker.php" method="GET" />
		<ul data-role="listview" data-filter="true">    
		<?php 		
			
			while($row = mysqli_fetch_array($items)) {
				$eid = get_eid($lid, $uid, $row['content'], $dbCon);
		
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
							<td>
								<?php echo $row['content']; ?>
							</td>
							<td>
								<form id="delete_item" action="delete_item.php" method="GET">
									<input type="submit" value="<?php echo $row['content']; ?>" name="submit" form="delete_item" data-role="button" data-icon="delete" data-iconpos="notext" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-theme="c" title="Delete" class="ui-btn ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext ui-btn-up-c"/>
								</form>
							</td>
						<tr>
					</table>
							 
				</li>
	 		 	
	 		 <?php
			}
			$_SESSION['item'] = $item;
			mysqli_close($dbCon);
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
		 			<li><a href="new_item.php">Add Item</a></li>
		 			<li><a href="sharing.php">Sharing</a></li>
					<li><a href="delete_list.php">Delete List</a></li>
					<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	</div>

</body>
</html>