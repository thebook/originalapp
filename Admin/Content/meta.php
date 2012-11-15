<?php


function lf_post_meta_boxes_save($post_id) { 

								
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
								
		return;
		
	if ( !isset( $_POST['main_meta'] ) || !isset( $_POST['lf-meta-nonce'] ) || !wp_verify_nonce($_POST['lf-meta-nonce'], basename(__FILE__) ) ) 
	
		return;
					
	if ( !current_user_can( 'edit_post', $post_id ) )
									
		return;
	
	update_post_meta( $post_id, 'main_meta', $_POST['main_meta'] );
	
		
}

function lf_meta_box() { 

$lf_slide_opt = new slide_opt('main_meta');

$meta = array( 
		'opt' => 
			array(
				// Post Settings 
				array( 
					'f' => 'pop',
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
												// Layout Func
												array(
													'f' => 'meta_layout',
													'o' => array()
														 ),
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
												// Show post thumbnails(preivew images)
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Thumbnail',
															'Show or hide your post thumbnail when viewed in a single post.', 
															'main_meta', 
															'show_post_thumbnail', 
															'show', 
															array( 'show', 'hide' ),
															array( 'Show', 'Hide' )) ),
												// What happens when the post thumbnail is clicked
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'select', 
															'Thumbnail Click',
															'Your thumbnail can behave differently based on what you chose when it is clicked.', 
															'main_meta', 
															'post_thumbnail_click', 
															'post', 
															array( 'null', 'post', 'lightbox', 'otherlight', 'webpage' ),
															array( 'Does nothing', 
																   'Link to post', 
																   'Open in a lightbox', 
																   'Open another image in a lightbox', 																   
																   'Go to another webpage' )) ),
												// Url for which webpage to redirect if thumbnail clicked,
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Webpage Link',
															'Here you can enter the url you wish the thumbnail to redirect to.', 
															'main_meta', 
															'post_thumbnail_click_webpage', 
															'',
															'',
															'',
															array( '#lf-post-meta-post_thumbnail_click', 
																   '#post_thumbnail_click_webpage-hook', 
																   '["webpage"]' )) ),
												// Upload image to be opened in a lightbox when thumbnail clicked
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'upload', 
															'Upload Image',
															'You can upload the image you would like the thumbnail to open', 
															'main_meta', 
															'post_thumbnail_click_image', 
															'',
															'',
															'',
															array( '#lf-post-meta-post_thumbnail_click', 
																   '#post_thumbnail_click_image-hook', 
																   '["otherlight"]' )) ),
												// Show inner widget area, which shows up next to the author box, or after post
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Inner Widget Area',
															'The Inner widget area comes after your post body, and you put any number of widgets in it.', 
															'main_meta', 
															'show_post_inner_widgets', 
															'show', 
															array( 'show', 'hide' ),
															array( 'Show', 'Hide' )) ),
												// Hide post comments( not the same as inbuilt disable comments )
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Comments',
															'You can hide your comments. To only disable commenting use the in built "discusion" box.', 
															'main_meta', 
															'show_post_comments', 
															'show', 
															array( 'show', 'hide' ),
															array( 'Show', 'Hide' )) ),
												// Show post meta( date and author )
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Meta',
															'Hiding post meta will hide the date and author of the post.', 
															'main_meta', 
															'show_post_meta', 
															'show', 
															array( 'show', 'hide' ),
															array( 'Show', 'Hide' )) )

													), )
												))),
				// Image Format 
				array( 
					'f' => 'pop',
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
												// Upload Image
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'upload', 
															'Upload Image',
															'Upload the posts image', 
															'main_meta', 
															'post_image_format_img_upload' ) ),
												// Image credit or author
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Credit',
															'You can write the name of the image author, if left blank no credit will show up.', 
															'main_meta', 
															'post_image_format_credit' ) ),
												// Image credit link
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Link',
															'You can have the credited name link to any webpage', 
															'main_meta', 
															'post_image_format_credit_link'  ) ),
												// Show/Hide text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Lightbox',
															'You can have your uploaded image open in a lightbox when clicked', 
															'main_meta', 
															'post_image_format_lightbox',
															'nolight',
															array( 'show', 'nolight' ),
															array( 'Lightbox', 'No Lightbox' )) ),
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
															'main_meta', 
															'post_image_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																							
													), )
												))),
				// Quote Format 
				array( 
					'f' => 'pop',
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
												// Quote Text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'textarea', 
															'Quote',
															'Quote Text', 
															'main_meta', 
															'post_quote_format' ) ),
												// Author name
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Author',
															'Name of the quote author, if left blank no author name will show up', 
															'main_meta', 
															'post_quote_format_credit' ) ),
												// Show/Hide text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text, if hidden the text written in the editor will not be shown', 
															'main_meta', 
															'post_quote_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																																
													), )
												))),
				// Gallery Format
				array( 
					'f' => 'pop',
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
												// Upload Images
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'gallery', 
															'Upload Images',
															'Upload gallery images, you can upload as many as you want, click on an image to remove it', 
															'main_meta', 
															'post_gallery_format_upload',
															'' ) ),
												// Transition effects
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'select', 
															'Transition',
															'The images in your gallery can transition in different ways', 
															'main_meta', 
															'post_gallery_format_effect',
															'text',
															array( 'slide', 'fade' ),
															array( 'Slide', 'Fade' )) ),
												// Show/Hide text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
															'main_meta', 
															'post_gallery_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																																		
													), )
												))),
				// Link Format
				array( 
					'f' => 'pop',
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
												// Link url
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Link',
															'Your link url', 
															'main_meta', 
															'post_link_format_link',
															'' ) ),
												// Link description 
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'textarea', 
															'Link Text',
															'You can enter text describing your link here, if left blank the link url will be used instead', 
															'main_meta', 
															'post_link_format_desc',
															''  ) ),
												// Show/Hide text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text, if hidden the text written in the editor will not be shown', 
															'main_meta', 
															'post_link_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																																													
													), )
												))),
				// Video Format 
				array( 
					'f' => 'pop',
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
												// OGV url link
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'OGV file url',
															'The url of your .ogv file', 
															'main_meta', 
															'post_video_format_ogv_url',
															'' ) ),
												// M4V url link
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'M4V file url',
															'The url of your .m4v file', 
															'main_meta', 
															'post_video_format_m4v_url',
															'') ),
												// Poster Upload
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'upload', 
															'Poster',
															'Upload the poster for your hosted video', 
															'main_meta', 
															'post_video_format_poster_upload' ) ),
												// Embeded video text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'textarea', 
															'Embed',
															'Acepts either youtube or vimeo embeds and urls', 
															'main_meta', 
															'post_video_format_embed',
															'' ) ),
												// Embeded video height
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'Embed Height',
															'Height of your embeded video, the default is 500px', 
															'main_meta', 
															'post_video_format_height',
															''  ) ),
												// Show/Hide Text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
															'main_meta', 
															'post_video_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																																		
													), )
												))),
				// Audio Format
				array( 
					'f' => 'pop',
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
												// OGA file url
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'OGA file url',
															'The url of your .oga file', 
															'main_meta', 
															'post_audio_format_oga_url',
															'' ) ),
												// MP3 file url
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'text', 
															'MP3 file url',
															'The url of your .mp3 file', 
															'main_meta', 
															'post_audio_format_mp3_url',
															'' ) ),
												// Poster upload
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'upload', 
															'Poster',
															'Upload the poster for your audio file', 
															'main_meta', 
															'post_audio_format_poster_upload' ) ),
												// Show/Hide Poster
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Show Poster',
															'You can show or hide the poster you have uploaded for you audio', 
															'main_meta', 
															'post_audio_format_poster_show',
															'hide',
															array( 'show', 'hide' ),
															array( 'Show', 'Hide' )) ),
												// Show/Hide text
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'radio', 
															'Text',
															'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
															'main_meta', 
															'post_audio_format_text',
															'text',
															array( 'text', 'notext' ),
															array( 'Show', 'Hide' )) )																																		
													), )
												))),
				// Page General Settings
				array( 
					'f' => 'pop',
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
												// Upload Image
												array(
													'f' => 'meta_layout',
													'o' => array() )																					
													), )
												))),
				// Slider Meta Boxes 
				// General Settings
				array( 
					'f' => 'pop',
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
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'select',
															'Type',
															'Set the layout type of your slider',
															'main_meta',
															'general_slider_type',
															'full',
															array('full-width', 'regular' ),
															array('Full width', 'Regular Width(960px)' ) ) ), 												
												// Text box 
												array(
													'f' => 'lf_meta_opt',
													'o' => 
														array(
															'textarea',
															'Text Box',
															'Enter the text of the box, it will appear to the right of the slider',
															'main_meta',
															'general_slider_text_box_one',
															'',
													        '',
															'',
															array( '#lf-post-meta-general_slider_type', 
																   '#general_slider_text_box_one-hook', 
																   '["onebox"]' ) ) )																																		
													), )
												))),
				// Add/remove slide
				array( 
					'f' => 'pop',
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
													'f' => array( $lf_slide_opt, 'buttons' ),
													'o' => array( 
																'/Framework/Slider/meta.php',
																'lf-remove-button',
																'meta_count_slider') ),
																																		
													), )
												))),
				// Slide prototype array Is defined in "Framework/Slider/options-meta.php" 
				array( 
					'f' => array( $lf_slide_opt, 'pop' ),
					'o'	=>	array() )
					));

$seo = array( 
			'f' => 'pop',
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
										// Post title
										array(
											'f' => 'lf_meta_opt',
											'o' => 
												array(
													'text', 
													'Title',
													'Search engines take up a maximum of 60 characters for the title', 
													'main_meta', 
													'post_seo_title') ),
										// Post description
										array(
											'f' => 'lf_meta_opt',
											'o' => 
												array(
													'text', 
													'Description',
													'Search engines take a maxumum of 160 characters for the description', 
													'main_meta', 
													'post_seo_description' ) ),
										// Post keywords
										array(
											'f' => 'lf_meta_opt',
											'o' => 
												array(
													'text', 
													'Keywords',
													'Seperate the keywords by commas', 
													'main_meta', 
													'post_seo_key' ) ),
										// Post meta robots index
										array(
											'f' => 'lf_meta_opt',
											'o' => 
												array(
													'radio', 
													'Robot Meta Index',
													'Let robots index this page', 
													'main_meta', 
													'post_seo_robots_index',
													'index',
													array( 'index', 'noidex' ),
													array( 'Index', 'Dont Index')) ),
										// Post meta robots link follow
										array(
											'f' => 'lf_meta_opt',
											'o' => 
												array(
													'radio', 
													'Robot Meta Follow',
													'Let robots follow links from this page', 
													'main_meta', 
													'post_seo_robots_follow',
													'follow',
													array( 'follow', 'nofollow' ),
													array( 'Follow', 'Dont Follow')) )																																	
											), )
										)));

	
$seop = $seo;
$seop['o']['0']['post_type'] = 'page';
	
	( !lf_other_use_seo() ) and array_push( $meta['opt'], $seo, $seop ); 
									
	multi( $meta );		

}

add_action( 'add_meta_boxes', 'lf_meta_box' ); 

add_action( 'save_post', 'lf_post_meta_boxes_save' );


function meta_layout() {

	global $post;     
	
	$main_meta = get_post_meta( $post->ID, 'main_meta', true );
	
	$main_opt = get_option('main_options'); 
	
	$layout = ( isset( $main_meta['chosen_layout'] ) ? $main_meta['chosen_layout'] : 'default' );

	echo '<tr>';
		
		echo '<th>';
			
			echo '<label for="chosen_layout">';
		
			echo '<strong>';
			
			echo 'Post Layout';
			
			echo '</strong>';
			
			echo '<span class="lf-admin-post-meta-th-span">';
			
			echo 'You can chose any of the layouts you have created, or if not certain use the preset default.';
			
			echo '</span>';
			
			echo '</label>';
		
		echo '</th>';
		
		echo '<td>';
		
			echo '<select class="lf-admin-post-meta-td-select" name="main_meta[chosen_layout]">';
			
			echo '<option value="default" '. selected( $layout, 'default', false ) .'>Default</option>';
			
			if ( isset( $main_opt['test_saved_layouts']['name'] ) ) {
			
				foreach ( $main_opt['test_saved_layouts']['name'] as $key => $value ) { 
				
					echo "<option value='$key' ". selected( $layout, $key, false ) .">$value</option>";
				
				}
			
			}
			
			echo '</select>';
		
		echo '</td>';
		
		echo '</tr>'; 

}

?>