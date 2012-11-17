<?php 

	return array(
				'options' => 'main_options',
				'page_name' => 'whitewhale',
				'form_action' => 'white_whale_save',
				'opt' => 
					array(
						// Create Menu page
						array(
							'f' => 'add_menu_page',
							'o' => 
								array(
									'LiquidFlux Setup',
									'White Whale', 		
									'administrator', 	
									'liquidfluxadmin', 
									'',		
									'', 
									'3' ) ),
						// Create Submenu page 
						array(
							'f' => 'add_submenu_page',
							'o' => 
								array(
									'liquidfluxadmin',
									'White Whale Admin',
									'Theme Options',
									'manage_options',
									'whitewhale',
									array( $this, 'page' ) ) ),
						// Register settings array 
						array(
							'f' => 'register_setting',
							'o' => 
								array(
									'main_options',
									'main_options') ),
						// Navigation
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'navigation',
										'title' => __('Navigation Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Change the style of your menu bars and breadcrumbs', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Menu Background 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Background',
																	'description' => 'Set the background color of your menu bars',
																	'array'       => 'main_options',
																	'name'        => 'menu_background',
																	'saved'       => '000000' )) ),
														            
														// Menu Text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Color',
																	'description' => 'Set the color of your menu text',
																	'array'       => 'main_options',
																	'name'        => 'menu_text_color',
																	'saved'       => 'ffffff' )) ),
														// Menu Hover color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Hover Color',
																	'description' => 'Set the color your menu buttons turn when hovered over',
																	'array'       => 'main_options',
																	'name'        => 'menu_hover_color',
																	'saved'       => 'bf3e2a' )) ),	
														// Menu Font  
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Text Font',
																	'description' => 'Set the font of your menu text',
																	'array'       => 'main_options',
																	'name'        => 'menu_text_font',
																	'saved'       => 'Arial' )) ),
														// Menu Text Size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Text Size',
																	'description' => 'Set the size of your menu text',
																	'array'       => 'main_options',
																	'name'        => 'menu_text_size',
																	'saved'       => '12',
															        'min'         => '10',
																	'max'         => '36'  )) ),
														// Menu Text style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Text Style',
																	'description' => 'Set the style of your menu button text',
																	'array'       => 'main_options',
																	'name'        => 'menu_text_style',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Menu Text weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Text Weight',
																	'description' => 'Set the weight of your menu button text',
																	'array'       => 'main_options',
																	'name'        => 'menu_text_weight',
																	'saved'       => 'bold',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) )
													)))
												)),
						// Header style
						array( 
							'f' => array($this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'header_style',
										'title' => __('Header Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Configure the style of your header and title', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Title choice 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Show Title',
																	'description' => 'Chose to show or hide your title, the search engines will still see your title',
																	'array'       => 'main_options',
																	'name'        => 'show_title',
																	'saved'       => 'inline-block',
															        'options'     => array('Show', 'Hide'),
																	'values'      => array('inline-block', 'none')  )) ),
														// Title font 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Title Font',
																	'description' => 'Chose your header title font',
																	'array'       => 'main_options',
																	'name'        => 'title_font',
																	'saved'       => 'georgia' )) ),
														// Title font style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Title Style',
																	'description' => 'Chose your title style',
																	'array'       => 'main_options',
																	'name'        => 'title_style',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Title weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Title Weight',
																	'description' => 'Chose your title weight',
																	'array'       => 'main_options',
																	'name'        => 'title_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
														// Title size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Title Size',
																	'description' => 'Set the size of your title',
																	'array'       => 'main_options',
																	'name'        => 'title_size',
																	'saved'       => '32',
															        'min'         => '20',
																	'max'         => '140'  )) ),
														// Title color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Title Color',
																	'description' => 'The color of your title',
																	'array'       => 'main_options',
																	'name'        => 'title_color',
																	'saved'       => '4e4340' )) ),
														// Show Logo 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Show Logo',
																	'description' => 'Chose to show your logo, or not display it',
																	'array'       => 'main_options',
																	'name'        => 'show_logo',
																	'saved'       => 'inline-block',
															        'options'     => array('Show', 'Hide'),
																	'values'      => array('inline-block', 'none')  )) ),
														// Logo  
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'upload',
																	'title'       => 'Logo Upload',
																	'description' => 'Upload your website logo if you want to show it',
																	'array'       => 'main_options',
																	'name'        => 'logo',
																	'saved'       => '' )) ),
														// Logo size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Logo Height',
																	'description' => 'Specify the height of your logo its width will scale accordingly',
																	'array'       => 'main_options',
																	'name'        => 'logo_size',
																	'saved'       => '32',
															        'min'         => '10',
																	'max'         => '140'  )) )
																)))
															)),
						// Post Formats
						array( 
							'f' => array($this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'post_formats_style',
										'title' => __('Post Formats Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Configure the style of your post formats', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Post title font 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Post Title Font',
																	'description' => 'Chose the your post title font',
																	'array'       => 'main_options',
																	'name'        => 'post_title_font',
																	'saved'       => 'georgia' )) ),
														// Post title size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Post Title Size',
																	'description' => 'Chose your post title font size',
																	'array'       => 'main_options',
																	'name'        => 'post_title_size',
																	'saved'		  => '22',
																	'min'		  => '12',
																	'max'		  => '60' )) ),
														// Post title style  
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Title Style',
																	'description' => 'Whether your post title is italic or not',
																	'array'       => 'main_options',
																	'name'        => 'post_title_style',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Post title weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Title Weight',
																	'description' => 'Set the text weight of your post title',
																	'array'       => 'main_options',
																	'name'        => 'post_title_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
														// Post Title Color
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Title Text Color',
																	'description' => 'Set the text color of the top box',
																	'array'       => 'main_options',
																	'name'        => 'post_title_color',
																	'saved'       => 'ffffff' )) ),
														// Post title Meta text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Title Meta Color',
																	'description' => 'Chose the color of your post title meta',
																	'array'       => 'main_options',
																	'name'        => 'post_title_meta_color',
																	'saved'       => '000000' )) ),
														// Post Title Box background
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Title Box Background',
																	'description' => 'The box which sits at the top of your post, it holds the post title, but can hold different things depending on post format (it is not present in every post format)',
																	'array'       => 'main_options',
																	'name'        => 'post_title_background',
																	'saved'       => '222222' )) ),
														// Post Title box texture
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'texture',
																	'title'       => 'Post Title Box Texture',
																	'description' => 'Set the box texture, if the texture is set to "none" then the background color will be visible',
																	'array'       => 'main_options',
																	'name'        => 'post_title_texture',
																	'saved'       => 'none',
																	'textures_to_show' => 3 )) ),
														// Text box background
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Box Background',
																	'description' => 'Set the background color of the text box of your posts, this box holds the body text',
																	'array'       => 'main_options',
																	'name'        => 'post_background',
																	'saved'       => 'ffffff' )) ),														
														// Body text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Text Color',
																	'description' => 'The color of your body text (90% of your writting)',
																	'array'       => 'main_options',
																	'name'        => 'post_text_color',
																	'saved'       => '222222' )) ),
														// Text highlight color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Highlight Color',
																	'description' => 'The general highlight color of your text e.g(links)',
																	'array'       => 'main_options',
																	'name'        => 'post_highlight_color',
																	'saved'       => 'B6D9AC'  )) ),
														// General Meta text size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'General Meta Size',
																	'description' => 'The size of both the post title and body meta',
																	'array'       => 'main_options',
																	'name'        => 'post_meta_size',
																	'saved'       => '14',
															        'min'         => '10',
																	'max'         => '36'  )) ),
														// Body text size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Post Text Size',
																	'description' => 'Set the body text size',
																	'array'       => 'main_options',
																	'name'        => 'post_text_size',
																	'saved'       => '14',
																	'min'         => '10',
																	'max'         => '32' )) ),
														// Body text font 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Post Text Font',
																	'description' => 'Set the font of your body text',
																	'array'       => 'main_options',
																	'name'        => 'post_text_font',
																	'saved'       => 'arial' )) ),
														// Meta text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Meta Color',
																	'description' => 'Chose the color of your body post meta',
																	'array'       => 'main_options',
																	'name'        => 'post_meta_color',
																	'saved'       => '000000' )) ),
														// Inner post title  
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Inner Post Title Size',
																	'description' => 'This inner post title shows up in post formats that are not the standard one, it is ussaly a less noticable title',
																	'array'       => 'main_options',
																	'name'        => 'inner_post_title_size',
																	'saved'       => '12',
															        'min'         => '10',
																	'max'         => '30'  )) ),
														// Inner post title style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Inner Post Title Style',
																	'description' => 'Set the inner post title style',
																	'array'       => 'main_options',
																	'name'        => 'inner_post_title_style',
																	'saved'       => 'italic',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Inner post title weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Inner Post Title Weight',
																	'description' => 'Set the inner post title weight',
																	'array'       => 'main_options',
																	'name'        => 'inner_post_title_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
														// Inner post title underline 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Inner Post Title Decoration',
																	'description' => 'Set the decoration of your inner post title',
																	'array'       => 'main_options',
																	'name'        => 'inner_post_title_decoration',
																	'saved'       => 'underline',
															        'options'     => array('Normal', 'Underline', 'Overline', 'Line Though'),
																	'values'      => array('normal', 'underline', 'overline', 'line-through')  )) ),
														// Body header font 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Post Headers Font',
																	'description' => 'The font of your content headers e.g(h1, h2)',
																	'array'       => 'main_options',
																	'name'        => 'post_headers_font',
																	'saved'       => 'arial' )) ),
														// Body header style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Headers Style',
																	'description' => 'Chose the style of your post headers',
																	'array'       => 'main_options',
																	'name'        => 'post_headers_style',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Body headers weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Headers Weight',
																	'description' => 'Set the weight of your post headers',
																	'array'       => 'main_options',
																	'name'        => 'post_headers_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
														// Image hover color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Image Hover Color',
																	'description' => 'The background color of an image that can be opened as a light box ( can be seen when hovered over )',
																	'array'       => 'main_options',
																	'name'        => 'post_image_hover_color',
																	'saved'       => 'bf3e2a' )) ),

												)))
											)),
						// Content
						array( 
							'f' => array($this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'general_style',
										'title' => __('General Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Configure the style of your text content.', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(														
														// Player background color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Player Background',
																	'description' => 'Set the backgroun color of your media player',
																	'array'       => 'main_options',
																	'name'        => 'player_background',
																	'saved'       => '000000' )) ),
														// Player highlight color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Player Highlight',
																	'description' => 'Set the highlight color of your player',
																	'array'       => 'main_options',
																	'name'        => 'player_highlight',
																	'saved'       => '44382d' )) ),
														// Player button color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Player Buttons Color',
																	'description' => 'Set the color of your players buttons',
																	'array'       => 'main_options',
																	'name'        => 'player_text',
																	'saved'       => 'ffffff' )) ),																											
														// Background color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Background Color',
																	'description' => 'The website background color',
																	'array'       => 'main_options',
																	'name'        => 'background_color',
																	'saved'       => 'F5EEB7' )) ),
														// Background Texture 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'texture',
																	'title'       => 'Background Texture',
																	'description' => 'The texture of your background, if you use a texture the background color wont show',
																	'array'       => 'main_options',
																	'name'        => 'background_texture',
																	'saved'       => '',
																	'textures_to_show' => 3 )) )
														))),
													)),
						// Slider
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'slider_style',
										'title' => __('Slider Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Change the color scheme of your sliders', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Slider background color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Slider Background',
																	'description' => 'Set the color of your slider backgrounds ( not visible in full-width mode )',
																	'array'       => 'main_options',
																	'name'        => 'slider_background',
																	'saved'       => 'ffffff' )) ),
														// Slider handle color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Arrow Color',
																	'description' => 'Set the color of the slider arrows',
																	'array'       => 'main_options',
																	'name'        => 'slider_arrow_color',
																	'saved'       => 'ffffff' )) ),	
														// Slider text box color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Box Color',
																	'description' => 'Set the color of the text boxes which appear for captions and featured posts',
																	'array'       => 'main_options',
																	'name'        => 'slider_text_box_color',
																	'saved'       => 'ffffff' )) ),
														// Slider text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Color',
																	'description' => 'Set the text color of your captions and featured post excerpts',
																	'array'       => 'main_options',
																	'name'        => 'slider_text_color',
																	'saved'       => '222222' )) ),
														// Slider caption size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Caption Size',
																	'description' => 'Set the size of your slider caption and post titles',
																	'array'       => 'main_options',
																	'name'        => 'slider_caption_size',
																	'saved'       => '24',
															        'min'         => '10',
																	'max'         => '42'  )) ),
														// Slider caption style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Caption Style',
																	'description' => 'Set the style of your captions and post titles',
																	'array'       => 'main_options',
																	'name'        => 'slider_caption_style',
																	'saved'       => 'italic',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('norma', 'italic')  )) ),
														// Slider caption weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Caption Weight',
																	'description' => 'Set the weight of your captions and post titles',
																	'array'       => 'main_options',
																	'name'        => 'slider_caption_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) )

													)))
												)),
						// Comments style
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'comments_settings',
										'title' => __('Comments Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Set up your comments look and semantics', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Comments text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Comments Text Color',
																	'description' => 'Set the text color of your comments',
																	'array'       => 'main_options',
																	'name'        => 'comments_text_color',
																	'saved'       => '222222' )) ),
														// Comments highlight color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Highlight Color',
																	'description' => 'The highlight color are the border colors of your comments',
																	'array'       => 'main_options',
																	'name'        => 'comments_highlight',
																	'saved'       => 'ffffff' )) ),
														// Comments header size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Header Text Size',
																	'description' => 'Your comments header shows the number of comments and a message',
																	'array'       => 'main_options',
																	'name'        => 'comments_header_size',
																	'saved'       => '16',
															        'min'         => '10',
																	'max'         => '36'  )) ),
														// Comment form header size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Form Title Size',
																	'description' => 'The title size of your comment form ',
																	'array'       => 'main_options',
																	'name'        => 'comment_form_title_size',
																	'saved'       => '24',
															        'min'         => '10',
																	'max'         => '42'  )) ),
														// Comment form header text 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'Form Title Text',
																	'description' => 'Set what the title of your comment form says',
																	'array'       => 'main_options',
																	'name'        => 'comment_form_title_text',
																	'saved'       => 'Leave A Comment' )) ),
														// Comment header text 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'Leave A Comment Message',
																	'description' => 'The leave a comment message for when there are already posted comments',
																	'array'       => 'main_options',
																	'name'        => 'comment_header_text',
																	'saved'       => 'Leave a comment' )) ),
														// No comment message 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'No Comments Message',
																	'description' => 'What the comment header says when there are no comments yet',
																	'array'       => 'main_options',
																	'name'        => 'comment_header_no_comment_text',
																	'saved'       => 'No comments yet, be the first!' )) ),
														// Closed comments message  
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'Closed Comments Message',
																	'description' => 'What the comment header says when the comments are closed',
																	'array'       => 'main_options',
																	'name'        => 'comment_header_closed_comments',
																	'saved'       => 'Sorry but comments are closed' )) )
															)))
														)),
						// Widgets Style
						array( 
							'f' => array( $this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'widget_style',
										'title' => __('Widget Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Set up your comments look and semantics', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Title size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Title Size',
																	'description' => 'Set the size of your widget titles',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_size',
																	'saved'       => '14',
															        'min'         => '10',
																	'max'         => '30'  )) ),
														// Title font 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'font',
																	'title'       => 'Title Font',
																	'description' => 'Set the font of your widget titles',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_font',
																	'saved'       => 'Arial' )) ),
														// Title style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Title Style',
																	'description' => 'Set the style of your widget titles',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_style',
																	'saved'       => 'italic',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Title weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Title Weight',
																	'description' => 'Set the weight of your widget titles',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
														// Widget box color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Widget Color',
																	'description' => 'The color of the widget boxes',
																	'array'       => 'main_options',
																	'name'        => 'widget_background',
																	'saved'       => 'ffffff' )) ),
														// Widget text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Text Color',
																	'description' => 'The color of the widgets text',
																	'array'       => 'main_options',
																	'name'        => 'widget_color',
																	'saved'       => '222222' )) ),
														// Widget text highlight color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Highlight color',
																	'description' => 'The color of the links in the widget text',
																	'array'       => 'main_options',
																	'name'        => 'widget_highlight',
																	'saved'       => 'bf3e2a' )) ),
														// Widget text size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Text Size',
																	'description' => 'The size of the widget body text',
																	'array'       => 'main_options',
																	'name'        => 'widget_text_size',
																	'saved'       => '12',
															        'min'         => '10',
																	'max'         => '22'  )) )

														)))
													))
												));
?>