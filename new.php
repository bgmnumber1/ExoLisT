<?php
session_start();
include("includes/dbConnect.php");
include("includes/functions.php");
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	//processing new list into database
		$listitle = mysqli_real_escape_string($dbCon, strip_tags($_GET['nlist_title']));
		$listype = mysqli_real_escape_string($dbCon, strip_tags($_GET['listype']));
		$uid = $_SESSION['id'];
		$uid = strip_tags($uid);
		$uid = mysqli_real_escape_string($dbCon, $uid);
		$sql = "INSERT INTO lists (id, uid, title, type)
			VALUES ('', '$uid', '$listitle', '$listype')";
		$isdup = dupcheck_listitle($listitle, $uid, $dbCon);
		// When user selects cancel on create new list form on "newlst.php" this redirects back to the main user page "user.php"
		if ($_GET['submit'] == "Cancel"){
			$_SESSION['reload'] = "TRUE";
			header("Location: user.php");
		}
		if ($listype == ''){
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
  								<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Error</h1>
  							</div>
  							<div data-role="main" class="ui-content"> 
								<p>You must select a list type!</p>
								<p><a href="newlst.php" data-role="button">Try Again</a></p>
							</div>
						</div>
					</body>
				</html>

			<?php 
			
		}
		else {
			if ($listitle == ''){
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
  									<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Error</h1>
  								</div>
  								<div data-role="main" class="ui-content"> 
									<p>You must input a list title!</p>
									<p><a href="newlst.php" data-role="button">Try Again</a></p>
								</div>
							</div>
						</body>
					</html>	

				<?php 
				}
			else {
				if ($isdup != '0'){
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
  										<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT - Error</h1>
  									</div>
  									<div data-role="main" class="ui-content"> 
										<p>You cannot have 2 lists with the same name!</p>
										<p><a href="newlst.php" data-role="button">Try Again</a></p>
									</div>
								</div>
							</body>
						</html>	

					<?php	
				}
				else{
					if (mysqli_query($dbCon,$sql) == '') {
			  			die('List not created' . mysqli_error($dbCon));  			
					}
					else { 	
						$_SESSION['reload'] = "TRUE";
						header("Location: user.php");
						}
					}
				}
			}
		
?>