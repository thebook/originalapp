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
																	'type'        => 'user',
																	'title'       => 'Profile Managment',
																	'description' => 'Manage what fields users have to fill in',
																	'array'       => 'main_options',
																	'name'        => 'user_profile',
																	'saved'       => 
																		array(
																			'field_counter' => 1,
																			'field' => 
																				array(
																					array(
																						'name'           => 'Some sName',
																						'description'    => 'Description',
																						'not_unique'     => 'The Text for not unique',
																						'character_type' => 'some_value',
																						'unique'         => 'yes',
																						'required' 		 => 'yes'
																					),
																					array(
																						'name'           => 'Some Name',
																						'description'    => 'Description',
																						'not_unique'     => 'The Text for not unique',
																						'character_type' => 'some_value',
																						'unique'         => 'yes',
																						'required' 		 => 'yes'
																					)))
																))),
													)))
												)),
						// Page setups
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'page_choices',
										'title' => __('Page Choices', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Setup up the page layout choices for default pages', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Home Page
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'Home',
																	'description' => 'Chose which page to set as home',
																	'array'       => 'main_options',
																	'name'        => 'home_page',
																	'saved'       => '' )) ),
														// Archive page
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'Archive',
																	'description' => 'Archive pages display post under certain categories and tags',
																	'array'       => 'main_options',
																	'name'        => 'archive_page',
																	'saved'       => '' )) ),
														// Search
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'Search',
																	'description' => 'Your search page displays results of anything a visitor may search for',
																	'array'       => 'main_options',
																	'name'        => 'search_page',
																	'saved'       => '' )) ),
														// not found page
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type'        => 'text',
																	'title'       => 'Not Found',
																	'description' => 'This page will show up whenever a visitor searches for something which does not exists',
																	'array'       => 'main_options',
																	'name'        => '404_page',
																	'saved'       => '' )) ),

													)))
												))
				));
?>