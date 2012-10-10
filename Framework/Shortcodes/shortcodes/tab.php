<?php 

/**
 * Tab wrapper [tabwrap]content[/tabwrap]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   Returns a div that wraps the other tabs
 */
function lf_tab_wrap_short($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'att' => ''
				), 
			$atts 
		) 
	);

	$cc = strip_tags( $content );
	$c  = do_shortcode( $cc );

	return "<div class=\"tabwrap-lf-tab\">$c</div>";

}

add_shortcode( 'tabwrap', 'lf_tab_wrap_short' );



/**
 * The tabs to be displayed inside the tabwrap
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   A invididual tab which is to be wrapped by tabwrap
 */
function lf_tab_short($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'title' => ''
				), 
			$atts 
		) 
	);

	return "<>";

}

add_shortcode( 'tab', 'lf_tab_short' );

?>