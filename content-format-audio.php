<?php

$meta   = get_post_meta( $post->ID, 'main_meta', true );
$jp     = new jplayer;
$oga    = $meta['post_audio_format_oga_url'];
$mp3    = $meta['post_audio_format_mp3_url'];
$p      = $meta['post_audio_format_poster_upload'];
$show   = $meta['post_audio_format_poster_show'];
$pos    = ( ( isset( $p ) ) ? array( 'poster' => $p ) : '' );
$poster = ( $show == 'show' ? $pos : '' );
?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">

	<?php $jp->play( 'audio', 'jp-audio', $post->ID, array( 'oga' => $oga, 'mp3' => $mp3 ), $poster ); ?>
		
	<?php if ( $meta['post_audio_format_text'] == 'text' )  : ?>
	
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



