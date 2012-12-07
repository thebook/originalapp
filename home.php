<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
*/ 

get_header();

	new database_table(
		array(
			'table_name' => 'test_stuff2',
			'do_we_update' => 'no',
			'fields' => array(
				array(
					'field_name' => 'fiesdald1',
					'field_input_type' => 'just_year'
					),
				array(
					'field_name' => 'fielasdd2',
					'field_input_type' => 'smalltext'
					),
				array(
					'field_name' => 'fieldasd3',
					'field_input_type' => 'smalltext'
					),			
				array(
					'field_input_type' => 'url'
					),
				array(
					'field_name' => 'field5',
					'field_input_type' => 'regular_number'
					)
				// array(
				// 	'field_name' => 'anothertypeoffield',
				// 	'field_input_type' => 'small_number'
				// 	)			
				)
			)
		);


	// $opt = get_option('homepage_options');

	// get_template_part( 'liquidheader' );
	
	// get_template_part( 'liquid-navigation' );

	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_one_switch',
	// 						'home_sidebar_one_widths',
	// 						'lf-homepage-sidebar-first' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_two_switch',
	// 						'home_sidebar_two_widths',
	// 						'lf-homepage-sidebar-second' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_three_switch',
	// 						'home_sidebar_three_widths',
	// 						'lf-homepage-sidebar-third' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_four_switch',
	// 						'home_sidebar_four_widths',
	// 						'lf-homepage-sidebar-fourth' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_five_switch',
	// 						'home_sidebar_five_widths',
	// 						'lf-homepage-sidebar-fifth' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_six_switch',
	// 						'home_sidebar_six_widths',
	// 						'lf-homepage-sidebar-sixth' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_seven_switch',
	// 						'home_sidebar_seven_widths',
	// 						'lf-homepage-sidebar-seventh' );
							
	// lf_create_home_widget_area( 
	// 						'homepage_options',
	// 						'home_sidebar_eight_switch',
	// 						'home_sidebar_eight_widths',
	// 						'lf-homepage-sidebar-eight' );
							
	// if ( isset($opt['home_footer_use']) ) {
	
	// 	if ( $opt['home_footer_use'] == 'activate' ) {
		
	// 		get_template_part('lf-footer');
		
	// 	}
	
	// }
							
get_footer();

?>