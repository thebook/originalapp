<?php 

/**
* Layout generating class
*/
class layout
{
	var $template_list = array();

	function __construct($template_manifestation_order) {

		$this->manifest($template_manifestation_order);
	}

	protected function get_template($template_definition)
	{
		extract( $template_definition );

		$template_name = "template_$name";
		new $template_name($template_params); 
	}

	public function manifest($template_manifestation_order)
	{
		foreach ($template_manifestation_order as $template_definition) {
			$this->get_template($template_definition);
		}
	}
	
}

?>