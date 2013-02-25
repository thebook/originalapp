<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Typse" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title><?php wp_title(''); ?></title>

	<!-- SEO stuff hooked onto this -->
	<?php lf_head_hook(); ?>

	<!-- Font insertion here -->
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" />
	
	<meta name="viewport" content="width=device-width; initial-scale=0.1; maximum-scale=0.1; user-scalable=0;" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<style type="text/css"><?php include FRAMEWORK .'/CSS/style-core.php'; ?></style>
		
	<!-- this creates the html5 elements in IE browsers below version 9 -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
<?php wp_head(); ?>

</head>
<body>
<div class="wrap">