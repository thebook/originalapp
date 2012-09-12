<?php 

function lf_create_meta_opt( $type ='text', $realname = null, $desc = null, $optarray = null, $name = null, $default = null, $options = null, $optvals = null, $hider = null ) { 
	
	global $post;
	
	$meta = get_post_meta( $post->ID, $optarray, true );
			
	$the_opt = ( isset( $meta[$name] )? $meta[$name] : $default );
		
	echo "<tr id='$name-hook'>";
		
		echo '<th>';
			
		echo '<label for="'. $name .'">';
		
		echo '<strong class="lf-admin-post-meta-th-strong">';
			
		echo $realname;
			
		echo '</strong>';
			
		echo '<span class="lf-admin-post-meta-th-span">';
		
		echo $desc;
			
		echo '</span>';
			
		echo '</label>';
		
		echo '</th>';
	
	switch ( $type ) {
		
		case 'select' : 
		
			echo '<td>';
			
			echo '<select id="lf-post-meta-'. $name .'" class="lf-admin-post-meta-td-select" name="main_meta['.$name.']">';
			
			foreach ( $options  as $index => $value ) { 
			
				echo '<option value="'. $value .'" '. selected( $the_opt, $value, false ) .'>';
				
				echo $optvals[$index];
				
				echo '</option>';
				
			}
			
			echo '</select>';
			
			echo '</td>';
		
		break;
		
		case 'radio' : 
		
			echo '<td>';
			
			foreach ( $options  as $index => $value ) { 
			
				echo '<label id="lf-post-meta-'. $name .'" class="lf-admin-post-meta-td-radio-label">';
			
				echo '<input class="admin-radio" type="radio" name="main_meta['.$name.']" '. checked( $the_opt, $value, false ) .' value="'. $value .'" />';
			
				echo $optvals[$index];
			
				echo '</label>';
	
			}
				
			echo '</td>';
			
		break;
		
		case 'text' : 
		
			echo '<td>';
		
			echo '<input id="lf-post-meta-'. $name .'" type="text" class="lf-admin-post-meta-td-text" name="'. $optarray .'['.$name.']" value="'. $the_opt .'" />';
		
			echo '</td>';
		
		break;
		
		case 'upload' : 
		
			echo '<td>';
		
			echo '<input id="lf-post-meta-'. $name .'" type="hidden" class="lf-admin-post-meta-td-text" name="'. $optarray .'['.$name.']" value="'. $the_opt .'" />';

			if ( $the_opt != '' ) {
			
				echo '<img src="'. $the_opt .'" class="lf-admin-post-meta-td-image" title="lightbox image" />';
			
			}
			
			echo '<input id="lf-post-meta-'. $name .'-button" class="button lf-admin-post-meta-td-button" type="button" value="Upload Image" />';
		
			echo '</td>';
		
		break;
		
		case 'gallery' : 
		
			echo '<td>';
			
			if ( $the_opt != '' ) {
			
				foreach ( $the_opt as $key => $value ) { 
				
					echo '<span class="lf-admin-post-meta-td-image-removeable" >'; 
					
					echo '<input id="lf-post-meta-'. $name .'" type="hidden" name="'. $optarray .'['.$name.']['.$key.']" value="'. $value .'" />';
					
					echo '<img src="'. $value .'" title="remove gallery image" />';
						
					echo '</span>';	
						
				}
			
			}
			
			echo '<input id="lf-post-meta-'. $name .'-button" class="button lf-admin-post-meta-td-button" type="button" value="Upload Image" />';
		
			echo '</td>';
		
		break;
		
		case 'textarea' : 
		
			echo '<td>';
		
			echo '<textarea id="lf-post-meta-'. $name .'" type="text" class="lf-admin-post-meta-td-text" rows="5" name="'. $optarray .'['.$name.']" />'. $the_opt .'</textarea>';
		
			echo '</td>';
		
		break;
		
	}
		
	echo '</tr>';
	
	if ( isset( $hider ) ) {
	
		echo '<script>parts.reveal("'. $hider[0] .'","'. $hider[1] .'",'. $hider[2] .' );</script>';
	
	}
	
	if ( $type == 'upload' ) { 
	
		echo '<script> parts.supload( "#lf-post-meta-'. $name .'-button", "#lf-post-meta-'. $name .'" );</script>';
	
	}
	
	if ( $type == 'gallery' ) { 
	
		echo '<script> parts.gallery( "#lf-post-meta-'. $name .'-button", "'.$name.'", "'.$optarray.'" );</script>';
	
	}
	
}
	

function lf_post_settings_callback() {

	global $post;
	
	$main_meta = get_post_meta( $post->ID, 'main_meta', true );
	
	$main_opt = get_option('main_options'); 
	
	$layout = ( isset( $main_meta['chosen_layout'] ) ? $main_meta['chosen_layout'] : 'default' );
	
	wp_nonce_field( basename(__FILE__), 'lf-nonce-meta-field' );

	echo '<table class="form-table lf-admin-post-meta-table">';
	
	echo '<tbody>';
	
		echo '<p>';
		
		echo 'You can adjust your post settings, thumbnail and chose its layout.';
		
		echo '</p>';
	
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
	
	// Thumbnails
	lf_create_meta_opt( 
				'radio', 
				'Thumbnail',
				'Show or hide your post thumbnail when viewed in a single post.', 
				'main_meta', 
				'show_post_thumbnail', 
				'show', 
				array( 'show', 'hide' ),
				array( 'Show', 'Hide' ) ); 
				
	lf_create_meta_opt( 
				'select', 
				'Thumbnail Click',
				'Your thumbnail can behave differently based on what you chose when it is clicked.', 
				'main_meta', 
				'post_thumbnail_click', 
				'post', 
				array( 'null', 'post', 'lightbox', 'otherlight', 'videolight', 'webpage' ),
				array( 'Does nothing', 'Link to post', 'Open in a lightbox', 'Open another image in a lightbox', 'Open video in a lightbox', 'Go to another webpage' ) ); 			
	
		// / thumbnail click variations
		lf_create_meta_opt( 
					'text', 
					'Webpage Link',
					'Here you can enter the url you wish the thumbnail to redirect to.', 
					'main_meta', 
					'post_thumbnail_click_webpage', 
					'',
					'',
					'',
					array( '#lf-post-meta-post_thumbnail_click', '#post_thumbnail_click_webpage-hook', '["webpage"]' ) );
					
		lf_create_meta_opt( 
					'upload', 
					'Upload Image',
					'You can upload the image you would like the thumbnail to open', 
					'main_meta', 
					'post_thumbnail_click_image', 
					'',
					'',
					'',
					array( '#lf-post-meta-post_thumbnail_click', '#post_thumbnail_click_image-hook', '["otherlight"]' ) ); 
						
	// Widget area 
	lf_create_meta_opt( 
				'radio', 
				'Inner Widget Area',
				'The Inner widget area comes after your post body, and you put any number of widgets in it.', 
				'main_meta', 
				'show_post_inner_widgets', 
				'show', 
				array( 'show', 'hide' ),
				array( 'Show', 'Hide' ) ); 
	
	
	// Comments			
	lf_create_meta_opt( 
				'radio', 
				'Comments',
				'You can hide your comments. To only disable commenting use the in built "discusion" box.', 
				'main_meta', 
				'show_post_comments', 
				'show', 
				array( 'show', 'hide' ),
				array( 'Show', 'Hide' ) ); 
	// Meta			
	lf_create_meta_opt( 
				'radio', 
				'Meta',
				'Hidding post meta will hide the date and author of the post.', 
				'main_meta', 
				'show_post_meta', 
				'show', 
				array( 'show', 'hide' ),
				array( 'Show', 'Hide' ) ); 
			
	echo '</tbody>';
	
	echo '</table>'; 
	
}

function lf_post_image_callback() { 

	wp_nonce_field( basename(__FILE__), 'lf-nonce-meta-field' );

	echo '<table class="form-table lf-admin-post-meta-table">';
	
	echo '<tbody>';
	
	echo '<p>';
	
	echo 'You can upload and adjust your image post format.';
	
	echo '</p>';
	
	lf_create_meta_opt( 
					'upload', 
					'Upload Image',
					'Upload the posts image', 
					'main_meta', 
					'post_image_format_img_upload' );
	 				
	lf_create_meta_opt( 
					'text', 
					'Credit',
					'You can write the name of the image author, if left blank no credit will show up.', 
					'main_meta', 
					'post_image_format_credit' );
					
	lf_create_meta_opt( 
					'text', 
					'Link',
					'You can have the credited name link to any webpage', 
					'main_meta', 
					'post_image_format_credit_link' );
					
	lf_create_meta_opt( 
					'radio', 
					'Text',
					'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
					'main_meta', 
					'post_image_format_text',
					'text',
					array( 'text', 'notext' ),
					array( 'Show', 'Hide' ) );
	
	echo '</tbody>';
	
	echo '</table>';

}

function lf_post_quote_callback() { 

	wp_nonce_field( basename(__FILE__), 'lf-nonce-meta-field' );

	echo '<table class="form-table lf-admin-post-meta-table">';
	
	echo '<tbody>';
	
	echo '<p>';
	
	echo 'You can paste the quote and author here and adjust settings.';
	
	echo '</p>';
	
	lf_create_meta_opt( 
					'textarea', 
					'Quote',
					'Quote Text', 
					'main_meta', 
					'post_quote_format' );
					
	lf_create_meta_opt( 
					'text', 
					'Author',
					'Name of the quote author, if left blank no author name will show up', 
					'main_meta', 
					'post_quote_format_credit' );
	
	lf_create_meta_opt( 
					'radio', 
					'Text',
					'You can hide or enable your body text, if hidden the text written in the editor will not be shown', 
					'main_meta', 
					'post_quote_format_text',
					'text',
					array( 'text', 'notext' ),
					array( 'Show', 'Hide' ) );
	
	echo '</tbody>';
	
	echo '</table>';
	

}

function lf_post_gallery_callback() {

	wp_nonce_field( basename(__FILE__), 'lf-nonce-meta-field' );

	echo '<table class="form-table lf-admin-post-meta-table">';
	
	echo '<tbody>';
	
	echo '<p>';
	
	echo 'You can upload your gallery images through this meta.';
	
	echo '</p>';
	
	lf_create_meta_opt( 
					'gallery', 
					'Upload Images',
					'Upload gallery images, you can upload as many as you want, click on an image to remove it', 
					'main_meta', 
					'post_gallery_format_upload',
					'' );
					
	lf_create_meta_opt( 
					'select', 
					'Transition',
					'The images in your gallery can transition in different ways', 
					'main_meta', 
					'post_gallery_format_effect',
					'text',
					array( 'slide', 'fade' ),
					array( 'Slider', 'Fade' ) );
					
	lf_create_meta_opt( 
					'radio', 
					'Text',
					'You can hide or enable your body text. If hidden the text written in the editor will not be shown.', 
					'main_meta', 
					'post_gallery_format_text',
					'text',
					array( 'text', 'notext' ),
					array( 'Show', 'Hide' ) );

	echo '</tbody>';
	
	echo '</table>';
	
	

}

function lf_post_meta_boxes_save($post_id) { 

								
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
								
		return;
		
	if ( !isset( $_POST['main_meta'] ) || !isset( $_POST['lf-nonce-meta-field'] ) || !wp_verify_nonce($_POST['lf-nonce-meta-field'], basename(__FILE__) ) ) 
	
		return;
					
	if ( !current_user_can( 'edit_post', $post_id ) )
									
		return;
	
	update_post_meta( $post_id, 'main_meta', $_POST['main_meta'] );
	
		
}

function lf_post_meta_boxes() { 

	add_meta_box(
		'post_settings_meta_box',
		__('Post Settings', 'liquidflux'),
		'lf_post_settings_callback',
		'post',
		'normal',
		'high' );
		
	add_meta_box(
		'image_format_meta',
		__('Image Settings', 'liquidflux'),
		'lf_post_image_callback',
		'post',
		'normal',
		'high' );
		
	add_meta_box(
		'quote_format_meta',
		__('Quote Settings', 'liquidflux'),
		'lf_post_quote_callback',
		'post',
		'normal',
		'high' );
		
	add_meta_box(
		'gallery_format_meta',
		__('Gallery Settings', 'liquidflux'),
		'lf_post_gallery_callback',
		'post',
		'normal',
		'high' );
		
}

add_action( 'add_meta_boxes', 'lf_post_meta_boxes' );

add_action( 'save_post', 'lf_post_meta_boxes_save' );


?>