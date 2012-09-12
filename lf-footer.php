<?php 
/*		
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0	
*/


$main_opt = get_option( 'main_options' );

$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'footer_state' );
			
if ( $layout != 'nofooter' ) {
					 
if ( $main_opt['footer_hide_shadow'] != "yes" ) {

	echo '<div class="lf-footer-shadow">&nbsp;</div>';
	
	}
	
echo '<footer id="footer" class="lf-footer-wrap" ><div class="lf-footer">';

	if ( $layout == 'fourwidget' ) {
	
		echo '<div class="lf-footer-widget-four">';
	
		dynamic_sidebar( 'footer-sidebar1' );	
		
		echo '</div>';
		
	}
	
	elseif ( $layout == 'twowidget' ) {
	
		echo '<div class="lf-footer-widget-two">';
	
		dynamic_sidebar( 'footer-sidebar1' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-two">';
		
		dynamic_sidebar( 'footer-sidebar2' );
		
		echo '</div>';
	
	}
	
	elseif ( $layout == 'threewidget' ) {
	
		echo '<div class="lf-footer-widget-three">';
	
		dynamic_sidebar( 'footer-sidebar1' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-three">';
		
		dynamic_sidebar( 'footer-sidebar2' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-three">';
		
		dynamic_sidebar( 'footer-sidebar3' );
		
		echo '</div>';
	
	}
	
	elseif ( $layout == 'onewidget' ) {
	
		echo '<div class="lf-footer-widget-one">';
	
		dynamic_sidebar( 'footer-sidebar1' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-one">';
		
		dynamic_sidebar( 'footer-sidebar2' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-one">';
		
		dynamic_sidebar( 'footer-sidebar3' );
		
		echo '</div>';
		
		echo '<div class="lf-footer-widget-one">';
		
		dynamic_sidebar( 'footer-sidebar4' );
		
		echo '</div>';
	
	}
	
echo '</div></footer>';

}

?>