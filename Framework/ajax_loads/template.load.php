<?php 

	$get_the_template_data = $_GET['template_data'];
	
	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );

	$template_definition = ( include FRAMEWORK .'/Definitions/templates.definition.php' );

	$template_name = "template_{$get_the_template_data['name']}";

	new $template_name;

?>