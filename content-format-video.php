<?php

$meta   = get_post_meta( $post->ID, 'main_meta', true );
$embed  = $meta['post_video_format_embed'];
$h 	    = $meta['post_video_format_height'];
$ogv    = $meta['post_video_format_ogv_url'];
$m4v    = $meta['post_video_format_m4v_url'];
$p      = $meta['post_video_format_poster_upload'];
$poster = ( isset( $p )) ? $p : '' ;

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">

<?php 

	if ( $embed !== '' ) { 
		lf_video_format_embed( $embed, $h );
	}

	elseif ( $ogv !== '' or $m4v !== '' ) {  	
		lf_video_format_host( $ogv, $m4v, $poster );
	} 
	
?>
		
	<?php if ( $meta['post_video_format_text'] == 'text' )  : ?>
	
	<div class="lf-post-img-text-wrap">
		
	<div class="lf-core-content-body-text">
		
		<h3 class="lf-post-format-media-title"> 
				
			<?php the_title(); ?> 
					
		</h3>
				
		<?php the_content();?>
																																		
	</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if ( is_singular() ) : ?>
										
	<?php	lf_content_meta( 'cat' ); ?>
								
	
	<?php endif; ?>
	
	
</article>