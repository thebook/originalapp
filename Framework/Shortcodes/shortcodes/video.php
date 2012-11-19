<?php 


/**
 * Takes an embeded video and displays it [video video="" height="" ]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   The embeded video ( youtube or vimeo )
 */
function lf_embed_vid($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'video'   => '',
				'height' => '500px'
				), 
			$atts 
		) 
	);

	( $height == '' ) and $height = '500px';

	( strpos( $height, 'px' ) === false ) and $height = $height . 'px'; 
	
	new helper_video($video, $height);
	
}

add_shortcode( 'video', 'lf_embed_vid' );


?>