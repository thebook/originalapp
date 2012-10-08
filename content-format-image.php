<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" >
	
	<?php if ( isset($meta['post_image_format_img_upload']) ) : ?>

	<?php if ( $meta['post_image_format_lightbox'] == 'show' ) { echo '<div class="lf-featured-icon-wrap"><a href="'.$meta['post_image_format_img_upload'].'" rel="lightbox" />'; } ?>
	
	<img class="lf-post-format-img" title="<?php the_title(); ?>" src="<?php echo $meta['post_image_format_img_upload']; ?>" />

	<?php if ( $meta['post_image_format_lightbox'] == 'show' ) { echo '</a></div>'; } ?>
	
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
				
			<?php lf_title(); ?> 
					
		</h3>
				
		<?php lf_content();?>
																																		
	</div>
	
	</div>
	
	<?php endif; ?>
	
	
	<?php lf_cat_single(); ?>
	
</article>