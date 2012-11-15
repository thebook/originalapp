<?php 
	// This is the definition array for the slider meta boxes, they have their own spin copared to post metaboxes
	return array(
			'options' => 'main_meta',
			'nonce' => 'lf-meta-nonce',
			'nonce_value' => basename(__FILE__),
			'opt' =>
				array(
					// General Slider options
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'general_slide',
									'desc'=> 'Set the general settings of your slider',
									'title' => __('General Settings', 'liquidflux'),
									'post_type' => 'lf_slide',
									'context' => 'normal',
									'priority' => 'high',
									'options' => 
										array( 
											'opt' => 
												array(							
													// Nonce Field
													array(
														'f' => 'wp_nonce_field',
														'o' => array(
																	basename(__FILE__), 
																	'lf-meta-nonce' ) ),
													// Type
													array(
														'f' => array( $this, 'create' ),
														'o' => array( 
															array(
															'type'        => 'select',
															'title'       => 'Type',
															'description' => 'Set the layout type of your slider',
															'array'       => 'main_meta',
															'name'        => 'general_slider_type',
															'saved'       => 'full',
															'values'      => array('full-width', 'regular' ),
															'options'     => array('Full width', 'Regular Width(960px)' ) )) )																																	
														))
													))),
					// Add/remove slide
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'add_remove_slide',
									'desc'=> 'Add and remove slides',
									'title' => __('Add/Remove', 'liquidflux'),
									'post_type' => 'lf_slide',
									'context' => 'side',
									'priority' => 'low',
									'options' => 
										array( 
											'opt' => 
												array(							
													// Nonce Field
													array(
														'f' => 'wp_nonce_field',
														'o' => array(
																	basename(__FILE__), 
																	'lf-meta-nonce' ) ),
													// Upload Image & counter
													array(
														'f' => array( $this, 'buttons' ),
														'o' => array( 
																	'/Framework/ajax_loads/slider.load.php',
																	'lf-remove-button',
																	'meta_count_slider') ),
																																			
														))
													))),
					// The slide prototype, this is cloned for each slide that is generated
					array(
						'f' => array( $this, 'for_each_slide_there_is_pop_one' ),
						'o' => 
							array(
								array( 
									'id' => 'slide',
									'desc' => 'Configure your slide to show video or image',
									'title' => 'Slide',
									'post_type' => 'lf_slide',
									'context' => 'normal',
									'priority' => 'low',
									'arr' => 'main_meta',
									'options' => 
										array( 
											'opt' =>
												array( 
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'select',
																'title' => 'Type',
																'description' => 'Chose the type of slide you want to have',
																'array' => 'main_meta',
																'name' => 'slide_type',
																'saved' => 'image',
																'values' => array('image','video','featured'),
																'options' => array('Image','Video','Featured Post'))) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'textarea',
																'title' => 'Embed',
																'description' => 'Embed your youtube or vimeo video',
																'array' => 'main_meta',
																'name' => 'slide_embed',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array('slide_type','["video"]'))) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Caption',
																'description' => 'The caption for your image, leave blank if no caption is desired',
																'array' => 'main_meta',
																'name' => 'slide_caption',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array('slide_type','["image"]'))) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'upload',
																'title' => 'Upload Image',
																'description' => 'Upload your slide image',
																'array' => 'main_meta',
																'name' => 'slide_upload',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array('slide_type','["image"]'))) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'post',
																'title' => 'Posts',
																'description' => 'Chose a post to feature on the slide',
																'array' => 'main_meta',
																'name' => 'slide_post',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array('slide_type','["featured"]'))) )																																																																				
										))
									)))
				));

?>