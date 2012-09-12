<?php 

function lf_ad_widget_display( $opts, $type = '200x200' ) {

	switch ( $type ) {
	
		case '200x200' : 
		
			echo '<div style="width: 200px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '160x160' : 
			
			echo '<div style="width: 160px; padding: 12px 20px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '120x600' : 
		
			echo '<div style="width: 120px; padding: 12px 40px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '125x125' : 
		
			echo '<div style=" width: 125px; padding: 12px 37px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '250x250' : 
		
			echo '<div style="width: 250px; padding: 24px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '300x250' :
		
			echo '<div style="width: 300px; padding: 24px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '336x280' :
		
			echo '<div style="width: 336px; padding: 24px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
		case '728x90' : 
		
			echo '<div style="width: 728px; padding: 12px;" class="lf-ad-widget-border-wrap" >';
			
			break;
			
	}

	if ( isset( $opts['ad_cover'], $opts['ad_with_us'] ) ) {
		
		if ( $opts['ad_cover'] == 'yes' ) { 
			
			echo '<div class="lf-ad-widget-dummy-ad">';
				
			echo '<a href="'. $opts['ad_link'] .'" title="'. $opts['ad_text'] .'" >';
				
			echo $opts['ad_text'];
				
			echo '</a>';
				
			echo '</div>';
			
		}
			
		else { 
			
			echo $opts['ad_code'];
			
		}
			
		if ( $opts['ad_with_us'] == 'yes' && $opts['ad_cover'] != 'yes' ) { 
			
			echo '<div class="lf-ad-widget-link-ad">';
			
			echo '<a href="'. $opts['ad_link'] .'" title="'. $opts['ad_text'] .'" >';
				
			echo $opts['ad_text'];
				
			echo '</a>';
				
			echo '</div>';
			
		} 
		
	}
		
	else { 
		
		echo $opts['ad_code'];
		
	}
		
	echo '</div>';
			
} 

include( ADMINPATH . '/Content/widgets/200x200-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/160x600-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/120x600-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/125x125-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/250x250-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/300x250-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/336x280-ad-widget.php' );

include( ADMINPATH . '/Content/widgets/728x90-ad-widget.php' );


?>