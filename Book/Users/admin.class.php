<?php 

/**
* Clas responsible for generating user interface
*/
class users extends alpha_tree_users 
{
	var $params;

	function __construct($paramaters)
	{
		$this->params['manifestation'] = ( include $paramaters['definition'] );
		add_action('admin_menu', array($this, 'create_page') );
	}

	public function create_page ()
	{
		multi($this->params['manifestation']);
	}

	public function manage_users_page ()
	{
		echo "manage users page";
	}

	public function see_users_page ()
	{
		echo "see users page";
	}

	protected function _create_and_register_users_page ($definitions)
	{
		
	}

	protected function _get_list_of_all_users ()
	{
		
	}
}

?>