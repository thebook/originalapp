<?php 

/**
* Clas responsible for generating user interface
*/
class users extends alpha_tree_users 
{

	function __construct($paramaters)
	{
		$this->params['manifestation']  = ( include $paramaters['definition'] );
		$this->params['creator']        = new table_creator;		

		add_action('admin_menu', array($this, 'create_page') );
	}

	public function create_page ()
	{
		multi($this->params['manifestation']);
	}

	public function register_user ($user_information)
	{
		$this->params['creator']->add_row_to_table( $this->params['table_name'], $user_information );
	}
	
	
	public function check_if_input_field_value_is_unqiue ($input_name, $input_value)
	{
		if ( in_array($input_name, $this->params['unique_options'] ) ) {

			if ( !$this->params['creator']->check_if_value_is_in_column( $this->params['table_name'], $input_name, $input_value ) ) {

				return $input_value;
			}

			else { 

				return "The $input_value is already in use by somone else";
			}
		}
	}

	public function create_and_init_database_table_and_columns ($paramaters)
	{
		$main_options					= $paramaters['options_to_save_unique_fields_to'];
		$this->params['table_name']     = $paramaters['table_name'];
		$this->params['unique_options'] = ( isset($main_options['unique_options']) ? $main_options['unique_options'] : $main_options['unique_options'] );

		$this->params['creator']->check_if_table_exists_if_not_create_one(
			array(
				'table_name' => $paramaters['table_name'],
				'fields'     => $paramaters['fields']
			));
	}
}

?>