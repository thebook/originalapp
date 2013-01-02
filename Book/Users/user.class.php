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

		$this->init_table_and_alterations_if_created( $this->params['manifestation']['init_table'] );
		add_action('admin_menu', array($this, 'create_page') );
	}

	/**
	 * Creates a table if not is created an inits its default field array other wise takes the current saved array and 
	 * alters the database fields 	
	 * @param  [type] $paramaters [description]
	 * @return [type]             [description]
	 */
	public function init_table_and_alterations_if_created ($paramaters)
	{
		$table 					 	= new table_creator;
		$main_options 				= get_option($paramaters['options_array']);
		$profile_fields             = $main_options['user_profile']['field'];
		$profile_fields_names	    = array();
		$database_column_names      = array();
		$columns_in_the_table 		= $table->show_all_columns_in_a_table($paramaters['table_name']);
		$this->params['table_name'] = $paramaters['table_name'];		

		// $this->params['unique_options'] = ( isset($main_options['unique_options']) ? $main_options['unique_options'] : $main_options['unique_options'] );

		if ( !$table->does_table_exist( $paramaters['table_name'] ) ) : 

			$table->_create_table(
				array(
					'table_name' => $paramaters['table_name'],
					'fields'     => $paramaters['default_fields'] ));

		else : 

			foreach ( $profile_fields as $field ) : 

				$field_name 			= str_replace(' ', '_', strtolower(trim($field['name'])));			
				$profile_fields_names[] = $field_name;
							
				if ( $table->does_column_exist( $paramaters['table_name'], $field_name ) ) { 
					
					$current_data_type = strtolower($table->convert_field_choice_into_statement($field['character_type']));

					if (  $current_data_type !== $table->get_column_information($paramaters['table_name'], $field_name, 'DATA_TYPE') ) :

						$table->change_data_type_of_column($paramaters['table_name'], $field_name, $current_data_type );

					endif;
				}
				else {		

					$column_insertion = array('table_name' => $paramaters['table_name'], 'field_name' => $field_name, 'field_input_type' => $field['character_type'] );

					$table->add_column_to_table( $column_insertion );
				}

				echo $field['old_name'];

			endforeach;

			foreach ( $columns_in_the_table as $column ) { 

				if ( $column['COLUMN_NAME'] !== 'id' and in_array( $column['COLUMN_NAME'], $profile_fields_names) === false ) {

					$table->remove_column_from_table(
						array(
							'table_name' => $paramaters['table_name'],
							'field_name' => $column['COLUMN_NAME']
						));
				}
			}

				# does field exists
				# 	if does check if it has changed
				# 	# if it has do nothing
				# if dosent add it


		endif;
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