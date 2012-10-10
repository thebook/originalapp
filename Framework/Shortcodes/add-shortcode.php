<?php 

function lf_add_mce_button( $buttons ) { 

	array_push( $buttons, ' | ', 'lf_dropdown' );
	
	return $buttons;
	
}

function lf_add_mce_plugin( $plugin_array ) {


	$plugin_array['lf_dropdown'] = FRAMEWORKURI . '/Shortcodes/plugin.js';
	
	return $plugin_array;
	
}

function lf_insert_mce_plugin() {

	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {

		add_filter( 'mce_external_plugins', 'lf_add_mce_plugin' );
	
		add_filter( 'mce_buttons', 'lf_add_mce_button' );
	
	}

}

add_action( 'init', 'lf_insert_mce_plugin' );


?>