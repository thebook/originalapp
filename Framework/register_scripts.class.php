<?php 

/**
* Use this class to register all of your css and javascript, be it admin side or visitior side. 
* The class should only really be called once; once that is done you simply write in new scripts inisde the "scripts.return.php"
* file which is always automaticly included in the construct. 
* 
* Note(ramble): that the word "scripts" is used though out the class to reference both css and javascript files; but may be used in 
* some contexts to reference just a javascript file; i know this isisnt the most neat way or talking about things, but is 
* used because wordpress has the wp_register/enqueue_"style" css and wp_register/enqueue_"script" for js, so sometimes 
* it makes sense to mention it like that
*/
class register_scripts
{
	/**
	 * Holds an array of all the "scripts" to be registered, which are "sorted" into four different categories
	 * 1)admin style, 2)admin script, 3)public style, 4)public script
	 * @var array
	 */
	var $sorted_scripts = array();

	/**
	 * Inits the class by including the definition file and sorting all of its definitions 
	 * into four categories
	 */
	function __construct()
	{
		$options = ( include FRAMEWORK .'/Definitions/scripts.definition.php' );

		foreach ( $options['opt'] as $option ) {

			$this->_sort($option['o'][0]);
		}

		$this->body();
	}

	/**
	 * Registers and calls admin side javascript
	 * @return  Javascript
	 */
	public function register_admin_scripts()
	{
		$this->_register_and_call($this->sorted_scripts['admin']['script']);
	}

	/**
	 * Registters and calls admin side css
	 * @return  Css
	 */
	public function register_admin_styles()
	{
		$this->_register_and_call($this->sorted_scripts['admin']['style']);
	}

	/**
	 * Registers and calls public javascript
	 * @return  Javascript
	 */
	public function register_public_scripts()
	{
		$this->_register_and_call($this->sorted_scripts['public']['script']);
	}

	/**
	 * Registers and calls public css
	 * @return  Css
	 */
	public function register_public_styles()
	{
		$this->_register_and_call($this->sorted_scripts['public']['style']);
	}

	/**
	 * Public function which is given a single script definition, which it then inserts in a $this->sorted_scripts; key which 
	 * responds to its "side" ( public, admin ) and "type" ( script, style ), it then inserts the whole script array into that 
	 * new key
	 * @param  array $a The definition "array"
	 * @return array    $this->sorted_scripts array is filled with the sorted values of the "$a" array 
	 */
	protected function _sort ($single_script)
	{	
		$this->sorted_scripts[$single_script['side']][$single_script['type']][] = $single_script;
	}

	/**
	 * Hooks all the scripts to wordpress
	 * @return  Regusters and calls scipts
	 */
	public function body ()
	{	
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		add_action( 'admin_head',            array( $this, 'register_admin_styles' ) );				
		add_action( 'wp_enqueue_scripts',    array( $this, 'register_public_styles' ) );
		add_action( 'wp_enqueue_scripts',    array( $this, 'register_public_scripts' ) );
	}

	/**
	 * Scripts are passed to this function, which it then takes and registers, after which it checks whether they 
	 * are set to be enqueued, if not it leaves it, if yes it checks if there is a condition 
	 * Scripts are passed into this helper funciton are ones which are to be processed per each of the four 
	 * script categories ( admin & public js, and admin & public css )
	 * @param  array $passed_scripts An array of the "passed scripts" which is to be processed
	 * @return                  Registers the script and decideds whether to call it
	 */
	protected function _register_and_call ($passed_scripts) 
	{
		foreach ($passed_scripts as $script) {

			$this->_register( $script['type'], $script['arg'] );
			
			( $script['enqueue'] ) and $this->_is_there_condition($script);
		}
	}

	/**
	 * Helper funciton called if the script is set to be enqued, checks if it is to be enqued for certain pages, if 
	 * not it calls the regular enqueue if yes it creates the if statement 
	 * @param  array  $script An array of paramaters for the script to the enqueued
	 * @return  Enqueues a script or creates a condition under which it will be 
	 */
	protected function _is_there_condition ($script)
	{
		if ( $script['conditional'] ) {

			$this->_check_condition($script['type'], $script['arg'][0], $script['conditional'] );
		}
		else {
			
			$this->_enque($script['type'], $script['arg'][0] );
		}
	}

	/**
	 * Helper funciton is called if a script is to be called under a condition, it takes the "$cond"ition array which tells 
	 * it whether the condition is for a "post type" admin page or just a "page"
	 * @param  string $type "Type" of script to enqueue
	 * @param  string $name The "name" of the script to enqueue
	 * @param  array  $cond The array condaining the "conditions"
	 * @return        Enqueues a script and creates an condition under which it does it
	 */
	protected function _check_condition ($type, $name, $cond)
	{
		global $pagenow, $post_type;

		foreach ($cond as $condition) {

			if ( $condition[0] ) {

				if ( $pagenow == 'post-new.php'  && $post_type == $condition[1]
					|| $pagenow == 'post.php' && $post_type == $condition[1] ) { 

						$this->_enque($type, $name);			
				}
			}
			else {

				( $pagenow == $condition[1] ) and $this->_enque($type, $name);	
			}
		}		
	}

	/**
	 * Helper function which calls "wp_register_style" or "wp_register_script" depedning on the $type paramater and 
	 * passes arguments
	 * @param  string $type      The "type" of script to register
	 * @param  array  $arguments An array of "arguments" to pass
	 * @return           	Register Script
	 */
	protected function _register ($type, $arguments)
	{
		$register ="wp_register_$type";

		call_user_func_array( $register, $arguments );
	}

	/**
	 * Function enqueues a script based on its type and name this function is used within others to fracture code complexity 
	 * a little
	 * @param  string $type The stype of script e.g ( style(css) or script(js) )
	 * @param  string $name The name of the registred script to enqueue
	 * @return        Enqueues a script
	 */
	protected function _enque ($type, $name)
	{
		$enque = "wp_enqueue_$type";
		$enque($name);
	}
}

?>