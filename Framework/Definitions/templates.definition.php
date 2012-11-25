<?php 

	return array(
			'slide' =>
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
								'type'        => 'text',
								'title'       => 'Chose slide',
								'description' => 'Chose your slider to show',
								'array'       => 'main_meta',
								'name'        => 'slide_id',
								'saved'       => '638'  ),
							)
					),
			'menu' =>
				array(
					'template_parts' => 
						array(),
					'options' => 
						array(
							// Menu 
							array(								 
								'type'        => 'text',
								'title'       => 'Chose Menu',
								'description' => 'Set which menu you wish to display',
								'array'       => 'main_meta',
								'name'        => 'id',
								'saved'       => '' ),
							// Navigation size 
							array(
								'type'        => 'select',
								'title'       => 'Thickness',
								'description' => 'Set the thickness of your menu',
								'array'       => 'main_meta',
								'name'        => 'navigation_size',
								'saved'       => '',
								'options'     => array('Thin', 'Medium', 'Thick'),
								'values'      => array('thin', 'medium', 'thick') ),
						),
					)
		);

?>