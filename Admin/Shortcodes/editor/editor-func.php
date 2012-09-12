<?php 

function lf_interface_registration( $buttons ) { 

	array_push( $buttons, ' | ', 'lf_dropdown' );
	
	return $buttons;
	
}

function lf_interface_plugin( $plugin_array ) {


	$plugin_array['lf_dropdown'] = ADMINURI . '/Shortcodes/editor/lf-editor-plugin.php';
	
	return $plugin_array;
	
}

function lf_interface_insert() {

	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {

		add_filter( 'mce_external_plugins', 'lf_interface_plugin' );
	
		add_filter( 'mce_buttons', 'lf_interface_registration' );
	
	}

}

add_action( 'init', 'lf_interface_insert' );


?>