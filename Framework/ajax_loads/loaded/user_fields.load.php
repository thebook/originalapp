<?php
/**
 * This loader template takes the values of ['options']['saved'] from the loader paramters 
 * and exports them to be used to create an input field option
 */
	
	extract($loader_paramaters['options']);
	
	$index = $_GET['index'];

	$list_of_character_type_options = 
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
			array( 'name' => 'Huge Number(100000+)',    'value' => 'huge_number' )
		);

?>
		<div id="profile_managment" class="<?php echo $class;?>-profile_managment profile_managment_field<?php echo $index; ?>">

			<strong>Field </strong>

			<!-- Field name -->
			<span>Field Name</span>
			<input type ="text" 
				   id   ="<?php echo "$id-$name"; ?>_field_name"
			       class="<?php echo $class;?>-text"
			       name ="<?php echo $array ."[$name][$index]"; ?>[name]"
			       value="">

			<!-- Field description -->
			<span>Field Description</span>
			<textarea name ="<?php echo $array ."[$name][$index]"; ?>[description]" 
					  id   ="<?php echo "$id-$name"; ?>_field_desc"
					  class="<?php echo $class;?>-text"></textarea>
			
			<!-- Incorect input -->
			<span>Incorect Input Text</span>
			<textarea name ="<?php echo $array ."[$name][$index]"; ?>[not_unique]" 
					  id   ="<?php echo "$id-$name"; ?>_incorect_field"
					  class="<?php echo $class;?>-text"></textarea>

			<!-- Type of input to expect -->
			<span>Type of input expected</span>
			<select name ="<?php echo $array ."[$name][$index]"; ?>[character_type]" 
					id   ="<?php echo "$id-$name"; ?>_character_type"
				    class="<?php echo "$class";?>-select">

				<?php option_spitter( $list_of_character_type_options, 'small_text' ); ?>

			</select>
			
			<!-- Checkbox fields, is unique or is required -->
			<div class="<?php echo $class; ?>-checkbox-wrap">
				
				<!-- Is unique -->
				<input type ="checkbox" 
				       name ="<?php echo $array ."[$name][$index]"; ?>[unique]" 
				       id   ="<?php echo "$id-$name"; ?>_unique"
				       value="yes">

				<label for="<?php echo "$id-$name"; ?>_unique" class="<?php echo "$class";?>-checkbox-label">Is Unique?</label>
				
				<!-- Is required field -->
				<input type="checkbox" 
				       name="<?php echo $array ."[$name][$index]"; ?>[required]" 
				       class="<?php echo "$class";?>-checkbox" 
				       id="<?php echo "$id-$name"; ?>_required"
				       value="yes">

				<label for="<?php echo "$id-$name"; ?>_required" class="<?php echo "$class";?>-checkbox-label">Is Required?</label>

			</div>

		</div>		