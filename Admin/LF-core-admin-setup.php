<?php

function liquidflux_admin_setup() { 

	add_menu_page(	'LiquidFlux Setup',
					'White Whale', 		
					'administrator', 	
					'liquidfluxadmin', 
					'',		
					'' . ADMINURI . '/assets/Images/menulogo.png', 
					'3');				
					
}
add_action( 'admin_menu', 'liquidflux_admin_setup');


include( ADMINPATH . '/Content/lf-content-func.php' );

include( ADMINPATH . '/Content/lf-post-formats-func.php' );

include( ADMINPATH . '/Content/lf-widgets-func.php' );

include( ADMINPATH . '/Content/lf-homepage-func.php' );

include( ADMINPATH . '/Content/meta.php' ); 


include( FRAMEWORK . '/utilities.php' );

include( FRAMEWORK . '/seo.php' ); 

include( FRAMEWORK . '/sidebar.php' ); 

include( FRAMEWORK . '/paged.class.php' ); 

include( FRAMEWORK . '/Content/post-meta.php' ); 

include( FRAMEWORK . '/Content/featured-image.php' ); 

include( FRAMEWORK . '/Content/post-text.php' ); 

include( FRAMEWORK . '/Content/title.php' ); 

include( FRAMEWORK . '/Shortcodes/include.php' );

include( FRAMEWORK . '/Slider/slide.php' );

include( FRAMEWORK . '/Slider/modify.class.php' );

include( FRAMEWORK . '/Options/include.php' );

include( FRAMEWORK . '/register_scripts.class.php' );

include( FRAMEWORK . '/admin-page.php' );

include( FRAMEWORK . '/rewrites.php' );

include( FRAMEWORK . '/layout.class.php' );

new register_scripts;



include( ADMINPATH . '/Footer/lf-footer-func.php' );

include( ADMINPATH . '/Header/lf-header-func.php' );

include( ADMINPATH . '/Navigation/lf-navigation-func.php' ); 


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
	
	// multi($options);
	// add_settings_section(
	// 						'main_options_layouts_section', 	
	// 						'Layouts', 
	// 						'main_options_layouts_callback', 	
	// 						'whitewhale' ); 
													
	// add_settings_section(	'main_options_header_section', 	
	// 						'Header', 	
	// 						'lf_header_section_callback', 	
	// 						'whitewhale' ); 
							
	// add_settings_section(	'main_options_navigation_section', 	
	// 						'Navigation', 	
	// 						'lf_navigation_section_callback', 	
	// 						'whitewhale' ); 
							
	// add_settings_section(	'main_options_slider_section', 	
	// 						'Slider', 	
	// 						'lf_slider_section_callback', 	
	// 						'whitewhale' ); 
							
	// add_settings_section(	'main_options_content_section', 	
	// 						'Content', 	
	// 						'lf_content_section_callback', 	
	// 						'whitewhale' );
							
	// add_settings_section(	'main_options_footer_section', 	
	// 						'Footer', 	
	// 						'lf_footer_section_callback', 	
	// 						'whitewhale' ); 
							
	// add_settings_section(	'main_options_portfolio_section', 	
	// 						'Portfolio', 	
	// 						'lf_portfolio_section_callback', 	
	// 						'whitewhale' ); 
							
	// add_settings_section(	'main_options_not_found_section', 	
	// 						'404', 	
	// 						'lf_not_found_section_callback', 	
	// 						'whitewhale' );
							
	// add_settings_section(	'main_options_theme_opt_section', 	
	// 						'Updates', 	
	// 						'lf_theme_opt_section_callback', 	
	// 						'whitewhale' );
																																			
// }

// add_action( 'admin_menu', 'add_white_whale_options' );


// function admin_style() {  
	
// 	global $pagenow, $post_type;
		
// 	if (  $pagenow == 'admin.php' ) {
	
// 		lf_font_style( 'admin-head' );
		
// 	}
	
// 	if (  $pagenow == 'admin.php' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'lf_slide'
// 		  || $pagenow == 'post.php'     && $post_type == 'lf_slide'
// 		  || $pagenow == 'post.php'     && $post_type == 'page' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'page'
// 		  || $pagenow == 'post.php'     && $post_type == 'post' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'post' ) {
	
// 		wp_enqueue_style( 'lf-admin-style',
// 						  ADMINURI . '/assets/admin-style.css',
// 						  '',
// 						  '1.0' );
						  
// 		wp_enqueue_style( 'thickbox' );
	
// 	}
								
// }
	
// add_action( 'admin_head', 'admin_style' );
	

// function lf_admin_js_ui() {

// 	global $pagenow, $post_type;
		
// 	if (  $pagenow == 'admin.php' ) {
			
// 		wp_enqueue_script( 'admin-js-ui',  
// 						   trailingslashit( get_template_directory_uri() ) . '/Admin/assets/admin-ui.js', 
// 						   array( 
// 								'jquery-ui-tabs', 
// 								'jquery-ui-sortable', 
// 								'jquery-ui-slider', 
// 								'thickbox', 
// 								'media-upload' ), 
// 						   '0.1', 
// 						   false );
						   
// 	}
	
// 	if ( $pagenow == 'post.php' && $post_type == 'post' or $post_type == 'lf_slide' || 
// 		 $pagenow == 'post-new.php' && $post_type == 'post' or $post_type == 'lf_slide' ) {
		  
// 		wp_enqueue_script( 
// 						'admin-js-ui',  
// 						trailingslashit( get_template_directory_uri() ) . '/Admin/assets/post-ui.js', 
// 						array('thickbox', 'media-upload'), 
// 						'0.1', 
// 						false );

// 		wp_enqueue_script(
// 						'clone-js',
// 						trailingslashit( get_template_directory_uri() ) . 'Framework/Slider/scripts/remove.js', 
// 						'',
// 						'1',
// 						false );

// 		}
	
// 	if (  $pagenow == 'admin.php'
// 		|| $pagenow == 'widgets.php' ) {
			
// 		wp_enqueue_script( 'color-picker', 
// 						   trailingslashit( get_template_directory_uri() ) . '/Admin/assets/colorpicker/colorPicker.js', 
// 						   '', 
// 						   '9.1', 
// 						   false );		

// 	}
			
// }
	
// 	add_action( 'admin_enqueue_scripts', 'lf_admin_js_ui' );
	
?>