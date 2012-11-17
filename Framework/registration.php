<?php 

function liquidflux_init_sidebars () 
{
	register_sidebar( 
		array(
			'name' 			=> __( 'First Sidebar', 'liquidflux' ),
			'id' 			=> 'lf-content-sidebar-first',
			'before_widget' => '<div id="%1$s" class="liquidflux-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3>', ) );
}

add_action( "widgets_init", 'liquidflux_init_sidebars' );

add_theme_support( 'post-thumbnails' );

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'video', 'audio', 'link' ) );
	
/**
 * General wordpress registaritons go here, throw all 'init' hooked registrations in here
 * @return pushes new values into global arrays ( i imaigne )
 */
function liquidflux_init_registrations () 
{	
	/**
	 * Register slider post
	 */
	register_post_type(
		'lf_slide',
			array(
				'labels'   => 
							array(
								'name'               => _x('Slider', 'general name', 'liquidflux'),
								'singular_name'      => _x('Slider', 'single name ', 'liquidflux'),
								'add_new'            => _x('New', 'slide', 'liquidflux' ),
								'add_new_item'       => __('Add New Slider','liquidflux'),
								'edit_item'          => __('Edit Slider', 'liquidflux'),
								'new_item'           => __('New Slider', 'liquidfllux'),
								'all_items'          => __('Sliders', 'liquidflux'),
								'view_item'          => __('View Slider', 'liquidflux'),
								'search_items'       => __('Search Sliders', 'liquidflux'),
								'not_found'          => __('Nothing Found', 'liquidflux'),
								'not_found_in_trash' => __('No Sliders In Trash', 'liquidflux'),
								'parent_item_colon'  => '',
								'menu_name'          => __('White Whale Sliders', 'liquidflux')
								),
				'public'   => false,
				'rewrite'  => false,
				'show_ui'  => true,
				'menu_icon'=> '',
				'supports' => array('title'),
				'show_in_menu'        => 'liquidfluxadmin',
				'exclude_from_search' => true
		));
	
	/**
	 * Register the navigation menu holder
	 */
	register_nav_menu ('liquidflux_navigation', 'Menu');
}	

add_action('init', 'liquidflux_init_registrations');

?>