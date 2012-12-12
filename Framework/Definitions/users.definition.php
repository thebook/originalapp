<?php 

	return array(
				'options' => 'user_options',
				'page_name' => 'whaleusers',
				'form_action' => 'users_save',
				'opt' => 
					array(
						array(
							'f' => array($this, 'create_and_init_database_table_and_columns'),
							'o' => 
								array(
									array(
										'table_name'    				   => 'whale_users',
										'options_to_save_unique_fields_to' => 'main_options',
										'unique_options' 				   =>  array( 'email' ),
										'fields' => 
											array(
												array(
													'field_name'       => 'first_name',
													'field_input_type' => 'smalltext' ),
												array(
													'field_name'       => 'second_name',
													'field_input_type' => 'smalltext' ),
												array(
													'field_name'       => 'e_mail',
													'field_input_type' => 'email' )
											))
									)),
						// Create Menu page
						array(
							'f' => 'add_menu_page',
							'o' => 
								array(
									'Manage Users',
									'Book Users', 		
									'administrator', 	
									'whaleusers', 
									'',		
									'', 
									'27' ) ),						
						// Create Submenu page 
						array(
							'f' => 'add_submenu_page',
							'o' => 
								array(
									'whaleusers',		// parent page
									'Checkout Users', 	// Title title
									'See users', 	    // Menu title
									'manage_options',  	// premission necessary
									'checkoutusers',	// slug
									array( $this, 'see_users_page' ) ) ),
						// Register settings array 
						array(
							'f' => 'register_setting',
							'o' => 
								array(
									'user_options',
									'user_options') )
						));	

?>