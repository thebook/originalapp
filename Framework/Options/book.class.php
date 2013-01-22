<?php 

/**
* A book post type class
*/
class books extends meta
{

	function __construct ($class_params)
	{
		parent::__construct($class_params);
		add_action('init', array($this, 'register'));
	}

	public function register ()
	{	
		register_post_type(
		'books',
		array(
			'labels'   => 
				array(
					'name'               => _x('Books', 'general name', 'liquidflux'),
					'singular_name'      => _x('Book', 'single name ', 'liquidflux'),
					'add_new'            => _x('New Book', 'book', 'liquidflux' ),
					'add_new_item'       => __('Add New Book','liquidflux'),
					'edit_item'          => __('Edit', 'liquidflux'),
					'new_item'           => __('New Book', 'liquidfllux'),
					'all_items'          => __('Books', 'liquidflux'),
					'view_item'          => __('View Book', 'liquidflux'),
					'search_items'       => __('Search The Books', 'liquidflux'),
					'not_found'          => __('Nothing Found', 'liquidflux'),
					'not_found_in_trash' => __('No Books found in trash', 'liquidflux'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Books', 'liquidflux') ),
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'menu_icon'           => '',
			'supports'            => array('title'),
			'exclude_from_search' => true ));
	}
}

?>		