<?php 

/**
* Clas responsible for generating user interface
*/
class branch_users_database extends branch_users_style
{

	function __construct($options) { 

		parent::__construct($options);

		$this->_create_table();
	}

	public function get_users ()
	{
		$creator = new table_creator;
		return $creator->get_all_rows_from_table($this->params['manifestation']['create_table']['name']);
	}

	public function get_user ($column_to_get_by, $value_to_get_by)
	{
		$creator = new table_creator;

		return $creator->get_row($this->params['manifestation']['create_table']['name'], $column_to_get_by, $value_to_get_by );
	}

}
?>