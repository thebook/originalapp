<?php 

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
												array( true,  'page' ),
												array( true,  'post' ) ),
										'enqueue' => true 
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
												trailingslashit( get_template_directory_uri() ) . '/Admin/assets/post-ui.js', 
												array(
													'thickbox', 
													'media-upload'), 
												'0.8', 
												false ),
										'conditional' => 
											array(
												array( false, 'admin.php'),
												array( true,  'lf_slide' )),
										'enqueue' => true 
											))),
						// clone js, cloning for the slider
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
												trailingslashit( get_template_directory_uri() ) . 'Framework/Slider/scripts/remove.js', 
												'',
												'1',
												false ),
										'conditional' => array( array( true,  'lf_slide' )), 
										'enqueue' => true
										))),
						// our own jquery
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'jquery', 
												COREURI . '/Js/jquery.js', 
												array(), 
												'1.7.1', 
												true ),
										'conditional' => false,
										'enqueue' => false
										))),
						// functions for pages
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'lf-functions',
												COREURI . '/Js/lf-functions.js',
												array( 'jquery', 'j-ease' ),
												'1',
												true  ),
										'conditional' => false,
										'enqueue' => true
										))),
						// easing plugin for jquery, ( for animations )
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'j-ease', 
												COREURI . '/Js/jquery.easing.min.js', 
												array( 'jquery' ), 
												'1.3', 
												true ),
										'enqueue' => false,
										'conditional' => false
										))),
						// j player
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'jplayer', 
												COREURI . '/Js/jquery.jplayer.min.js', 
												array( 'jquery' ), 
												'2.2', 
												true ),
										'conditional' => false, 
										'enqueue' => true
										))),
						// lightbox plugin
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'slimbox',
												COREURI . '/Js/slimbox2.js',
												array( 'jquery' ),
												'2.0',
												true ),
										'conditional' => false, 
										'enqueue' => true
										))),
						// slider
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'script',
										'arg'  => 
											array(
												'flexslider', 
												FRAMEWORKURI . '/Slider/scripts/flexslider-min.js',
												array( 'jquery', 'j-ease' ),
												'2.1',
												true ),
										'conditional' => false, 
										'enqueue' => true
										))),
						// public style
						array(
							'f' => array( $this, 'sort'),
							'o' =>
								array(
									array(
										'side' => 'public',
										'type' => 'style',
										'arg'  => 
											array(
												'lfstyle', 
												FRAMEWORKURI . '/CSS/style-core.css' ),
										'conditional' => false, 
										'enqueue' => true
										)))
									));

?>