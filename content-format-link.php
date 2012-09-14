<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">
	
	<?php if ( $meta['post_link_format_link'] != '' ) : ?>
	
	<div class="lf-post-format-quote-wrap">
	
		<div class="post-format-link-image"></div>
		
		<div class="lf-post-format-quote-text">
			
			<p class="lf-post-format-quote">
				
				<a href="<?php echo $meta['post_link_format_link']; ?>" title="<?php the_title(); ?>">
				
					<?php echo ( $meta['post_link_format_text_style'] == 'custom' ? $meta['post_link_format_desc'] : $meta['post_link_format_link'] );  ?>
					
				</a>
				
			</p>
				
		</div>
			
	</div>
	
	<?php endif; ?>
	
											
	<?php if ( $meta['post_link_format_text'] == 'text' )  : ?>
	
	<div class="lf-core-content-body-text">
										
		<?php the_content();?>
													
	</div>
	
	<?php endif; ?>
	
	<?php if ( is_singular() ) : ?>
												
	<?php	lf_content_meta( 'cat' ); ?>
								
	<?php endif; ?>
	
</article>