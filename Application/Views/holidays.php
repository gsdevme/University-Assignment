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

				<!-- Lets now load our holiday list element -->
				<?php if(isset($holidays)): for($holidays;$holidays->valid();$holidays->next()): ?>
					<!-- Holiday class, with Image, Title, PubDate, Offer and Description -->
					<div class="holidays">
						<a href="<?php echo $holidays->current()->guid; ?>" target="_blank" title="<?php echo $holidays->current()->title; ?>">
							<img src="<?php echo $img;?>transparent.gif" alt="<?php echo $holidays->current()->title; ?>" class="grabHolidayImages" data-holidays-image="<?php echo $url . 'proxy.php?url=' . $holidays->current()->guid; ?>"/>
						</a>

						<div class="text">
							<?php if(isset($user)): ?>
								<div class="fav">
									<?php if(isset($savedHolidays, $savedHolidays[$holidays->current()->id])): ?>
										<a href="<?php echo $url;?>favourites/toggle/<?php echo urlencode(base64_encode($holidays->current()->guid)); ?>" title="Remove from Favourites"><img src="<?php echo $img; ?>remove.png" alt="Remove from Favourites"></a>
									<?php else: ?>
										<a href="<?php echo $url;?>favourites/toggle/<?php echo urlencode(base64_encode($holidays->current()->guid)); ?>" title="Add to Favourites"><img src="<?php echo $img; ?>add.png" alt="Add to Favourites"></a>
									<?php endif; ?>
								</div>
							<?php else: ?>
								<div class="fav">
									<a href="<?php echo $url;?>auth/login/<?php echo urlencode(base64_encode('You must login to use thise feature')); ?>" title="Add to Favourites"><img src="<?php echo $img; ?>add.png" alt="Add to Favourites"></a>
								</div>							
							<?php endif; ?>

							<h2><a href="<?php echo $holidays->current()->guid; ?>" target="_blank" title="<?php echo $holidays->current()->title; ?>"><?php echo $holidays->current()->title; ?></a> [<?php echo $holidays->current()->pubDate; ?>]</h2>
							<h4><?php echo $holidays->current()->offer; ?></h4>

							<p><?php echo $holidays->current()->description; ?></p>
						</div>
					</div>				
				<?php endfor; ?>
				<?php else: ?>
					<p>No Holidays saved.</p>
				<?php endif; ?>
			</div>

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