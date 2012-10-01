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
												)))
										)); 

										
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