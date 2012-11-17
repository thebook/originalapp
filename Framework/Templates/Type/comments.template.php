<?php 

/**
* A comment generating template class
*/
class template_comments extends branch_content
{
	function __construct($template_paramaters) 
	{ ?>
		<?php $this->_init_post_object(); ?>
		
		<div class="lf-comments-wrap">	
			
			<?php $this->_get_every_template_part_and_pass_paramaters($template_paramaters); ?>
			
		</div>
<?php }

	public function _check_if_comments_are_password_protected ()
	{ ?>
		
		<?php if ( post_password_required( $this->template_paramaters['post_object']->ID ) ) : ?>
				
			<p> <?php _e('Sorry, but a password is required to see the comments', 'liquidflux');?></p>
			
			<?php echo get_the_password_form(); ?>
		
			<?php return; ?> 

		<?php endif; ?>
	
<?php }

	protected function _generate_disclaimer_and_comments ($disclaimer_messages)
	{ ?>
		
		<p class="lf-comment-header-counter"> <?php echo get_comments_number( $this->template_paramaters['post_object']->ID ); ?></p>
		
		<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
			<p class="lf-comment-header-text"><?php echo $disclaimer_messages['comments_are_closed_message']; ?></p>
		
		<?php elseif ( have_comments()) : ?>
		
			<p class="lf-comment-header-text"><?php echo $disclaimer_messages['comments_message']; ?></p>
		
			<?php wp_list_comments(array( 'callback' => array($this, '_single_comment_generator' ) )); ?>	
		
		<?php else : ?>
			
			<p class="lf-comment-header-text"><?php echo $disclaimer_messages['no_comments_message']; ?></p>
		
		<?php endif; ?>
		
<?php }

	public function _single_comment_generator ( $comment_id, $passed_paramaters, $current_depth)
	{ ?>
		
		<?php $GLOBALS['comment'] = $comment_id; ?>
		
		<?php $comment_publish_date = get_comment_date('d/m/Y') .' | '. get_comment_time(); ?>
   			
		<li class="lf-comment-article <?php echo $current_depth; ?>" id="comment-of-the-number-<?php comment_ID(); ?>"> 
				
			<div class="lf-comment-inner-wrap">
				
				<div class="lf-comment-avatar">
											
					<?php echo get_avatar( $comment_id, '40' ); ?>
																											
				</div>	
				
				<address class="lf-author">

					<?php echo comment_author_link(); ?>
					
				</address>
														
				<time class="lf-comment-date" datetime="<?php echo $comment_publish_date; ?>" pubdate>
													
					<?php echo $comment_publish_date; ?>
													
				</time>
				
				<?php if ( $current_depth < 5 ) : ?>
										 						
					<span class="lf-reply" title="Reply to this comment">

						<?php comment_reply_link(array( 'depth' => $current_depth, 'max_depth' => 5, 'reply_text' => 'Reply', 'respond_id' => 'lf-comment-form-wrap' ), $comment_id ); ?>
					
					</span>
				
				<?php endif; ?>
					
				<?php lf_comment_edit_link(); ?>
								
				<div id="comment-<?php comment_ID(); ?>" class="lf-comment-text">
																						
					<?php comment_text(); ?>
																												
				</div>
			
			</div>
				
		<!-- </li> a closing li tag would go here, but is ommited since wordpress comments close themselves  -->
<?php }
	
	protected function _generate_comment_form ($form_params)
	{ ?>
		<div id="lf-comment-form-wrap" class="lf-comment-form-wrap"><?php 
			comment_form( 
				array( 		
					'comment_notes_after'  => '',
					'comment_notes_before' => '',
					'title_reply'          => "{$form_params['title']}",
					'comment_field'        => '<textarea id="comment" class="lf-comment-form-textarea" name="comment" aria-required="true" rows="10" cols="80"></textarea>' 
					)); 			
	  ?></div>	
<?php }
}

?>		