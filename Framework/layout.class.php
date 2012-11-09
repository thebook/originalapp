<?php 

/**
* Layout generating class
*/
class layouts
{
	var $template_list = array();

	function __construct($options) {
		
		$definition = ( include $options['definition_array_path'] );
		multi($definition);	
	}

	protected function get_template($name)
	{
		$passed_params;
		include $this->template_list[$name]['template_path'];
	}

	public function define_template($template_definition_array)
	{	
		extract($template_definition_array);

		( !isset( $this->template_list[$name] ) ) and $this->template_list[$name]['template_path'] = $template_path;												
	}

	public function manifest($template_manifestation_order)
	{
		foreach ($template_manifestation_order as $template_name) {
			$this->get_template($template_name);
		}
	}

	
}

?>