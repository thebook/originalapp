<?php 

	return array(
				'options' => 'main_options',
				'page_name' => 'whitewhale',
				'form_action' => 'white_whale_save',
				'title' => 'RecyclaBook',
				'sub_title' => '.Development Version',
				'opt' => 
					array(
						// Create Menu page
						array(
							'f' => 'add_menu_page',
							'o' => 
								array(
									'Recyclabook Setup',
									'Options', 		
									'administrator', 	
									'liquidfluxadmin', 
									'',		
									'', 
									'3' ) ),
						// Create Submenu page 
						array(
							'f' => 'add_submenu_page',
							'o' => 
								array(
									'liquidfluxadmin',
									'Admin',
									'Theme Options',
									'manage_options',
									'whitewhale',
									array( $this, 'page' ) ) ),
						// Register settings array 
						array(
							'f' => 'register_setting',
							'o' => 
								array(
									'main_options',
									'main_options') ),
						// // Navigation
						// array( 
						// 	'f' => array( $this, 'pop'),
						// 	'o'	=>	
						// 		array(
						// 			array( 
						// 				'id' => 'profile_managment',
						// 				'title' => __('Profile Managment', 'liquidflux'),
						// 				'page'  => 'whitewhale',
						// 				'desc'  => __('Control which input fields your users have to fill in, which are unique and which mandatory', 'liquidflux'),
						// 				'options' => 
						// 					array( 
						// 						'opt' => 
						// 							array(
						// 								// Menu Background 
						// 								array(
						// 									'f' => array( $this, 'create'),
						// 									'o' => array(  
						// 										array(
						// 											'type'        => 'user',
						// 											'title'       => 'Profile Managment',
						// 											'description' => 'Manage what fields users have to fill in',
						// 											'array'       => 'main_options',
						// 											'name'        => 'user_profile',
						// 											'saved'       => 
						// 												array(
						// 													'field_counter' => 1,
						// 													'field' => 
						// 														array(
						// 															array(
						// 																'name'           => 'Some sName',
						// 																'description'    => 'Description',
						// 																'not_unique'     => 'The Text for not unique',
						// 																'character_type' => 'some_value',
						// 																'unique'         => 'yes',
						// 																'required' 		 => 'yes'
						// 															),
						// 															array(
						// 																'name'           => 'Some Name',
						// 																'description'    => 'Description',
						// 																'not_unique'     => 'The Text for not unique',
						// 																'character_type' => 'some_value',
						// 																'unique'         => 'yes',
						// 																'required' 		 => 'yes'
						// 															)))
						// 										))),
						// 							)))
						// 						)),
						// Page setups
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'page_choices',
										'title' => __('Ticketing', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Set ticketing expiery date and other options', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(																												
														// Number of days to add to expected deliver
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'slider',
																	'title'       => 'Number Of Days To Expected Deliver',
																	'description' => 'Change how many days you are willing to wait for pedning tickets, till a delivery is considered expired',
																	'array'       => 'main_options',
																	'name'        => 'expiery_wait',
																	'saved'       => 10,
																	'min'         => 1,
																	'max'   	  => 364,
																	'value'       => ' day/s',
																	'step'        => 1 )) ),	
														// Pending color
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Pending Color',
																	'description' => 'Set the label color for pending tickets',
																	'array'       => 'main_options',
																	'name'        => 'pending_color',
																	'saved'       => '651709' )) ),
														// Complete Color
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Successful Color',
																	'description' => 'Set the label color for tickets which were paid for',
																	'array'       => 'main_options',
																	'name'        => 'complete_color',
																	'saved'       => '34B27D' )) ),
														// Waiting for response
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Waiting For Response Color',
																	'description' => 'Set the label color for tickets which are waiting for a response on the updated state form the user',
																	'array'       => 'main_options',
																	'name'        => 'waiting_color',
																	'saved'       => 'B24734' )) ),
														// Returned Books
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Returned Color',
																	'description' => 'Set the label color for tickets whose books have been returned',
																	'array'       => 'main_options',
																	'name'        => 'returned_color',
																	'saved'       => '146543' )) ),
														// Expired books 
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Expired Color',
																	'description' => 'Set the label color for tickets which have expired',
																	'array'       => 'main_options',
																	'name'        => 'expired_color',
																	'saved'       => '64FEBD' )) ),
														// Awaiting return 
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Awaiting Return Color',
																	'description' => 'Set the label color for tickets which are waiting to be returned',
																	'array'       => 'main_options',
																	'name'        => 'waiting_return_color',
																	'saved'       => '35494C' )) ),
													)))
												))
				));
?>