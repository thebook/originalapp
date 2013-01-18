<?php 

/**
* A admin class
*/
class branch_users_style extends alpha_tree_users
{

	function __construct($creation_paramaters) 
	{
		parent::__construct($creation_paramaters);
		add_action("wp_ajax_save_user_field", array( $this, 'save_user_field' ));
	}

	public function save_user_field ()
	{
		$update  = $_POST['update_information'];
				   unset($update['user_id']);
		$id      = $_POST['update_information']['user_id'];
		$creator = new table_creator;
		$creator->update_row($this->params['manifestation']['create_table']['name'], $update, 'id', $id );

		$response['header']  = 'Done';
		$response['message'] = "User with the id of \"<strong>$id</strong>\" has been edited.";

		echo json_encode($response);
		exit;
	}

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

	public function display_users_page ()
	{ ?>
		
		<div class="display_users_page_wrap"><?php $this->display_users(); ?></div>

		<script>
			alpha.track_events_on_this(".display_users_page_wrap", "click");
		</script>
<?php }

	public function display_users ()
	{
		$creator   = new table_creator;
		$all_users = $creator->get_all_rows_from_table($this->params['users_table']);
		
		foreach ($all_users as $key => $user) {			
			$this->_display_user($user);
		}
	}

	protected function _display_user ($information_of_the_user)
	{ ?> 

		<div class="profile_display_user">	

			<?php $this->_display_summary($information_of_the_user); ?>		

			<?php unset($information_of_the_user['id']); ?>
			
			<div class="full_user_display">
				
				<?php foreach ( $information_of_the_user as $field_name => $field_value ) : ?>

					<div class="personal_field">

						<h6 class="personal_field_name"><?php echo ucwords(str_replace('_', ' ', $field_name )); ?> : </h6>

						<p class="personal_field_text"><?php echo $field_value; ?></p>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

<?php }

	protected function _display_summary ($information_of_the_user)
	{ ?>

		<div class="small_user_display">
				
			<div class="small_user_field">
				
				<div class="small_user_field_name">User Id : </div>

				<div class="small_user_field_value user_id"><?php echo $information_of_the_user['id']; ?></div>

			</div>

			<div class="small_user_controls">
				<span data-function-to-call="toggle_hide"  data-function-instructions="{ 'parent_of_the_element' : '.profile_display_user', 'element_to_hide' : '.full_user_display' }" class="small_user_toggle">-</span>
				<span data-function-to-call="edit_user" data-function-instructions="{ 'user_id' : <?php echo $information_of_the_user['id']; ?> }" class="small_user_edit">Edit</span>
			</div>

		</div>
<?php }
}

?>