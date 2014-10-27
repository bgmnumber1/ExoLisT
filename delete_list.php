<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	$lid = $_GET['lid'];
	$uid = $_SESSION['id'];
	$listitle = get_listitle($lid, $dbCon);
	
	if(isset($_GET['Yes'])){
	    $delistitems_sql="DELETE FROM list_content WHERE lid = '$lid' AND uid = '$uid'";
	    $items = mysqli_query($dbCon, $delistitems_sql);
		if($items != 'TRUE'){
			?>
				<html> 
					<head>
						<title>ExoLisT - Success</title>	
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
		  					</div>
		  			 		<div data-role="main" class="ui-content">
		  						<h2>Items from <? echo $listitle; ?> could not be deleted. <? echo "(".$items.")"; ?> </h2>
									<a href="listview.php?lid=<?php echo $lid; ?>" data-role="button">Back to List View</a>
							</div>
						</div>
					</body>
				</html>
			<?
		}
	    $delist_sql="DELETE FROM `lists` WHERE `id` = '$lid' AND `uid` = '$uid'";
	    $list = mysqli_query($dbCon, $delist_sql);
		if($list != 'TRUE'){
			?>
				<html> 
					<head>
						<title>ExoLisT - Success</title>	
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
		  					</div>
		  			 		<div data-role="main" class="ui-content">
		  						<h2><? echo $listitle; ?> could not be deleted. <? echo "(".$list.")"; ?> </h2>
									<a href="listview.php?lid=<?php echo $lid; ?>" data-role="button">Back to List View</a>
							</div>
						</div>
					</body>
				</html>
			<?
		}
		?>
			<html> 
				<head>
					<title>ExoLisT - Success</title>	
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
	  					</div>
	  			 		<div data-role="main" class="ui-content">
	  						<h2><? echo $listitle; ?> was sucessfully deleted <? echo $_GET['Yes']; ?></h2>
								<a href="user.php" data-role="button">Back to Lists</a>
						</div>
					</div>
				</body>
			</html>
		<?
	}

	
			 ?>
		<html> 
			<head>
				<title>ExoLisT - Success</title>	
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
  					</div>
  			 		<div data-role="main" class="ui-content">
  						<h2>Are you sure you want to delete <? echo $listitle; ?> <? echo "(".$lid.")"; ?> <? echo "(".$uid.")"; ?></h2>
						<form id="delist" action="delete_list.php" method="GET">
  							<input type="submit" value="Yes" name='Yes' />
							<a href="listview.php?lid=<? echo $lid; ?>" data-role="button">No</a>
						</form>
					</div>
				</div>
			</body>
		</html>

			<?php


?>