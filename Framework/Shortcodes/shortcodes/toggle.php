<?php 

/**
 * Toggle box shortcode [tog open="" title=""]content[/tog]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   A toggle box which could be open or closed by default
 */
function lf_tog_short($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'open' => 'Close',
				'title'=> '',
				), 
			$atts 
		) 
	);

	$title = esc_attr( $title );
	$o     = esc_attr( $open );
	$c     = strip_tags( $content );

	return "<div class=\"tog-lf-$o\"><span class=\"tog-lf-ti\">$title</span><p>$c</p></div>";

}

add_shortcode( 'tog', 'lf_tog_short' );

?>