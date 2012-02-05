<div id="breadcrumb">
	<ul>
		<?php if(isset($breadcrumb)) foreach((array)$breadcrumb as $item): ?>
			<li><a href="<?php echo $url . $item[0]; ?>"><?php echo $item[1]; ?>&nbsp; &nbsp; </a></li>
		<?php endforeach; ?>
	</ul>
</div>