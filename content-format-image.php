<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">
	
	<?php if ( isset($meta['post_image_format_img_upload']) ) : ?>
	
	<img class="lf-post-format-img" title="<?php the_title(); ?>" src="<?php echo $meta['post_image_format_img_upload']; ?>" />
	
	<span class="lf-post-format-img-link">
		
		By : 
<?php

	if ( isset( $meta['post_image_format_credit'] ) ) {
	
		if ( lf_whitespace( $meta['post_image_format_credit'] ) ) { 
	
			if ( isset( $meta['post_image_format_credit_link'] ) ) {
			
				if ( lf_whitespace( $meta['post_image_format_credit_link'] ) ) {
					
					echo '<a title="Author Link" href="'. $meta['post_image_format_credit_link'] .'" >';
					
					echo $meta['post_image_format_credit'];
					
					echo '</a>';
				
				}
				
				else { 
				
					echo $meta['post_image_format_credit'];
				
				}
					
			}

			else { 
			
				echo $meta['post_image_format_credit']; 
			
			}
		
		}
		
	}

?>
	
	</span>
	
	<?php endif; ?>
	
	<?php if ( $meta['post_image_format_text'] == 'text' )  : ?>
	
	<span class="post-arrow"></span>
	
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