<?php 
	
	// Used within the "register_scripts" Class : path "/Framework/register_scripts.php"
	// Use this array to feed the class all the js and styles you want registered and enqueued, as such
	// you will not need to register them anywhere else or in any other file. One registration to rule them all

	return array( 
				'opt' =>
					array(
						// Admin style
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'style',
										'arg'  => 
											array(
												'lf-admin',
												FRAMEWORKURI .'/CSS/style-admin.css',
												array('thickbox'),
												'1.0' ),
										'conditional' => 
											array(
												array( false, 'admin.php'),
												array( true,  'lf_slide' ),
												array( true,  'books' ),
												array( true,  'page' ),
												array( true,  'post' ) ),
										'enqueue' => true 
											))),
						// Admin style
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'layout',
												FRAMEWORKURI .'/scripts/layout.js',
												array('jquery'),
												'1.0' ),
										'conditional' => array(
											array( true,  'page' ),
											array( true,  'post' )
											),
										'enqueue' => false
											))),
						// jGrowl
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'jGrowl',  
												SCRIPTS .'/jgrowl.min.js', 
												array('jquery'), 
												'1.25', 
												false ),
										'conditional' => false,
										'enqueue' => false 
											))),
						// admin js
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'post-ui',  
												SCRIPTS .'/post-ui.js', 
												array(
													'thickbox', 
													'media-upload',
													'jGrowl',
													'jquery-ui-slider',
													'layout'), 
												'1.0', 
												false ),
										'conditional' => 
											array(
												array( false, 'admin.php'),
												array( true,  'lf_slide' ),
												array( true,  'books' ),
												array( true,  'post' )
												),
										'enqueue' => true 
											))),
						// Colorpicker
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'lf-color-picker',  
												SCRIPTS .'/colorpicker.js', 
												array('jquery'), 
												'1.16', 
												false ),
										'conditional' => 
											array(
												array( false, 'admin.php')),
										'enqueue' => true 
											))),
						// users js init
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'lf_users',
												SCRIPTS .'/init.users.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'lf_users_adder',
												SCRIPTS .'/adder.users.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'lf_users_utility',
												SCRIPTS .'/utility.users.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.mover',
												SCRIPTS .'/mover.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.editer',
												SCRIPTS .'/editer.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'amazon',
												SCRIPTS .'/amazon.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.search',
												SCRIPTS .'/search.alpha.js',
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.ticket',
												SCRIPTS .'/ticket.alpha.js',
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.verify.ticket',
												SCRIPTS .'/ticket.verify.alpha.js',
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha.buttons.ticket',
												SCRIPTS .'/ticket.buttons.alpha.js',
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'alpha',
												SCRIPTS .'/alpha.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => false,
										'enqueue' => true
										))),
						// remove js, cloning for the slider
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'clone-js',
												SCRIPTS .'/remove.js', 
												array('jquery'),
												'1',
												false ),
										'conditional' => array( 
											array( true, 'lf_slide' )
											), 
										'enqueue' => true
										))),
						// remove js, cloning for the slider
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'admin',
										'type' => 'script',
										'arg'  => 
											array(
												'load-js',
												SCRIPTS .'/load.js', 
												array('jquery'),
												'1.1',
												false ),
										'conditional' => array( 
											array( false, 'admin.php' )
											), 
										'enqueue' => true
										))),
						// // easing plugin for jquery, ( for animations )
						// array(
						// 	'f' => array( $this, 'sort'),
						// 	'o' =>
						// 		array(
						// 			array(
						// 				'side' => 'public',
						// 				'type' => 'script',
						// 				'arg'  => 
						// 					array(
						// 						'j-ease', 
						// 						SCRIPTS .'/jquery.easing.min.js', 
						// 						array( 'jquery' ), 
						// 						'1.3', 
						// 						true ),
						// 				'enqueue' => true,
						// 				'conditional' => false
						// 				))),
						// // The comments reply script
						// array(
						// 	'f' => array( $this, 'sort'),
						// 	'o' =>
						// 		array(
						// 			array(
						// 				'side' => 'public',
						// 				'type' => 'script',
						// 				'arg'  => 
						// 					array(
						// 						'reply', 
						// 						SCRIPTS .'/comments.reply.js', 
						// 						array(), 
						// 						'1.0', 
						// 						true ),
						// 				'enqueue' => false,
						// 				'conditional' => false
						// 				))),
						// // j player
						// array(
						// 	'f' => array( $this, 'sort'),
						// 	'o' =>
						// 		array(
						// 			array(
						// 				'side' => 'public',
						// 				'type' => 'script',
						// 				'arg'  => 
						// 					array(
						// 						'jplayer', 
						// 						SCRIPTS .'/jquery.jplayer.min.js', 
						// 						array( 'jquery' ), 
						// 						'2.2', 
						// 						true ),
						// 				'conditional' => false, 
						// 				'enqueue' => true
						// 				))),
						// // lightbox plugin
						// array(
						// 	'f' => array( $this, 'sort'),
						// 	'o' =>
						// 		array(
						// 			array(
						// 				'side' => 'public',
						// 				'type' => 'script',
						// 				'arg'  => 
						// 					array(
						// 						'slimbox',
						// 						SCRIPTS .'/slimbox2.js',
						// 						array( 'jquery' ),
						// 						'2.0',
						// 						true ),
						// 				'conditional' => false, 
						// 				'enqueue' => true
						// 				))),
						// // slider
						// array(
						// 	'f' => array( $this, 'sort'),
						// 	'o' =>
						// 		array(
						// 			array(
						// 				'side' => 'public',
						// 				'type' => 'script',
						// 				'arg'  => 
						// 					array(
						// 						'flexslider', 
						// 						SCRIPTS .'/flexslider-min.js',
						// 						array( 'jquery', 'j-ease' ),
						// 						'2.1',
						// 						true ),
						// 				'conditional' => false, 
						// 				'enqueue' => true
						// 				)))
									));

?>