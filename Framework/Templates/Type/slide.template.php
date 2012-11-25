<?php 

/**
* A slider template class
*/
class template_slide
{	
	
	function __construct($template_params)
	{	
		$meta = get_post_meta( $template_params['slide_id'], 'main_meta', true ); 
		$this->_manifest( $meta );
	}

	protected function _slider_js ()
	{ ?>			
		<script>
			!function ($) { 
				$(document).ready( 
					function () {
						alert("stuff");		
						$('#lf-slide-hook').flexslider({

							animation: "slide",
							namespace: "lf-slider-",
							selector : ".lf-slider > div",
							smoothHeight: true,
							slideshow : false,
							slideshowSpeed : 8000,
							animationSpeed : 400,
							controlNav : false,
							prevText : "",
							nextText : "",
							video : true,
							start : function (slider) { 
							
								var t = $('#lf-slide-hook');
								
								t.css('opacity', '0');
								$('.lf-slider-background').removeClass('lf-slider-loading');
								t.animate({'opacity' : '1'}, 700 );
							}
						});	
					});
			}(jQuery);

		</script>

<?php }

	protected function _get_a_post_and_manifest_as_slide ( $slider_meta_array, $current_slide )
	{ ?>
		
		<?php $post_to_display = get_post( $slider_meta_array["slide_post_$current_slide"] ); ?>

		<?php $post_helpers = new produce_helper; ?> 

			<?php echo get_the_post_thumbnail( $post_to_display->ID ); ?>

			<div class="lf-slider-text-wrap">
						
				<div class="lf-slider-text">

					<header><h3><?php echo $post_to_display->post_title; ?></h3></header>

					<p><?php echo $post_helpers->_lf_cut_excerpt( $post_to_display->post_content, 500, false ); ?></p>

					<a href="<?php echo get_permalink( $post_to_display->ID ); ?>">...Read More</a>

				</div>			
					
			</div>

<?php }

	protected function _get_uploaded_image_and_manifest_as_slide ($slider_meta_array, $current_slide)
	{ ?>

		<?php $slide_image_url = $slider_meta_array["slide_upload_$current_slide"]; ?>
		
		<?php $slide_caption = $slider_meta_array["slide_caption_$current_slide"];?>

			<?php if ( $slide_image_url !== '' ) : ?>

				<img src="<?php echo $slide_image_url; ?>">

			<?php endif;?>

			<?php if ( $slide_caption !== '' ) : ?> 

				<div class="lf-slider-text-wrap">
					
					<div class="lf-slider-text">

						<header>
							
							<h3><?php echo $slide_caption; ?></h3>
						
						</header>

					</div>			
				
				</div>

			<?php endif;?>


<?php }

	protected function _take_array_and_generate_slides ( $slider_meta_array )
	{ ?>
		<?php for ($current_slide=1; $current_slide < $slider_meta_array['meta_count_slider'] + 1; $current_slide++) : ?>

			<div class="lf-slider-slide">

				<?php if ( $slider_meta_array["slide_type_$current_slide"] == 'image' ) : ?> 

					<?php $this->_get_uploaded_image_and_manifest_as_slide( $slider_meta_array, $current_slide ); ?>

				<?php elseif ( $slider_meta_array["slide_type_$current_slide"] == 'featured' ) : ?> 

					<?php $this->_get_a_post_and_manifest_as_slide( $slider_meta_array, $current_slide ); ?>

				<?php endif; ?>

			</div>

		<?php endfor; ?>

<?php }

	protected function _manifest ( $slider_meta_array )
	{ ?>
			
		<div class="lf-slider-background lf-slider-loading">

			<div id="lf-slide-hook" class="lf-slider-wrap-<?php echo $slider_meta_array['general_slider_type']; ?>">

				<div class="lf-slider">

					<?php $this->_take_array_and_generate_slides( $slider_meta_array ); ?>

				</div>

					<?php $this->_slider_js() ?>

			</div>
		</div>

<?php }
}
?>