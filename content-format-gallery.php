<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" >
	
	
<?php 
		
	$gallery = ( isset( $meta['post_gallery_format_upload'] ) ? $meta['post_gallery_format_upload'] : '' );
	
	if ( $gallery != '' ) {
	
		echo '<div id="lf-gallery-slider-'. $post->ID .'" class="lf-post-format-gallery">';
	
	
		echo '<img   src="'. current( $gallery ) .'" class="lf-post-format-img" />'; 
		
		array_shift( $gallery );
		
		foreach ( $gallery as $value ) { 
			
			echo '<img style="display:none;" src="'. $value .'" class="lf-post-format-img" />';
			
		}
		
		echo '<script>$( window ).load( function () {  use.slider( "'. $meta['post_gallery_format_effect'].'", "#lf-gallery-slider-'. $post->ID .'" ); } );</script>';

		echo '</div>';
	
	}
	
?>
	
	<?php if ( $meta['post_gallery_format_text'] == 'text' )  : ?>
	
	<span class="post-arrow"></span>
	
	<div class="lf-post-img-text-wrap">
			
	<div class="lf-core-content-body-text">
		
		<h3 class="lf-post-format-media-title"> 
				
			<?php the_title(); ?> 
					
		</h3>
				
		<?php lf_content();?>
																																		
	</div>
	
	</div>
	
	<?php endif; ?>
	

	<?php lf_cat_single(); ?>
	
</article>