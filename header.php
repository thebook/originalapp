<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Typse" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title>Recyclabook</title>

	<link rel="shortcut icon" href="<?php echo FRAMEWORKURI .'/CSS/Includes/Works/rfavicon.png'; ?>"/>
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<style type="text/css"><?php include FRAMEWORK .'/CSS/style-core.php'; ?></style>
		
	<!-- this creates the html5 elements in IE browsers below version 9 -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
	<?php wp_head(); ?>

	<script src="<?php echo FRAMEWORKURI .'/scripts/jquery.js'; ?>"></script>	
	<script src="<?php echo FRAMEWORKURI .'/scripts/mousewheel.jquery.js'; ?>"></script>	
	<script src="<?php echo FRAMEWORKURI .'/scripts/alpha.js'; ?>"></script>

	<script>	  
	  	var scripts = "<?php echo FRAMEWORKURI .'/scripts'; ?>",
	  		frameworkuri = "<?php echo FRAMEWORKURI; ?>",
	  		ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		alpha.load_scripts_asynchronously_with_callback(
			[
			 scripts+"/native.extend.js", 
			 scripts+"/front.recyclabus.alpha.js", 
			 scripts+"/front.search.alpha.js", 
			 scripts+"/front.books.alpha.js", 
			 scripts+"/front.books.popup.alpha.js", 
			 scripts+"/front.change_page.alpha.js", 
			 scripts+"/front.basket.alpha.js", 
			 scripts+"/front.registration.alpha.js", 
			 scripts+"/front.confirm.alpha.js", 
			 scripts+"/front.thank_you.alpha.js", 
			 scripts+"/utility.users.js", 
			 scripts+"/utility.alpha.js", 
			 scripts+"/front.test.alpha.js", 
			 scripts+"/amazon.js", 
			 scripts+"/ticket.alpha.js", 
			 scripts+"/front.alpha.js"
			],
			function (error, result) { 				
				alpha.front();
			});
	</script>

</head>
<body>
<div class="wrap">