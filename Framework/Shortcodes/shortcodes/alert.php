<?php


/**
 * Crates an alert type box based on choice [alert color="" ]content[/alert]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   Returns an alert box
 */
function lf_alert_short($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'color' => 'Yellow'
				), 
			$atts 
		) 
	);

	$c   = esc_attr( $color );
	$con = strip_tags( $content );

	return "<div class='alert-box-$c'>$con</div>";

}

add_shortcode( 'alert', 'lf_alert_short' );


?>