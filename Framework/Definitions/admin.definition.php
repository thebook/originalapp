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
									'White Whale Admin',
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
						// Navigation
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'profile_managment',
										'title' => __('Profile Managment', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Control which input fields your users have to fill in, which are unique and which mandatory', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Menu Background 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Background',
																	'description' => 'Set the background color of your menu bars',
																	'array'       => 'main_options',
																	'name'        => 'menu_background',
																	'saved'       => '000000' )) ),										
													)))
												))
							));
?>