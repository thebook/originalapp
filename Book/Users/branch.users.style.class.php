<?php 

/**
* A admin class
*/
class branch_users_style extends alpha_tree_users
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
		$reference_table    = $this->params['manifestation']['create_table']['name'] .'_fields_data';	
		$names_of_fields_which_have_been_saved = array();
	
		# check for duplicates

		foreach ($to_be_saved_option as $key => $field) :
			
			$original_field_name  = $field['field_name'];

			$field['field_name']  = strtolower(str_replace(' ', '_', trim($field['field_name'])));

			$has_field_been_saved = (in_array($field['field_name'], $names_of_fields_which_have_been_saved)? true : false );

			if ( !$has_field_been_saved ) : 

				if (!$creator->check_if_value_is_in_column($reference_table, 'field_name', $field['field_name']) and !empty($field['field_name'])) :

					$creator->add_row_to_table($reference_table, $field);
					
					$current_option[$field_number] = $field;
					
					$response['message'] .=  "<p class=\"seperate_notications\">Oke field <strong>$original_field_name</strong> has been <span style=\"text-decoration:underline;\">saved</span> as you wished.</p>";

				else : 
					if ( !empty($field['field_name']) ) { 

						$creator->update_row($reference_table, $field, 'field_name', $field['field_name']);
						
						$response['message'] .=  "<p class=\"seperate_notications\">Oke field <strong>$original_field_name</strong> has been <span style=\"text-decoration:underline;\">updated</span> as you wished.</p>";

						$current_option[$field_number] = $field;
					}
					else { 
						$response['message'] .=  '<p class=\"seperate_notications\">Umm field number <strong>'. ( $field_number + 1 ) .'</strong> does not have a name as such <span style="text-decoration:underline;">it can\'t be saved</span>, i am so sorry.</p>';
					}

				endif;			

				$names_of_fields_which_have_been_saved[] = $field['field_name'];

			else : 

				$order_of_duplicate_field = array_keys($names_of_fields_which_have_been_saved, $field['field_name']);
				$order_of_duplicate_field = $order_of_duplicate_field[0] + 1;

				$response['message'] .= "<p class=\"seperate_notications\">Looks like field <strong>option ". ( $field_number + 1 ) ."'s</strong> name : <strong>\"$original_field_name\"</strong> is a <span style=\"text-decoration:underline;\">duplicate</span> of option number <strong>$order_of_duplicate_field</strong>, different capitalization of words still counts as a duplicate.</p>";

			endif;

			$field_number++;

		endforeach;

		update_option($option_name, $current_option );

		echo json_encode($response);

		exit;
	}

	public function profile_page ()
	{ ?>

		<?php $config = $this->params['manifestation']; ?>

		<div>
			<form id="<?php echo $this->params['id'];?>" 
				  action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" 
				  method="post" class="<?php echo $this->params['id']; ?>-form">
				
				<!-- Top Stripe -->
				<div class="<?php echo $this->params['id']; ?>-header">
					<!-- Name . Version -->
					<div class="<?php echo $this->params['id']; ?>-header-wrap">	
						<!-- Title -->
						<h1><?php echo $config['title']; ?></h1>
						<!-- Version  -->
						<span class="<?php echo $this->params['id']; ?>-label"><?php echo $config['sub_title']; ?></span>
					</div>
					<!-- Logo -->
					<a href="http://www.recyclabook.co.uk" title="">
						<!-- Image -->
						<img  class="<?php echo $this->params['id']; ?>-image" src="<?php echo FRAMEWORKURI .'/CSS/Includes/Images/login-logo.png';?>"/>
					</a>
				</div>
				
				<!-- Save Stripe -->
				<div class="<?php echo $this->params['id']; ?>-save">

					<!-- the "wp-admin/admin-ajax.php" looks for the value of an "action" named input,
						that value then is used to append to create a action hook named "wp_ajax_{append your action value here}"
						we then hook into it by adding our ajax handler function to hook -->
					<input type="hidden" name="action" value="<?php echo $config['form_action']; ?>">

					<input type="hidden" name="<?php echo $this->params['id']; ?>_nonce" value="<?php echo wp_create_nonce($this->params['class']);?>">

					<input id="<?php echo $this->params['id']; ?>_save" type="submit" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Save', 'liquidflux'); ?>"/>
					
					<input id="<?php echo $this->params['id']; ?>_reset" type="button" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Reset', 'liquidflux'); ?>"/>
					
				</div>

				<!-- Body -->
				<div class="<?php echo $this->params['id']; ?>-body">

					<?php $this->profile_managment($config['create_table']['name']); ?>

					<input data-function-instructions="{ 'ajax_path' : '<?php echo AJAXLOADS; ?>', 'user_options' : '<?php echo $config['options']?>' }" data-function-to-call="add_new_field_input" class="profile_button" type="button" value="Add Field">

				</div>

				<script>
					// Initiates ajax saving
					ajax.save({
						form : "<?php echo $this->params['id']; ?>",
						save : "<?php echo $this->params['id']; ?>_save",
						});
					// Initiates ajax resets
					ajax.reset({
						reset  : "<?php echo $this->params['id']; ?>_reset",
						action : "<?php echo $config['form_action'];?>_reset",
						nonce  : "<?php echo wp_create_nonce($this->params['class']);?>",
						nonce_name: "<?php echo $this->params['id'];?>_nonce"
					});
					
					alpha.track_events_on_this(".<?php echo $this->params['id']; ?>-body", "click");
					alpha.create_instruction_variable("mover", "elements_to_move_to", ".users_profile_box");
					

				</script>
			</form>
		</div>

<?php }
	
	
	public function profile_managment ($table_name)
	{  	
		$creator = new table_creator;
		$options = get_option($this->params['manifestation']['options']);
		$fields_to_display = (empty($options)? $creator->get_all_rows_from_table($table_name .'_fields_data') : $options );
		
		foreach ( $fields_to_display as $key => $field ) : 

			$this->_field_option_box($key, $field);

		endforeach; 

 	}

 	protected function _field_option_box ($key, $field)
 	{	
		$template_options = 
			array(
				'template_options' => 
					array(
						'name' => 'user',
						'user_options' => $this->params['manifestation']['options'],
						'field' => $field
			));	

			require ( FRAMEWORK ."/ajax_loads/load/user.load.php");
	}
}

?>