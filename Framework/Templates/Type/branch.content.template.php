<?php 

/**
* branches the alpha tree template class to create a basis to content templates
*/
class branch_content extends alpha_tree_template
{
	
	function __construct($template_parts_to_get)
	{ ?>
		<div class="liquidflux-content">

			<?php $this->_get_every_template_part_and_pass_paramaters($template_parts_to_get); ?>

		</div>

<?php }

	protected function _content ($template_params)
	{ ?>
		<div class="liquidflux-post-<?php echo $template_params['size']; ?>">
											
			<?php $this->_get_every_template_part_and_pass_paramaters($template_params['template_parts_to_get']); ?>

		</div>
<?php }

	protected function _sidebar ($sidebar_name)
	{ ?>
		<aside class="liquidflux-aside">
			
			<?php dynamic_sidebar($sidebar_name); ?>

		</aside>
	<?php }

	protected function _init_helpers ()
	{
		$this->template_paramaters['post_helpers'] = new produce_helper; 
	}

	protected function _init_post_meta ()
	{
		global $post;

		$this->template_paramaters['post_meta'] = get_post_meta( $post->ID, 'main_meta', true ); 
	}

	protected function _print_content ()
	{ ?>
		<div class="lf-post-img-text-wrap">
					
			<div class="lf-core-content-body-text">
				
				<h3 class="lf-post-format-media-title"> 
						
					<?php $this->template_paramaters['post_helpers']->lf_title(); ?> 
							
				</h3>
						
				<?php $this->template_paramaters['post_helpers']->lf_content();?>
																																				
			</div>
		
		</div>
	<?php }

	protected function _author_box ()
	{ ?>
		<?php if ( get_the_author_meta('description') ) : ?>
						
			<div class="lf-article-author-inner-wrap-box">
									
				<div class="lf-article-author-text-wrap">
										
					<h3 class="lf-article-author-box-h3">
												
						<?php the_author_meta('user_url'); ?>
											
					</h3>									
										
					<p class="lf-article-author-box-text" >
												
						<?php the_author_meta('description'); ?>
													
					</p>

				</div>
										
				<div class="lf-article-author-img-wrap">
									
					<?php echo get_avatar( get_the_author_meta('user_email') );?>
										
				</div>
						
			</div>
			
		<?php endif; ?>		
<?php }
	
	protected function _comments ()
	{
		comments_template();
	}
	
	protected function _inner_sidebar ($sidebar_name)
	{
		dynamic_sidebar($sidebar_name);
	}
}

?>