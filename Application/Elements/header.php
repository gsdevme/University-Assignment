<!-- header with Site title and slogan. -->
<header>
	<div class="container-960">
		<h1><a href="<?php echo $url;?>home" title="Visit Newcastle">Second Rate Holidays</a></h1>
		<h2>all inclusive holidays</h2>

		<!-- Navigation with two images instead of the text -->
		<nav>
			<ul>
				<li class="<?php echo ($controller == 'Home') ? 'active' : null; ?>"><a href="<?php echo $url;?>home" title="Homepage"><img src="<?php echo $img;?>home.png" alt="Homepage"/></a></li>
				<li class="<?php echo ($controller == 'favourites') ? 'active' : null; ?>"><a href="<?php echo $url;?>favourites" title="Favourites"><img src="<?php echo $img;?>favourite.png" alt="Favourite"/></a></li>
				<li class="<?php echo ($controller == 'whatson') ? 'active' : null; ?>"><a href="<?php echo $url;?>whatson" title="What's On">What's On</a></li>
				<li class="<?php echo ($controller == 'places') ? 'active' : null; ?>"><a href="<?php echo $url;?>places" title="Places">Places</a></li>
			</ul>
		</nav>	

		<div id="accounts">
			<ul>
				<?php if(isset($user)): ?>
					<li><a href="<?php echo $url;?>account" title="Account"><?php echo preg_replace('/\s(.)+/', null, $user->name); ?></a></li>
					<li><a href="<?php echo $url;?>auth/logout" title="Logout">Logout</a></li>
				<?php else: ?>
					<li><a href="<?php echo $url;?>auth/signup" title="Signup">Signup</a></li>
					<li><a href="<?php echo $url;?>auth/login" title="Login">Login</a></li>
				<?php endif; ?>
			</ul>
		</div>

	</div>
</header>