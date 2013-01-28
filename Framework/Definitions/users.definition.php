<?php 

	return array(
				'options' => 'user_options',
				'page_name' => 'whaleusers',
				'form_action' => 'users_save',
				'title' => 'Profile Managment',
				'sub_title' => '',
				'create_table' => 
					array(
						'name' => 'whale_users',
						'options_array'  => 'main_options',
						'define_data_type_array' => 
							array(
								array(
									'column_name' => 'field_name',
									'data_type'   => 'VARCHAR(100)',
									'auto_increment' => false,
									'unique' => true,
								),
								array(
									'column_name' => 'description',
									'data_type'   => 'TEXT',
									'auto_increment' => false,
									'unique' => false,
								),
								array(
									'column_name' => 'field_input_type',
									'data_type'   => 'TINYTEXT',
									'auto_increment' => false,
									'unique' => false,
								),					
								array(
									'column_name' => 'help_them_along',
									'data_type'   => 'TEXT',
									'auto_increment' => false,
									'unique' => false,
								),
								array(
									'column_name' => 'is_unique',
									'data_type'   => 'TINYINT',
									'auto_increment' => false,
									'unique' => false,
								),
								array(
									'column_name' => 'required',
									'data_type'   => 'TINYINT',
									'auto_increment' => false,
									'unique' => false,
								)
							),
						'default_setup' => 
							array(
								array(
									'field_name'       => 'first_name',
									'description'      => 'Description for first name',
									'help_them_along'  => 'This be help for first name',
									'is_unique'        => 0,									
									'required'         => 1,
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'second_name',
									'description'      => 'Description for second name',
									'help_them_along'  => 'This be help for second name',
									'is_unique'        => 0,
									'required'         => 1,
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'user_name',
									'description'      => 'Description for user name',
									'help_them_along'  => 'Help for user name',
									'is_unique'        => 1,
									'required'         => 1,
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'e_mail',
									'description'      => 'Description for second name',
									'help_them_along'  => 'This be help for email',
									'is_unique'        => 1,
									'required'         => 1,
									'field_input_type' => 'email' )
							)),
				'opt' => 
					array(
						// Create Menu page
						array(
							'f' => 'add_menu_page',
							'o' => 
								array(
									'Manage Users',
									'Members', 		
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
									'whaleusers',			// parent page
									'User Fields', 			// Title title
									'Field	 Settings', // Menu title
									'manage_options',  		// premission necessary
									'whaleusers',			// slug
									array( $this, 'profile_page' ) ) ),
						// Create Submenu page 
						array(
							'f' => 'add_submenu_page',
							'o' => 
								array(
									'whaleusers',		// parent page
									'Checkout Users', 	// Title title
									'See Users', 	    // Menu title
									'manage_options',  	// premission necessary
									'checkoutusers',	// slug
									array( $this, 'display_users_page' ) ) ),
						// Register settings array 
						array(
							'f' => 'register_setting',
							'o' => 
								array(
									'user_options',
									'user_options') )
						));	

?>