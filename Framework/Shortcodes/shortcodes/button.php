<?php

function lf_but_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '',
				'url' => '',
				'size' => 'normal',
				'read' => 'Click Me' 
				), 
			$atts 
		) 
	);

	$c = esc_attr( $color );
	$r  = esc_attr( $read );
	$u  = esc_attr( $url );
	$s  = esc_attr( $size );

	return "<a href='$u' title='$r' class='lf-shortcode-button-$s-$c'>$r</a>";

}

add_shortcode( 'button', 'lf_but_shortcode' );


?>