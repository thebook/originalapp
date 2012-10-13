<?php 

/**
 * Tab wrapper [tabwrap]content[/tabwrap]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string   The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html     Returns tab div with a ul full of li's as titles, and the contetns of the [tab] shortcode as text
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

	// Array to hold all the tab titles
	$tabs = array();
	// Return Var
	$t    = '';

	// Extract the title names from the [tab] shortcodes
	preg_match_all( '/tab title="([^\"]+)"/i', $content, $m, PREG_OFFSET_CAPTURE );
	// If is not empty
	( isset( $m[1] ) ) and $tabs = $m[1];

	// If there is more than one tab
	if ( count($tabs) ) {

		$t.= '<div class="tab-wrap-lf">';
		$t.= '<ul class="tab-head-lf">';

		foreach ($tabs as $tab) {
		
			$t.= '<li class="tab-li-lf"><a>'.$tab[0].'</a></li>';
		
		}

		$t.= '</ul>';
		$t.= do_shortcode( $content );
		$t.= '</div>';
	}
	else { 

		$t = do_shortcode( $content );
	}

	return $t;
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

	$cc = strip_tags( $content );
	$c  = do_shortcode( $cc );

	return "<div class=\"tab-box-lf\">$c</div>";

}

add_shortcode( 'tab', 'lf_tab_short' );

?>