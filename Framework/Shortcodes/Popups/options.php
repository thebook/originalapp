<?php 

$short = array( 
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
			   			'shortcode'   => 'button' )
			);

?>