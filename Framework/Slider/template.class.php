<?php 


	/**
	* A class which generates a slider and its components
	*/
	class slide
	{	
		/**
		 * @var array An array of all the slides 
		 */
		var $a;

		function __construct($post)
		{	
			$meta = get_post_meta( $post, 'main_meta', true ); 
			$this->a = $meta;
			$this->body( $meta );
		}

		public function js()
		{ ?>
			
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
								console.log( slider );
								t.css('opacity', '0');
								$('.lf-slider-background').removeClass('lf-slider-loading');
								t.animate({'opacity' : '1'}, 700 );
							}
						});			
					});
			</script>


<?php	}

		public function feature( $m, $i )
		{ ?>
			
			<?php $p = get_post( $m["slide_post_$i"] ); ?>

				<div class="lf-slider-text">
							
					<div class="lf-slider-t-wrap">

						<div class="lf-slider-art">

							<h3><?php echo $p->post_title; ?></h3>

								<?php echo _lf_cut_excerpt( $p->post_content, 250, false ); ?>

								<a href="<?php echo get_permalink( $p->ID ); ?>">...Read More</a>

						</div>

					</div>			
						
				</div>

				<?php  echo get_the_post_thumbnail( $p->ID ); ?>


<?php	}

		public function image($m, $i)
		{ ?>

				<?php $u = $m["slide_upload_$i"]; ?>
				
				<?php $c = $m["slide_caption_$i"];?>

					<?php if ( $c !== '' ) : ?> 

						<div class="lf-slider-text">
							
							<div class="lf-slider-t-wrap">

								<span><?php echo $c; ?></span>

							</div>			
						
						</div>

					<?php endif;?>

					<?php if ( $u !== '' ) : ?>

						<img src="<?php echo $u; ?>">

					<?php endif;?>

<?php  	}

		public function literate( $m )
		{
			for ($i=1; $i < $m['meta_count_slider'] + 1; $i++) {

				echo '<div class="lf-slider-slide">';

				if ( $m["slide_type_$i"] == 'image' ) {

					$this->image( $m, $i );
				}

				if ( $m["slide_type_$i"] == 'featured' ) {

					$this->feature( $m, $i );
				}

				echo '</div>';

			}
		}

		public function body( $m )
		{ ?>
			
			<div class="lf-slider-background lf-slider-loading">

				<div id="lf-slide-hook" class="lf-slider-wrap">

					<div class="lf-slider lf-slider-wrap-<?php echo $m['general_slider_type']; ?>">

						<?php $this->literate( $m ); ?>

					</div>

						<?php $this->js() ?>

				</div>
			</div>

<?php	}
	}


?>