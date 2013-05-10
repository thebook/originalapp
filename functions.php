<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');
define('BOOK', TEMPLATEPATH . '/Book' );

$global_admin_options_white_whale = get_option('main_options');

include FRAMEWORK . '/include.php';

include FRAMEWORK .'/Apis/include.php';

include FRAMEWORK .'/data/include.php';

new account;
new ticket;
new book;
new email;

new amazon(
	array(
		'ajax_handler_function' => 'amazon',
		'amazon_access_key'    => 'AKIAJUAOUYTIWMMCXY6Q',
		'amazon_secret_key'    => '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',
		'amazon_associates_id' => 'recyc-21',
		'region'               => 'co.uk'
	));
?>