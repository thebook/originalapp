<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('TEMPLATEURI', get_template_directory_uri() );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define("INNER", TEMPLATEPATH . '/inner');
define("OUTER", TEMPLATEPATH . '/outer');
define("OUTPUT", TEMPLATEPATH. '/output');
define("STARTING_PATH", get_template_directory_uri() . '/outer');

include INNER .'/include.php';
new account;
new book;
new email;
new ticket;
new settings;
new pdf_maker;
// new amazon(
// 	array(
// 		'ajax_handler_function' => 'amazon',
// 		'amazon_access_key'     => 'AKIAJUAOUYTIWMMCXY6Q',
// 		'amazon_secret_key'     => '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',
// 		'amazon_associates_id'  => 'recyc-21',
// 		'region'                => 'co.uk'
// 	)
// );

?>