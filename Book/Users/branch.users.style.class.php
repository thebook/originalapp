<?php 

/**
* A admin class
*/
class branch_users_style extends alpha_tree_users
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

					<input data-function-to-call="add_new_field_input" data-ajax-template="<?php echo AJAXLOADS; ?>" type="button" value="Add Field">
					<input type="button" value="Remove Field">

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

					lf_users.init(".<?php echo $this->params['id']; ?>-body");
					lf_users.create_global_variable('ajax_path', 'ze path');
					lf_users.create_global_variable('path', 'path');
					console.log(lf_users.global);

				</script>
			</form>
		</div>

<?php }
	
	# get all the rows and then find their coresponding array and spit		
	public function profile_managment ($table_name)
	{  	
		$creator = new table_creator;
		$fields_to_display = $creator->get_all_rows_from_table($table_name .'_fields_data');		
		
		foreach ( $fields_to_display as $key => $field ) : 

			$this->_field_option_box($key, $field);

		endforeach; 

 	}

 	protected function _field_option_box ($key, $field)
 	{ ?>

 		<?php 
 			$user_options = $this->params['manifestation']['options'];
 			$data_types_for_conversion_into_options = 
				array(
					array( 
						'name' => 'Post Code', 										
						'value' => 'post_code' ),
					array( 
						'name' => 'Small Text', 				
						'value' => 'smalltext' ),
					array( 
						'name' => 'Moderate Text', 			
						'value' => 'medium_text' ),
					array( 
						'name' => 'Alot of text', 			
						'value' => 'alot_of_text' ),
					array( 
						'name' => 'The Year', 				
						'value' => 'just_year' ),
					array( 
						'name' => 'Full Date', 				
						'value' => 'the_date' ),
					array( 
						'name' => 'Hours and Minutes', 		
						'value' => 'the_time' ),
					array( 
						'name' => 'A Url',	 				
						'value' => 'url' ),
					array( 
						'name' => 'The Email', 				
						'value' => 'email' ),
					array( 
						'name' => 'Money Input', 			
						'value' => 'money' ),
					array( 
						'name' => 'Decimal Number',          
						'value' => 'decimal' ),
					array( 
						'name' => 'Small Number(1-100)',     
						'value' => 'small_number' ),
					array( 
						'name' => 'Medium Number(1-100000)', 
						'value' => 'medium_number' ),
					array( 
						'name' => 'Huge Number(100000+)',    
						'value' => 'huge_number' ));
		?> 

		<div class="users_profile_box">

			<!-- Field name -->
			<div class="user_profile_box_field">

				<div class="user_profile_desc">
					<strong>Field Name</strong>
					<span>Desc</span>
				</div>
				
				<div class="user_profile_input">
					<input type="text" name="<?php echo $user_options ."[$key]"; ?>[field_name]" value="<?php echo $field['field_name']; ?>">
				</div>
			</div>

			<!-- Description -->
			<div class="user_profile_box_field">
					
				<div class="user_profile_desc">
					<strong>Description</strong>
					<span>Desc</span>
				</div>

				<div class="user_profile_input">
					<textarea name="<?php echo $user_options ."[$key]"; ?>[description]"><?php echo $field['description']; ?></textarea>
				</div>
			</div>

			<!-- Help them along -->
			<div class="user_profile_box_field">
					
				<div class="user_profile_desc">
					<strong>Incorrect Input</strong>
					<span>Desc</span>
				</div>

				<div class="user_profile_input">
					<textarea name="<?php echo $user_options ."[$key]"; ?>[help_them_along]"><?php echo $field['help_them_along']; ?></textarea>
				</div>
			</div>

			<!-- Input Type -->
			<div class="user_profile_box_field">
					
				<div class="user_profile_desc">
					<strong>Input Type</strong>
					<span>Desc</span>
				</div>

				<div class="user_profile_input">
					<select name="<?php echo $user_options ."[$key]"; ?>[field_input_type]" id="">				
						<?php option_spitter( $data_types_for_conversion_into_options, $field['field_input_type'] ); ?>
					</select>
				</div>
			</div>

			<!-- Unique Field -->
			<div class="user_profile_box_field">

				<div class="user_profile_desc">
					<strong>Make Unique</strong>
					<span>Desc</span>
				</div>

				<div class="user_profile_input">						
					<select name="<?php echo $user_options ."[$key]"; ?>[is_unique]">

						<option value="1" <?php selected( $field['is_unique'], '1'); ?>>Unique</option>

						<option value="0" <?php selected( $field['is_unique'], '0'); ?>>Not Unique</option>

					</select>
				</div>
			</div>

			<!-- Required Field -->
			<div class="user_profile_box_field">

				<div class="user_profile_desc">
					<strong>Make Required</strong>
					<span>Desc</span>
				</div>
			
				<div class="user_profile_input">

					<select name="<?php echo $user_options ."[$key]"; ?>[required]">

						<option value="1" <?php selected( $field['required'], '1'); ?>>Required</option>

						<option value="0" <?php selected( $field['required'], '0'); ?>>Not Required</option>

					</select>
				</div>
			</div>

			<input data-function-to-call="" type="button" value="Remove Field" class="profile_button">
			
		</div>
<?php }


}

?>