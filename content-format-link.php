<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" >
	
	<?php if ( $meta['post_link_format_link'] != '' ) : ?>
	
	<div class="lf-post-format-quote-wrap">
	
		<div class="post-format-link-image"></div>
		
		<div class="lf-post-format-quote-text">
			
			<p class="lf-post-format-quote">
				
				<a href="<?php echo $meta['post_link_format_link']; ?>" title="<?php the_title(); ?>">
				
					<?php echo ( ctype_space( $meta['post_link_format_desc'] ) ? $meta['post_link_format_link'] : $meta['post_link_format_desc'] );  ?>
					
				</a>
				
			</p>
				
		</div>
			
	</div>
	
	<?php endif; ?>
	
											
	<?php if ( $meta['post_link_format_text'] == 'text' )  : ?>
	
	<div class="lf-core-content-body-text">
										
		<?php lf_content();?>
													
	</div>
	
	<?php endif; ?>
	
	
	<?php lf_cat_single(); ?>
	
</article>