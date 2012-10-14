<?php 

function lf_reg_slider() {
	
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
				'public'   => true,
				'rewrite'  => false,
				'show_ui'  => true,
				'menu_icon'=> '',
				'supports' => array('title', 'revisions'),
				'show_in_menu'        => 'liquidfluxadmin',
				'exclude_from_search' => true
		));
	
}	

add_action('init', 'lf_reg_slider');





?>