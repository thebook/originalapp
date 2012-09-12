<?php

function lf_slider_section_callback() {

	echo '<div class="form-table">';
	
	lf_create_option( 'listpost' , 
	                  'main_options[featured_slider]',
					  'featured_slider_opt',
					  'main_options',
					  'featured_slider',
					  '<p>Set any of the sliders you have created to be a featured slider.</p>
					  <p>( note: in the layouts section you can turn off your featured slider by choosing <b>"Only Description"</b> or <b>"No Slider & Description"</b> )</p>',
					  'Set Featured Slider',
					  '',
					  '',
					  'liquidslider' );
					  				  				  			  
	lf_create_option( 'slider' , 
	                  'main_options[slider_height]',
					  'slider_height_opt',
					  'main_options',
					  'slider_height',
					  '<p>Set the height of your featured slider.</p>
					  <p>When setting the slider height you should make it as high as the shortest image in your slide.</p>
					  <p>When being viewed by a tabled or phone, your slider height will be 70% of the set height, when viewed by tablet, and 40% of the set height when viewed by phone; this is to accommodate for its width becoming smaller.</p>',
					  'Set Slider Height',
					  ' pixels' );
					  
	lf_create_option( 'select', 
					  'main_options[slider_auto_play]', 
					  'slider_auto_play_opt', 
					  'main_options', 
					  'slider_auto_play', 
					  '<p>Set your slider to either auto play when your page loads, or to be static and only move when clicked. </p>', 
					  'Set Slider Play', 
					  array( 'noautoplay', 'autoplay' ),
					  array( 'No Auto Play', 'Auto Play' ) ); 
					  
	lf_create_option( 'slider', 
					  'main_options[slider_duration]', 
					  'slider_duration_opt', 
					  'main_options', 
					  'slider_duration', 
					  'Set the speed a which your slides move from one to another.</p> 
					  <p>1000 mili-seconds are equal to 1 second.</p>', 
					  'Set Slide Speed',
					  ' mili-seconds' ); 
					  				  
	lf_font_style( 'option',
				   'main_options[slider_text_font]',
				   'slider_text_font_opt',
				   'main_options',
				   'slider_text_font',
				   '<p>Set the font of all the text in the slider, from any of the fonts listed.</p>
					<p>Only select one option. </p>',
				   'Set Slider Text Font' );
				   
	lf_create_option( 'slider' , 
	                  'main_options[slider_text_size]',
					  'slider_text_size_opt',
					  'main_options',
					  'slider_text_size',
					  '<p>Set the size of all the text in the slider.</p>
					  <p>Chose any value from 12 pixels to 54 pixels. </p>',
					  'Set Slider Text Size',
					  ' pixels' );
				   
	lf_create_option( 'color', 
					  'main_options[slider_text_color]', 
					  'slider_text_color', 
					  'main_options', 
					  'slider_text_color', 
					  '<p>Set the color of all the text in the slider.</p>
					  <p>( after saving the right hand box will display the chosen color )</p>', 
					  'Set Slider Text Color' ); 
					  
	lf_create_option( 'color', 
					  'main_options[slider_text_highlight_color]', 
					  'slider_text_highlight_color', 
					  'main_options', 
					  'slider_text_highlight_color', 
					  '<p>Set the slider text highlight color.</p>
					  <p>The highlight color is the background which is behind the Short Tag and the Description.</p>
					  <p>The default color of text highlight is white. </p>', 
					  'Set Slider Text Highlight Color' ); 
	
	lf_create_option( 'select', 
					  'main_options[slider_shading_state]', 
					  'slider_shading_state_opt', 
					  'main_options', 
					  'slider_shading_state', 
					  '<p>Set the shading state of your slider background.</p>
					  <p>The shading of the slider goes over its background and shades the color you have picked, whilst preserving it.</p>
					  <p>This can be turned off, however, or the background can be made transparent.</p>
					  <ul>
					  <li><b>Shaded</b> : Puts shading over the background of your slider.</li>
					  <li><b>Just Color</b> : Removes the shading of the background but keeps the set color.</li>
					  <li><b>Transparent</b> : Makes the slider background transparent, thereby removing the background color and shading.</li>
					  </ul>', 
					  'Set Shading State', 
					  array( 'fullshading', 'justcolor', 'none' ),
					  array( 'Shaded', 'Just Color', 'Transparent' ) ); 
					  
	lf_create_option( 'color', 
					  'main_options[slider_background_color]', 
					  'slider_background_color', 
					  'main_options', 
					  'slider_background_color', 
					  '<p>Set the slider background color.</p> 
					  <p>The slider background is the overall background of the whole slider. It is positioned behind the text highlight and every other part.</p>
					  <p>The default color is blue. </p>', 
					  'Set Slider Background Color' ); 
					  				  
	lf_create_option( 'select', 
					  'main_options[slider_shorttag_display]', 
					  'slider_shorttag_display_opt', 
					  'main_options', 
					  'slider_shorttag_display', 
					  '<p>Set the short tag to either display or hide.</p>
					   <p>The short tag is a line of text which is above your slider. This can be useful for holding mission statements or quotes. </p>', 
					  'Set Short Tag Display', 
					  array( 'show', 'hide' ),
					  array( 'Show', 'Hide' ) ); 
					  
	lf_create_option( 'text',
					  'main_options[slider_shorttag_text]',
					  'slider_shorttag_text_opt',
					  'main_options',
					  'slider_shorttag_text',
					  '<p>Set the text your short tag will show.</p>',
					  'Set Short Tag Text' );
					  
	echo '</div>';

}

function lf_slider_editable_style() {

	$main_opt = get_option( 'main_options' );

	lf_style_change ( 
		'double', 
		$main_opt['slider_text_color'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p,
		.lf-comment-article-comment p,
		.lf-comment-article-author-wrap time,
		.lf-comment-form-input-text,
		.lf-comment-form-textarea', 
		'color', 
		array( '#444', $main_opt['slider_text_color'] ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_highlight_color'], 
		null, 
		'.lf-slider-description,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text,
		.lf-slider-navigation,
		.lf-comment-form-input-text,
		.lf-comment-form-textarea', 
		'background-color', 
		array( '#fff', $main_opt['slider_text_highlight_color'] ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_highlight_color'], 
		null, 
		'.lf-comment-article-wrap,
		.lf-comment-article-bottom-border-filler,
		.lf-comment-border', 
		'border-color', 
		array( '#fff', $main_opt['slider_text_highlight_color'] ));
	
	lf_style_change (
		'single',
		$main_opt['slider_background_color'],
		null,
		'.lf-slider-bottom-background,
		.lf-slider-top-background,
		.lf-slider-description-only-color', 
		'background-color',
		'#4A92E8' );
		
	// Garidents
	lf_style_change ( 
		'numerous', 
		$main_opt['slider_shading_state'], 
		array( 
			null, 
			'fullshading', 
			'justcolor', 
			'none' ),
		'.lf-slider-top-garident,
		.lf-slider-description-only-top-garident', 
		'background', 
		array( 'url("  ' . get_template_directory_uri() . '/Core/Images/garident.png") no-repeat scroll 0 0 transparent', 
			   'url("  ' . get_template_directory_uri() . '/Core/Images/garident.png") no-repeat scroll 0 0 transparent', 
			   'none',
			   'none' ) );
			   
	lf_style_change ( 
		'numerous', 
		$main_opt['slider_shading_state'], 
		array( 
			null, 
			'fullshading', 
			'justcolor', 
			'none' ),
		'.lf-slider-bottom-background,
		.lf-slider-top-background,
		.lf-slider-description-only-color', 
		'background-color', 
		array( $main_opt['slider_background_color'],
			   $main_opt['slider_background_color'],
			   $main_opt['slider_background_color'],
			   'transparent' ) );
			   
	lf_style_change ( 
		'numerous', 
		$main_opt['slider_shading_state'], 
		array( 
			null, 
			'fullshading', 
			'justcolor', 
			'none' ),
		'.lf-slider-bottom-garident,
		.lf-slider-description-only-bottom-garident', 
		'background', 
		array( 'url("  ' . get_template_directory_uri() . '/Core/Images/garidentbot.png") no-repeat scroll 0 0 transparent', 
			   'url("  ' . get_template_directory_uri() . '/Core/Images/garidentbot.png") no-repeat scroll 0 0 transparent', 
			   'none',
			   'none' ) );
			   
	
	// Font 
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_size'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p', 
		'font-size', 
		array( '16px', $main_opt['slider_text_size'] . 'px' ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_size'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p', 
		'line-height', 
		array( '24px', ( ( $main_opt['slider_text_size'] / 100 ) * 150 ) . 'px' ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_size'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p', 
		'font-size', 
		array( '1rem', $main_opt['slider_text_size'] / 16 . 'rem' ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_size'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p', 
		'line-height', 
		array( '1.5rem', ( ( $main_opt['slider_text_size'] / 100 ) * 150 ) / 16 . 'rem' ));
		
	lf_style_change ( 
		'double', 
		$main_opt['slider_text_font'], 
		null, 
		'.lf-slider-description p,
		.lf-slider-shorttag,
		.lf-slider-decription-only-text p', 
		'font-family', 
		array( '"Georgia", serif', $main_opt['slider_text_font'] ) );
			
	lf_style_change (
		'numerous',
		$main_opt['slider_shorttag_display'],
		array(
			null,
			'show',
			'hide' ),
		'.lf-slider-shorttag-wrap',
		'display',
		array( 
			'block', 
			'block', 
			'none' ) );
			
	lf_style_change ( 
		'single',
		$main_opt['slider_shorttag_display'],
		'hide',
		'.lf-slider-top-garident,
		.lf-slider-top-background',
		'height',
		108 - ( ( ( $main_opt['slider_text_size'] / 100 ) * 150 ) + 36 ) . 'px' );
		
	lf_style_change ( 
		'double',
		$main_opt['slider_height'],
		null,
		'.lf-slider-content-wrap,
		.lf-slider-wrap',
		'height',
		array(
			'200px',
			$main_opt['slider_height'] . 'px' ) );
					
}

add_action( 'lf_editable_style', 'lf_slider_editable_style' );

function lf_slider_editable_style_tablet() {

	$main_opt = get_option( 'main_options' );

	lf_style_change ( 
		'double',
		$main_opt['slider_height'],
		null,
		'.lf-slider-content-wrap,
		.lf-slider-wrap',
		'height',
		array(
			'200px',
			( ( $main_opt['slider_height'] / 100 ) * 70 ) . 'px' ) );

}

add_action( 'lf_editable_style_tablet', 'lf_slider_editable_style_tablet' );

function lf_slider_editable_style_small() {

	$main_opt = get_option( 'main_options' );

	lf_style_change ( 
		'double',
		$main_opt['slider_height'],
		null,
		'.lf-slider-content-wrap,
		.lf-slider-wrap',
		'height',
		array(
			'200px',
			( ( $main_opt['slider_height'] / 100 ) * 40 ) . 'px' ) );

}

add_action( 'lf_editable_style_small', 'lf_slider_editable_style_small' );

function lf_register_slider_post() {
																					
	register_post_type( 
		'liquidslider',
		array( 	
			'labels' => 
				array(
					'name' 	=> _x('Sliders', 'post type general name'),
					'singular_name' => _x('Slider', 'post type singular name'),
					'add_new' => _x('Create New', 'Slide'),
					'add_new_item' => __('Add New Slider'),
					'edit_item' => __('Edit Slider'),
					'new_item' => __('New Slider'),
					'all_items' => __('Sliders'),
					'view_item' => __('View Slider'),
					'search_items' => __('Search Sliders'),
					'not_found' =>  __('No Sliders Found'),
					'not_found_in_trash' => __('No Sliders found in Trash'), 
					'parent_item_colon' => '',
					'menu_name' => 'Sliders' ),
			'public' => true,
			'show_ui' => true, 
			'show_in_menu' => 'liquidfluxadmin',
			'hierarchical' => false,
			'supports' => array( 'title'),
			'rewrite'  => false ) ); 		 
		
}

add_action('init', 'lf_register_slider_post');


function slider_meta_content() { 
	
	global $post;
	
	$main_meta = get_post_meta( $post->ID, 'main_meta', true );
	
		echo "<table class='lf-option-table'>";
		
		echo '<tbody>';
		
		echo '<tr>';
		
		echo '<th>';
		
		echo '<input type="button" class="lf-slider-ui-add-button" value="+ Slide" />';
		
		echo '<input type="button" class="lf-slider-ui-remove-button" value="- Slide" />';
		
		echo '</th>';
		
		echo '</tr>';
	
		if ( $main_meta != null ) {
		
			$oldindex = 0;
			
			foreach ( $main_meta as $value ) {
				
				$oldindex++;
				
				echo "<tr class='lf_slider_main_meta_tr$oldindex'>";
					
				echo '<th>';
					
				echo "Slide $oldindex";
					
				echo '</th>';
				
				echo '<td>';
					
				echo "<div id='lf_slider_main_meta_upload_id$oldindex' class='lf_admin_core_upload_wrap'>";
							
				echo "<input type='text' name='main_meta[slider_image_upload$oldindex]' id='lf_slider_main_meta_upload_input_id$oldindex' class='lf_admin_core_upload_input' value='$value' />";
							
				echo '<input type="button" id="_button" class="lf_admin_core_upload_button" value="Upload" />';
							
				echo '</div>';
					
				echo '</td>';
					
				echo '</tr>'; 
					
			}
	
		}
	
		echo '</tbody>';
		 
		echo '</table>';
	
		echo '<div class="lf_slider_main_meta_image_preview">';
		
		if ( $main_meta != null ) {
	
			foreach ( $main_meta as $value ) { 
		
				echo "<img src='$value' />";
		
			}
		
		}
	
		echo '</div>';
	
		echo '<script> lf_ui_parts.slides_generate();  lf_ui_parts.media_upload_slider_meta(); </script>';
		
	} 

function save_slider_meta($post_id) { 

	global $post; 	
									
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
								
			return;
						
		if ( !current_user_can('edit_post') )
									
			return;
			
		$main_meta = $_POST['main_meta'];
		
		update_post_meta( $post->ID, 'main_meta', $main_meta );
			
}


function slide_meta_boxes() { 
								
	add_meta_box( 
			'lf_slider_post_meta_box',
			__('Slide', 'liquidflux'),
			'slider_meta_content',
			'liquidslider',
			'normal',
			'high' );
			
}

add_action('add_meta_boxes', 'slide_meta_boxes' );

add_action('save_post', 'save_slider_meta' );



function lf_slider_js() {
							
	wp_register_script( 'swipeslider', 
						ADMINURI . '/Slider/assets/swipe.js', 
						array( 'jquery' ), 
						'1.0', 
						false );
								
	wp_enqueue_script ( 'swipeslider' );
	
}

add_action('wp_enqueue_scripts', 'lf_slider_js');

?>
