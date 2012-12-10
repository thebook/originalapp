<?php 

/**
* A class for creating dtabase tables
*
* 	to-do add a add column func, and a drop column func
* 	make interface first
*/
class database_table_creator
{

	function __construct()
	{
		
	}

	// public function _check_if_table_exists_if_not_create ($passed_creation_paramaters)
	// {
	// 	global $wpdb;

	// 	$is_the_table_not_in_the_database = ( $wpdb->query("SHOW TABLES LIKE '$wpdb->prefix{$passed_creation_paramaters['table_name']}'") !== 1 );
	// 	$is_table_set_to_be_updated       = ( $passed_creation_paramaters['do_we_update'] === 'yes'  );

	// 	if ( $is_the_table_not_in_the_database or $is_table_set_to_be_updated ) { 

	// 		echo "The table is not in the database and so we procced bzz a pub pop bebop";
	// 	}
	// 	else {
	// 		echo "the table is in the database escape now";
	// 	}
	// }

	public function check_if_table_exists_if_not_create_one ($passed_creation_paramaters)
	{
		global $wpdb;

		$is_the_table_not_in_the_database = ( $wpdb->query("SHOW TABLES LIKE '$wpdb->prefix{$passed_creation_paramaters['table_name']}'") !== 1 );
		$is_table_set_to_be_updated       = ( $passed_creation_paramaters['do_we_update'] === 'yes'  );

		if ( $is_the_table_not_in_the_database ) { 

			echo "The table is not in the database and so we procced bzz a pub pop bebop";

			echo $this->_create_table($passed_creation_paramaters);
		}	
		else { 
			echo "the table is in database";
		}
	}

	protected function _create_table ($table_creation_paramaters)
	{	
		require_once ABSPATH .'/wp-admin/includes/upgrade.php'; 
		
		global $wpdb; 

		$data_fields = $this->_convert_table_fields_into_database_field_statements($table_creation_paramaters['fields']);

		$string_to_insert_into_mysql_query = "
			CREATE TABLE $wpdb->prefix{$table_creation_paramaters['table_name']} ( 
			id MEDIUMINT NOT NULL AUTO_INCREMENT,
			". $this->_convert_table_fields_into_database_field_statements($table_creation_paramaters['fields']) ."
			PRIMARY KEY (id)
			)";

		dbDelta($string_to_insert_into_mysql_query);
	}

	public function add_column_to_table ($paramaters)
	{
		global $wpdb;

		$field_to_add = $this->_convert_table_field_choices_into_database_field_statement($paramaters['field_array']);

		echo "ALTER TABLE $wpdb->prefix{$paramaters['table_name']}
			ADD $field_to_add
			";

		// $wpdb->query("
		// 	ALTER TABLE {$paramaters['table_name']}
		// 	ADD {$paramaters['column_name']} $character_type
		// 	");
	}

	public function drop_column_from_table ($paramaters)
	{
		global $wpdb;

		echo "ALTER TABLE $wpdb->prefix{$paramaters['table_name']}
		DROP COLUMN {$paramaters['field_name']}";

		// $wpdb->query("
		// 	ALTER TABLE {$paramaters['table_name']}
		// 	DROP COLUMN {$paramaters['column_name']}
		// 	");
	}

	protected function _convert_table_fields_into_database_field_statements ($fields_array)
	{	
		$return_string = '';

		foreach ($fields_array as $table_field) {
			$return_string .= $this->_convert_table_field_choices_into_database_field_statement($table_field);
		}

		return $return_string;
	}

	protected function _convert_table_field_choices_into_database_field_statement ($the_field_array)
	{
		extract($the_field_array);

		$field_string = strtolower($field_name) ." ";

		switch ($field_input_type) {
			case 'smalltext':
				$field_string .= "TINYTEXT NOT NULL,";
			break;
			
			case 'medium_text' : 
				$field_string .= "TEXT NOT NULL,";
			break;

			case 'alot_of_text' : 
				$field_string .= "LONGTEXT NOT NULL,";
			break;

			case 'just_year' : 
				$field_string .= "YEAR DEFAULT '". date('Y') ."' NOT NULL,";
			break;

			case 'the_date' :
				$field_string .= "DATE DEAULT '". date('Y') ."' NOT NULL,";
			break;

			case 'just_time' : 
				$field_string .= "TIME DEFAULT '". date("H:i:s") ."' NOT NULL,";
			break;

			case 'url'   :
			case 'email' : 
				$field_string .= "VARCHAR(120) DEFAULT '' NOT NULL,";
			break;

		 	case 'money'   : 
		 	case 'decimal' :
		 		$field_string .= "DECIMAL NOT NULL,";
		 	break;

		 	case 'small_number' : 
		 		$field_string .= "TINYINT NOT NULL,";
		 	break;

		 	case 'regular_number' : 
		 		$field_string .= "MEDIUMINT NOT NULL,";
		 	break;

		 	case 'huge_number' : 
		 		$field_string .= "INT NOT NULL,";
		 	break;
		}

		return $field_string;
	}

}

?>