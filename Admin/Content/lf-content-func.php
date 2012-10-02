<?php 

function lf_content_meta( $type = 'category' ) { 

	if ( $type == 'category' || $type == 'cat' ) { 
	
		echo '<div class="lf-meta-text-tags">';
			
		echo '<span data-icon="4" aria-hidden="true"></span>';
		
		echo '</div>';
	
		echo '<div class="lf-meta-text-tags">';
		
		$tag_list = get_the_tag_list('',', ');
		
		echo '<span>';
								
		if ($tag_list) { 
													
			echo $tag_list . ', ';
				
		}
											
		if ( is_object_in_taxonomy( get_post_type(), 'category') ) { 

			echo get_the_category_list(', ') . ';';
					
		}	

		echo '</span>';
																
		edit_post_link( '', '<span class="lf-meta-edit">', '</span>' );	
	
		echo '</div>';
		
	}
	
	elseif ( $type == 'meta' ) { ?>
	
		<div class="sidesix">
							
			<span class="lf-meta-text" data-icon="1" aria-hidden="true">
											
					<?php the_author_link(); ?>
														
			</span>
													
			<span class="lf-meta-text-comp" data-icon="(" aria-hidden="true">
												
				<span class="lf-meta-highlight lf-next-to-icon" >
													
					<?php  printf( __('%1$s'), get_comments_number() ); ?> 
												
				</span>									
											
			</span>

			<span class="lf-meta-text-comp">
			
				<time datetime="<?php the_time('d m, Y'); ?>" pubdate><?php the_time('| d-m-Y'); ?></time>
				
			</span>
										
		</div>
	
<?php }

}

function lf_featured_img() { 

	global $post;

	$m = get_post_meta( $post->ID, 'main_meta', true );

	$setting = $m['post_thumbnail_click'];

	if ( has_post_thumbnail() ) {

		echo '<p class="lf-featured-image">';

			if ( $setting == 'post' or $setting == 'webpage' ) {

				$href = ( $setting == 'post' ? get_permalink() : $m['post_thumbnail_click_webpage'] );

				echo '<a href="'.$href.'" title="'.get_the_title().'" />';

				the_post_thumbnail();

				echo '</a>';
				
			}
			elseif ( $setting == 'lightbox' or $setting =='otherlight' ) {

				$href = ( $setting == 'lightbox' ?  wp_get_attachment_url( get_post_thumbnail_id() ) : $m['post_thumbnail_click_image'] );

				echo '<span class="lf-featured-icon-wrap">';

				echo '<a href="'.$href.'" title="'.get_the_title().'" rel="lightbox" />';

				the_post_thumbnail();

				echo '</a>';
				
				echo '</span>';

			}
			else { 

				the_post_thumbnail();
			}
										
		echo '<p>';
	
	}

}

function lf_content_state_class_echo() { 
		
	global $post;	
	
	$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'content_state' );
	
	if ( is_page() ) {
	
		if ( is_page_template( 'page-one-sidebar-left.php' ) 
			|| is_page_template( 'page-one-sidebar-right.php' ) )  {
	
			echo 'three';
		
		}
		
		elseif ( is_page_template( 'page-two-sidebar-left.php' )
				|| is_page_template( 'page-two-sidebar-right.php' ) ) {
	
			echo 'two';
		
		}
		
		elseif ( is_page_template( 'page-three-sidebar-left.php' )
				|| is_page_template( 'page-three-sidebar-right.php' ) ) {
	
			echo 'one';
		
		}
		
		else { 
		
			echo 'full';
		
		}
			
	}
	
	else {

		if ( $layout == null
			|| $layout == 'nosidebar' ) {
			
				echo 'full';
			
			}
		
		elseif ( $layout == 'onesidebarleft' 
				|| $layout == 'onesidebarright' ) { 
				
					echo 'three';
				
				}
				
		elseif ( $layout == 'twosidebarleft' 
				|| $layout == 'twosidebarright' ) { 
				
					echo 'two';
				
				}
				
		elseif ( $layout == 'threesidebarleft' 
				|| $layout == 'threesidebarright' ) { 
				
					echo 'one';
				
				}
	
	}

}

function lf_core_sidebar_generate( $type ) { 

	global $post;
	
	$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'content_state' );

	if ( $type == 'left' ) {
	
		//breadcrumbs('lf-main-navigation-style');

		if ( $layout == "onesidebarleft" 
			|| $layout == "twosidebarleft" 
			|| $layout == "threesidebarleft" ) { 
					
				get_sidebar(); 
					
			}
		
	}
	
	elseif ( $type == 'right' ) { 
	
		if ( $layout == "onesidebarright" 
		|| $layout == "twosidebarright" 
		|| $layout == "threesidebarright" ) { 
				
			get_sidebar(); 
				
		}
	
	}

}

function lf_content_section_callback() { 

	echo '<div class="form-table">';
	
	// Post title 
	
	lf_font_style(
		'option',
		'main_options[posttitle_font_choice]',
		'posttitle_font_choice_opt',
		'main_options',
		'posttitle_font_choice',
		'<p>Set the font of your post titles.</p>
		 <p>Select one option. </p>',
		'Set Post Title Font' );
	
	lf_create_option( 
		'slider',
		'main_options[posttitle_text_size]',
		'posttitle_text_size_opt',
		'main_options',
		'posttitle_text_size',
		'<p>Set the post title text size by choosing any of the values from 12 pixels to 72 pixels.</p>',
		'Set Post Title Text Size',
		' pixels' );
		
	lf_create_option( 
		'select',
		'main_options[posttitle_text_style]',
		'posttitle_text_style_opt',
		'main_options',
		'posttitle_text_style',
		'<p>Set your post title style to be</p>
		<p> Normal, <i>Italic</i> or <b>Bold</b></p>',
		'Set Post Title Text Style',
		array( 'normal', 'italic', 'bold' ),
		array( 'Normal', 'Italic', 'Bold' ) );
	
	lf_create_option( 
		'color',
		'main_options[posttitle_text_color]',
		'posttitle_text_color_opt',
		'main_options',
		'posttitle_text_color',
		'<p>Set the color of your post title.</p>
		 <p>( after saving the right hand box will display the chosen color )</p>',
		'Set Post Title Text Color' );
	
	// Meta Text
	lf_create_option( 
		'slider',
		'main_options[meta_text_size]',
		'meta_text_size_opt',
		'main_options',
		'meta_text_size',
		'<p>Set your meta text size by choosing any of the values from 6 pixels to 48 pixels.</p> 
		 <p>Meta text is the text which displays author and post date information underneath your post title; as well, as the text which displays post category and tag underneath your post.</p>',
		'Set Meta Text Size',
		' pixels');
		
	lf_create_option( 
		'select',
		'main_options[meta_text_style]',
		'meta_text_style_opt',
		'main_options',
		'meta_text_style',
		'<p>Set your meta text style to be :</p>
		<p> Normal, <i>Italic</i> or <b>Bold</b></p>',
		'Set Meta Text Style',
		array( 'normal', 'italic', 'bold' ),
		array( 'Normal', 'Italic', 'Bold' ) );
		
	lf_create_option( 
		'color',
		'main_options[meta_text_color]',
		'meta_text_color_opt',
		'main_options',
		'meta_text_color',
		'<p>Set the color of your meta text . ( after saving the right hand box will display the chosen color )</p>',
		'Set Meta Text Color' );
		
	lf_create_option( 
		'color',
		'main_options[meta_text_highlight_color]',
		'meta_text_highlight_color_opt',
		'main_options',
		'meta_text_highlight_color',
		'<p>Set the color of your meta text highlights . ( after saving the right hand box will display the chosen color )</p>
		 <p>Meta text highlights are parts of your meta text, which are a different color to your regular meta text, for example : the author name, or the number of comments ) </p>',
		'Set Meta Highlight Color' );
	
	// Body Text
	
	lf_font_style(
		'option',
		'main_options[body_font_choice]',
		'body_font_choice_opt',
		'main_options',
		'body_font_choice',
		'<p>Set the font your body text. Your body text is the most general text in your entire website, this is the content text of your posts, as well as the texts for widgets, navigation and buttons.</p> 
		 <p>Select one option. </p>',
		'Set Body Text Font' );
	
	lf_create_option( 
		'slider',
		'main_options[body_text_size]',
		'body_text_size_opt',
		'main_options',
		'body_text_size',
		'<p>Set the body text size by choosing any of the values from 6 pixels to 36 pixels. </p>',
		'Set Body Text Size',
		' pixels');
		
	lf_create_option( 
		'select',
		'main_options[body_text_style]',
		'body_text_style_opt',
		'main_options',
		'body_text_style',
		'<p>Set your body text style to be :</p>
		<p> Normal, <i>Italic</i> or <b>Bold</b></p>',
		'Set Body Text Style',
		array( 'normal', 'italic', 'bold' ),
		array( 'Normal', 'Italic', 'Bold' ) );
		
	lf_font_style(
		'option',
		'main_options[body_header_font_choice]',
		'posttitle_font_choice_opt',
		'main_options',
		'body_header_font_choice',
		'<p>Set the font of your body text headers.</p>
		 <p>Your body headers are all the headers ( h1 to h6 tags ), which are found in your post content.</p>
		 <p>Select one option.</p>',
		'Set Body Text Header Font' );
		
	lf_create_option( 
		'select',
		'main_options[body_text_headers_style]',
		'body_text_headers_style_opt',
		'main_options',
		'body_text_headers_style',
		'<p>Set your body text headers style to be :</p>
		<p> Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></p>',
		'Set Body Text Headers Style',
		array( 'normal', 'italic', 'bold', 'bolditalic' ),
		array( 'Normal', 'Italic', 'Bold', 'Bold & Italic' ) );
	
	lf_create_option( 
		'color',
		'main_options[body_text_color]',
		'body_text_color_opt',
		'main_options',
		'body_text_color',
		'<p>Set the color of your body text . ( after saving the right hand box will display the chosen color )</p>
		 <p>This will also make your body text headers the same color.</p>',
		'Set Body Text Color' );
	
	// Button
	lf_create_option( 
		'select',
		'main_options[more_button_state]',
		'more_button_state_opt',
		'main_options',
		'more_button_state',
		'<p>Set the state of your website buttons to : </p>
		 <ul>
		 <li><b>Styled</b> : The buttons will have shading as well as a background color around them.</li>
		 <li><b>Plain</b> : The buttons will have no shading, but still have a background.</li>
		 <li><b>Just Text</b> : The buttons have no background color, or shading, they are just text.</li>
		 </ul>',
		'Set Button State',
		array( 'styled', 'plain', 'text'),
		array( 'Styled', 'Plain', 'Just Text' ) );

	lf_create_option( 
		'color',
		'main_options[more_button_back_color]',
		'more_button_back_color_opt',
		'main_options',
		'more_button_back_color',
		'<p>Set the background color of your buttons.</p>
		<p>( after saving the right hand box will display the chosen color )</p>',
		'Set Button Background Color' );
		
	lf_create_option( 
		'color',
		'main_options[more_button_text_color]',
		'more_button_text_color_opt',
		'main_options',
		'more_button_text_color',
		'<p>Set the color of your buttons.</p> 
		 <p>( after saving the right hand box will display the chosen color )</p>',
		'Set Button Text Color' );
		
	lf_create_option( 
		'text',
		'main_options[more_button_read_more_text]',
		'more_button_read_more_text_opt',
		'main_options',
		'more_button_read_more_text',
		'<p>Set the text of your "Read More" buttons</p> 
		 <p>The readmore buttons appear on every excerpt of a post.</p>',
		'Set Read More Text' );
	
		
	// Widget 	
	lf_create_option( 
		'slider',
		'main_options[widget_header_text_size]',
		'widget_header_text_size_opt',
		'main_options',
		'widget_header_text_size',
		'<p>Set the widget title text size by choosing any of the values from 6 pixels to 72 pixels.</p>',
		'Set Widget Header Size',
		' pixels');
		
	lf_create_option( 
		'select',
		'main_options[widget_header_style]',
		'widget_header_style_opt',
		'main_options',
		'widget_header_style',
		'<p>Set your widgets headers style to be :</p>
		<p> Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></p>',
		'Set Widget Header Style',
		array( 'normal', 'bold', 'italic', 'bolditalic' ),
		array( 'Normal', 'Bold', 'Italic', 'Bold & Italic' ) );
		
	lf_create_option( 
		'color',
		'main_options[widget_header_text_color]',
		'widget_header_text_color_opt',
		'main_options',
		'widget_header_text_color',
		'<p>Set the color of your widget headers.</p> 
		 <p>( after saving the right hand box will display the chosen color )</p>',
		'Set Widget Header Color' );
		
	lf_create_option( 
		'color',
		'main_options[article_border_color]',
		'article_border_color_opt',
		'main_options',
		'article_border_color',
		'<p>Set the color of your article border. ( after saving the right hand box will display the chosen color )</p>
		<p>Your article border is the border at the bottom of your article. </p>',
		'Set Article Border Color' );
		
	lf_create_option( 
		'color',
		'main_options[body_border_color]',
		'body_border_color_opt',
		'main_options',
		'body_border_color',
		'<p>Set the color of your body border . ( after saving the right hand box will display the chosen color )</p>
		 <p>Your body border is the border which is between your content and sidebar/sidebars. </p>',
		'Set Body Border Color' );
	
	// Background 
	lf_create_option( 
		'select',
		'main_options[body_background_texture]',
		'body_background_texture_opt',
		'main_options',
		'body_background_texture',
		'<p>Set background texture to any of the given ones or upload your own.</p>
		 <p>To use a uploaded texture chose <b>"Uploaded"</b>.</p>
		 <p>All preset textures are partially transparent, which means that the background color you set will be seen through them.</p>
		 <p>This way your textures can be any color. ( this can not be said for uploaded textures ).</p>',
		'Set Background Texture',
		array( 'notexture', 'default', 'wool', 'linen', 'fabric', 'corrugation', 'nistri', 'scale', 'diamonds', 'irongrip', 'upload' ),
		array( 'No Texture', 'Default', 'Wool', 'Linen', 'Fabric', 'Corrugation', 'Nistri', 'Scale', 'Diamonds', 'Iron Grip', 'Uploaded' ) );
		
	lf_create_option( 
		'upload',
		'main_options[body_texture_upload]',
		'body_texture_upload_opt',
		'main_options',
		'body_texture_upload',
		'<p>Upload any texture to use as a background of your website.</p>
		 <p>The texture preview to the right is just an example of how your texture may look like, and is not representative of how exactly the texture will appear in the website.</p>',
		'Upload Body Texture' );
		
	lf_create_option( 
		'color',
		'main_options[body_background_color]',
		'body_background_color_opt',
		'main_options',
		'body_background_color',
		'<p>Set the background color of your website.</p> 
		<p> ( after saving the right hand box will display the chosen color )</p>',
		'Set Background Color' );
		
	lf_create_option( 
			'divider', 
			'Ad Styling',
			'<p>Style the look of your dummy ads, and ad links.</p>
			<p>If <b>"Have An "Advertise With Us" Link ?"</b> or <b>"Use Dummy Advert ?"</b> is ticked in your advert widget, you will be able to see this styling applied.</p>',
			'12px' ); 
	
	echo '</div>';
	
}

function lf_editable_style_content() { 

	$main_opt = get_option( 'main_options' );
	
		// Color 
		lf_style_change(
			'double',
			$main_opt["meta_text_color"],
			null,
			'.lf-meta-text,
			.lf-meta-text-tags,
			.lf-meta-text time,
			.lf-meta-text-comp',
			'color',
			array(
				'#444',
				$main_opt["meta_text_color"] ) );
				
		lf_style_change(
			'double',
			$main_opt["meta_text_highlight_color"],
			null,
			'.lf-meta-text a,
			.lf-meta-text-tags a,
			.lf-meta-highlight,
			.lf-comment-article-author-link a,
			.comment-edit-link,
			.comment-reply-link,
			a',
			'color',
			array(
				'#4A92E8',
				$main_opt["meta_text_highlight_color"] ) );
				
		lf_style_change(
			'double',
			$main_opt["body_text_color"],
			null,
			'body,
			p, 
			time, 
			span, 
			li, 
			blockquote, 
			b, 
			sub, 
			sup, 
			abbr, 
			cite, 
			strong, 
			em, 
			i, 
			big, 
			small, 
			del, 
			dfn, 
			kbd, 
			samp, 
			ins, 
			var, 
			q, 
			ul, 
			ol,
			.lf-core-content-aside-widget,
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.lf-pagnation-num,
			.lf-pagnation-nav',
			'color',
			array(
				'#444',
				$main_opt["body_text_color"] ) );
				
		lf_style_change(
			'double',
			$main_opt['posttitle_text_color'],
			null,
			'.lf-posttitle,
			 .lf-posttitle a,
			 .lf-portfolio-posttitle a,
			 .lf-portfolio-desc-title h1',
			'color',
			array( 
				'#444',
				$main_opt['posttitle_text_color'] ) );
				
		lf_style_change(
			'double',
			$main_opt['body_background_color'],
			null,
			'body',
			'background-color',
			array( 
				'#e7e7e7',
				$main_opt['body_background_color'] ) );
				
		lf_style_change(
			'double',
			$main_opt['body_background_color'],
			null,
			'.lf-comment-article-bottom-border',
			'border-color',
			array( 
				'#e7e7e7',
				$main_opt['body_background_color'] ) );
						
		// Texture		
		lf_style_change(
			'numerous',
			$main_opt['body_background_texture'],
			array(
				null,
				'notexture', 
				'default', 
				'wool', 
				'linen', 
				'fabric', 
				'corrugation', 
				'nistri', 
				'scale', 
				'diamonds', 
				'irongrip',
				'upload'),
			'body',
			'background-image',
			array( 
				'url( ' . get_template_directory_uri() . '/Core/Images/texture.png)',
				'none',
				' url( ' . get_template_directory_uri() . '/Core/Images/texture.png)',
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/wool-texture.png)', 
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/linen-texture.png)', 
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/bedsheet-texture.png)',  
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/corrugation-texture.png)', 
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/nistri-texture.png)',  
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/scale-texture.png)',  
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/diamonds-texture.png)',  
				' url( ' . get_template_directory_uri() . '/Core/Images/textures/irongrip-texture.png)',
				' url( '. $main_opt["body_texture_upload"] . ' )' ) );
		
		/* //  Text // */
		
		// Post title 
		lf_style_change(
			'double',
			$main_opt['posttitle_text_size'],
			null,
			'.lf-posttitle',
			'font',
			array( 
				'normal 36px/36px "Georgia", Serif ',
				$main_opt['posttitle_text_style'] .' '. 
				$main_opt['posttitle_text_size'] . 'px/' . 
				$main_opt['posttitle_text_size'] . 'px ' . $main_opt["posttitle_font_choice"] ) );
				
		lf_style_change(
			'double',
			$main_opt['posttitle_text_size'],
			null,
			'.lf-posttitle',
			'font',
			array( 
				'normal 2.25rem/2.25rem "Georgia", Serif ',
				$main_opt['posttitle_text_style'].' '. 
				$main_opt['posttitle_text_size'] / 16 . 'rem/' . 
				$main_opt['posttitle_text_size'] / 16 . 'rem ' . $main_opt["posttitle_font_choice"] ) );
		
		// Meta 
		lf_style_change(
			'double',
			$main_opt['posttitle_text_size'],
			null,
			'.lf-meta-text,
			.lf-meta-text time,
			.lf-meta-text-comp,
			.lf-meta-text-tags,
			.lf-meta-highlight,
			.lf-comment-article-author-link a,
			.lf-comment-links-wrap a',
			'font',
			array( 
				'normal 14px/24px "Georgia", Serif ',
				$main_opt['meta_text_style'] .' '. 
				$main_opt['meta_text_size'] . 'px/' . 
				( ( $main_opt['meta_text_size'] / 2 ) + $main_opt['meta_text_size'] ) . 'px ' . $main_opt["body_font_choice"] ) );
				
		lf_style_change(
			'double',
			$main_opt['posttitle_text_size'],
			null,
			'.lf-meta-text,
			.lf-meta-text time,
			.lf-meta-text-comp,
			.lf-meta-text-tags,
			.lf-meta-highlight,
			.lf-comment-article-author-link a,
			.lf-comment-links-wrap a',
			'font',
			array( 
				'normal 0.875rem/1.5rem "Georgia", Serif ',
				$main_opt['meta_text_style'].' '. 
				$main_opt['meta_text_size'] / 16 . 'rem/' . 
				( $main_opt['meta_text_size'] + ( $main_opt['meta_text_size'] / 2 )  ) / 16  . 'rem ' . $main_opt["body_font_choice"] ) );
		
		// Body 
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'body,
			p, 
			time, 
			span, 
			li,  
			sub, 
			sup, 
			abbr, 
			cite,   
			del, 
			dfn, 
			samp, 
			ins, 
			var,  
			ul, 
			ol,
			.lf-core-content-aside-widget,
			.lf-pagnation-num,
			.lf-pagnation-num-current,
			.lf-footer-widget-one div,
			.lf-footer-widget-two div,
			.lf-footer-widget-three div,
			.lf-footer-widget-four div,
			.lf-top-bot-bar-text,
			.lf-toggle-box-head,
			.lf-toggle-box-content,
			.form-submit input[type="submit"],
			#searchform .lf-button,
			.lf-widget-field',
			'font',
			array( 
				'normal 16px/24px "Georgia", Serif ',
				$main_opt['body_text_style'] .' '. 
				$main_opt['body_text_size'] . 'px/' . 
				( ( $main_opt['body_text_size'] / 2 ) + $main_opt['body_text_size'] ) . 'px ' . $main_opt["body_font_choice"] ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'body,
			p, 
			time, 
			span, 
			li,  
			sub, 
			sup, 
			abbr, 
			cite,   
			del, 
			dfn, 
			samp, 
			ins, 
			var,  
			ul, 
			ol,
			.lf-core-content-aside-widget,
			.lf-pagnation-num,
			.lf-pagnation-num-current,
			.lf-footer-widget-one div,
			.lf-footer-widget-two div,
			.lf-footer-widget-three div,
			.lf-footer-widget-four div,
			.lf-toggle-box-head,
			.lf-toggle-box-content,
			.form-submit input[type="submit"],
			#searchform .lf-button,
			.lf-widget-field',
			'font',
			array( 
				'normal 1rem/1.5rem "Georgia", Serif ',
				$main_opt['body_text_style'].' '. 
				$main_opt['body_text_size'] / 16 . 'rem/' . 
				( $main_opt['body_text_size'] + ( $main_opt['body_text_size'] / 2 )  ) / 16 . 'rem ' . $main_opt["body_font_choice"] ) );
		
		
		/* // Headers // */
		$h_one = ( $main_opt['body_text_size'] / 100 ) * 150 ;
		$h_two = ( $main_opt['body_text_size'] / 100 ) * 125 ;
		$h_small = ( $main_opt['body_text_size'] / 100 ) * 75 ;
		
		lf_style_change(
			'double',
			$main_opt['body_text_color'],
			null,
			'.lf-posttitle a:hover,
			.lf-portfolio-posttitle a:hover',
			'background-color',
			array( 
				'#444',
				$main_opt['posttitle_text_color'] ) );
				
		lf_style_change(
			'double',
			$main_opt['navigation_text_color'],
			null,
			'.lf-posttitle a:hover,
			.lf-portfolio-posttitle a:hover',
			'color',
			array( 
				'#fff',
				$main_opt['navigation_text_color'] ) );
				
		lf_style_change(
			'double',
			$main_opt['navigation_text_color'],
			null,
			'.lf-posttitle a:hover,
			.lf-portfolio-posttitle a:hover',
			'border-bottom-color',
			array( 
				'#fff',
				$main_opt['posttitle_text_color'] ) );
		
		// h1		
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h1',
			'font-size',
			array( 
				'20px',
				$h_one . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h1',
			'line-height',
			array( 
				'24px',
				( ( $h_one / 2 ) + $h_one ) . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h1',
			'font-size',
			array( 
				'1.25rem',
				( $h_one / 16 ) . 'rem/'  ) ); 
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h1',
			'line-height',
			array( 
				'1.5rem',
				( ( ( $h_one / 2 ) + $h_one ) / 16 ) . 'rem' ) ); 
				
		lf_style_change(
			'double',
			$main_opt['body_header_font_choice'],
			null,
			'h1',
			'font-family',
			array( 
				'"Georgia", serif',
				$main_opt["body_header_font_choice"] ) ); 
		
		// h2
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h2',
			'font-size',
			array( 
				'20px',
				$h_two . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h2',
			'line-height',
			array( 
				'24px',
				( ( $h_two / 2 ) + $h_two ) . 'px "Georgia", Serif ' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h2',
			'font-size',
			array( 
				'1.25rem',  
				$h_two / 16  . 'rem' ) ); 
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h2',
			'line-height',
			array( 
				'1.5rem', 
				( ( ( $h_two / 2 ) + $h_two ) / 16 ) . 'rem' ) ); 
				
		lf_style_change(
			'double',
			$main_opt['body_header_font_choice'],
			null,
			'h2',
			'font-family',
			array( 
				'"Georgia", serif',
				$main_opt["body_header_font_choice"] ) ); 
		
		// Widget Header
		lf_style_change(
			'double',
			$main_opt['widget_header_text_size'],
			null,
			'.lf-core-content-aside-widget-h3',
			'font-size',
			array( 
				'20px',
				$main_opt['widget_header_text_size'] . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['widget_header_text_size'],
			null,
			'.lf-core-content-aside-widget-h3',
			'line-height',
			array( 
				'24px',
				( $main_opt['widget_header_text_size'] / 2 ) + $main_opt['widget_header_text_size'] . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['widget_header_text_size'],
			null,
			'.lf-core-content-aside-widget-h3',
			'font-size',
			array( 
				'1.25rem',
				$main_opt['widget_header_text_size'] / 16 . 'rem' ) );
				
		lf_style_change(
			'double',
			$main_opt['widget_header_text_size'],
			null,
			'.lf-core-content-aside-widget-h3',
			'line-height',
			array( 
				'1.5rem',
				( ( $main_opt['widget_header_text_size'] / 2 ) + $main_opt['widget_header_text_size'] ) / 16 . 'rem' ) );
				
		lf_style_change(
			'numerous',
			$main_opt['widget_header_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'.lf-core-content-aside-widget-h3',
			'font-style',
			array( 
				'normal',
				'normal',
				'italic',
				'italic' ) );
				
		lf_style_change(
			'numerous',
			$main_opt['widget_header_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'.lf-core-content-aside-widget-h3',
			'font-weight',
			array( 
				'normal',
				'normal',
				'normal',
				'bold' ) );
				
		lf_style_change(
			'double',
			$main_opt['widget_header_text_color'],
			null,
			'.lf-core-content-aside-widget-h3',
			'color',
			array( 
				'#444',
				$main_opt['widget_header_text_color'] ) );
				
		lf_style_change(
			'double',
			$main_opt['body_font_choice'],
			null,
			'.lf-core-content-aside-widget-h3',
			'font-family',
			array( 
				'"Georgia", serif',
				$main_opt["body_font_choice"] ) ); 
				 
		// h3 
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h3',
			'font-size',
			array( 
				'16px',
				$main_opt['body_text_size'] . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h3',
			'font-size',
			array( 
				'1rem', 
				$main_opt['body_text_size'] / 16 . 'rem' ) ); 
				
		// h4, h5, h6
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h4,
			h5,
			h6',
			'font-size',
			array( 
				'normal 20px/24px "Georgia", Serif ',
				$h_small . 'px' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h4,
			h5,
			h6',
			'font-size',
			array( 
				'1.25rem', 
				( $h_small / 16 ) . 'rem' ) ); 
		
		// Line Heights
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h3,
			h4,
			h5,
			h6',
			'line-height',
			array( 
				'24px', 
				( ( $main_opt['body_text_size'] / 2 ) + $main_opt['body_text_size'] ) . 'px' ) ); 
				
		lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'h3,
			h4,
			h5,
			h6',
			'line-height',
			array( 
				'1.5rem', 
				( $main_opt['body_text_size'] + ( $main_opt['body_text_size'] / 2 )  ) / 16 . 'rem' ) );
				
		lf_style_change(
			'double',
			$main_opt['body_header_font_choice'],
			null,
			'h3,
			h4,
			h5,
			h6',
			'font-family',
			array( 
				'"Georgia", serif',
				$main_opt["body_header_font_choice"] ) );
				
				
		

		// Header Styles 
		lf_style_change(
			'numerous',
			$main_opt['body_text_headers_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'h1,
			h2,
			h3,
			h4,
			h5,
			h6',
			'font-style',
			array( 
				'italic',
				'normal',
				'italic',
				'italic' ) );
				
		lf_style_change(
			'numerous',
			$main_opt['body_text_headers_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'h1,
			h2,
			h3,
			h4,
			h5,
			h6',
			'font-weight',
			array( 
				'bold',
				'normal',
				'normal',
				'bold' ) );
		
		/* // Button // */
		lf_style_change( 
			'numerous-property',
			$main_opt['more_button_state'],
			array(
				null,
				'styled', 
				'plain', 
				'text' ),
			'.lf-button,
			.lf-comment-form-wrap input[type = "submit"]',
			array(
				'background-image',
				'background-position' ),
			array( 
				array(
					'url( ' . get_template_directory_uri() . '/Core/Images/shading/lf-button-sprite.png)',
					'url( ' . get_template_directory_uri() . '/Core/Images/shading/lf-button-sprite.png)',
					'none',
					'none' ),
				array( 
					'0px 0px',
					'0px 0px',
					'0',
					'0' )) );
				
		lf_style_change( 
			'numerous',
			$main_opt['more_button_state'],
			array(
				null,
				'styled', 
				'plain', 
				'text' ),
			'.lf-button:hover,
			.lf-comment-form-wrap input[type = "submit"]:hover',
			'background-position',
			array( '0px -65px',
				   '0px -65px',
				   '0',
				   '0' ) );
				
		lf_style_change( 
			'double',
			$main_opt['more_button_text_color'],
			null,	
			'.lf-button,
			.lf-button a,
			.lf-comment-form-wrap input[type = "submit"]',
			'color',
			array( 
				'#fff',
				$main_opt['more_button_text_color'] ) );
				
		lf_style_change( 
			'nested',
			array(
				$main_opt['more_button_back_color'],
				$main_opt['more_button_state'] ),
			array(
				$main_opt['more_button_back_color'],
				'text' ),
			'.lf-button,
			.lf-comment-form-wrap input[type = "submit"]',
			'background-color',
			array( 
				'transparent',
				$main_opt['more_button_back_color'] ) );
				
		// Content State	
/*
		lf_style_change(
			"numerous-property",
			$main_opt['content_state'],
			array(
				'onesidebarright',
				'twosidebarright',
				'threesidebarright' ),
			'.lf-core-content-three',
			array( 
				'padding',
				'margin',
				'border-width',
				'border-right-style' ),
			array( 
				array(
					'0 24px 0 12px',
					'0 24px 0 12px',
					'0 24px 0 12px' ),
				array(
					'0 6px 0 0',
					'0 6px 0 0',
					'0 6px 0 0' ),
				array(
					'6px',
					'6px',
					'6px' ),
				array(
					'solid',
					'solid',
					'solid' ) ) );
								
		lf_style_change(
			'numerous-property',
			$main_opt['content_state'],
			array(
				'onesidebarright',
				'twosidebarright',
				'threesidebarright' ),
			'.lf-core-content-two',
			array( 
				'padding',
				'margin',
				'border-width',
				'border-right-style' ),
			array( 
				array(
					'0 24px 0 12px',
					'0 24px 0 12px',
					'0 24px 0 12px' ),
				array(
					'0 6px 0 0',
					'0 6px 0 0',
					'0 6px 0 0' ),
				array(
					'6px',
					'6px',
					'6px' ),
				array(
					'solid',
					'solid',
					'solid' ) ) );
					
		lf_style_change(
			'numerous-property',
			$main_opt['content_state'],
			array(
				'onesidebarleft',
				'twosidebarleft',
				'threesidebarleft' ),
			'.lf-core-content-two',
			array( 
				'padding',
				'margin',
				'border-width',
				'border-left-style' ),
			array( 
				array(
					'0 12px 0 24px',
					'0 12px 0 24px',
					'0 12px 0 24px' ),
				array(
					'0 0 0 6px',
					'0 0 0 6px',
					'0 0 0 6px' ),
				array(
					'6px',
					'6px',
					'6px' ),
				array(
					'solid',
					'solid',
					'solid' ) ) );
					
		lf_style_change(
			'numerous-property',
			$main_opt['content_state'],
			array(
				'onesidebarleft',
				'twosidebarleft',
				'threesidebarleft' ),
			'.lf-core-content-three',
			array( 
				'padding',
				'margin',
				'border-width',
				'border-left-style' ),
			array( 
				array(
					'0 12px 0 24px',
					'0 12px 0 24px',
					'0 12px 0 24px' ),
				array(
					'0 0 0 6px',
					'0 0 0 6px',
					'0 0 0 6px' ),
				array(
					'6px',
					'6px',
					'6px' ),
				array(
					'solid',
					'solid',
					'solid' ) ) ); 
					
		lf_style_change(
			'double',
			$main_opt['body_border_color'],
			null,
			'.lf-core-content-two,
			.lf-core-content-three,
			.lf-core-content-three-page-left,
			.lf-core-content-two-page-left,
			.lf-core-content-three-page-right,
			.lf-core-content-two-page-right',
			'border-color',
			array(
				'#fff',
				$main_opt['body_border_color'] ) ); */
				
		lf_style_change(
			'double',
			$main_opt['article_border_color'],
			null,
			'.lf-article-bottom-border',
			'border-bottom-color',
			array( 
				'#d0d0d0',
				$main_opt['article_border_color'] ) );
								
}

add_action( "lf_editable_style", "lf_editable_style_content" );
	
	

function lf_editable_style_content_tablet() { 

	$main_opt = get_option( 'main_options' );

		lf_style_change(
			'single',
			$main_opt["content_state"],
			'onesidebarright',
			'.lf-core-content-three',
			'padding',
			'0 24px 0 6px' );
			
		lf_style_change(
			'single',
			$main_opt["content_state"],
			'onesidebarleft',
			'.lf-core-content-three',
			'padding',
			'0 6px 0 24px' );
				
		lf_style_change(
			'single',
			$main_opt["content_state"],
			'twosidebarright',
			'.lf-core-content-two',
			'padding',
			'0 12px 0 6px' );
			
		lf_style_change(
			'single',
			$main_opt["content_state"],
			'twosidebarleft',
			'.lf-core-content-two',
			'padding',
			'0 6px 0 12px' );

}

add_action( "lf_editable_style_tablet", "lf_editable_style_content_tablet" );


function lf_editable_style_content_small() { 

	$main_opt = get_option( 'main_options' );
		
		lf_style_change(
			'numerous-property',
			$main_opt["content_state"],
			array(
				'twosidebarright',
				'twosidebarleft' ),
			'.lf-core-content-two',
			array(
				'padding',
				'margin',
				'border' ),
			array( 
				array(
					'0 6px', 
					'0 6px' ),
				array(
					'0px',
					'0px' ),
				array(
					'none',
					'none' ) ) );
					
		lf_style_change(
			'numerous-property',
			$main_opt["content_state"],
			array(
				'onesidebarright',
				'onesidebarleft' ),
			'.lf-core-content-three',
			array(
				'padding',
				'margin',
				'border' ),
			array( 
				array(
					'0 6px', 
					'0 6px' ),
				array(
					'0px',
					'0px' ),
				array(
					'none',
					'none' ) ) );
					
		

}

add_action( "lf_editable_style_small", "lf_editable_style_content_small" );


?>