
<?php $slide = layout_finder( 'main_options', 'main_meta', get_the_ID(), 'chosen_layout', 'slider_state' ); ?>

<?php $m = get_post_meta( 545, 'main_meta', true ); ?>



<div class="lf-slider-background lf-slider-loading">

<div id="lf-slide-hook" class="lf-slider-wrap">

	<div class="lf-slider lf-slider-wrap-<?php echo $m['general_slider_type']; ?>">

		<!-- Begin For loop -->
		<?php for ($i=1; $i < $m['meta_count_slider'] + 1; $i++) : ?>
			
			<?php $u = $m["slide_upload_$i"];	
				  $c = $m["slide_caption_$i"];?>

			<!-- A slide wrapper -->
			<div class="lf-slider-slide">
				<!-- If image slide -->
				<?php if ( $m["slide_type_$i"] == 'image' ) : ?>

					<?php if ( isset( $u ) ) : ?><img src="<?php echo $u; ?>"><?php endif;?>

					
				<!-- If video slide -->
				<?php else : ?>

					<?php echo do_schortcode( $m['slide_embed'] ); ?>

				<?php endif; ?>

			</div>

		<?php endfor; ?>

	</div>

	<!-- Extra Text Box -->
	<?php if ( $m['general_slider_type'] == 'onebox' ) : ?>

		<div class="lf-slider-main-box">

			<?php echo $m['general_slider_text_box_one']; ?>

		</div>

	<?php endif; ?>

	<!-- Script -->
	<script>
		$(window).load( 
			function () {
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
	</script>

</div>

</div>