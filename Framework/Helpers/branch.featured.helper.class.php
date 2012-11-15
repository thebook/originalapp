<?php 

/**
* A helper class which generates post featured images
*/
class helper_featured_image extends helper_post_meta
{

	public function _show_featured_image() 
	{ ?>
		<?php global $post; ?>

		<?php $current_post_meta = get_post_meta( $post->ID, 'main_meta', true ); ?>

		<?php $thumbnail_settings = $current_post_meta['post_thumbnail_click']; ?>

		<?php if ( has_post_thumbnail() && is_single() ) : ?>

			<p class="lf-featured-image">

				<?php if ( $thumbnail_settings == 'post' or $thumbnail_settings == 'webpage' ) : ?>

					<?php $href = ( $thumbnail_settings == 'post' ? get_permalink() : $current_post_meta['post_thumbnail_click_webpage'] ); ?>

					<a href="<?php echo $href; ?>" title="<?php the_title(); ?>">

						<?php the_post_thumbnail(); ?>

					</a>
					
				
				<?php elseif ( $thumbnail_settings == 'lightbox' or $thumbnail_settings =='otherlight' ) : ?>

					<?php $href = ( $thumbnail_settings == 'lightbox' ?  wp_get_attachment_url( get_post_thumbnail_id() ) : $current_post_meta['post_thumbnail_click_image'] ); ?>

					<span class="lf-featured-icon-wrap">

						<a href="<?php echo $href; ?>" title="<?php the_title(); ?>" rel="lightbox" >

							<?php the_post_thumbnail(); ?>

						</a>
					
					</span>

				<?php else : ?>
				
					<?php the_post_thumbnail(); ?>

				<?php endif; ?>
											
			</p>
		
		<?php endif; ?>

	<?php } 
}
?>