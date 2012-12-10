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

			$this->_create_table($passed_creation_paramaters);
		}	
	}

	protected function _create_table ($table_creation_paramaters)
	{	
		require_once ABSPATH .'/wp-admin/includes/upgrade.php'; 
		
		global $wpdb; 

		$string_to_insert_into_mysql_query = "
			CREATE TABLE $wpdb->prefix{$table_creation_paramaters['table_name']} ( 
			id MEDIUMINT NOT NULL AUTO_INCREMENT,
			". $this->_convert_table_fields_into_database_field_statements($table_creation_paramaters['fields']) ."
			PRIMARY KEY (id)
			)";
			
		// echo $string_to_insert_into_mysql_query;

		dbDelta($string_to_insert_into_mysql_query);
	}

	public function does_column_exist ($table_name, $column_name)
	{
		global $wpdb;

		$try_to_show_fieldname_column = $wpdb->query("SHOW COLUMNS FROM `$wpdb->prefix$table_name` LIKE '$column_name' ");

		return ( $try_to_show_fieldname_column === 1 ? true : false );
	}

	public function add_column_to_table ($paramaters)
	{
		if ( !$this->does_column_exist($paramaters['table_name'], $paramaters['field_name']) ) { 
			
			global $wpdb;
			
			$field_to_be_inserted = $this->_convert_table_field_choices_into_database_field_statement(
				array(
					'field_name'       => $paramaters['field_name'], 
					'field_input_type' => $paramaters['field_input_type'] 
					));

			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} ADD $field_to_be_inserted"); 
		}
	}

	public function remove_column_from_table ($paramaters)
	{
		if ( $this->does_column_exist($paramaters['table_name'], $paramaters['field_name']) ) { 

			global $wpdb;
			
			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} DROP COLUMN {$paramaters['field_name']}");
		}
	}

	public function rename_column_in_table ($paramaters)
	{
		if (  $this->does_column_exist($paramaters['table_name'], $paramaters['old_name']) &&
			 !$this->does_column_exist($paramaters['table_name'], $paramaters['field_name']) ) {  
			
			global $wpdb;

			$the_replace_column_field = $this->_convert_table_field_choices_into_database_field_statement(
				array(
					'field_name'       => $paramaters['field_name'], 
					'field_input_type' => $paramaters['field_input_type'] 
					));

			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} change {$paramaters['old_name']} $the_replace_column_field");
		}
	}

	protected function _convert_table_fields_into_database_field_statements ($fields_array)
	{	
		$return_string = '';

		foreach ($fields_array as $table_field) {
			$return_string .= $this->_convert_table_field_choices_into_database_field_statement($table_field).",";
		}

		return $return_string;
	}

	protected function _convert_table_field_choices_into_database_field_statement ($the_field_array)
	{
		extract($the_field_array);

		$field_string = strtolower($field_name) ." ";

		switch ($field_input_type) {
			case 'smalltext':
				$field_string .= "TINYTEXT NOT NULL";
			break;
			
			case 'medium_text' : 
				$field_string .= "TEXT NOT NULL";
			break;

			case 'alot_of_text' : 
				$field_string .= "LONGTEXT NOT NULL,";
			break;

			case 'just_year' : 
				$field_string .= "YEAR DEFAULT '". date('Y') ."' NOT NULL";
			break;

			case 'the_date' :
				$field_string .= "DATE DEAULT '". date('Y') ."' NOT NULL";
			break;

			case 'just_time' : 
				$field_string .= "TIME DEFAULT '". date("H:i:s") ."' NOT NULL";
			break;

			case 'url'   :
			case 'email' : 
				$field_string .= "VARCHAR(120) DEFAULT '' NOT NULL";
			break;

		 	case 'money'   : 
		 	case 'decimal' :
		 		$field_string .= "DECIMAL NOT NULL";
		 	break;

		 	case 'small_number' : 
		 		$field_string .= "TINYINT NOT NULL";
		 	break;

		 	case 'regular_number' : 
		 		$field_string .= "MEDIUMINT NOT NULL";
		 	break;

		 	case 'huge_number' : 
		 		$field_string .= "INT NOT NULL";
		 	break;
		}

		return $field_string;
	}

}

?>