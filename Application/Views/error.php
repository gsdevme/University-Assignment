<!DOCTYPE html>
<html lang="en">
	<head>		
		<?php $this->element('meta'); ?>
	</head>
	
	<body>		
		<h1>PHP Error</h1>

		<p><?php pre($exception->getMessage()); ?></p>

		<?php echo '<pre>' . print_r($exception, true) . '</pre>'; ?>
	</body>
</html>