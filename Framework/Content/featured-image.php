<?php 

function lf_featured_img() { 

	global $post;

	$m = get_post_meta( $post->ID, 'main_meta', true );

	$setting = $m['post_thumbnail_click'];

	if ( has_post_thumbnail() && is_single() ) {

		echo '<p class="lf-featured-image">';

			if ( $setting == 'post' or $setting == 'webpage' ) {

				$href = ( $setting == 'post' ? get_permalink() : $m['post_thumbnail_click_webpage'] );

				echo '<a href="'.$href.'" title="'.get_the_title().'" />';

				the_post_thumbnail();

				echo '</a>';
				
			}
			elseif ( $setting == 'lightbox' or $setting =='otherlight' ) {

				$href = ( $setting == 'lightbox' ?  wp_get_attachment_url( get_post_thumbnail_id() ) : $m['post_thumbnail_click_image'] );

				echo '<span class="lf-featured-icon-wrap">';

				echo '<a href="'.$href.'" title="'.get_the_title().'" rel="lightbox" />';

				the_post_thumbnail();

				echo '</a>';
				
				echo '</span>';

			}
			else { 

				the_post_thumbnail();
			}
										
		echo '<p>';
	
	}

}

?>