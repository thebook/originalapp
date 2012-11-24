<?php 

	return array(
			'sidebar' =>
				array(
					// If template has template parts in it we move put them under "template_parts" and define as original
					'template_parts' => 
						array(
							'advert' => 
								array(
									'options' => array(
										array(),
									)) ),
					// If it has simple options we put them under "template_parts"
					'options' => 
						array(
							// Sidebar Size 
							array(
								'type'        => 'select',
								'title'       => 'Sidebar Size',
								'description' => 'Set the width of the sidebar',
								'array'       => 'main_meta',
								'name'        => 'sidebar_size',
								'saved'       => 'third',
							    'options'     => array('Half', 'Third', 'Quarter'),
								'values'      => array('half', 'third', 'quarter')  ),
							// Sidebar Size (should be a select later on )
							array(
								'type'        => 'text',
								'title'       => 'Sidebar Size',
								'description' => 'Set the width of the sidebar',
								'array'       => 'main_meta',
								'name'        => 'name_of_sidebar_to_get',
								'saved'       => 'white-whale-default-sidebar' )
							)
					),
		);

?>