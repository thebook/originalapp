<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');
define('AJAXLOADS', FRAMEWORKURI .'/ajax_loads/ajax_loader.php' );
define('BOOK', TEMPLATEPATH . '/Book' );

$global_admin_options_white_whale = get_option('main_options');

include FRAMEWORK . '/include.php'; 

// include FRAMEWORK . '/Options/include.php';

include FRAMEWORK .'/Apis/include.php';

include FRAMEWORK .'/data/include.php';

// include BOOK .'/include.php';

// include FRAMEWORK . '/Ticketing/include.php';

new register_scripts;
	
// new admin( 
// 	array(
// 		'id' => 'lf-admin',
// 		'class' => 'lf-admin-td', 
// 		'default_type' => 'option',
// 		'definition' => FRAMEWORK .'/Definitions/admin.definition.php'
// 		));

new account;
new ticket;
new book;
new email;

// $user = new branch_users_database( 
// 	array(
// 		'id' => 'lf-users',
// 		'class' => 'lf-user-meta',
// 		'default_type' => 'option',
// 		'definition' => FRAMEWORK .'/Definitions/users.definition.php'
// 		));

// $books = new books(
// 	array(
// 		'id'           => 'lf-post-meta',
// 		'class'        => 'lf-admin-post-meta-td',
// 		'default_type' => 'meta', 
// 		'definition'   => FRAMEWORK .'/Definitions/book.definition.php'
// 	));

$amazon = new amazon(
	array(
		'ajax_handler_function' => 'amazon',
		'amazon_access_key'    => 'AKIAJUAOUYTIWMMCXY6Q',
		'amazon_secret_key'    => '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',
		'amazon_associates_id' => 'recyc-21',
		'region'               => 'co.uk'
	));

// new tickets( FRAMEWORK .'/Definitions/ticket.definition.php');

?>