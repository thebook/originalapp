<?php 

/**
* Admin helpers
*/
class admin_help
{
	
	function __construct()
	{
			
	}

	public function pop($a)
	{	
		$call = $this->wrap_ite( $a['options'] );
		add_settings_section( $a['id'], $a['title'], $call, $a['page'] );
	}

	public function wrap_ite($a)
	{	
		multi( $a );
	}
}

?>