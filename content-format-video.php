<?php

$meta   = get_post_meta( $post->ID, 'main_meta', true );
$embed  = $meta['post_video_format_embed'];
$h 	    = $meta['post_video_format_height'];
$ogv    = $meta['post_video_format_ogv_url'];
$m4v    = $meta['post_video_format_m4v_url'];
$p      = $meta['post_video_format_poster_upload'];
$poster = ( isset( $p )) ? array( 'poster' => $p ) : '' ;

?>

<article id="post-<?php the_ID(); ?>" >

<?php 

	if ( $embed !== '' ) { 
		lf_video_format_embed( $embed, $h );
	}

	elseif ( $ogv !== '' or $m4v !== '' ) {  	
	
		$jp = new jplayer;
	
		$jp->play( 'video', 'jp-video', $post->ID, array( 'ogv' => $ogv, 'm4v' => $m4v ), $poster );	
		
	} 
	
?>
		
	<?php if ( $meta['post_video_format_text'] == 'text' )  : ?>
	
	<div class="lf-post-img-text-wrap">
		
	<div class="lf-core-content-body-text">
		
		<h3 class="lf-post-format-media-title"> 
				
			<?php lf_title(); ?> 
					
		</h3>
				
		<?php lf_content();?>
																																		
	</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php lf_cat_single(); ?>
	
	
</article>