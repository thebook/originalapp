<?php 

	return array(
				'options' => 'user_options',
				'page_name' => 'whaleusers',
				'form_action' => 'users_save',
				'title' => 'Profile Managment',
				'sub_title' => '',
				'create_table' => 
					array(
						'name'     => 'whale_users',
						'options_array'  => 'main_options',
						'unique_options' =>  array( 'email' ),
						'default_setup' => 
							array(
								array(
									'field_name'       => 'first_name',
									'description'      => 'Description for first name',
									'unique'           => 'false',
									'required'         => 'true',
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'second_name',
									'description'      => 'Description for second name',
									'unique'           => 'false',
									'required'         => 'true',
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'user_name',
									'description'      => 'Description for user name',
									'unique'           => 'true',
									'required'         => 'true',
									'field_input_type' => 'smalltext' ),
								array(
									'field_name'       => 'e_mail',
									'description'      => 'Description for second name',
									'unique'           => 'true',
									'required'         => 'true',
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
									'Settings User Fields', // Menu title
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