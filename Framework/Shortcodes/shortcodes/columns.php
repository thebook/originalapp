<?php

/**
 * Column generate shortcode [column size=""]content[/column]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   A div element which is the speicfied with
 */
function lf_col_short($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'size' => 'full'
				), 
			$atts 
		) 
	);

	$s  = esc_attr( $size );
	$cc = strip_tags( $content );
	$c  = do_shortcode( $cc );

	return "<div class=\"lf-column-size-$s\">$c</div>";

}

add_shortcode( 'column', 'lf_col_short' );

?>