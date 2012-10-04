<?php

/**
 * Matches the layout with the side; designed to have more than one on the page 
 * @param  string $lay  the layout( e.g output of some option )
 * @param  string $side side specified( e.g 'left, right, twosidebarright...'
 * @return sidebar.php file
 */
function lf_get_sidebar( $lay, $side ) {

	if ( $lay == $side ) {

		get_sidebar();

	}
}

/**
 * Used to generate sidebars faster by default for posts and pages as layout_finder() will be commonly be used for 
 * knowing which sidebar to show, lf_get_sidebar() should be used in other circumstances, such as adding more than one sidebar
 * @param  string $side side name( e.g left, right, twoleft )
 * @return sidebar.php file
 */
function lf_sidebar($side) {

	global $post;

	$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'content_state' );

	lf_get_sidebar( $layout, $side );

}

?>