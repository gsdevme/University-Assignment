<div id="search">
	<form action="<?php echo $url;?>search" method="post">						
		<fieldset>
			<input type="text" name="search" placeholder="Search:"/>
		</fieldset>

		<fieldset>
			<input type="radio" name="searchby" value="title" checked><label>Title</label>
			<input type="radio" name="searchby" value="description"><label>Description</label>				
			<input type="submit" value="Search"/>
		</fieldset>						
	</form>
</div>

<div class="imageDisplay" style="background:url('<?php echo $img;?>generic-holiday-image.jpg');">
	<div>
		<h3>Family Activity Holiday to Slovakia</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus adipiscing ligula a ligula fermentum luctus</p>
	</div>
</div>

<div class="imageDisplay" style="background:url('<?php echo $img;?>generic-holiday-image1.jpg');">
	<div>
		<h3>Family Safari Holidays to Namibia</h3>
		<p>Nulla a libero metus. Integer gravida tempor metus eget condimentum. Integer eget iaculis tortor. Nunc sed ligula sed augue rutrum ultrices eget nec odio.</p>
	</div>
</div>