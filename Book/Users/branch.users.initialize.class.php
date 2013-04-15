<?php 

/**
* A class which initializes the user tables and remodels any fields if necessary
*/
class branch_users_initialize extends alpha_tree_users
{
	protected function _create_table ()
	{
		extract($this->params['manifestation']['create_table']);

			$creator 			        = new table_creator;
			$table_of_fields_name       = "{$name}_fields_data";
			$does_table_exist           = $creator->does_table_exist($name);
			$does_table_of_fields_exist = $creator->does_table_exist($table_of_fields_name);

			if ( !$does_table_exist and !$does_table_of_fields_exist ) : 
				
				$creator->create_table(
				 array(
				 	'table_name'  => $name,
				 	'primary_key' => 'id',
				 	'fields'      => array(
				 	array(
				 		'column_name'    => 'id',
				 		'data_type'      => 'INT',
				 		'auto_increment' => true,
				 		'unique'         => false				 									 				
				 	))
				 ));
	
				$creator->create_table(
				array(
					'table_name'  => $table_of_fields_name, 
					'primary_key' => false,
					'fields'      => $define_data_type_array 
				));

				foreach ( $default_setup as $field ) : 

					$creator->add_row_to_table($table_of_fields_name, $field); 

				endforeach;
			endif;

			$this->change_table_columns_based_on_saved_options($name, $table_of_fields_name);
	}

	public function change_table_columns_based_on_saved_options ($name, $table_of_fields_name)
	{
		$creator    = new table_creator;	
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
		
		$this->_remove_columns($name, $field_rows);
	}

	protected function _remove_columns ($table_name, $field_rows)
	{
		$creator           = new table_creator;
		$column_names      = $creator->get_all_column_information($table_name, 'COLUMN_NAME');
		$field_names       = filter_multi_array_value_into_single($field_rows, 'field_name');
		$columns_to_remove = array_diff($column_names, $field_names);

		unset($columns_to_remove[0]);
		
		if (!empty($columns_to_remove)) : 

			foreach ($columns_to_remove as $key => $column_name ) :

				$creator->remove_column_from_table(
					array(
						'table_name' => $table_name, 
						'field_name' => $column_name
				));
			
			endforeach;
		endif;
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
}

?>