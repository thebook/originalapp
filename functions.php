<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');
define('BOOK', TEMPLATEPATH . '/Book' );

$global_admin_options_white_whale = get_option('main_options');

include BOOK .'/include.php';

include FRAMEWORK . '/include.php'; 

include FRAMEWORK . '/Helpers/include.php';

include FRAMEWORK . '/Shortcodes/include.php';

include FRAMEWORK . '/Options/include.php';

include FRAMEWORK . '/Templates/include.php';

new register_scripts;
	
new admin( 
	array(
		'id' => 'lf-admin',
		'class' => 'lf-admin-td', 
		'default_type' => 'option',
		'definition' => FRAMEWORK .'/Definitions/admin.definition.php'
		));

new meta(
	array( 
		'id' => 'lf-post-meta',
		'class' => 'lf-admin-post-meta-td',
		'default_type' => 'meta', 
		'definition' => FRAMEWORK .'/Definitions/meta_boxes.definition.php'
		));

new leaf_slide(
	array(
		'id' => 'lf-post-meta',
		'class' => 'lf-admin-post-meta-td',
		'default_type' => 'meta', 
		'definition' => FRAMEWORK .'/Definitions/slider.definition.php'
		));

?>