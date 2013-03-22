<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');
define('AJAXLOADS', FRAMEWORKURI .'/ajax_loads/ajax_loader.php' );
define('BOOK', TEMPLATEPATH . '/Book' );

$global_admin_options_white_whale = get_option('main_options');

include FRAMEWORK . '/include.php'; 

include FRAMEWORK . '/Helpers/include.php';

include FRAMEWORK . '/Options/include.php';

include BOOK .'/include.php';

include FRAMEWORK .'/Apis/include.php';

include FRAMEWORK . '/Ticketing/include.php';


new register_scripts;
	
new admin( 
	array(
		'id' => 'lf-admin',
		'class' => 'lf-admin-td', 
		'default_type' => 'option',
		'definition' => FRAMEWORK .'/Definitions/admin.definition.php'
		));

$user = new branch_users_database( 
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

$amazon = new amazon(
	array(
		'ajax_handler_function' => 'amazon',
		'amazon_access_key'    => 'AKIAJUAOUYTIWMMCXY6Q',
		'amazon_secret_key'    => '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',
		'amazon_associates_id' => 'recyc-21',
		'region'               => 'co.uk'
	));

new tickets( FRAMEWORK .'/Definitions/ticket.definition.php');

// var_export(unserialize('a:3:{i:1;a:13:{s:4:"ASIN";s:10:"1780873697";s:4:"ISBN";s:10:"1780873697";s:6:"author";s:16:"Paul Glendinning";s:7:"binding";s:9:"Paperback";s:10:"dimensions";a:4:{s:6:"Height";s:3:"496";s:6:"Length";s:1:"0";s:6:"Weight";s:1:"0";s:5:"Width";s:3:"520";}s:5:"image";s:61:"http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg";s:16:"lowest_new_price";s:3:"208";s:17:"lowest_used_price";s:3:"385";s:15:"number_in_stock";s:1:"1";s:18:"package_dimensions";a:4:{s:6:"Height";s:3:"126";s:6:"Length";s:3:"504";s:6:"Weight";s:2:"66";s:5:"Width";s:3:"496";}s:5:"pages";s:3:"416";s:5:"price";s:3:"699";s:5:"title";s:49:"Maths in Minutes: 200 K...Explained in an Instant";}i:2;a:13:{s:4:"ASIN";s:10:"1780873697";s:4:"ISBN";s:10:"1780873697";s:6:"author";s:16:"Paul Glendinning";s:7:"binding";s:9:"Paperback";s:10:"dimensions";a:4:{s:6:"Height";s:3:"496";s:6:"Length";s:1:"0";s:6:"Weight";s:1:"0";s:5:"Width";s:3:"520";}s:5:"image";s:61:"http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg";s:16:"lowest_new_price";s:3:"208";s:17:"lowest_used_price";s:3:"385";s:15:"number_in_stock";s:1:"1";s:18:"package_dimensions";a:4:{s:6:"Height";s:3:"126";s:6:"Length";s:3:"504";s:6:"Weight";s:2:"66";s:5:"Width";s:3:"496";}s:5:"pages";s:3:"416";s:5:"price";s:3:"699";s:5:"title";s:49:"Maths in Minutes: 200 K...Explained in an Instant";}i:3;a:13:{s:4:"ASIN";s:10:"1780873697";s:4:"ISBN";s:10:"1780873697";s:6:"author";s:16:"Paul Glendinning";s:7:"binding";s:9:"Paperback";s:10:"dimensions";a:4:{s:6:"Height";s:3:"496";s:6:"Length";s:1:"0";s:6:"Weight";s:1:"0";s:5:"Width";s:3:"520";}s:5:"image";s:61:"http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg";s:16:"lowest_new_price";s:3:"208";s:17:"lowest_used_price";s:3:"385";s:15:"number_in_stock";s:1:"1";s:18:"package_dimensions";a:4:{s:6:"Height";s:3:"126";s:6:"Length";s:3:"504";s:6:"Weight";s:2:"66";s:5:"Width";s:3:"496";}s:5:"pages";s:3:"416";s:5:"price";s:3:"699";s:5:"title";s:49:"Maths in Minutes: 200 K...Explained in an Instant";}}'));
// var_export(unserialize('a:4:{i:0;a:4:{s:5:"title";s:10:"The Hobbit";s:6:"author";s:16:"J. R. R. Tolkien";s:5:"quote";s:3:"795";s:4:"isbn";s:10:"026110330X";}i:1;a:4:{s:5:"title";s:10:"The Hobbit";s:6:"author";s:16:"J. R. R. Tolkien";s:5:"quote";s:3:"294";s:4:"isbn";s:10:"0007106777";}i:2;a:4:{s:5:"title";s:10:"The Hobbit";s:6:"author";s:16:"J. R. R. Tolkien";s:5:"quote";s:4:"1412";s:4:"isbn";s:10:"0007487304";}i:3;a:4:{s:5:"title";s:10:"The Hobbit";s:6:"author";s:14:"J.R.R. Tolkien";s:5:"quote";s:3:"896";s:4:"isbn";s:10:"389940565X";}}'));

?>