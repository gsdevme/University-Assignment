<?php for($holidays;$holidays->valid();$holidays->next()): ?>
	<!-- Holiday class, with Image, Title, PubDate, Offer and Description -->
	<div class="holidays">
		<img src="<?php echo $img;?>transparent.gif" alt="<?php echo $holidays->current()->title; ?>" class="grabHolidayImages" title="<?php echo $url . 'proxy.php?url=' . $holidays->current()->guid; ?>"/>

		<div class="text">
			<h2><a href="<?php echo $holidays->current()->guid; ?>" target="_blank" title="<?php echo $holidays->current()->title; ?>"><?php echo $holidays->current()->title; ?></a> [<?php echo $holidays->current()->pubDate; ?>]</h2>
			<h4><?php echo $holidays->current()->offer; ?></h4>

			<p><?php echo $holidays->current()->description; ?></p>
		</div>
	</div>					
<?php endfor; ?>