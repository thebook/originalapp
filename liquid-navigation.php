<?php
/*		
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0 
*/

$main_opt = get_option("main_options");


	if ( $main_opt["navigation_state"] == "nodropnav" ) {

		echo '<nav class="lf-main-navigation-style longnavhook">';
		
			wp_nav_menu( array('theme_location' => 'true_navigation'));
		
		echo '</nav>';

	}

	elseif ( $main_opt["navigation_state"] == "fullnav" ) {

		echo '<nav class="lf-main-navigation-style lf-drop-down-hook longnavhook">';
		
			wp_nav_menu( array('theme_location' => 'true_navigation'));
		
		echo '</nav>';

	}
		
?>