<div id="search">
	<form action="<?php echo $url;?>search" method="post">						
		<fieldset>
			<input type="text" name="search" placeholder="Search:" value="<?php echo ifsetor($_POST['search']); ?>"/>
		</fieldset>

		<fieldset>
			<input type="radio" name="searchby" value="title" <?php echo ((isset($_POST['searchby'])) && ($_POST['searchby'] == 'description')) ? null : 'checked';?>><label>Title</label>
			<input type="radio" name="searchby" value="description" <?php echo ((isset($_POST['searchby'])) && ($_POST['searchby'] == 'description')) ? 'checked' : null;?>><label>Description</label>				
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