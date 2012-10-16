<?php 

/**
* A class updating the slider metaboxes, with more each to match a the slide number, as well with functions 
* which allow the ajaxification of dynamicly created metaxboxes for the slider, though jAPI ( sweet plugin )
*/
class slide_opt
{

	public function pop( $a )
	{
		global $post;

		$m = get_post_meta( $post->ID, $a['arr'], true );
		$s = ( isset( $m['slide_num'] ) ? $m['slide_num'] : 1 );

		for ($si=1; $si < $s + 1; $si++) { 
			
			$o = $this->literate( $a, $si );

			pop( $o );

		}
	}

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
}

function lf_slide_add() { ?>

	<tr>
		<td>
			<input onclick="javascript:clone.c('<?php echo get_template_directory_uri() .'/Framework/Slider/meta.php'; ?>')" type="button" value="Add Slide" class="lf-admin-post-meta-td-button">
			<input onclick="javascript:clone.remove('.postbox');" type="button" value="Remove"    class="lf-admin-post-meta-td-button">
		</td>
	</tr>

<?php }

function meta_hider($id) {

	echo "<input type=\"hidden\" id=\"$id\" name=\"main_meta[$id]\" value=\"\">";

}

?>