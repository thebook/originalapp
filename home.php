<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
*/ 

get_header();
	

	$table_creator = new table_creator;
	
	$table_name = "whale_users";

	var_export($table_creator->get_column_information($table_name, 'first_name', 'DATA_TYPE'));

	// $table_creator->check_if_table_exists_if_not_create_one(
	// 	array(
	// 		'table_name' => $table_name,
	// 		'fields' => array(
	// 			array(
	// 				'field_name' => 'fiesdald1',
	// 				'field_input_type' => 'just_year'
	// 				)
	// 			)
	// 		));

	// $table_creator->add_row_to_table(
	// 	$table_name, 
	// 	array('first_name' => 'some value', 'second_name' => '4545')
	// );

	echo $table_creator->check_if_value_is_in_column('whale_users', 'first_name', 'some valuess');

	// $table_creator->rename_column_in_table(
	// 	array(
	// 		'table_name' 	   => $table_name,
	// 		'field_name' 	   => 'value',
	// 		'field_input_type' => 'smalltext',
	// 		'old_name'   	   => 'the_new_field_name'
	// 		));

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