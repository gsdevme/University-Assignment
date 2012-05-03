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

<div class="fontsize">
	<ul>

		<li><a href="#increase" onclick="font.increase();return false;">Increase Font Size</a></li>
		<li><a href="#decrease" onclick="font.decrease();return false;">Decrease Font Size</a></li>
	</ul>
</div>

<p>
    <a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fwww.numyspace.co.uk%2F~unn_w11025228%2Fhome&profile=css3&usermedium=all&warning=1&vextwarning=&lang=en">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
</p>

<p>
    <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.numyspace.co.uk%2F~unn_w11025228%2Fhome&charset=%28detect+automatically%29&doctype=Inline&group=0"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>

<h3><a href="<?php echo $url;?>readme.txt">readme.txt for the assignment is provided here</a></h3><br/>
<h3><a href="<?php echo $url;?>docs/namespace-None.html">apigen documentation</a></h3><br/>
<h3><a href="<?php echo $url;?>git.log.txt">GIT Commit log for the assignment is provided here</a></h3>