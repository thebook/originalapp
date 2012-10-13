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
	$o     = strtolower( esc_attr( $open ) );
	$c     = strip_tags( $content );
	
	// The display value of the toggle content
	$di    = ( $o == 'close' ? 'none' : 'block' );
	// Icon type "f" for up arrow, "g" for down arrow
	$i     = ( $o == 'close' ? 'f' : 'g' );
	// The data icon element attributes
	$datai = " data-icon=\"$i\" aria-hidden=\"true\" class=\"tog-lf-c\"";

	return "<div class=\"tog-lf\" data-id=\"$o\"><span class=\"tog-lf-ti\"><span $datai></span><span>$title</span></span><p style=\"display:$di;\" class=\"lf-tog-p\">$c</p></div>";

}

add_shortcode( 'tog', 'lf_tog_short' );

?>