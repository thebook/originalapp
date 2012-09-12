<?php
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0 
*/

$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'content_state' );

	if ( $layout == 'onesidebarleft' 
		|| $layout == 'onesidebarright' ) { 
			
			echo '<aside class="lf-core-content-aside">';
	
			dynamic_sidebar( 'lf-content-sidebar-first' );

			echo '</aside>';
			
		}
			
	elseif ( $layout == 'twosidebarleft' 
			|| $layout == 'twosidebarright' ) { 
			
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-first' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-second' );

				echo '</aside>';
			
			}
			
	elseif ( $layout == 'threesidebarleft' 
			|| $layout == 'threesidebarright' ) { 
			
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-first' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-second' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-third' );

				echo '</aside>';
			
			}

?>																										

