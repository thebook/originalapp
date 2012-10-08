<?php 

// Shortcode array
include( './options.php' );
// Get the key for the shortcode to generate
$k = $_GET['popup'];
// Loads the shortcode generator class
require_once( 'shortcode-generate.class.php' );
// Create shortcode 
$shortcode = new short( $short, $k );
// Echos class
$shortcode->body();

?>