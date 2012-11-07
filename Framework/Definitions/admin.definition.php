<?php 

	return array(
				'options' => 'main_options',
				'page_name' => 'whitewhale',
				'form_action' => 'white_whale_save',
				'opt' => 
					array(
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
										'title' => __('Navigation', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Configure the options of your menu bars and breadcrumbs', 'liquidflux'),
										'options' => 
											array( 
												'opt' => 
													array(
														// Breadcrumbs 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Use Breadcrumbs',
																	'description' => 'Breacrumbs show the user which page they are currently',
																	'array'       => 'main_options',
																	'name'        => 'breadcrumbs',
																	'saved'       => 'none',
															        'options'     => array('Use', 'Dont Use'),
																	'values'      => array('use', 'none')  )) )
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
																	'type'        => 'select',
																	'title'       => 'Title Choice',
																	'description' => 'Chose how your site title will look like',
																	'array'       => 'main_options',
																	'name'        => 'title_choice',
																	'saved'       => 'titleandlogo',
															        'options'     => array('Title', 'Title & Logo', 'Logo', 'None'),
																	'values'      => array('title', 'titleandlogo', 'logo', 'none')  )) ),
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
																	'title'       => 'Logo Size',
																	'description' => 'The size of your logo',
																	'array'       => 'main_options',
																	'name'        => 'logo_size',
																	'saved'       => '32',
															        'min'         => '10',
																	'max'         => '90'  )) ),
														// Header height 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Header Height',
																	'description' => 'Set the height of your header',
																	'array'       => 'main_options',
																	'name'        => 'header_height',
																	'saved'       => '50',
															        'min'         => '50',
																	'max'         => '500'  )) )
																)))
															)),
						// Content
						array( 
							'f' => array($this, 'pop'),
							'o'	=>	
								array(
									array( 
										'id' => 'content_style',
										'title' => __('Content Style', 'liquidflux'),
										'page'  => 'whitewhale',
										'desc'  => __('Configure the style of your text content.', 'liquidflux'),
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
														// Post title color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Title Color',
																	'description' => 'Set yout post title color',
																	'array'       => 'main_options',
																	'name'        => 'post_title_color',
																	'saved'       => '000000' )) ),
														// Meta text color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Post Meta Color',
																	'description' => 'Chose the color of your post meta',
																	'array'       => 'main_options',
																	'name'        => 'post_meta_color',
																	'saved'       => '000000' )) ),
														// Meta text size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Post Meta Size',
																	'description' => 'Set post meta size',
																	'array'       => 'main_options',
																	'name'        => 'post_meta_size',
																	'saved'       => '12',
															        'min'         => '8',
																	'max'         => '24'  )) ),
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
														// Body text style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Text Style',
																	'description' => 'Set the style of the body text',
																	'array'       => 'main_options',
																	'name'        => 'post_text_style',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Body text weight 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Post Text Weight',
																	'description' => 'Chose the weight of the body text',
																	'array'       => 'main_options',
																	'name'        => 'post_text_weight',
																	'saved'       => 'normal',
															        'options'     => array('Normal', 'Bold'),
																	'values'      => array('normal', 'bold')  )) ),
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
																	'saved'       => '000000' )) ),
														// Read more color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Read More Color',
																	'description' => 'Set the color of your read more text',
																	'array'       => 'main_options',
																	'name'        => 'post_readmore_color',
																	'saved'       => '79BAA0' )) ),
														// Read more text 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'text',
																	'title'       => 'Read More Text',
																	'description' => 'Custom text for the read more link',
																	'array'       => 'main_options',
																	'name'        => 'post_readmore_text',
																	'saved'       => 'Continue Reading' )) ),
														// Widget title size 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'slider',
																	'title'       => 'Widget Title Size',
																	'description' => 'The widget title font size',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_size',
																	'saved'       => '14',
															        'min'         => '10',
																	'max'         => '36'  )) ),
														// Widget title style 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'radio',
																	'title'       => 'Widget Title Style',
																	'description' => 'Chose the widget title style',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_style',
																	'saved'       => 'italic',
															        'options'     => array('Normal', 'Italic'),
																	'values'      => array('normal', 'italic')  )) ),
														// Widget title color 
														array(
															'f' => array( $this, 'create'),
															'o' => array(  
																array(
																	'type'        => 'color',
																	'title'       => 'Widget Title Color',
																	'description' => 'Set the color of your widget title',
																	'array'       => 'main_options',
																	'name'        => 'widget_title_color',
																	'saved'       => '4e4340' )) ),
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
																	'saved'       => 'F5EEB7' )) )


														)))
													))
												));
	

?>