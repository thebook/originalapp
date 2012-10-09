<?php 

$short = array( 
		// Alert shortcode [alert color="" ]content[/alert]
		'alert' => array( 
						'o' => 
							array( 								
								array( 
									'type' => 'select', 
								 	'text' => 'Type', 
								 	'desc' => 'Chose the type of alert box that you want', 
								 	'id'   => 'color', 						   	        
								 	'val'  => array("Gray", "Yellow", "Green", "Red", "Blue")
								),
								array( 
									'type' => 'text', 
								 	'text' => 'Text', 
								 	'desc' => 'The text content of your alert box', 
								 	'exc'  => 'content', 						   	        
								 	'val'  => array()
								)
							),
			   			'name' 	      => 'Alert Boxes', 
			   			'description' => 'Chose the type of alertbox you want, and set its text',
			   			'shortcode'   => 'alert',
			   			'content'     => 'content',
				   		'tabs'        => false ),
			// Button shortcode [button url="" read="" size="" color="" ]
			'buttons' => array( 
						'o' => 
							array( 								
								array( 
									'type' => 'text', 
								 	'text' => 'Url', 
								 	'desc' => 'The link that your button leads to', 
								 	'id'   => 'url', 						   	        
								 	'val'  => array()
								),
								array( 
									'type' => 'text', 
								 	'text' => 'Text', 
								 	'desc' => 'The read text of your button', 
								 	'id'   => 'read', 						   	        
								 	'val'  => array()
								),
								array( 
									'type' => 'select', 
								 	'text' => 'Size', 
								 	'desc' => 'The size of your button', 
								 	'id'   => 'size', 						   	        
								 	'val'  => array( 'Medium', 'Large', 'Small')
								),
								array( 
									'type' => 'select', 
								 	'text' => 'Color', 
								 	'desc' => 'Chose the color of your button, if left to default the custom color you chose for buttons in theme options will be the color', 
								 	'id'   => 'color', 						   	        
								 	'val'  => array( "Default", "Red", "Green", "Pink", "Black", "Gray", "Blue", "Yellow"  )
								)
							),
			   			'name' 	      => 'Button', 
			   			'description' => 'Set the url, size, colors and text of your button',
			   			'shortcode'   => 'button',
			   			'content'     => false,
				   		'tabs'        => false ),
			// Video embed [video video="" height="" ]
			'embed' => array( 
							'o' => 
								array( 								
									array( 
										'type' => 'textarea', 
									 	'text' => 'Url', 
									 	'desc' => 'The url or embed code of the video', 
									 	'id'   => 'video', 						   	        
									 	'val'  => array()
									),
									array( 
										'type' => 'text', 
									 	'text' => 'Height', 
									 	'desc' => 'The height of your embeded video', 
									 	'id'   => 'height', 						   	        
									 	'val'  => array()
									)
								),
				   			'name' 	      => 'Video', 
				   			'description' => 'Embed youtube and vimeo videos',
				   			'shortcode'   => 'video',
				   			'content'     => false,
				   			'tabs'        => 'Videos' )
			);

?>