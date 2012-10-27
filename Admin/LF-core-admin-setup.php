<?php

	function lf_create_option( $type = "text" , $name = null, $theid = null, $optionarray = null, $option = null, $description = null, $optiontext = null, $thevalue = null, $thetext = null, $customquery = null ) {
	
		$the_opt_array = get_option($optionarray);
		
		if ( isset( $the_opt_array[$option]) ) {
		
			$the_opt = $the_opt_array[$option];
			
		}
		
		else { 
		
			$the_opt = '';
		
		}
		
			if ( $type == "text" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
				
			echo '<input type="text" name="'. $name .'" id="'. $theid .'" class="lf_admin_core_input" value="'. $the_opt .'" />';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';
			
			echo '</div>';
		
			}
			
			elseif ( $type == "checkbox" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
			
			echo '<input type="checkbox"  name="'. $name .'" id="'. $theid .'" class="lf_admin_core_checkbox" value="true" '. checked( $the_opt, "true", false ) .' />';
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';	
			
			}
			
			elseif ( $type == "select" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
			
			echo '<select name="'. $name .'" id="'. $theid .'" class="lf_admin_core_input_select" >';
			
			foreach ( $thevalue as $index => $value ) {
			
				echo '<option value="'. $value .'" '. selected( $the_opt, $value, false ) .'>'. $thetext[$index] .'</option>';
				
			}
			
			echo '</select>';
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';	
			
			}
			
			elseif ( $type == "radio" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_radio_main_wrap">';
			
			foreach ( $thevalue as $index => $value ) {
			
				echo '<div class="lf_admin_core_radio_wrap">';
			
				echo '<input type="radio" name="'. $name .'" value="'. $value .'" class="lf_admin_core_radio" '. checked( $the_opt, $value, false ) .' />';
				
				echo '<span class="lf_admin_core_radio_span" >'. $thetext[$index] .'</span>';
				
				echo '</div>';
				
			}
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';
			
			
			}
			
			elseif ( $type == "color" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
		
			echo '<input type="text" name="'. $name .'" id="'. $theid .'" value="'. $the_opt .'" class="lf_admin_core_color_option_input" onclick="colorPicker(event)" />';
			
			echo '<div style="background-color: '. $the_opt .'" class="lf_admin_core_color_option_col"></div>';
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';
			
			}
			
			elseif ( $type == "upload" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_upload_wrap">';
			
			echo '<input type="text" name="'. $name .'" id="'. $theid .'" class="lf_admin_core_upload_input" value="'. $the_opt .'" />';
			
			echo '<input type="button" id="'. $theid .'_button" class="lf_admin_core_upload_button" value="Upload" />';
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '<img src="'. $the_opt .'" class="lf_admin_core_upload_preview" />';
			
			echo '</div>';
				
			}
			
			elseif ( $type == "listpost" ) {
			
			$queryargs = array( 'post_type' => $customquery, 'posts_per_page' => '-1' );
			$querycall = new WP_Query( $queryargs );
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
			
			echo '<div class="lf_admin_core_input_select_multiple-wrap">';
			
			echo '<select name="'. $name .'" id="'. $theid .'" class="lf_admin_core_input_select_multiple" multiple>';
			
			while ( $querycall->have_posts() ) : $querycall->the_post(); 
			
				echo '<option value="'. get_the_ID() . '" '. selected( $the_opt, get_the_ID() , false ) .' >'. get_the_title() .'</option>'; 
			
			endwhile;
			
			echo '</select>';
			
			echo '</div>';
			
			echo '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';	
						
			}
			
			elseif ( $type == "slider" ) { 
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
	
			echo '<div class="lf_admin_core_input_wrap">';
	
			echo '<div class="slider-scaling" id="'. $theid .'" ></div>';
	
			echo '<input type="text" name="'. $name .'" class="slider-scaling-input" value="'. $the_opt .'" />';
			
			echo '</div>';
			
			echo '<div class="slider-scaling-desc-part">'. $the_opt . $thevalue . '</div>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
	
			echo '</div>';
			
			}
			
			elseif ( $type == "text-box" ) {
			
			echo '<div class="lf_admin_core_option_wrap">';
			
			echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
			echo '<div class="lf_admin_core_input_wrap" >'; 
				
			echo '<textarea name="'. $name .'" id="'. $theid .'" class="lf_admin_core_input" />'. $the_opt .'</textarea>';
			
			echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
			echo '</div>';
			
			echo '</div>';
		
			}
			
			elseif ( $type == "divider" ) { 
			
				echo '<div class="lf_admin_core_option_wrap">';
	
				echo '<h4 style="margin: '. $optionarray .' 55% 0 5%;" class="lf_admin_core_option_divider">'. $name .'</h4>';
				
				echo '<div class="LF-option-inv-desc">'. $theid .'</div>';
	
				echo '</div>';
			
			}
			
	}

function liquidflux_admin_setup() { 

	add_menu_page(	'LiquidFlux Setup',
					'White Whale', 		
					'administrator', 	
					'liquidfluxadmin', 
					'',		
					'' . ADMINURI . '/assets/Images/menulogo.png', 
					'3');				
					
}
add_action( 'admin_menu', 'liquidflux_admin_setup');

function white_whale_main_admin() {	?>
		
	<div class="LF-main-options-wrapper">
									
		<div>
			<div>	
				<form id="main-opts-form-hook" name="main_options_form" action="options.php" method="post" class="main-options-form" >
								
					<div class="main-form-tabs">
								
						<div class="main-options-tab-nav-hook"></div>
									
						<div class="lf-main-options-save-button-wrap">
							
							<input type="submit" class="lf-main-options-save-button" name="submit" value="Save" />
										
							<div class="LF-option-inv-desc"> 
							
								<p> The Save Button, which... well... saves your options. </p>
								
							</div>
							
						</div>
												
						<div class="main-options-tiny-info-box">Press the "+" button on your keyboard to open help.</div>
									
						<div class="main-options-info-box"></div>
																	
						<?php settings_fields('main_options');?>
						<?php do_settings_sections('whitewhale');?>
																						
					</div>
					
					<script> lf_ui_parts.media_upload_init(); </script>
								
				</form>
									
			</div>
									
		</div>
	
	</div>
				
<?php }

include( ADMINPATH . '/Content/lf-content-func.php' );

include( ADMINPATH . '/Content/lf-post-formats-func.php' );

include( ADMINPATH . '/Content/lf-widgets-func.php' );

include( ADMINPATH . '/Content/lf-homepage-func.php' );

include( ADMINPATH . '/Content/meta.php' ); 


include( FRAMEWORK . '/utilities.php' );

include( FRAMEWORK . '/seo.php' ); 

include( FRAMEWORK . '/sidebar.php' ); 

include( FRAMEWORK . '/paged.class.php' ); 

include( FRAMEWORK . '/Content/post-meta.php' ); 

include( FRAMEWORK . '/Content/featured-image.php' ); 

include( FRAMEWORK . '/Content/post-text.php' ); 

include( FRAMEWORK . '/Content/title.php' ); 

include( FRAMEWORK . '/Shortcodes/include.php' );

include( FRAMEWORK . '/Slider/slide.php' );

include( FRAMEWORK . '/Slider/modify.class.php' );

include( FRAMEWORK . '/Options/include.php' );

include( FRAMEWORK . '/scripts.class.php' );

new lf_registrate_scripts;



include( ADMINPATH . '/Footer/lf-footer-func.php' );

include( ADMINPATH . '/Header/lf-header-func.php' );

include( ADMINPATH . '/Navigation/lf-navigation-func.php' ); 


//include( ADMINPATH . '/Slider/lf-slider-func.php' ); // post error

//include( ADMINPATH . '/Page_templates/lf-page-templates-func.php' ); // post error

// include( ADMINPATH . '/Shortcodes/lf-shortcodes-func.php' );

// include( FRAMEWORK . '/Shortcodes/add-shortcode.php' );



function add_white_whale_options() {


	add_submenu_page( 	'liquidfluxadmin', 
						'White Whale Admin', 
						'Options', 
						'manage_options', 
						'whitewhale',
						'white_whale_main_admin' );
							
	register_setting(	'main_options', 	
						'main_options' ); 
						
	add_settings_section(
							'main_options_layouts_section', 	
							'Layouts', 
							'main_options_layouts_callback', 	
							'whitewhale' ); 
													
	add_settings_section(	'main_options_header_section', 	
							'Header', 	
							'lf_header_section_callback', 	
							'whitewhale' ); 
							
	add_settings_section(	'main_options_navigation_section', 	
							'Navigation', 	
							'lf_navigation_section_callback', 	
							'whitewhale' ); 
							
	add_settings_section(	'main_options_slider_section', 	
							'Slider', 	
							'lf_slider_section_callback', 	
							'whitewhale' ); 
							
	add_settings_section(	'main_options_content_section', 	
							'Content', 	
							'lf_content_section_callback', 	
							'whitewhale' );
							
	add_settings_section(	'main_options_footer_section', 	
							'Footer', 	
							'lf_footer_section_callback', 	
							'whitewhale' ); 
							
	add_settings_section(	'main_options_portfolio_section', 	
							'Portfolio', 	
							'lf_portfolio_section_callback', 	
							'whitewhale' ); 
							
	add_settings_section(	'main_options_not_found_section', 	
							'404', 	
							'lf_not_found_section_callback', 	
							'whitewhale' );
							
	add_settings_section(	'main_options_theme_opt_section', 	
							'Updates', 	
							'lf_theme_opt_section_callback', 	
							'whitewhale' );
																																		
}

add_action( 'admin_menu', 'add_white_whale_options' );


// function admin_style() {  
	
// 	global $pagenow, $post_type;
		
// 	if (  $pagenow == 'admin.php' ) {
	
// 		lf_font_style( 'admin-head' );
		
// 	}
	
// 	if (  $pagenow == 'admin.php' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'lf_slide'
// 		  || $pagenow == 'post.php'     && $post_type == 'lf_slide'
// 		  || $pagenow == 'post.php'     && $post_type == 'page' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'page'
// 		  || $pagenow == 'post.php'     && $post_type == 'post' 
// 		  || $pagenow == 'post-new.php' && $post_type == 'post' ) {
	
// 		wp_enqueue_style( 'lf-admin-style',
// 						  ADMINURI . '/assets/admin-style.css',
// 						  '',
// 						  '1.0' );
						  
// 		wp_enqueue_style( 'thickbox' );
	
// 	}
								
// }
	
// add_action( 'admin_head', 'admin_style' );
	

// function lf_admin_js_ui() {

// 	global $pagenow, $post_type;
		
// 	if (  $pagenow == 'admin.php' ) {
			
// 		wp_enqueue_script( 'admin-js-ui',  
// 						   trailingslashit( get_template_directory_uri() ) . '/Admin/assets/admin-ui.js', 
// 						   array( 
// 								'jquery-ui-tabs', 
// 								'jquery-ui-sortable', 
// 								'jquery-ui-slider', 
// 								'thickbox', 
// 								'media-upload' ), 
// 						   '0.1', 
// 						   false );
						   
// 	}
	
// 	if ( $pagenow == 'post.php' && $post_type == 'post' or $post_type == 'lf_slide' || 
// 		 $pagenow == 'post-new.php' && $post_type == 'post' or $post_type == 'lf_slide' ) {
		  
// 		wp_enqueue_script( 
// 						'admin-js-ui',  
// 						trailingslashit( get_template_directory_uri() ) . '/Admin/assets/post-ui.js', 
// 						array('thickbox', 'media-upload'), 
// 						'0.1', 
// 						false );

// 		wp_enqueue_script(
// 						'clone-js',
// 						trailingslashit( get_template_directory_uri() ) . 'Framework/Slider/scripts/remove.js', 
// 						'',
// 						'1',
// 						false );

// 		}
	
// 	if (  $pagenow == 'admin.php'
// 		|| $pagenow == 'widgets.php' ) {
			
// 		wp_enqueue_script( 'color-picker', 
// 						   trailingslashit( get_template_directory_uri() ) . '/Admin/assets/colorpicker/colorPicker.js', 
// 						   '', 
// 						   '9.1', 
// 						   false );		

// 	}
			
// }
	
// 	add_action( 'admin_enqueue_scripts', 'lf_admin_js_ui' );
	
?>