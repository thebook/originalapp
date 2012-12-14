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

	public function init_table_and_alterations_if_created ($paramaters)
	{
		$table 					 	= new table_creator;
		$main_options 				= get_option($paramaters['options_array']);
		$profile_fields             = $main_options['user_profile']['field'];
		$table_name 				= $paramaters['table_name'];
		$this->params['table_name'] = $paramaters['table_name'];

		// var_export( $saved_user_fields );
		// $this->params['unique_options'] = ( isset($main_options['unique_options']) ? $main_options['unique_options'] : $main_options['unique_options'] );

		if ( !$table->does_table_exist( $paramaters['table_name'] ) ) : 

			echo "table does not exist";
			// $table->_create_table(
			// 	array(
			// 		'table_name' => $paramaters['table_name'],
			// 		'fields'     => $paramaters['default_fields'] ));
		else : 

			foreach ( $profile_fields as $field ) : 

				$field_name = str_replace(' ', '_', strtolower(trim($field['name'])));

				// echo "Character type : {$field['character_type']},  Field name : $field_name; ";
				// echo $field_name;
				
				echo $field['character_type'];
							
				if ( $table->does_column_exist( $paramaters['table_name'], $field_name ) ) { 
					
					// echo $field['character_type'];
				}

				// else {

				// 	$column_insertion = array( 'field_name' => $field_name, 'field_input_type' => $field['character_type'] );

				// 	$table->add_column_to_table( $paramaters['table_name'], $column_insertion );
				// }

				# does field exists
				# 	if does check if it has changed
				# 	# if it has do nothing
				# if dosent add it

			endforeach;

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