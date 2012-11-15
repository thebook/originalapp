<?php

/**
* A helper class for the post meta fields
*/
class helper_post_meta
{
	
	protected function _show_publish_date_author_and_comment_number_of_post () 
	{ ?>
		<div class="lf-time-meta-wrap">
									
			<span class="lf-meta-text" data-icon="1" aria-hidden="true">
											
				<?php the_author_link(); ?>
														
			</span>
													
			<span class="lf-meta-text-comp" data-icon="(" aria-hidden="true">
												
				<span class="lf-meta-highlight lf-next-to-icon" >
													
					<?php  printf( __('%1$s'), get_comments_number() ); ?> 
												
				</span>									
											
			</span>

			<span class="lf-meta-text-comp">
			
				<time datetime="<?php the_time('d m, Y'); ?>" pubdate><?php the_time('| d-m-Y'); ?></time>
				
			</span>
										
		</div>
	<?php }

	protected function _show_categories_and_tags_work_belong_to () 
	{?>
		<div class="lf-meta-text-tags">
				
			<span data-icon="4" aria-hidden="true"></span>
			
		</div>
		
		<div class="lf-meta-text-tags">
		
			<?php $tag_list = get_the_tag_list('', ', '); ?>
			
			<span>
									
				<?php if ($tag_list) : ?>
															
					<?php echo $tag_list . ', '; ?>
						
				<?php endif; ?>

													
				<?php if ( is_object_in_taxonomy( get_post_type(), 'category') ) : ?>

					<?php echo get_the_category_list(', ') . ';'; ?>
							
				<?php endif; ?>

			</span>
																	
			<?php edit_post_link( '', '<span class="lf-meta-edit">', '</span>' ); ?>
		
		</div>
<?php }

	public function _show_which_categories_belongs_to () 
	{ 
	
	 	( is_single() ) and $this->_show_categories_and_tags_work_belong_to(); 
 	
 	} 


	public function _show_content_meta_of_type ( $type = 'category' ) 
	{ 
		switch ($type) {

			case 'category' :

				$this->_show_categories_and_tags_work_belong_to();

			break;

			case 'time' : 

				$this->_show_publish_date_author_and_comment_number_of_post();

			break;
		}
	}
}

?>