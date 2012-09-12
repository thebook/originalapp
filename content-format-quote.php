<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">
	
	<?php if ( $meta['post_quote_format'] != '' ) : ?>
	
	<div class="lf-post-format-quote-wrap">
	
		<div class="post-format-quote-image"></div>
		
		<div class="lf-post-format-quote-text">
			
			<p class="lf-post-format-quote">
				
				<?php echo $meta['post_quote_format']; ?>
					
			</p>
			
			<address class="lf-post-format-quote-author"> 
		
<?php 

	if ( isset( $meta['post_quote_format_credit'] ) ) {
	
		if ( lf_whitespace( $meta['post_quote_format_credit'] ) ) { 
			
			echo $meta['post_quote_format_credit'];
		
		}
		
	}

?>
		
		</address>
		
		</div>
			
	</div>
	
	<?php endif; ?>
											
	<?php if ( $meta['post_quote_format_text'] == 'text' )  : ?>
	
	<div class="lf-core-content-body-text">
										
		<?php the_content();?>
													
	</div>
	
	
	<?php endif; ?>
	
	<?php if ( is_singular() ) : ?>
												
	<?php	lf_content_meta( 'cat' ); ?>
								
	<?php endif; ?>
	
</article>