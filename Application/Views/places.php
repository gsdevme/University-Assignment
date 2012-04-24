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
				<h3>Places</h3>
				<p>
				Lorem ipsum dolor sit amet, lacinia eleifend ac neque, leo feugiat, a morbi duis ad nibh eu lacus. Nisl rutrum porta, nec duis in eleifend wisi, a sollicitudin faucibus proin tristique, vivamus et aliquam fusce massa sed. Ut risus non blandit. Nisl interdum dolor, ac ultricies, eget nec a ad nulla scelerisque nec. Eu leo ornare mauris magna ac eleifend. Sit augue doloremque placerat eu vestibulum lectus, pede non auctor suspendisse laoreet, vel mauris, arcu lacinia dolor. Nibh amet elit nunc ullamcorper nunc, suspendisse nibh gravida, nibh wisi arcu, est ut suspendisse, maecenas amet arcu vestibulum. Ullamcorper ac posuere sem ac suscipit odio, dictumst lacus cursus, felis magnis nec, varius eu magna scelerisque scelerisque. Molestiae ac orci et, nam et tempus leo mi.</p>
				<p>
				Est elit porttitor arcu lobortis praesent pellentesque. Libero eu in fusce euismod ipsum, lorem vestibulum nunc iaculis volutpat varius, facilisis aenean accumsan tellus, turpis sit justo enim. Sed ea quis euismod imperdiet amet turpis, pretium sem scelerisque at, porta ac vel vitae mi aliquam, at morbi ipsum, sed malesuada maecenas donec lacus sem. Nec felis nulla, sapien lectus vitae enim erat fringilla, elit quis bibendum. Pellentesque laoreet nullam ante primis ac, veniam vivamus proin et ac leo, at sit sed donec, ac integer orci, pharetra quam nunc mi integer nullam sapien. Turpis ut tempor faucibus justo lectus dui, arcu tortor, metus in suscipit, eleifend a, eu orci ullam aliquam. Luctus aliquam est tempor non at felis, quisque magna ut vel wisi, est integer, consectetuer mi wisi non, vestibulum non accumsan sit natoque leo litora. Ligula ultrices orci lectus.</p>
				
				<h4>Another Header!</h4>
				<p>
				In accumsan, nulla auctor vehicula pharetra commodo semper, fusce dolor amet. Pede pellentesque velit, viverra suspendisse, nunc interdum fringilla ipsum ultrices sed vel, odio lacus, dolor nibh scelerisque aliquam eu. Erat velit mauris, mi justo porta maecenas. Nascetur dolores arcu lectus vel etiam sem, labore risus, ut vulputate urna laoreet a vestibulum deserunt, morbi in vitae. Faucibus integer magna elit nec sollicitudin, ut sollicitudin vel interdum a posuere. Tellus leo sed tincidunt molestie tempus eget. Litora justo ac ante nec. Magna in porta etiam mauris ut, elementum sit.</p>
				<p>
				Duis morbi pretium taciti. Alias purus sed at. Est magna, nulla integer dolor suspendisse, non nec et quis convallis at pellentesque. Sit venenatis libero imperdiet do lectus, sed odio nunc vel ipsum, in at risus odio vestibulum facilisis. Faucibus scelerisque tristique euismod at malesuada. Nullam mauris vestibulum aliquam dui, quis fermentum at, sed luctus vel a dui tincidunt in, risus ultrices et, curabitur et fringilla duis non curabitur. Wisi morbi, platea sed tristique praesent ac suspendisse amet, pede ac velit iaculis neque. Ut eget maecenas adipisicing curabitur blandit, diam leo, in sem tempor accumsan a sed, porttitor sollicitudin, viverra mauris eu diam feugiat nam. Scelerisque maecenas tortor nullam facilisis interdum velit, donec nulla, duis aenean integer dolor. Vel feugiat, dolor at magna. Deserunt incidunt sed proin duis sit, tortor cras lectus integer elit.</p>
				<p>
				</p>
			</div>

			<!-- Right is right, limited to 340 pixels wide -->
			<div id="right">
				<?php $this->element('right');?>
			</div>
		</div>

		<!-- all thats left is our footer now.. -->
		<?php $this->element('footer'); ?>
	</body>
</html>