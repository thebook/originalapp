<?php 

/**
* A class for dealing with user ajax calls and database commit s / perhasp should be called database commits 
*/
class branch_users_commits extends branch_users_initialize
{
	
	function __construct($creation_paramaters) 
	{
		parent::__construct($creation_paramaters);
		add_action("wp_ajax_save_user_field",                 array( $this, 'save_user_field' ));
		add_action("wp_ajax_remove_user",                     array( $this, 'user_remove' ));
		add_action("wp_ajax_nopriv_create_user",              array( $this, 'create_user' ));
		add_action("wp_ajax_nopriv_check_if_email_is_in_use", array( $this, 'check_if_email_is_in_use' ));
	}

	public function make_default_template_for_user_insertion ()
	{
		$creator       = new table_creator; 
		$fields        = $creator->get_all_rows_from_table($this->params['manifestation']['create_table']['name'] .'_fields_data');
		$preset_fields = array();

		foreach ($fields as $field) :

			$preset_fields[$field['field_name']] = '';

		endforeach;

		return $preset_fields;
	}

	public function check_if_email_is_in_use ()
	{
		$creator = new table_creator;

		echo $creator->check_if_value_is_in_column($this->params['manifestation']['create_table']['name'], 'e_mail', $_POST['email']);
	}

	public function create_user ()
	{
		$new_user = $_POST['user'];
		$template = $this->make_default_template_for_user_insertion();
		$new_user = array_merge($template, $new_user);
		$creator  = new table_creator;

		$creator->add_row_to_table($this->params['manifestation']['create_table']['name'], $new_user );
		$the_user = $creator->get_row($this->params['manifestation']['create_table']['name'], 'e_mail', $new_user['e_mail']);
		
		echo json_encode($the_user);

		exit;
	}

	public function save_user_field ()
	{
		$creator 			 = new table_creator;
		$update  			 = $_POST['update_information'];
		$id      			 = $_POST['update_information']['user_id'];
		$response['header']  = 'Done';
		$response['message'] = "User with the id of \"<strong>$id</strong>\" has been edited.";		
		
		unset($update['user_id']);		
		$creator->update_row($this->params['manifestation']['create_table']['name'], $update, 'id', $id );
		
		echo json_encode($response);

		exit;
	}

	public function user_remove ()
	{
		$creator 			 = new table_creator;
		$user    			 = $_POST['user'];
		$response['header']  = 'User Remove';
		$response['message'] = "User of the id <strong>\"$user\"</strong> has been deleted";

		$creator->delete_row($this->params['manifestation']['create_table']['name'], 'id', $user );
		
		echo json_encode($response);
		exit;
	}
}

?>