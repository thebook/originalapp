<?php 

/**
* A template class which extends branch content and 
* generates post formats based on the templates
*/
class template_post_formats extends branch_content
{

	public function _post_formats()
	{ ?> 
		<?php $this->_init_helpers(); ?>

		<?php $this->_init_post_meta(); ?>		

			<?php while (have_posts()) : the_post(); ?>
				
				<?php $post_format_name = get_post_format(); ?>
				
				<?php ( $post_format_name === false ) and $post_format_name = 'standard'; ?>
					
				<?php $this->_get_a_single_template_part( "$post_format_name" ); ?>
															
			<?php endwhile; ?>	
			
<?php }

	protected function _standard()
	{ ?>

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?> 

		<article id="post-<?php the_ID(); ?>" >
	
			<div class="lf-core-content-post-format-head-wrap">
			
				<div class="lf-core-content-post-format-head-holder-wrap">
			
					<header>
									
						<h1 class="lf-posttitle">
												
							<?php $post_helpers->lf_title(); ?> 
													
						</h1>
												
					</header>	
											
					<?php $post_helpers->_show_content_meta_of_type( 'time' ); ?>
						
				</div>
			
				
			</div>
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
			<?php $post_helpers->_show_featured_image(); ?>
										
			<div class="lf-post-img-text-wrap">
													
				<div class="lf-core-content-body-text">
													
					<?php $post_helpers->lf_content();?>
																
				</div>
			
			</div>
			
			
		</article>
<?php }

	protected function _video()
	{?>
		<?php 

		global $post;
		$post_meta    = $this->template_paramaters['post_meta']; 
		$post_helpers = $this->template_paramaters['post_helpers']; 
		$meta         = get_post_meta( $post->ID, 'main_meta', true );
		$embed        = $meta['post_video_format_embed'];
		$h 	          = $meta['post_video_format_height'];
		$ogv          = $meta['post_video_format_ogv_url'];
		$m4v          = $meta['post_video_format_m4v_url'];
		$p            = $meta['post_video_format_poster_upload'];
		$poster       = ( isset( $p )) ? array( 'poster' => $p ) : '' ;

		?>

		<article id="post-<?php the_ID(); ?>" >

			<!-- Video player -->
			<?php if ( $embed !== '' ) : ?>

				<?php lf_video_format_embed( $embed, $h ); ?>
				
			<?php elseif ( $ogv !== '' or $m4v !== '' ) : ?>
				
				<?php $jp = new jplayer; ?>
				
				<?php $jp->play( 'video', 'jp-video', $post->ID, array( 'ogv' => $ogv, 'm4v' => $m4v ), $poster ); ?>
					
			<?php endif; ?>
				
			<!-- Show text if enabled -->
			<?php if ( $meta['post_video_format_text'] == 'text' )  : ?>
				
				<?php $this->_print_content(); ?>
				
			<?php endif; ?>
			
			<!-- Post category tags and edit button -->
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
			
		</article>
<?php }

	protected function _audio()
	{ ?>
		<?php 
		global $post;
		$post_meta    = $this->template_paramaters['post_meta']; 
		$post_helpers = $this->template_paramaters['post_helpers']; 
		$meta         = get_post_meta( $post->ID, 'main_meta', true );
		$jp           = new jplayer;
		$oga          = $meta['post_audio_format_oga_url'];
		$mp3          = $meta['post_audio_format_mp3_url'];
		$p            = $meta['post_audio_format_poster_upload'];
		$show         = $meta['post_audio_format_poster_show'];
		$pos          = ( ( isset( $p ) ) ? array( 'poster' => $p ) : '' );
		$poster       = ( $show == 'show' ? $pos : '' );
		
		?>

		<article id="post-<?php the_ID(); ?>" >

			<!-- Audio player  -->
			<?php $jp->play( 'audio', 'jp-audio', $post->ID, array( 'oga' => $oga, 'mp3' => $mp3 ), $poster ); ?>
			
			<!-- If post text is set to show -->
			<?php if ( $meta['post_audio_format_text'] == 'text' )  : ?>
			
				<?php $this->_print_content(); ?>
			
			<?php endif; ?>
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>

	<?php }

	protected function _quote()
	{ ?>

		<?php $post_meta    = $this->template_paramaters['post_meta']; ?>

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?> 

		<article id="post-<?php the_ID(); ?>" >
			
			<?php if ( $post_meta['post_quote_format'] != '' ) : ?>
			
				<div class="lf-post-format-quote-wrap">
				
					<div class="post-format-quote-image"></div>
					
					<div class="lf-post-format-quote-text">
						
						<p class="lf-post-format-quote">
							
							<?php echo $post_meta['post_quote_format']; ?>
								
						</p>
						
						<address class="lf-post-format-quote-author"> 
					
							<?php if ( isset( $post_meta['post_quote_format_credit']) and lf_whitespace( $post_meta['post_quote_format_credit'] ) ) : ?>
										
								<?php echo $post_meta['post_quote_format_credit']; ?>
									
							<?php endif; ?>
					
						</address>
					
					</div>
						
				</div>
			
			<?php endif; ?>
													
			<?php if ( $post_meta['post_quote_format_text'] == 'text' )  : ?>
			
				<?php $this->_print_content(); ?>
			
			<?php endif; ?>
			
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>
<?php }

	protected function _link()
	{ ?>

		<?php $post_meta    = $this->template_paramaters['post_meta']; ?>

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?> 

		<article id="post-<?php the_ID(); ?>" >
			
			<?php if ( $post_meta['post_link_format_link'] != '' ) : ?>
			
				<div class="lf-post-format-quote-wrap">
				
					<div class="post-format-link-image"></div>
					
					<div class="lf-post-format-quote-text">
						
						<p class="lf-post-format-quote">
							
							<a href="<?php echo $post_meta['post_link_format_link']; ?>" title="<?php the_title(); ?>">
							
								<?php echo ( ctype_space( $post_meta['post_link_format_desc'] ) ? $post_meta['post_link_format_link'] : $post_meta['post_link_format_desc'] );  ?>
								
							</a>
							
						</p>
							
					</div>
						
				</div>
			
			<?php endif; ?>
			
													
			<?php if ( $post_meta['post_link_format_text'] == 'text' )  : ?>
			
				<?php $this->_print_content(); ?>
			
			<?php endif; ?>
			
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>
<?php }

	protected function _image()
	{ ?>

		<?php $post_meta    = $this->template_paramaters['post_meta']; ?>

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?> 

		<article id="post-<?php the_ID(); ?>" >
			
			<?php if ( isset($post_meta['post_image_format_img_upload']) ) : ?>

				<!-- Wrap with lightbox wrapper if set to light box -->
				<?php if ( $post_meta['post_image_format_lightbox'] == 'show' ) { echo '<div class="lf-featured-icon-wrap"><a href="'.$post_meta['post_image_format_img_upload'].'" rel="lightbox" />'; } ?>
					<!-- Display image regardless of whether set to be lightboxed -->
					<img class="lf-post-format-img" title="<?php the_title(); ?>" src="<?php echo $post_meta['post_image_format_img_upload']; ?>" />

				<?php if ( $post_meta['post_image_format_lightbox'] == 'show' ) { echo '</a></div>'; } ?>
				
				<!-- Image credits -->
				<span class="lf-post-format-img-link">
					
					By : 

						<?php if ( isset( $post_meta['post_image_format_credit'] ) and lf_whitespace( $post_meta['post_image_format_credit'] ) ) : ?>
							
							<?php if ( isset( $post_meta['post_image_format_credit_link'] ) ) : ?>
							
								<?php if ( lf_whitespace( $post_meta['post_image_format_credit_link'] ) ) : ?>
									
									<a title="Author Link" href="<?php echo $post_meta['post_image_format_credit_link']; ?>" >
									
										<?php echo $post_meta['post_image_format_credit']; ?>
									
									</a>
								
								<?php else : ?> 
								
									<?php echo $post_meta['post_image_format_credit']; ?>
								
								<?php endif; ?>

							<?php else : ?>
							
								<?php echo $post_meta['post_image_format_credit']; ?>
							
							<?php endif; ?>
							
						<?php endif; ?>
				
				</span>
			
			<?php endif; ?>
			
			<!-- If editor text is enabled show text -->
			<?php if ( $post_meta['post_image_format_text'] == 'text' )  : ?>
			
				<span class="post-arrow"></span>
				
				<?php $this->_print_content(); ?>
			
			<?php endif; ?>
						
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>
<?php }

	protected function _gallery()
	{ ?>

		<?php global $post; ?>

		<?php $post_meta    = $this->template_paramaters['post_meta']; ?> 

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?>

		<article id="post-<?php the_ID(); ?>" >
				
			<?php $gallery = ( isset( $post_meta['post_gallery_format_upload'] ) ? $post_meta['post_gallery_format_upload'] : '' ); ?>
			
			<?php if ( $gallery != '' ) : ?>
			
				<div id="lf-gallery-slider-<?php echo $post->ID; ?>" class="lf-post-format-gallery">
			
					<img src="<?php echo current( $gallery ); ?>" class="lf-post-format-img" />
				
					<?php array_shift( $gallery ); ?>
				
					<?php foreach ( $gallery as $value ) : ?>
						
						<img style="display:none;" src="<?php echo $value; ?>" class="lf-post-format-img" />
						
					<?php endforeach; ?>
				
					<script>
						!function ($) { 
							$( window ).load( function () {  
								use.slider( 
									"<?php echo $post_meta['post_gallery_format_effect']; ?>", 
									"#lf-gallery-slider-<?php echo $post->ID; ?>" ); 
								});
						}(jQuery);
					</script>

				</div>
			
			<?php endif; ?>

		
			<?php if ( $post_meta['post_gallery_format_text'] == 'text' )  : ?>
			
				<span class="post-arrow"></span>
				
				<?php $this->_print_content(); ?>
			
			<?php endif; ?>
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>
<?php }

	protected function _aside()
	{ ?>

		<?php $post_helpers = $this->template_paramaters['post_helpers']; ?>

		<article id="post-<?php the_ID(); ?>" >
																
			<?php $this->_print_content(); ?>
			
			<?php $post_helpers->_show_which_categories_belongs_to(); ?>
			
		</article>
	<?php }
}

?>	