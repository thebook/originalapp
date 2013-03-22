<?php 

/**
* A class for saving and editing user fields 
*/
class branch_users_save_fields extends branch_users_commits
{	
	public function save ()
	{
		$this->_not_allowed();

		$option_name        = $this->params['manifestation']['options'];
		$current_option     = array();
		$response['error']  = false;
		$response['header'] = 'Report';
		$response['message']= '';
		$field_number 		= 0;
		$creator            = new table_creator;
		$to_be_saved_option = $_POST[$option_name];
		$saved_options      = get_option($option_name);
		$reference_table    = $this->params['manifestation']['create_table']['name'] .'_fields_data';	
		$names_of_fields_which_have_been_saved = array();
		$fields_renamed	    = array();

		foreach ($to_be_saved_option as $key => $field) :
			
			$original_field_name      = $field['field_name'];
			$old_field_name           = (isset($saved_options[$key]['old_name'])? $saved_options[$key]['old_name'] : $field['old_name'] );
			$normal_old_name          = ucwords(str_replace('_', ' ',$old_field_name));
			$current_field_number     = ( $field_number + 1 );
			$field['field_name']      = strtolower(str_replace(' ', '_', trim($field['field_name'])));
			
			unset($field['old_name']);

			$is_name_field_empty      = empty($field['field_name']);			
			$has_field_been_though    = (in_array($field['field_name'], $names_of_fields_which_have_been_saved)? true : false );
			$has_field_been_saved     = $creator->check_if_value_is_in_column($reference_table, 'field_name', $field['field_name']);
			$has_old_field_been_saved = $creator->check_if_value_is_in_column($reference_table, 'field_name', $old_field_name);
			$is_the_field_added       = (!$has_field_been_saved and !$is_name_field_empty);
			$has_field_been_renamed   = (( $old_field_name !== $field['field_name'] ) and $has_old_field_been_saved );

			if ( !$has_field_been_though ) :

				if ( $has_field_been_renamed and !$is_name_field_empty ) : 

					if ( $has_field_been_saved ) : 

						$response['message'] .= "<p class=\"sperate_notifications\">Hmm the field number <strong>$current_field_number</strong> can not be <span style=\"text-decoration:underline;\">renamed</span> from <strong>$normal_old_name</strong> to <strong>$original_field_name</strong> because a field with that name <span style=\"text-decoration:underline;\">already exists</span></p>";

					else : 

						
						$creator->update_row($reference_table, $field, 'field_name', $old_field_name);

						$fields_renamed[] = $old_field_name;

						$field['old_name'] = $field['field_name'];

						$current_option[$field_number] = $field;						

						$response['message'] .= "<p class=\"seperate_notications\">Lets see <strong>$normal_old_name</strong> has been <span style=\"text-decoration:underline;\">renamed</span> into <strong>$original_field_name</strong> and <span style=\"text-decoration:underline;\">updated</span> as you wished.</p>";

					endif;

				elseif ($is_the_field_added) :

				
					$creator->add_row_to_table($reference_table, $field);
					
					$field['old_name'] = $field['field_name'];

					$current_option[$field_number] = $field;
					
					$response['message'] .= "<p class=\"seperate_notications\">Oke field <strong>$original_field_name</strong> has been <span style=\"text-decoration:underline;\">added</span> as you wished.</p>";
				

				elseif ($is_name_field_empty) : 
		
					$response['message'] .= "<p class=\"seperate_notications\">Umm field number <strong> $current_field_number </strong> does not have a name as such <span style=\"text-decoration:underline;\">it can't be saved</span>, i am so sorry.</p>";
				
				elseif ($has_field_been_saved) : 


					$creator->update_row($reference_table, $field, 'field_name', $field['field_name']);
						
					$response['message'] .= "<p class=\"seperate_notications\">Oke field <strong>$original_field_name</strong> has been <span style=\"text-decoration:underline;\">updated</span> as you wished.</p>";

					$field['old_name'] = $field['field_name'];

					$current_option[$field_number] = $field;

				else : 

					$response['message'] = '<p>Funky time ahoy</p>';

				endif;			

				$names_of_fields_which_have_been_saved[] = $field['field_name'];

			else : 

				$order_of_duplicate_field = array_keys($names_of_fields_which_have_been_saved, $field['field_name']);
				$order_of_duplicate_field = $order_of_duplicate_field[0] + 1;

				$response['message'] .= "<p class=\"seperate_notications\">Looks like field <strong>option ". ( $field_number + 1 ) ."'s</strong> name : <strong>\"$original_field_name\"</strong> is a <span style=\"text-decoration:underline;\">duplicate</span> of option number <strong>$order_of_duplicate_field</strong>, different capitalization of words still counts as a duplicate.</p>";

			endif;

			$field_number++;

		endforeach;

		$saved_field_names = filter_multi_array_value_into_single($current_option, 'field_name');
		$saved_field_names = array_merge($saved_field_names, $fields_renamed);
		$row_fields        = filter_multi_array_value_into_single($creator->get_all_rows_from_table($reference_table), 'field_name');
		$fields_to_remove  = (array_diff($row_fields, $saved_field_names));
		
		if (!empty($fields_to_remove)) :

			foreach ( $fields_to_remove as $field_to_remove ) :

				$creator->delete_row($reference_table, 'field_name', $field_to_remove);
				$orignal_field_to_remove = ucwords(str_replace('_', ' ', $field_to_remove));
				$response['message'] .= "<p class=\"seperate_notications\">Right'o <strong>$orignal_field_to_remove</strong> has been <span style=\"text-decoration:underline;\">removed</span> from the fields.</p>";

			endforeach;
		endif;

		update_option($option_name, $current_option);
		echo json_encode($response);

		exit;
	}
}

?>