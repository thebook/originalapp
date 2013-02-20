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
																	'name'        => 'waiting_arrival_color',
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
																	'name'        => 'awaiting_response_color',
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
																	'name'        => 'awaiting_return_color',
																	'saved'       => '35494C' )) ),
														// Awaiting delivery
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Awaiting Delivery Color',
																	'description' => 'Set the label color for tickets which are waiting to be delivered to the customer',
																	'array'       => 'main_options',
																	'name'        => 'awaiting_delivery_color',
																	'saved'       => '35494C' )) ),
														// Awaiting delivery
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'color',
																	'title'       => 'Delivered Color',
																	'description' => 'Set the label color for tickets which have been delivered',
																	'array'       => 'main_options',
																	'name'        => 'delivered_color',
																	'saved'       => '35494C' )) ),
													)))
												)),
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'email_setup',
										'title' => __('Email Setup', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Setup the email sending, for when users recieve emails', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(	
														// Mail host
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'Host Address',
																	'description' => 'Set up host adress, from which mail is delivered',
																	'array'       => 'main_options',
																	'name'        => 'mail_host',
																	'saved'       => '' )) ),
														// Encription
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'select',
																	'title'       => 'Encription',
																	'description' => 'Chose the encription for the host service its either ssl or tls',
																	'array'       => 'main_options',
																	'name'        => 'encription',
																	'saved'       => 'ssl',
																	'options'     => array('ssl', 'tsl'),
																	'values'      => array('SSL', 'TSL')  )) ),
														// email
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'E mail',
																	'description' => 'The email which is the sender',
																	'array'       => 'main_options',
																	'name'        => 'email',
																	'saved'       => '' )) ),
														// email password
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'E mail password',
																	'description' => 'The password for the email',
																	'array'       => 'main_options',
																	'name'        => 'email_password',
																	'saved'       => '' )) ),
														// From name
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'From Name',
																	'description' => 'The from name when the email is sent',
																	'array'       => 'main_options',
																	'name'        => 'name',
																	'saved'       => '' )) ),
																)))
												))
				));
?>