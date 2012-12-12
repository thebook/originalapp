<?php 

/**
* A class which generates user managment option
*/
class generate_user extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
		
		<?php $main_options = get_option( $array ); ?>

		<?php $current_field_count = ( isset( $main_options[$name]["field_counter"] ) ? $main_options[$name]["field_counter"] : 1 ); ?>

<?php 

		$array_to_be_passed_in_ajax_get = 
			array( 
				'name'    => 'user_fields', 
				'options' => 
					array( 
						'array' => $array, 
						'name'  => $name, 
						'saved' => $saved, 
						'current_field_count' => $current_field_count )); 


?>

		<!-- Create all of the saved fields or default ones -->
		<?php $this->_generate_field_options($array, $name, $saved, $current_field_count ); ?>

		<!-- The counter, input keeps count of the number of fields saved, 
			 the paragrapth tag keeps the current added count -->
		<input type="hidden" name="<?php echo "$this->id-$name"; ?>[field_counter]" id="profile_managment_counter" value="<?php echo $current_field_count; ?>">
		<p style="display: none;" id="<?php echo "$this->id-$name"; ?>_field_counter-counter"><?php echo $current_field_count; ?></p>

		<!-- Add button -->
		<input type="button" onclick="javascript:remove.c('<?php echo AJAXLOADS ?>', '' );" class="<?php echo $this->class; ?>-profile_button" value="Add Field">
	
		<!-- Remove Button -->
		<input id="manage_profile_remove_id" type="button" onclick="javascript:remove.remove('profile_managment');" class="<?php echo $this->class; ?>-profile_button" value="Remove Field">

		<!-- Sets the current index for the add script -->
		<script>remove.index('#profile_managment_counter', '#manage_profile_remove_id');</script>

<?php }

	protected function _generate_field_options ($array, $name, $saved, $current_field_count)
	{ ?>

		<?php for ( $index=0; $index < $current_field_count; $index++ ) : ?>

			<div id="profile_managment" class="<?php echo $this->class;?>-profile_managment">

				<strong>Field : <?php echo $saved[$index]['name'] ?></strong>

				<!-- Field name -->
				<span>Field Name</span>
				<input type ="text" 
					   id   ="<?php echo "$this->id-$name"; ?>_field_name"
				       class="<?php echo $this->class;?>-text"
				       name ="<?php echo $array ."[$name][$index]"; ?>[name]"
				       value="<?php echo $saved[$index]["name"]; ?>">

				<!-- Field description -->
				<span>Field Description</span>
				<textarea name ="<?php echo $array ."[$name][$index]"; ?>[description]" 
						  id   ="<?php echo "$this->id-$name"; ?>_field_desc"
						  class="<?php echo $this->class;?>-text"><?php echo $saved[$index]["description"]; ?></textarea>
				
				<!-- Incorect input -->
				<span>Incorect Input Text</span>
				<textarea name ="<?php echo $array ."[$name][$index]"; ?>[not_unique]" 
						  id   ="<?php echo "$this->id-$name"; ?>_incorect_field"
						  class="<?php echo $this->class;?>-text"><?php echo $saved[$index]["not_unique"]; ?></textarea>

				<!-- Type of input to expect -->
				<span>Type of input expected</span>
				<select name ="<?php echo $array ."[$name][$index]"; ?>[character_type]" 
						id   ="<?php echo "$this->id-$name"; ?>_character_type"
					    class="<?php echo "$this->class";?>-select">

					    <?php 
					    option_spitter(
					    	array(
					    		array( 'name' => 'Post Code', 				'value' => 'post_code' ),
					    		array( 'name' => 'Small Text', 				'value' => 'smalltext' ),
					    		array( 'name' => 'Moderate Text', 			'value' => 'medium_text' ),
					    		array( 'name' => 'Alot of text', 			'value' => 'alot_of_text' ),
					    		array( 'name' => 'The Year', 				'value' => 'just_year' ),
					    		array( 'name' => 'Full Date', 				'value' => 'the_date' ),
					    		array( 'name' => 'Hours and Minutes', 		'value' => 'the_time' ),
					    		array( 'name' => 'A Url',	 				'value' => 'url' ),
					    		array( 'name' => 'The Email', 				'value' => 'email' ),
					    		array( 'name' => 'Money Input', 			'value' => 'money' ),
					    		array( 'name' => 'Decimal Number',          'value' => 'decimal' ),
					    		array( 'name' => 'Small Number(1-100)',     'value' => 'small_number' ),
					    		array( 'name' => 'Medium Number(1-100000)', 'value' => 'medium_number' ),
					    		array( 'name' => 'Huge Number(100000+)',    'value' => 'huge_number' )), 
					    	$saved[$index]['character_type']
					    ); ?>

				</select>
				
				<!-- Checkbox fields, is unique or is required -->
				<div class="<?php echo $this->class; ?>-checkbox-wrap">
					
					<!-- Is unique -->
					<input type ="checkbox" 
					       name ="<?php echo $array ."[$name][$index]"; ?>[unique]" 
					       id   ="<?php echo "$this->id-$name"; ?>_unique"
					       value="yes"
					       <?php checked( $saved[$index]["unique"], "yes", true ); ?>>

					<label for="<?php echo "$this->id-$name"; ?>_unique" class="<?php echo "$this->class";?>-checkbox-label">Is Unique?</label>
					
					<!-- Is required field -->
					<input type="checkbox" 
					       name="<?php echo $array ."[$name][$index]"; ?>[required]" 
					       class="<?php echo "$this->class";?>-checkbox" 
					       id="<?php echo "$this->id-$name"; ?>_required"
					       value="yes"
					       <?php checked( $saved[$index]["required"], "yes", true ); ?>>

					<label for="<?php echo "$this->id-$name"; ?>_required" class="<?php echo "$this->class";?>-checkbox-label">Is Required?</label>

				</div>

			</div>		

		<?php endfor; ?>
<?php }
}

?>