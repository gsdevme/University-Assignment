<meta charset="utf-8"/>
<title><?php echo $title; ?></title>

<meta name="description" content="<?php echo $description; ?>"/>
<meta name="keywords" content="<?php echo $keywords; ?>"/>

<link rel="author" href="<?php echo $url;?>Public/humans.txt">

<link rel="shortcut icon" href="<?php echo $img; ?>favicon.ico" />	

<!-- 
	The Reset.css only purpose is the reset all CSS properties across all 
	browsers so we have an equal playing field.

	Ref: http://html5doctor.com/html-5-reset-stylesheet/ 
-->
<link rel="stylesheet" href="<?php echo $css; ?>reset.css"/>

<link rel="stylesheet" href="<?php echo $css; ?>style.css"/>

<!-- 
	None of the javascript below was written by myself, all they do is allow IE7,8
 	to have certain abilities that real browsers have. #Microfail

 	Ref: http://code.google.com/p/html5shiv/
 	Ref: http://polyfilljs.com/
 -->
<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="//polyfilljs.com/js/mylibs/querySelector.min.js"></script>
	<script src="//polyfilljs.com/js/mylibs/getelementsbyclassname.min.js"></script>
<![endif]-->