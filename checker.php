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
	
	 while (list($var, $val) = each($item)) {
        if($_GET[$val] == $val){
        	check_listitem($val, $dbCon);
        } else {
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
  						<h2>List <?php echo $_SESSION['title']; ?> has been updated successfully!</h2>
  						<p><a href="javascript:history.go(-1)" data-role="button">Return</a></p>
					</div>
				</div>
			</body>
		</html>
		
		
		
		
		
		
		<?php
	}

?>