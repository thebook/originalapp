<?php

// include( ADMINPATH . '/Content/lf-content-func.php' );

// include( ADMINPATH . '/Content/lf-post-formats-func.php' );

// include( ADMINPATH . '/Content/lf-widgets-func.php' );

// include( ADMINPATH . '/Content/lf-homepage-func.php' );

// include( ADMINPATH . '/Content/meta.php' ); 


include( FRAMEWORK . '/utilities.php' );

include( FRAMEWORK . '/seo.php' ); 

include( FRAMEWORK . '/sidebar.php' ); 

include( FRAMEWORK . '/paged.class.php' ); 




include( FRAMEWORK . '/Content/branch.meta.helper.class.php' ); 

include( FRAMEWORK . '/Content/branch.featured.helper.class.php' ); 

include( FRAMEWORK . '/Content/produce.helper.php' ); 





include( FRAMEWORK . '/Shortcodes/include.php' );

include( FRAMEWORK . '/Options/include.php' );

include( FRAMEWORK . '/register_scripts.class.php' );

include( FRAMEWORK . '/rewrites.php' );

include FRAMEWORK . '/layout.class.php';

include FRAMEWORK . '/jplayer.class.php';

include FRAMEWORK . '/Templates/include.php';

new register_scripts;



// include( ADMINPATH . '/Footer/lf-footer-func.php' );

// include( ADMINPATH . '/Header/lf-header-func.php' );

// include( ADMINPATH . '/Navigation/lf-navigation-func.php' ); 


//include( ADMINPATH . '/Slider/lf-slider-func.php' ); // post error

//include( ADMINPATH . '/Page_templates/lf-page-templates-func.php' ); // post error

// include( ADMINPATH . '/Shortcodes/lf-shortcodes-func.php' );

// include( FRAMEWORK . '/Shortcodes/add-shortcode.php' );

// add_action('wp_ajax_white_whale_save', 'white_whale_save' );



// function add_white_whale_options() {


	// add_submenu_page( 	'liquidfluxadmin', 
	// 					'White Whale Admin', 
	// 					'Options', 
	// 					'manage_options', 
	// 					'whitewhale',
	// 					'admin_page' );
							
	// register_setting(	'main_options', 	
	// 					'main_options' ); 
	
	// $page = new admin('lf-admin', 'lf-admin-td', 'option');

	// $page->body();
	
	new admin( 
		array(
			'id' => 'lf-admin',
			'class' => 'lf-admin-td', 
			'default_type' => 'option',
			'definition' => FRAMEWORK .'/Definitions/admin.definition.php'
			));

	new meta(
		array( 
			'id' => 'lf-post-meta',
			'class' => 'lf-admin-post-meta-td',
			'default_type' => 'meta', 
			'definition' => FRAMEWORK .'/Definitions/meta_boxes.definition.php'
			));

	new leaf_slide(
		array(
			'id' => 'lf-post-meta',
			'class' => 'lf-admin-post-meta-td',
			'default_type' => 'meta', 
			'definition' => FRAMEWORK .'/Definitions/slider.definition.php'
			));
	
?>