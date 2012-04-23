<!DOCTYPE html>
<html lang="en">
	<head>		
		<!-- Lets get our CSS and charset sorted. -->
		<?php $this->element('meta'); ?>
	</head>
	
	<body>	
		<!---
			THIS VIEW IS ONLY USED FOR DISPLAYING 404 Errors
		-->

		<!-- load our header element, same across all pages -->
		<?php $this->element('header'); ?>

		<!-- wrap our homepage within a 960 and mainpage -->
		<div class="container-960 mainpage">
			<h1>404 - Not Found</h1>
			<p>It looks like this page doesn't exit !</p>
		</div>

		<!-- all thats left is our footer now.. -->
		<?php $this->element('footer'); ?>
	</body>
</html>