<?php 
/* 
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Typse" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title><?php wp_title(''); ?></title>

	<?php lf_head_hook(); ?>

<?php 

	lf_font_style( 'print', '', '', 'main_options', 'header_title_font' ); 
	lf_font_style( 'print', '', '', 'main_options', 'posttitle_font_choice' ); 
	lf_font_style( 'print', '', '', 'main_options', 'body_font_choice' ); 
	lf_font_style( 'print', '', '', 'main_options', 'body_header_font_choice' ); 
	lf_font_style( 'print', '', '', 'main_options', 'slider_text_font' );  
	
?>
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" />
	
	<meta name="viewport" content="width=device-width; initial-scale=0.1; maximum-scale=0.1; user-scalable=0;" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	<!-- this creates the html5 elements in IE browsers below version 9 -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->z
		
<?php wp_head(); ?>

</head>
<body>
<div id="lf-core-main-body-wrap">