<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');
define('AJAXLOADS', FRAMEWORKURI .'/ajax_loads/ajax_loader.php' );
define('BOOK', TEMPLATEPATH . '/Book' );

$global_admin_options_white_whale = get_option('main_options');

include FRAMEWORK . '/include.php'; 

include FRAMEWORK . '/Helpers/include.php';

include FRAMEWORK . '/Shortcodes/include.php';

include FRAMEWORK . '/Options/include.php';

include FRAMEWORK . '/Templates/include.php';

include BOOK .'/include.php';

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

new branch_users_database( 
	array(
		'id' => 'lf-users',
		'class' => 'lf-user-meta',
		'default_type' => 'option',
		'definition' => FRAMEWORK .'/Definitions/users.definition.php'
		));

$books = new books(
	array(
		'id'           => 'lf-post-meta',
		'class'        => 'lf-admin-post-meta-td',
		'default_type' => 'meta', 
		'definition'   => FRAMEWORK .'/Definitions/book.definition.php'
	));

?>