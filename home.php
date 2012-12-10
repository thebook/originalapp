<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
*/ 

get_header();
	

	$table_creator = new database_table_creator;
	
	$table_name = "test_table";

	$table_creator->check_if_table_exists_if_not_create_one(
		array(
			'table_name' => $table_name,
			'do_we_update' => 'no',
			'fields' => array(
				array(
					'field_name' => 'fiesdald1',
					'field_input_type' => 'just_year'
					)
				)
			));

	$table_creator->rename_column_in_table(
		array(
			'table_name' 	   => $table_name,
			'field_name' 	   => 'value',
			'field_input_type' => 'smalltext',
			'old_name'   	   => 'the_new_field_name'
			));

	// $table_creator->remove_column_from_table(
	// 	array(
	// 		'table_name'  => $table_name,
	// 		'field_name' => 'fiesdald1'
	// 		));

	// $table_creator->add_column_to_table(
	// 	array(
	// 		'table_name'  	   => $table_name,
	// 		'field_name'  	   => 'fiesdald12',
	// 		'field_input_type' => 'smalltext'
	// 		)
	// 	);



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