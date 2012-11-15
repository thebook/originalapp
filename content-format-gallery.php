
<?php $meta = get_post_meta( $post->ID, 'main_meta', true ); ?>

<article id="post-<?php the_ID(); ?>" >
	
	
	<?php $gallery = ( isset( $meta['post_gallery_format_upload'] ) ? $meta['post_gallery_format_upload'] : '' ); ?>
	
	<?php if ( $gallery != '' ) : ?>
	
		<div id="lf-gallery-slider-<?php echo $post->ID; ?>" class="lf-post-format-gallery">
	
			<img src="<?php echo current( $gallery ); ?>" class="lf-post-format-img" />
		
			<?php array_shift( $gallery ); ?>
		
			<?php foreach ( $gallery as $value ) : ?>
				
				<img style="display:none;" src="<?php echo $value; ?>" class="lf-post-format-img" />
				
			<?php endif; ?>
		
			<script>$( window ).load( function () {  use.slider( "<?php echo $meta['post_gallery_format_effect']; ?>", "#lf-gallery-slider-<?php echo $post->ID; ?>" ); } );</script>

		</div>
	
	<?php endif; ?>

	
	<?php if ( $meta['post_gallery_format_text'] == 'text' )  : ?>
	
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