<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>ExoLisT-Contact Info</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="includes/jquery.mobile-1.4.2.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
 
<body>
<div data-role="page">

  	 <div data-role="header" style="background-color:green;color:white;">
		<h1 class="ui-title" role="heading" aria-level="1" style="font-weight:normal">ExoLisT-Contact Info</h1>
		<a href="javascript:history.back();" class="ui-btn-right ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-role="button" data-inline="true" data-icon="back" data-theme="e">Back...</a>
	</div>
	<div data-role="main" class="ui-content">
		<table align="center">
			<tr>
				<th>Developer</th>
				<td>Alec Sokso</td>
			</tr>
			<tr>
				<th>Email Me</th>
				<td><a href="mailto:alec.sokso@icloud.com?Subject=Exolist%20User%20Inquiry" target="_top">alec.sokso@icloud.com</a></td>
			</tr>
			<tr>
				<th>Call Me</th>
				<td>1-484-524-3531</td>
			</tr>
		
		</table>
		<div align="center">
			<h4>Message from Developer</h2>
			<p>If you email or call me I will do my best answer your messages as quickly and efficiently as possible. ~Alec</p>
			<p> If I am not available you can always reference the <a href="#" style="font-weight:normal;">user documentation</a>.</p>
		</div>
	</div>
</div>