<?php

$main_opt = get_option( 'main_options' );

$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'slider_state' );

if ( $layout != 'noslider' ) : 

	if ( $layout == "fullslider"
		|| $layout == "nodescslider" ) :

?>

<div class="lf-slider-top-wrap">

	<div class="headfot lf-slider-shorttag-wrap">
		
		<div>							
			
			<span class="lf-slider-shorttag">
				
				<?php echo $main_opt['slider_shorttag_text']; ?>
			
			</span>	
		
		</div>
	
	</div>
					
	<div class="lf-slider-top-garident">
	
	</div>
	
	<div class="headfot lf-slider-top-background "> 																	
				
	</div>

</div>

<div class="lf-slider-wrap"> 
	
	<div class="lf-slider-navigation-filler-wrap">
	
		<div class="lf-slider-navigation-filler">
	
		</div>
	
		<a  class="lf-slider-navigation lf-slider-navigation-left" href='#' onclick='slider.prev(); return false;'>
	
		</a>
	
	</div>
	
	<div id="swipeslide" class="lf-slider-content-wrap"> 

		
	
		<div class="lf-slider-slide-cont">
		
<?php 

	$main_opt = get_option( 'main_options' );
	
	$main_meta = null;
	
	if ( isset( $main_opt['featured_slider'] ) ) {
	
		$main_meta = get_post_meta( $main_opt['featured_slider'], 'main_meta', true );
		
	}

		if ( $main_meta != null ) {
		
			foreach ( $main_meta as $value ) { 
			
				echo '<div class="lf-slider-slide">';
				
				echo "<img src='$value' />";
				
				echo '</div>';
			
			}
		
		}
	
?>
		
		</div>
		
	</div> 
	
	<div class="lf-slider-navigation-filler-wrap">
	
	<div class="lf-slider-navigation-filler">
	
	</div>
	
	<a  class="lf-slider-navigation lf-slider-navigation-right" href='#' onclick='slider.next();return false;'>
			
	</a> 
	
	</div>

</div>
															
<script> 

	var slider = new Swipe( document.getElementById('swipeslide'), {
		<?php 
				
		if ( $main_opt['slider_duration'] != null ) {
		
			echo 'speed : ' . $main_opt['slider_duration'] . ',';
		
		
		}
		
		if ( $main_opt['slider_auto_play'] == 'autoplay' ) {

			echo 'auto : ' . $main_opt['slider_duration'];
			
		}
		
?>		
	}); 




</script> 

<!-- slider end -->

<div class="lf-slider-bottom-wrap">

	<div class="lf-slider-bottom-garident">
		
	</div>
		
		
	<div class="lf-slider-bottom-background headfot">
		
	</div>
	
<?php 

		if ( $layout == "fullslider" ) :
		
?>
	
	<div class="lf-slider-description">
	
		<p>
					
			<?php $website_description = get_option('blogdescription'); echo $website_description; ?>
				
		</p>
		
	</div>

<?php 

	endif;
	
	echo '</div>';

	endif;

	if ( $layout == "description" ) :

?>

<div class="lf-slider-top-wrap">
		
		<div class="lf-slider-description-only-color headfot ">
				
			<div class="lf-slider-description-only-top-garident"></div>				
				
				<div class="lf-slider-decription-only-text">
					
					<p>
						
						<?php $website_description = get_option('blogdescription'); echo $website_description; ?>
						
					</p>
				
				</div>
				
				<div class="lf-slider-description-only-bottom-garident">
				
				</div>
		</div>
		
	</div>
	
<?php 

	endif; 
	
	endif;
	
?>


