<!DOCTYPE html>
<html lang="en">
	<head>		
		<!-- Lets get our CSS and charset sorted. -->
		<?php $this->element('meta'); ?>
	</head>
	
	<body>	
		<!---
			THIS VIEW IS ONLY USED FOR DISPLAYING EXCEPTIONS, NOTHING MORE
		-->

		<!-- load our header element, same across all pages -->
		<?php $this->element('header'); ?>

		<!-- wrap our homepage within a 960 and mainpage -->
		<div class="container-960 mainpage">
			<?php if(isset($exception)): ?>
				<h2>Line <?php echo $exception->getLine(); ?> Trigged: <?php echo $exception->getMessage(); ?></h2>
				<h4>File: <?php echo $exception->getFile(); ?></h4>

				<table>
					<?php foreach((array)$exception->getTrace() as $trace): ?>
						<tr>
							<?php foreach($trace as $property => $value): ?>
								<td><?php echo $value; ?></td>							
							<?php endforeach; ?>						
						<tr>
					<?php endforeach; ?>
				</table>
			<?php endif; ?>
		</div>

		<!-- all thats left is our footer now.. -->
		<?php $this->element('footer'); ?>
	</body>
</html>