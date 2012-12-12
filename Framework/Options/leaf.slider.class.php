<?php 

/**
 * A leaf class which puts out a number of slide metaboxes matching that of the meta_count_slider option,
 * to do this it appends the current index number of the slide at the end of the options names, so that all the inputs 
 * are saved correctly and extends the meta class allowing normal meta boxes to be added aswell
 */
class leaf_slide extends meta
{	

	function __construct($options) 
	{
		if ( isset( $options['ajax'] ) ) :

			$this->params['id']		= $options['id'];
			$this->params['class']  = $options['class'];
			$this->params['def']    = $options['default_type'];
			$this->params['manifestation'] = ( include $options['definition'] );
			$modified_slide['args'] = $this->modify_options_within_current_slide( $this->params['manifestation']['opt'][2]['o'][0], $options['ajax'] );
			$this->wrap( false, $modified_slide );

		else : 
			parent::__construct($options);

		endif;
	}

	/**
	 * The slide version of the ussual pop() function, gets the number of slides from the an input which holds the number
	 * and generates a metabox for each
	 * @param  array $options_to_change The options "array" which is modified to have a number equaling the index appended at names and ids 
	 * @return array    Returns the modified array which is then run though the standard pop()
	 */
	public function for_each_slide_there_is_pop_one ($options_to_create)
	{

		global $post;
		
		$post_meta = get_post_meta( $post->ID, $this->params['manifestation']['options'], true );

		$number_of_slides = ( isset( $post_meta['meta_count_slider'] ) ? $post_meta['meta_count_slider'] : 1 );

		for ($current_slide=1; $current_slide < $number_of_slides + 1; $current_slide++) { 
			
			$litarated_slides = $this->modify_options_within_current_slide( $options_to_create, $current_slide );

			$this->pop( $litarated_slides );
		}
	}

	/**
	 * Literates through an array of option definitions and appends a index number at the end of each name or id reference
	 * @param  array $options_to_change The option "array"
	 * @param  int   $i The number to append ( "index" )
	 * @return array    Modified array
	 */
	public function modify_options_within_current_slide ( $options_to_change, $slide_index )
	{
		
		// new opt array
		$changed_options = $options_to_change;
		// metabox id
		$changed_options['id']    = $changed_options['id'] . $slide_index;
		// metabox title
		$changed_options['title'] = $changed_options['title'] . " $slide_index";

		// Literate though each option paramaters and append an index number where necessary
		foreach ($changed_options['options']['opt'] as $index => $option) 
		{	
			// Update the option name paramater to have an appended index 
			$changed_options['options']['opt'][$index]['o'][0]['name'] = $option['o'][0]['name'] . "_$slide_index";

			// If a hider paramater is set we update it 
			if ( isset( $option['o'][0]['hider'] ) )
			{
				$changed_options['options']['opt'][$index]['o'][0]['hider'][0] = $option['o'][0]['hider'][0] . "_$slide_index"; 
			}
		}		
		// Return the modified options
		return $changed_options;
	}


	/**
	 * Creates two buttons a counter input and shows last saved value, and calls the remove.js init function
	 * @param  string $ajax_box_url  The "url" from which to get the generated meta boxes via ajax
	 * @param  string $remove_id  The "remove" button id
	 * @param  string $slide_counter_name The "counter" input id and name
	 * @return html     
	 */
	public function buttons ( $ajax_box_url, $remove_id, $slide_counter_name ) 
	{ ?>

		<?php global $post; ?>

		<?php $post_meta = get_post_meta( $post->ID, $this->params['manifestation']['options'], true ); ?>
	
		<?php $current_slide_count = ( isset( $post_meta[$slide_counter_name] ) ? $post_meta[$slide_counter_name] : 1 ); ?>

		<tr>
			<td>
				<input onclick="javascript:remove.c('<?php echo get_template_directory_uri() .$ajax_box_url; ?>')" type="button" value="Add Slide" class="lf-admin-post-meta-td-button button">
		
				<input onclick="javascript:remove.remove('slide');" type="button" value="Remove" id="<?php echo $remove_id; ?>" class="lf-admin-post-meta-td-button button">
			</td>
		</tr>

		<input type="hidden" name="main_meta[<?php echo $slide_counter_name; ?>]" id="<?php echo $slide_counter_name; ?>" value="<?php echo $current_slide_count; ?>">

		<p style="display: none;" id="<?php echo $slide_counter_name; ?>-counter"><?php echo $current_slide_count; ?></p>

		<script>remove.index('#<?php echo $slide_counter_name; ?>', '#<?php echo $remove_id; ?>');</script>

	<?php }

}
?>