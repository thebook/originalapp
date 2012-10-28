<?php 

	return array( 
				'opt' => 
					array(
						// Header
						array( 
							'f' => array($this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'header_admin',
										'title' => __('Header', 'liquidflux'),
										'page'  => 'whitewhale',
										'options' => 
											array( 
												'opt' => 
													array(
														// Leaderboard size
														array(
															'f' => array($this, 'put'),
															'o' => array(
																	'select',
																	'Leaderboard Size',
																	'Chose the size of your header advert',
																	'main_options',
																	'header_advert_type',
																	'large',
																	array('large', 'small'),
																	array('Large(728x90)', 'Small(468x60)') ) ),
														// Leaderboard Code 
														array(
															'f' => array( $this, 'put'),
															'o' => 
																array(
																	'textarea',
																	'Leaderboard Code',
																	'Paste the code of your leaderboard ad here',
																	'main_options',
																	'header_leaderboard_ad_code' ) ),
														// Title style 
														array(
															'f' => array( $this, 'put'),
															'o' => 
																array(
																	'select',
																	'Title Style',
																	'Set the style of your title',
																	'main_options',
																	'header_title_sate',
																	'titlelogo',
															        array( 'titlelogo', 'logo', 'title', 'none' ),
																	array( 'Title & Logo', 'Logo', 'Title', 'None' ) ) ),
														// 
														//  Font choice should come in here
														//  
														//  Title text style 
														array(
															'f' => array( $this, 'put'),
															'o' => 
																array(
																	'select',
																	'Title Text Style',
																	'Style your header title',
																	'main_options',
																	'header_text_style',
																	'normal',
															        array( 'normal', 'italic', 'bold', 'italicbold' ),
																	array( 'Normal', 'Italic', 'Bold', 'Italic & Bold' ) ) ),
														// Title size 
														// array(
														// 	'f' => array( $this, 'put'),
														// 	'o' => 
														// 		array(
														// 			'slider',
														// 			'Title Size',
														// 			'Set the size of your title',
														// 			'main_options',
														// 			'header_title_font_size',
														// 			'32' ) ),
														// // Title color 
														// array(
														// 	'f' => array( $this, 'put'),
														// 	'o' => 
														// 		array(
														// 			'color',
														// 			'Title Color',
														// 			'The color of your title text',
														// 			'main_options',
														// 			'header_title_color',
														// 			'#444' ) ),
															))
														))),
						// Navigation
						array( 
							'f' => array( $this, 'pop' ),
							'o'	=>	
								array(
									array( 
										'id' => 'navigation_admin',
										'title' => __('Navigation', 'liquidflux'),
										'page'  => 'whitewhale',
										'options' => 
											array( 
												'opt' => 
													array(							
														// Upload Image
														array(
															'f' => array( $this, 'put' ),
															'o' => 
																array(
																	'text',
																	'Title Color',
																	'The color of your title text',
																	'main_options',
																	'header_title_color',
																	'#444' ) ),
																																				
															), )
														)))
													));
	

?>