<?php 

/**
* An options parent class upon which other classes are extended
*/
class alpha_tree_options
{	
	/**
	 * An array of paramaters passed though the constructor
	 * @var array
	 */
	var $params;

	/**
	 * Takes the "id" prefix and "class" prefix of the option elements, as well as the "default" check type it should make,
	 * be it for 'options'(get_option()) or meta(get_option_meta())
	 * @param string $id    The elements id prefix
	 * @param string $class The elements class prefix
	 * @param string $def   The option type
	 */
	function __construct($id, $class, $def)
	{
		$this->params['id']		= $id;
		$this->params['class']  = $class;
		$this->params['def']    = $def;
	}

	/**
	 * The option generating funcitons, this function creates a new class instance coresponding to the "type" paramater
	 * @param array $passed_options The options which are passed to create the input, each key is treated as a variable because it is extracted
	 * @return html       A new input option
	 */
	public function opt ( $passed_options )
	{ 	
		extract( $passed_options );
		// Set default value or retrive an old one if exists
		$passed_options['saved'] = _default( $this->params['def'], $array, $name, $saved );
		// Create a class based on type and first name
		$class = "generate_" . $type;
		// Call option by creating new class ( the option is echoed from class construct )
		new $class( $passed_options, $this->params['id'], $this->params['class'] );
	}
	
	/**
	 * Hider functions calls the reveal() function from the post-ui.js file which hides the current option row if based on 
	 * what value another option has
	 * @param  array  $h The name of the other option and a js array of the values on which it should show
	 * @param  string $n The current option name
	 * @return js    Calls the reveal.reveal() function
	 */
	public function hider($h, $n)
	{	
		echo '<script>reveal.reveal( "#'.$this->params['id'].'-'.$h[0].'", "#'.$n.'-hook", '.$h[1].' );</script>';
	}
}

?>