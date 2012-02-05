<!DOCTYPE html>
<html lang="en">
	<head>		
		<!-- Lets get our CSS and charset sorted. -->
		<?php $this->element('meta'); ?>
	</head>
	
	<body>	
		<!-- load our header element, same across all pages -->
		<?php $this->element('header'); ?>

		<!-- wrap our homepage within a 960 and mainpage -->
		<div class="container-960 mainpage">

			<!-- Left is left, limited to 600 pixels wide -->
			<div id="left">

				<!-- Lets now load our holiday list element -->
				<?php if(isset($holidays)): ?>
					<?php $this->element('holidaysList'); ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- all thats left is our footer now.. -->
		<?php $this->element('footer'); ?>

		<script src="<?php echo $js;?>ajax.js"></script>
		<script src="<?php echo $js;?>holidayImages.js"></script>
	</body>
</html>