<?php 

function slide_pop( $a ) {

	global $post;

	$m  = get_post_meta( $post->ID, $a['arr'], true );
	$sl = ( isset( $m['slide_num'] ) ? $m['slide_num'] : 1 );

	for ($s=1; $s < $sl + 1 ; $s++) { 

		// new opt array
		$o = $a;
		// metabox id
		$o['id']    = $o['id'] . $s;
		// metabox title
		$o['title'] = $o['title'] . " $s";
		// Alter inner options to have different "slide" number appended
		// Type
		$o['options']['opt'][1]['o'][4] = $o['options']['opt'][1]['o'][4] . "_$s";
		// Video
		$o['options']['opt'][2]['o'][4] = $o['options']['opt'][2]['o'][4] . "_$s";
		$o['options']['opt'][2]['o'][8] = array( "#lf-post-meta-slide_type_$s", "#slide_embed_$s-hook", '["video"]' );
		// Caption
		$o['options']['opt'][3]['o'][4] = $o['options']['opt'][3]['o'][4] . "_$s";
		$o['options']['opt'][3]['o'][8] = array( "#lf-post-meta-slide_type_$s", "#slide_caption_$s-hook", '["image"]' );
		// Image Upload
		$o['options']['opt'][4]['o'][4] = $o['options']['opt'][4]['o'][4] . "_$s";
		$o['options']['opt'][4]['o'][8] = array( "#lf-post-meta-slide_type_$s", "#slide_upload_$s-hook", '["image"]' );
		
		// Call regular pop with the modified methods
		pop( $o );
	}
}

function lf_slide_add() { ?>

	<tr>
		<td>
			<input type="button" value="Add Slide" class="lf-admin-post-meta-td-button">
			<input type="button" value="Remove"    class="lf-admin-post-meta-td-button">
		</td>
	</tr>

<?php }

?>