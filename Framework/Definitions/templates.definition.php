<?php 

return array(
		'opt' => array(
			array(
				'f' => array($this, 'define_template'),
				'o' => array(
					array(
						'name' => 'header',
						'template_path' => TEMPLATEPATH .'/liquidheader.php' ))
					),
			array(
				'f' => array($this, 'define_template'),
				'o' => array(
					array(
						'name' => 'test_content',
						'template_path' => TEMPLATEPATH .'/test-content.php' ))
					)
			));

?>