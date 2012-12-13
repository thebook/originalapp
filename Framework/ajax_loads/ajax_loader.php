<?php 

	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );	

	require FRAMEWORK ."/ajax_loads/load/{$_GET['template_options']['name']}.load.php";

?>