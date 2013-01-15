<?php 
	
	$template_options = (isset($_GET['template_options'])? $_GET['template_options'] : $template_options['template_options'] ); 
	$key              = ( isset($key)? $key : timestamp() ); 
	$user_options     = $template_options['user_options']; 
	$field            = ( isset($template_options['field'])? $template_options['field'] : array('field_name' => '', 'description' => '', 'help_them_along' => '', 'field_input_type' => '', 'is_unique' => '', 'required' => '' ) );
	
	$data_types_for_conversion_into_options = 
		array(
			array( 'name' => 'Post Code', 'value' => 'post_code' ),
			array( 'name' => 'Small Text','value' => 'smalltext' ),
			array( 'name' => 'Moderate Text', 'value' => 'medium_text' ),
			array( 'name' => 'Alot of text', 'value' => 'alot_of_text' ),
			array( 'name' => 'The Year', 'value' => 'just_year' ),
			array( 'name' => 'Full Date', 'value' => 'the_date' ),
			array( 'name' => 'Hours and Minutes', 'value' => 'the_time' ),
			array( 'name' => 'A Url', 'value' => 'url' ),
			array( 'name' => 'The Email', 'value' => 'email' ),
			array( 'name' => 'Money Input', 'value' => 'money' ),
			array( 'name' => 'Decimal Number', 'value' => 'decimal' ),
			array( 'name' => 'Small Number(1-100)', 'value' => 'small_number' ),
			array( 'name' => 'Medium Number(1-100000)', 'value' => 'medium_number' ),
			array( 'name' => 'Huge Number(100000+)', 'value' => 'huge_number' ));	

?>

<div class="users_profile_box">

	<!-- Remove field button -->
	<input data-function-to-call="remove_field" class="user_profile_box_remove" type="button" value="Remove">

	<!-- Minimise field button -->
	<input data-function-to-call="toggle_user_field" data-function-instructions="{ 'user_field_inner_box' : '.user_profile_box_field_inner', 'what_to_say' : 'Click to move around' }" class="user_profile_box_minimize open" type="button" value="-">

	<div class="user_profile_box_field_inner">

		<div class="user_profile_box_field_split">
			<!-- Field name -->
			<div class="user_profile_box_field">

				<div class="user_profile_desc">
					<strong>Field Name</strong>
					<span>Desc</span>
				</div>
				
				<div class="user_profile_input">
					<input type="text" name="<?php echo $user_options ."[$key]"; ?>[field_name]" value="<?php echo ucwords(str_replace('_', ' ', $field['field_name'])); ?>">
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
		</div>

		<div class="user_profile_box_field_split">
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
		</div>

		<div class="user_profile_box_field_split">
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

		</div>
	</div>
</div>