<?php 

/**
* Clas responsible for generating user interface
*/
class branch_users_database extends branch_users_style
{

	function __construct($options) { 

		parent::__construct($options);

		$this->_table_create();

	}


	protected function _table_create ()
	{
		extract($this->params['manifestation']['create_table']);

			$creator = new table_creator;
			$table_of_fields_name = "{$name}_fields_data";
			$does_table_exist = $creator->does_table_exist($name);
			$does_table_of_fields_exist = $creator->does_table_exist($table_of_fields_name);

			if ( !$does_table_exist and !$does_table_of_fields_exist ) : 
				
				/**
				 * Set up the field refrence table
				 */
				$creator->create_table(
					array(
						'table_name'  => $table_of_fields_name, 
						'primary_key' => false,
						'fields'      => $define_data_type_array 
					));

				foreach ( $default_setup as $field ) : $creator->add_row_to_table($table_of_fields_name, $field); endforeach;

			endif; 

			$this->change_table_columns_based_on_saved_options($name);

	}

	public function change_table_columns_based_on_saved_options ($name)
	{
		$creator = new table_creator;

		echo "update the user columns";
		// echo $creator->create_table(
		// 	array(
		// 		'table_name'  => 'whale_users_ss',
		// 		'primary_key' => 'id',
		// 		'field_statements' => 
		// 			array(					
		// 				array(
		// 					'column_name' => 'name_something_else',
		// 					'data_type'   => 'VARCHAR',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'id',
		// 					'data_type'   => 'INT',
		// 					'auto_increment' => true
		// 				),
		// 				array(
		// 					'column_name' => 'name_1',
		// 					'data_type'   => 'TEXT',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'namef',
		// 					'data_type'   => 'TINYTEXT',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameff',
		// 					'data_type'   => 'LONGTEXT',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffsgd',
		// 					'data_type'   => 'YEAR',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffsg',
		// 					'data_type'   => 'DATE',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffsf',
		// 					'data_type'   => 'TIME',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffb',
		// 					'data_type'   => 'DECIMAL',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffbv',
		// 					'data_type'   => 'TINYINT',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffbvv',
		// 					'data_type'   => 'MEDIUMINT',
		// 					'auto_increment' => false
		// 				),
		// 				array(
		// 					'column_name' => 'nameffbvvv',
		// 					'data_type'   => 'INT',
		// 					'auto_increment' => false
		// 				)
		// 			)));
		
	}

	/**
	 * Method should be seperated into many different methods 
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

		// Create  table
		if ( !$table->does_table_exist( $paramaters['table_name'] ) ) : 

			$table->_create_table(
				array(
					'table_name' => $paramaters['table_name'],
					'fields'     => $paramaters['default_fields'] ));

		// Update table
		else : 

			foreach ( $profile_fields as $field ) : 

				$old_field_name         = (isset($field['old_name'])? str_replace(' ', '_', strtolower(trim($field['old_name']))) : false );
				$field_name 			= str_replace(' ', '_', strtolower(trim($field['name'])));		
				$profile_fields_names[] = $field_name;
						
				// Change data type of column
				if ( $table->does_column_exist( $paramaters['table_name'], $field_name ) ) { 
					
					$current_data_type = strtolower($table->convert_field_choice_into_statement($field['character_type']));

					if (  $current_data_type !== $table->get_column_information($paramaters['table_name'], $field_name, 'DATA_TYPE') ) :

						$table->change_data_type_of_column($paramaters['table_name'], $field_name, $current_data_type );

					endif;
				}
				// Rename column
				elseif ( $old_field_name !== false and $table->does_column_exist( $paramaters['table_name'], $old_field_name ) ) { 
					
					$table->rename_column_in_table(
						array(
							'table_name' 	   => $paramaters['table_name'],
							'old_name'   	   => $old_field_name,
							'field_name'   	   => $field_name,
							'field_input_type' => $field['character_type']
						));
				}
				// Add new column
				else {		
					echo $field['character_type'];
					$column_insertion = array('table_name' => $paramaters['table_name'], 'field_name' => $field_name, 'field_input_type' => $field['character_type'] );

					$table->add_column_to_table( $column_insertion );
				}				

			endforeach;

		endif;
	}

	/**
	 * Creates the page which was defined, perhaps wait and replace wiht branch_admin one or 
	 */
	public function create_page ()
	{
		multi($this->params['manifestation']);
	}

	/**
	 * Register the user and pass paramaters into a row, the paramaters would probably fill each row or avoid some 
	 * ( could use improvment potentualy ) 
	 * @param  array $user_information An array of user information, values and which columns to enter them in
	 */
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



	/**
	 * This one might be a better way of doing it 
	 */

	// public function create_and_init_database_table_and_columns ($paramaters)
	// {
	// 	$main_options					= $paramaters['options_to_save_unique_fields_to'];
	// 	$this->params['table_name']     = $paramaters['table_name'];
	// 	$this->params['unique_options'] = ( isset($main_options['unique_options']) ? $main_options['unique_options'] : $main_options['unique_options'] );

	// 	$this->params['creator']->check_if_table_exists_if_not_create_one(
	// 		array(
	// 			'table_name' => $paramaters['table_name'],
	// 			'fields'     => $paramaters['fields']
	// 		));
	// }
}

?>