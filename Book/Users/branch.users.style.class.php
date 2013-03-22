<?php 

/**
* a class for displaying should be rmeodeled perhaps
*/
class branch_users_style extends branch_users_save_fields
{
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

		<?php $this->_filter_users(); ?>
		
		<div class="display_users_page_wrap"><?php $this->display_users(); ?></div>

		<script>alpha.track_events_on_this(".display_users_page_wrap", "click");</script>

<?php }

	protected function _filter_users ()
	{ ?> 
		
		<div class="search_users_wrap">
			
			<input type="text" data-function-to-call="filter_search" data-function-instructions="{'what_to_filter' : '.profile_display_user', 'filter_by' : 'data_type'}" class="search_users">

		</div>

		<script>alpha.track_events_on_this(".search_users", 'keypress');</script>

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

		<div class="profile_display_user" <?php $this->_display_filter($information_of_the_user); ?>>	

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

	protected function _display_filter ($information_of_the_user)
	{
		$filter = 'data-filter="';

		foreach ( $information_of_the_user as $field_name => $field_value ) :
			$field_name = str_replace('_', ' ', $field_name);
			$filter .= "$field_name :: $field_value ";

		endforeach;

		$filter .= '"';

		echo $filter;

	}

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