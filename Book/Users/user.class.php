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
				
				 $creator->create_table(
				 	array(
				 		'table_name' => $name,
				 		'primary_key' => 'id',
				 		'fields' => array(
				 			array(
				 				'column_name' => 'id',
				 				'data_type' => 'INT',
				 				'auto_increment' => true,
				 				'unique' => false				 									 				
				 				))
				 		));		
	
				$creator->create_table(
					array(
						'table_name'  => $table_of_fields_name, 
						'primary_key' => false,
						'fields'      => $define_data_type_array 
					));

				foreach ( $default_setup as $field ) : $creator->add_row_to_table($table_of_fields_name, $field); endforeach;

			endif;

		$this->change_table_columns_based_on_saved_options($name, $table_of_fields_name);
	}

	public function change_table_columns_based_on_saved_options ($name, $table_of_fields_name)
	{
		$creator = new table_creator;	

		$field_rows = $creator->get_all_rows_from_table($table_of_fields_name);

		foreach ($field_rows as $row ) { 

			$column_to_be_created = array( 
				'table_name'     => $name,
				'column_name'    => $row['field_name'],
				'unique'         => ( $row['is_unique'] === 1? true : false ),
				'auto_increment' => false,
				'data_type'      => $this->_convert_field_input_types_into_data_type($row['field_input_type'])
			);

			$creator->add_column_to_table($column_to_be_created);
		}
	}

	protected function _convert_field_input_types_into_data_type ($field_input_type)
	{
		switch ($field_input_type) { 

			case 'post_code':
			case 'smalltext':
				$data_type = 'TINYTEXT';
			break;
			
			case 'medium_text' : 
				$data_type = 'TEXT NOT NULL';
			break;

			case 'alot_of_text' : 
				$data_type = 'LONGTEXT';
			break;

			case 'just_year' : 
				$data_type = 'YEAR';
			break;

			case 'the_date' :
				$data_type = 'DATE';
			break;

			case 'just_time' : 
				$data_type = 'TIME';
			break;

			case 'url'   :
			case 'email' : 
				$data_type = 'VARCHAR(100)';
			break;

		 	case 'money'   : 
		 	case 'decimal' :
		 		$data_type = 'DECIMAL';
		 	break;

		 	case 'small_number'  :
		 	case 'medium_number' : 
		 		$data_type = 'TINYINT';
		 	break;

		 	case 'regular_number' : 
		 		$data_type = 'MEDIUMINT';
		 	break;

		 	case 'huge_number' : 
		 		$data_type = 'INT';
		 	break;
		}

		return $data_type;
	}




	/**
	 * May be obsolete 
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