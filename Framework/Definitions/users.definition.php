<?php 

	return array(
				'options' => 'user_options',
				'page_name' => 'whaleusers',
				'form_action' => 'users_save',
				'opt' => 
					array(
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
						// Create subpage for user profile managment
						array(
							'f' => 'add_submenu_page',
							'o' => 
								array(
									'whaleusers',			// parent page
									'Manage User Profiles', // Title title
									'Manage Profiles', 	    // Menu title
									'manage_options',  	    // premission necessary
									'whaleusers',			// slug
									array( $this, 'manage_users_page' ) ) ),
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