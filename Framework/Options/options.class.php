<?php 

/**
* An options class upon which other classes are extended
*/
class options
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
	 * @param  string $type The options "type" e.g 'select, text, radio'
	 * @param  string $a    The name of the "array" which holds the option values
	 * @param  string $n    The specific option "name"
	 * @param  string $s    The the value to display if the option has no "saved" value 
	 * @param  array  $ov   If the option is an 'radio' or 'select' we write in the "option values" ( no spaces )
	 * @param  array  $o    If the option is an 'radio' or 'select' we write in the "option" text
	 * @return html       A new input option
	 */
	public function opt ( $type, $a, $n, $s, $ov, $o )
	{ 	
		// Set default value or retrive an old one if exists
		$s = _default( $this->params['def'], $a, $n, $s );
		// Consolidate option paramaters into an array
		$opt = array_combine( array('name', 'array', 'saved', 'options', 'values' ), array( $n, $a, $s, $o, $ov ) );
		// Create a class basde on type and first name
		$class = "generate_" . $type;
		// Call option by creating new class ( the option is echoed from class construct )
		new $class( $opt, $this->params['id'], $this->params['class'] );
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
		if ( isset( $h ) )
		{	
			echo '<script>reveal.reveal( "#'.$this->params['id'].'-'.$h[0].'", "#'.$n.'-hook", '.$h[1].' );</script>';
		}
	}
}

?>