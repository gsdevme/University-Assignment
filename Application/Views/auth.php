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
			<?php $this->element('breadcrumb'); ?>

			<!-- Left is left, limited to 600 pixels wide -->
			<div id="left">
				<?php if(isset($message)): ?>
					<div class="error"><p><?php echo $message; ?></p></div>
				<?php endif; ?>

				<?php $this->element($form); ?>				
			</div>

			<!-- Right is right, limited to 340 pixels wide -->
			<div id="right">
				<?php $this->element('right');?>
			</div>
		</div>

		<!-- all thats left is our footer now.. -->
		<?php $this->element('footer'); ?>

		<script src="<?php echo $js;?>ajax.js"></script>
		<script src="<?php echo $js;?>holidayImages.js"></script>
		<script src="<?php echo $js;?>font.js"></script>
	</body>
</html>