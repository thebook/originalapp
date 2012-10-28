<?php 

/**
 * This be the rewrites section, meaning it rewrites some already used wordpress functions to make them, well better.
 * It doesent really rewrite though just creates a modified new function which is used instead, prefixed "better" or "lf" for short 
 */

function lf_add_settings_section($id, $title, $callback, $page, $ca = null) {

	global $wp_settings_sections;

	if ( !isset($wp_settings_sections) ) 
	{
		$wp_settings_sections = array();
	}

	if ( !isset($wp_settings_sections[$page]) )
	{
		$wp_settings_sections[$page] = array();
	}

	if ( !isset($wp_settings_sections[$page][$id]) )
	{
		$wp_settings_sections[$page][$id] = array();
	}

	$wp_settings_sections[$page][$id] = array( 'id' => $id, 'title' => $title, 'callback' => $callback, 'callargs' => $ca, 'page' => 'page' );
}

?>