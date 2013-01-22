<?php 
/**
* A alpha tree class for all apis
*/
class alpha_tree_api
{
	
	protected $paramaters;

	function __construct($params)
	{
		add_action("wp_ajax_{$params['ajax_handler_function']}", array($this, 'create') );
	}
}
	

?>