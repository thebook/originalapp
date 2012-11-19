<?php 
/* 
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0 
*/

get_header();

// $manifest_array = get_chosen_layout();
// get_chosen_layout () {

// 	$post_meta     = get_post_meta( $post->ID, 'main_meta', true );

// 	$layout_name   = $post_meta['chosen_layout']; 

// 	$main_options  = get_option( 'main_options' );

// 	return $chosen_layout = $saved_layouts['saved_layouts'][$layout_name];
// }


$manifest_array = array(
		array(
			'name' => 'header',
			'template_params' => array(
				array(
					'name' => 'advert',
					'params' => 
						array(
							'ad_code' => 'sda',
							'ad_size' => 'leaderboard' ) ),
				array(
					'name' => 'title_and_logo',
					'params' =>
						array(
							array(
								'name' => 'title',
								'params' => array()),
							array(
								'name' => 'logo',
								'params' => array() )
							)
						)
			)),
		array(
			'name' => 'slide',
			'template_params' => 638 ),
		array(
			'name' => 'menu',
			'template_params' => array(
				'background_color' => '000',
				'color' => 'fff',
				'template_parts_to_get' => 
					array(
						array(
							'name' => 'navigation',
							'params' => 
								array( 
									'id' => '11',
									'navigation_size' => 'thick',
									 ))
							)
						)),
		array(
			'name' => 'post_formats',
			'template_params' => 
				array(
					array(
						'name' => 'content',
						'params' => 
							array(
								'size' => 'full',
								'template_parts_to_get' => 
									array(
										array(
											'name' => 'post_formats',
											'params' => array() ),
										array(
											'name' => 'inner_sidebar',
											'params' => 'lf-content-default-single-widget-area' ),
										array(
											'name' => 'author_box',
											'params' => '' ),
										array(
											'name' => 'comments',
											'params' => '' ) 
										))),

					array(
						'name' => 'sidebar',
						'params' => array( 
							'name_of_sidebar_to_get' => 'first-sidebar',
							'sidebar_size' => 'third' )
						)
								)),
		array(
			'name' => 'menu',
			'template_params' => array(
				'background_color' => '000',
				'color' => 'fff',
				'template_parts_to_get' => 
					array(
						array(
							'name' => 'navigation',
							'params' => 
								array( 
									'id' => '11',
									'navigation_size' => 'thin',
									 ))
							)
						))
		 );

new layout($manifest_array);

// $nav_menus = wp_get_nav_menus( array( 'orderby' => 'name' ));

// foreach ($nav_menus as $menu) {
// 	echo $menu->term_id;
// }

get_footer();

?>
