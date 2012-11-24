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
								'name'        => 'template_params',
								'saved'       => '638'  ),
							)
					),
		);

?>