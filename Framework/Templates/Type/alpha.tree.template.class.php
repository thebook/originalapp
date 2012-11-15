<?php 

/**
* The parent class from which all other template classes come
*/
class alpha_tree_template
{
	var $template_paramaters;

	protected function _get_every_template_part_and_pass_paramaters($templates_to_get)
	{
		foreach ($templates_to_get as $template_part) {

			call_user_func_array( array( $this, "_{$template_part['name']}" ), array( $template_part['params'] ) ); 
			
		}
	}

	protected function _get_a_single_template_part($template_to_get)
	{
		call_user_func( array($this, "_$template_to_get") );
	}

	protected function _init_option()
	{
		$this->template_paramaters['admin_option'] = get_option('main_options');
	}
}

?>