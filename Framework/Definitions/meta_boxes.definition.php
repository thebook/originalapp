<?php 
	
	$meta_box_manifestation = 
		array( 
			'options' => 'main_meta',
			'nonce' => 'lf-meta-nonce',
			'nonce_value' => basename(__FILE__),
			'opt' => 
				array(
					// Post Settings 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'post_settings_meta_box',
									'desc'=> 'You can adjust your post settings, thumbnail and chose its layout.',
									'title' => __('Post Settings', 'liquidflux'),
									'post_type' => 'post',
									'context' => 'normal',
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
																	'lf-meta-nonce' )
															 ),
													// Echo the function call which displays metaboxes acording to post format
													array(
														'f' => 'scripter',
														'o' => array( 'reveal.radio_reveal("#post-formats-select", ["gallery", "image", "quote", "link", "video", "audio" ], ["#gallery_format_meta", "#image_format_meta", "#quote_format_meta", "#link_format_meta", "#video_format_meta", "#audio_format_meta"]);' )
															),
													// Layout builder 
													array(
														'f' => array( $this, 'create'),
														'o' => array(  
															array(
																'type'        => 'layout_button',
																'title'       => 'Create Layout',
																'description' => 'Create a layout for you post, by entering the layout builder',
																'array'       => 'main_meta',
																'name'        => 'post_layout',
																'saved'       => '',
														        'button_name' => 'Create Layout' )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Thumbnail',
																'description' => 'Show or hide your post thumbnail when viewed in a single post.',
																'array' => 'main_meta',
																'name' => 'show_post_thumbnail',
																'saved' => 'show',
																'values' => array('show','hide'),
																'options' => array('Show','Hide') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'select',
																'title' => 'Thumbnail Click',
																'description' => 'Your thumbnail can behave differently based on what you chose when it is clicked.',
																'array' => 'main_meta',
																'name' => 'post_thumbnail_click',
																'saved' => 'post',
																'values' => array('null','post','lightbox','otherlight','webpage'),
																'options' => array('Does nothing','Link to post','Open in a lightbox','Open another image in a lightbox','Go to another webpage') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Webpage Link',
																'description' => 'Here you can enter the url you wish the thumbnail to redirect to.',
																'array' => 'main_meta',
																'name' => 'post_thumbnail_click_webpage',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array( 'post_thumbnail_click', '["webpage"]' ) )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'upload',
																'title' => 'Upload Image',
																'description' => 'You can upload the image you would like the thumbnail to open',
																'array' => 'main_meta',
																'name' => 'post_thumbnail_click_image',
																'saved' => '',
																'values' => '',
																'options' => '',
																'hider' => array('post_thumbnail_click','["otherlight"]') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Inner Widget Area',
																'description' => 'The Inner widget area comes after your post body, and you put any number of widgets in it.',
																'array' => 'main_meta',
																'name' => 'show_post_inner_widgets',
																'saved' => 'show',
																'values' => array('show','hide'),
																'options' => array('Show','Hide') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Comments',
																'description' => 'You can hide your comments. To only disable commenting use the in built "discusion" box.',
																'array' => 'main_meta',
																'name' => 'show_post_comments',
																'saved' => 'show',
																'values' => array('show','hide'),
																'options' => array('Show','Hide') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Meta',
																'description' => 'Hiding post meta will hide the date and author of the post.',
																'array' => 'main_meta',
																'name' => 'show_post_meta',
																'saved' => 'show',
																'values' => array('show','hide'),
																'options' => array('Show','Hide') )) )
										))
					))),
					//Image Format 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'image_format_meta',
									'desc'=> 'You can upload and adjust your image post format.',
									'title' => __('Image Settings', 'liquidflux'),
									'post_type' => 'post',
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
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'upload',
																'title' => 'Upload Image',
																'description' => 'Upload the posts image',
																'array' => 'main_meta',
																'name' => 'post_image_format_img_upload',
																'saved' => ''  ) )),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Credit',
																'description' => 'You can write the name of the image author, if left blank no credit will show up.',
																'array' => 'main_meta',
																'name' => 'post_image_format_credit',
																'saved' => '' ) )),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Link',
																'description' => 'You can have the credited name link to any webpage',
																'array' => 'main_meta',
																'name' => 'post_image_format_credit_link',
																'saved' => '' ) )),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Lightbox',
																'description' => 'You can have your uploaded image open in a lightbox when clicked',
																'array' => 'main_meta',
																'name' => 'post_image_format_lightbox',
																'saved' => 'nolight',
																'values' => array('show','nolight'),
																'options' => array('Lightbox','No Lightbox') )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Text',
																'description' => 'You can hide or enable your body text. If hidden the text written in the editor will not be shown.',
																'array' => 'main_meta',
																'name' => 'post_image_format_text',
																'saved' => 'text',
																'values' => array('text','notext'),
																'options' => array('Show','Hide') )) )												
										))
					))),
					// Quote Format 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'quote_format_meta',
									'desc'=> 'You can paste the quote and author here and adjust settings.',
									'title' => __('Quote Settings', 'liquidflux'),
									'post_type' => 'post',
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
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'textarea',
																'title' => 'Quote',
																'description' => 'Quote Text',
																'array' => 'main_meta',
																'name' => 'post_quote_format',
																'saved' => '' )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Author',
																'description' => 'Name of the quote author, if left blank no author name will show up',
																'array' => 'main_meta',
																'name' => 'post_quote_format_credit',
																'saved' => '' )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Text',
																'description' => 'You can hide or enable your body text, if hidden the text written in the editor will not be shown',
																'array' => 'main_meta',
																'name' => 'post_quote_format_text',
																'saved' => 'text',
																'values' => array('text','notext'),
																'options' => array('Show','Hide'))) ),																																																						
										))
					))),
					// Gallery Format
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'gallery_format_meta',
									'desc'=> 'You can upload your gallery images through this meta.',
									'title' => __('Gallery Settings', 'liquidflux'),
									'post_type' => 'post',
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
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type' => 'gallery',
																	'title' => 'Upload Images',
																	'description' => 'Upload gallery images, you can upload as many as you want, click on an image to remove it',
																	'array' => 'main_meta',
																	'name' => 'post_gallery_format_upload',
																	'saved' => '')) ),
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type' => 'select',
																	'title' => 'Transition',
																	'description' => 'The images in your gallery can transition in different ways',
																	'array' => 'main_meta',
																	'name' => 'post_gallery_format_effect',
																	'saved' => 'text',
																	'values' => array('slide','fade'),
																	'options' => array('Slide','Fade'))) ),
														array(
															'f' => array( $this, 'create'),
															'o' => array(
																array(
																	'type' => 'radio',
																	'title' => 'Text',
																	'description' => 'You can hide or enable your body text. If hidden the text written in the editor will not be shown.',
																	'array' => 'main_meta',
																	'name' => 'post_gallery_format_text',
																	'saved' => 'text',
																	'values' => array('text','notext'),
																	'options' => array('Show','Hide'))) ),																												
										))
					))),
					// Link Format
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'link_format_meta',
									'desc'=> 'You can enter you link here along with a description.',
									'title' => __('Link Settings', 'liquidflux'),
									'post_type' => 'post',
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
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'Link',
																'description' => 'Your link url',
																'array' => 'main_meta',
																'name' => 'post_link_format_link',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'textarea',
																'title' => 'Link Text',
																'description' => 'You can enter text describing your link here, if left blank the link url will be used instead',
																'array' => 'main_meta',
																'name' => 'post_link_format_desc',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Text',
																'description' => 'You can hide or enable your body text, if hidden the text written in the editor will not be shown',
																'array' => 'main_meta',
																'name' => 'post_link_format_text',
																'saved' => 'text',
																'values' => array('text','notext'),
																'options' => array('Show','Hide'))) ),
										))
					))),
					// Video Format 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'video_format_meta',
									'desc'=> 'You can upload your own video and either use you tube or vimeo',
									'title' => __('Video Settings', 'liquidflux'),
									'post_type' => 'post',
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
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'OGV file url',
																'description' => 'The url of your .ogv file',
																'array' => 'main_meta',
																'name' => 'post_video_format_ogv_url',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'M4V file url',
																'description' => 'The url of your .m4v file',
																'array' => 'main_meta',
																'name' => 'post_video_format_m4v_url',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'upload',
																'title' => 'Poster',
																'description' => 'Upload the poster for your hosted video',
																'array' => 'main_meta',
																'name' => 'post_video_format_poster_upload',
																'saved' => '' )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'textarea',
																'title' => 'Embed',
																'description' => 'Acepts either youtube or vimeo embeds and urls',
																'array' => 'main_meta',
																'name' => 'post_video_format_embed',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'slider',
																'title' => 'Embed Height',
																'description' => 'Height of your embeded video',
																'array' => 'main_meta',
																'name' => 'post_video_format_height',
																'saved' => '500',
																'min'   => '250',
																'max'   => '700')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Text',
																'description' => 'You can hide or enable your body text. If hidden the text written in the editor will not be shown.',
																'array' => 'main_meta',
																'name' => 'post_video_format_text',
																'saved' => 'text',
																'values' => array('text','notext'),
																'options' => array('Show','Hide'))) ),
										))
					))),
					// Audio Format
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'audio_format_meta',
									'desc'=> 'Upload your own audio',
									'title' => __('Audio Settings', 'liquidflux'),
									'post_type' => 'post',
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
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'OGA file url',
																'description' => 'The url of your .oga file',
																'array' => 'main_meta',
																'name' => 'post_audio_format_oga_url',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'text',
																'title' => 'MP3 file url',
																'description' => 'The url of your .mp3 file',
																'array' => 'main_meta',
																'name' => 'post_audio_format_mp3_url',
																'saved' => '')) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'upload',
																'title' => 'Poster',
																'description' => 'Upload the poster for your audio file',
																'array' => 'main_meta',
																'name' => 'post_audio_format_poster_upload',
																'saved' => '' )) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Show Poster',
																'description' => 'You can show or hide the poster you have uploaded for you audio',
																'array' => 'main_meta',
																'name' => 'post_audio_format_poster_show',
																'saved' => 'hide',
																'values' => array('show','hide'),
																'options' => array('Show','Hide'))) ),
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type' => 'radio',
																'title' => 'Text',
																'description' => 'You can hide or enable your body text. If hidden the text written in the editor will not be shown.',
																'array' => 'main_meta',
																'name' => 'post_audio_format_text',
																'saved' => 'text',
																'values' => array('text','notext'),
																'options' => array('Show','Hide'))) ),
														))
					))),
					// Page General Settings
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'page_general_settings',
									'desc'=> 'Adjust page settings, including layout',
									'title' => __('Page Settings', 'liquidflux'),
									'post_type' => 'page',
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
													// options here																					
														))
					)))
		));

	$seo_post_meta_box = array( 
		'f' => array($this, 'pop'),
		'o'	=>	
			array(
				array( 
					'id' => 'seo_post_settings',
					'desc'=> 'Configure your SEO settings.',
					'title' => __('SEO Settings', 'liquidflux'),
					'post_type' => 'post',
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
									array(
										'f' => array( $this, 'create'),
										'o' => array(
											array(
												'type' => 'text',
												'title' => 'Title',
												'description' => 'Search engines take up a maximum of 60 characters for the title',
												'array' => 'main_meta',
												'name' => 'post_seo_title',
												'saved' => '')) ),
									array(
										'f' => array( $this, 'create'),
										'o' => array(
											array(
												'type' => 'text',
												'title' => 'Description',
												'description' => 'Search engines take a maxumum of 160 characters for the description',
												'array' => 'main_meta',
												'name' => 'post_seo_description',
												'saved' => '')) ),
									array(
										'f' => array( $this, 'create'),
										'o' => array(
											array(
												'type' => 'text',
												'title' => 'Keywords',
												'description' => 'Seperate the keywords by commas',
												'array' => 'main_meta',
												'name' => 'post_seo_key',
												'saved' => '' )) ),
									array(
										'f' => array( $this, 'create'),
										'o' => array(
											array(
												'type' => 'radio',
												'title' => 'Robot Meta Index',
												'description' => 'Let robots index this page',
												'array' => 'main_meta',
												'name' => 'post_seo_robots_index',
												'saved' => 'index',
												'values' => array('index','noidex'),
												'options' => array('Index','Dont Index'))) ),
									array(
										'f' => array( $this, 'create'),
										'o' => array(
											array(
												'type' => 'radio',
												'title' => 'Robot Meta Follow',
												'description' => 'Let robots follow links from this page',
												'array' => 'main_meta',
												'name' => 'post_seo_robots_follow',
												'saved' => 'follow',
												'values' => array('follow','nofollow'),
												'options' => array('Follow','Dont Follow'))) ),																																																		
										))
		)));
	
	$seo_page_meta_box = $seo_post_meta_box;
	$seo_page_meta_box['o']['0']['post_type'] = 'page';

	( !are_other_seo_plugins_being_used() ) and array_push( $meta_box_manifestation['opt'], $seo_post_meta_box, $seo_page_meta_box ); 
	
	return $meta_box_manifestation;
?>