<?php 
 
 global $global_admin_options_white_whale;

 new template_comments(
 	array(
 		array(
 			'name' => 'check_if_comments_are_password_protected',
 			'params' => ''
 			),
 		array(
 			'name' => 'generate_disclaimer_and_comments',
 			'params' => array(
 				'no_comments_message' => $global_admin_options_white_whale['comment_header_no_comment_text'],
 				'comments_message' => $global_admin_options_white_whale['comment_header_text'],
 				'comments_are_closed_message' => $global_admin_options_white_whale['comment_header_closed_comments']
 				)
 			),
 		array(
 			'name' => 'generate_comment_form',
 			'params' => array(
 				'title' => $global_admin_options_white_whale['comment_form_title_text']
 				)
 			)
 	));

?>