<!-- header with Site title and slogan. -->
<header>
	<div class="container-960">
		<h1><a href="<?php echo $url;?>home" title="Visit Newcastle">Second Rate Holidays</a></h1>
		<h2>all inclusive holidays</h2>

		<!-- Navigation with two images instead of the text -->
		<nav>
			<ul>
				<li><a href="<?php echo $url;?>home" title="Homepage"><img src="<?php echo $img;?>home.png" alt="Homepage"/></a></li>
				<li><a href="<?php echo $url;?>favourite" title="Favourites"><img src="<?php echo $img;?>favourite.png" alt="Favourite"/></a></li>
				<li><a href="<?php echo $url;?>whatson" title="What's On">What's On</a></li>
				<li><a href="<?php echo $url;?>places" title="Places">Places</a></li>
				<li><a href="<?php echo $url;?>holidays" title="Holidays">Holidays</a></li>
			</ul>
		</nav>	

		<div id="accounts">
			<ul>
				<li><a href="<?php echo $url;?>auth/signup" title="Signup">Signup</a></li>
				<li><a href="<?php echo $url;?>auth/login" title="Login">Login</a></li>
			</ul>
		</div>
	</div>
</header>