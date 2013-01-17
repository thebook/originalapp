<?php 

/**
* User registration alpha class
*/
class alpha_tree_users extends admin
{

	function __construct($creation_paramaters) 
	{ 
		parent::__construct($creation_paramaters);
		
		$this->params['users_table'] = $this->params['manifestation']['create_table']['name'];
	}

}
?>