<?php 

/**
* A class updating the slider metaboxes, with more each to match a the slide number, as well with functions 
* which allow the ajaxification of dynamicly created metaxboxes for the slider, though jAPI ( sweet plugin )
*/
class slide_opt
{	
	/**
	 * The post "meta" option array
	 * @var [type]
	 */
	var $m;

	/**
	 * Gets the saved meta array
	 * @param array $meta The array in which post meta options are saved
	 */
	function __construct( $meta ) 
	{	
		global $post;

		$this->m = get_post_meta( $post->ID, $meta, true );
	}

	/**
	 * The slide version of the ussual pop() function, gets the number of slides from the an input which holds the number
	 * and generates a metabox for each
	 * @param  array $a The options "array" which is modified to have a number equaling the index appended at names and ids 
	 * @return array    Returns the modified array which is then run though the standard pop()
	 */
	public function pop( $a )
	{
		
		$s = ( isset( $this->m['meta_count_slider'] ) ? $this->m['meta_count_slider'] : 1 );

		for ($si=1; $si < $s + 1; $si++) { 
			
			$o = $this->literate( $a, $si );

			pop( $o );

		}
	}

	/**
	 * Literates through an array of option definitions and appends a index number at the end of each name or id reference
	 * @param  array $a The option "array"
	 * @param  int   $i The number to append ( "index" )
	 * @return array    Modified array
	 */
	public function literate( $a, $i )
	{
		
		// new opt array
		$o = $a;
		// metabox id
		$o['id']    = $o['id'] . $i;
		// metabox title
		$o['title'] = $o['title'] . " $i";
		// Alter inner options to have different "slide" number appended
		// Type
		$o['options']['opt'][1]['o'][4] = $o['options']['opt'][1]['o'][4] . "_$i";
		// Video
		$o['options']['opt'][2]['o'][4] = $o['options']['opt'][2]['o'][4] . "_$i";
		$o['options']['opt'][2]['o'][8] = array( "#lf-post-meta-slide_type_$i", "#slide_embed_$i-hook", '["video"]' );
		// Caption
		$o['options']['opt'][3]['o'][4] = $o['options']['opt'][3]['o'][4] . "_$i";
		$o['options']['opt'][3]['o'][8] = array( "#lf-post-meta-slide_type_$i", "#slide_caption_$i-hook", '["image"]' );
		// Image Upload
		$o['options']['opt'][4]['o'][4] = $o['options']['opt'][4]['o'][4] . "_$i";
		$o['options']['opt'][4]['o'][8] = array( "#lf-post-meta-slide_type_$i", "#slide_upload_$i-hook", '["image"]' );
		
		return $o;
	}


	/**
	 * Creates two buttons a counter input and shows last saved value, and calls the remove.js init function
	 * @param  string $u  The "url" from which to get the generated meta boxes via ajax
	 * @param  string $r  The "remove" button id
	 * @param  string $co The "counter" input id and name
	 * @return html     
	 */
	public function buttons( $u, $r, $co ) 
	{ ?>

		<?php $cc = ( isset( $this->m[$co] ) ? $this->m[$co] : 1 ); ?>

		<tr>
		
			<td>
		
				<input onclick="javascript:remove.c('<?php echo get_template_directory_uri() .$u; ?>')" type="button" value="Add Slide" class="lf-admin-post-meta-td-button">
		
				<input onclick="javascript:remove.remove('.postbox');" type="button" value="Remove" id="<?php echo $r; ?>" class="lf-admin-post-meta-td-button">
		
			</td>
		
		</tr>

		<input type="hidden" name="main_meta[<?php echo $co; ?>]" id="<?php echo $co; ?>" value="<?php echo $cc; ?>">

		<p style="display: none;" id="<?php echo $co; ?>-counter"><?php echo $cc; ?></p>

		<script>remove.index('#<?php echo $co; ?>', '#<?php echo $r; ?>');</script>

	<?php }

}
?>