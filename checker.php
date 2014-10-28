<?php
	session_start();
	include("includes/dbConnect.php");
	include("includes/functions.php");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	$item = array();
	$item = $_SESSION['item'];
	$uid = $_SESSION['id'];
	$lid = $_GET['lid'];
	$lid = strip_tags($lid);
	$lid = mysqli_real_escape_string($dbCon, $lid);
	$title = get_listitle($lid, $dbCon);
	 while (list($var, $val) = each($item)) {
        if($_GET[$val] == $val){
			$val = strip_tags($val);
			$val = mysqli_real_escape_string($dbCon, $val);
        	check_listitem($val, $dbCon);
        } else {
			$val = strip_tags($val);
			$val = mysqli_real_escape_string($dbCon, $val);
        	uncheck_listitem($val, $dbCon);
        }
    }
    
    if (isset($_SESSION['item'])){
		if ($_SESSION['item'] != ''){
			$_SESSION['item'] = '';
		}
	}
	if ($_SESSION['item'] == ''){
		?>
		<html> 
			<head>
				<title>ExoLisT - Success!</title>	
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
				<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
				<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
			</head>
			<body>
				<div data-role="page">
 		 			<div data-role="header">
  						<h1 class="ui-title" role="heading" aria-level="1">ExoLisT - Success!</h1>
  					</div>
  			 		<div data-role="main" class="ui-content">
  						<h2>List <?php echo $title; ?> has been updated successfully!</h2>
  						<p><a href="listview.php?id=<?php echo $lid; ?>" data-role="button">Return</a></p>
					</div>
				</div>
			</body>
		</html>
		
		
		
		
		
		
		<?php
	}

?>