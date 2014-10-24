<?php
session_start();
include("includes/dbConnect.php");
include("includes/functions.php");
header("Cache-control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	//processing new list into database
		$listitle = mysqli_real_escape_string($dbCon, $_POST['nlist_title']);
		$listype = mysqli_real_escape_string($dbCon, $_POST['listype']);
		$uid = $_SESSION['id'];
		$sql = "INSERT INTO lists (id, uid, title, type)
			VALUES ('', '$uid', '$listitle', '$listype')";
		$isdup = dupcheck_listitle($listitle, $uid, $dbCon);
		// This makes sure that the cookies are not reset when looping this form through "addnew.php" to add items to a list
		if ($_SESSION['title'] == ''){
			$_SESSION['title'] = $listitle;
			}
		// When user selects cancel on create new list form on "newlst.php" this redirects back to the main user page "user.php"
		if ($_POST['submit'] == "Cancel"){
			error_reporting(E_ERROR | E_PARSE);
			header("Location: user.php", true, 303);
		}
		if ($listype == ''){
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
  								<h1>ExoLisT - Error</h1>
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
  									<h1>ExoLisT - Error</h1>
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
  										<h1>ExoLisT - Error</h1>
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
			  			die('' . mysqli_error($dbCon));  			
					}
					else { 	
							header("Location: new_item.php");
						}
					}
				}
			}
		
?>