<?php 

/**
* A comment generating template class
*/
class template_comments extends branch_content
{
	function __construct($template_paramaters) 
	{ ?>
		<?php $this->_init_post_object(); ?>

		<?php $this->_init_helpers(); ?>
		
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
		
		<?php $comment_publish_date = get_comment_date('j/n/Y/G/i/s'); ?>

		<?php $gravatar = $this->_check_what_type_comment_id_is_and_make_an_email_string($comment_id); ?>
   			
		<li class="lf-comment-article <?php echo $current_depth; ?>" id="comment-of-the-number-<?php comment_ID(); ?>"> 
				
			<div class="comment">
				
				<div 	id="lf-gravatar-<?php comment_ID(); ?>" 
						onmouseover=""
					 	class="lf-comment-avatar">
											
					<?php echo get_avatar( $comment_id, '36' ); ?>
					
					<div style="display: none;" class="lf-hovercard hovercard-for-<?php echo $gravatar; ?>">
						<span class="post-hover-arrow"></span>
					</div>

					<script>
						!function ($) { 
							$(document).ready( 
								function () {
									comment.gravatar_hovercard({
										hash_link : '<?php echo $gravatar; ?>', 
										id        : 'lf-gravatar-<?php comment_ID(); ?>'
									});
								});
						}(jQuery);
					</script>	

				</div>	

				
				<address class="lf-author">

					<?php echo comment_author_link(); ?>
					
				</address>

				<?php if ( $current_depth > 1 ) : ?>

					<span class="lf-reply"></span>

				<?php endif; ?>
														
				<time class="lf-comment-date" datetime="<?php echo $comment_publish_date; ?>" pubdate>
													
					&middot; <?php $this->template_paramaters['post_helpers']->how_many_days_ago($comment_publish_date); ?>
													
				</time>
										 												
				<div id="comment-<?php comment_ID(); ?>" class="lf-comment-text">
																						
					<?php comment_text(); ?>

					<p class="lf-comment-options">
						
						<?php comment_reply_link(array( 'depth' => $current_depth, 'max_depth' => 5, 'reply_text' => 'Reply', 'respond_id' => 'lf-comment-form-wrap' ), $comment_id ); ?>

						<?php lf_comment_edit_link(''); ?>

					</p>
																												
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

	protected function _check_what_type_comment_id_is_and_make_an_email_string ($comment_id)
	{
		
		if ( is_numeric($comment_id) ) :

			$get_user = get_userdata((int)$comment_id);

			($get_user) and $email = $get_user->user_email;
		 
		elseif ( is_object($comment_id) ) :
		

		    if ( !empty($comment_id->user_id) ) :
		    
		        $get_user = get_userdata((int)$comment_id->user_id);
		        
		        ( $get_user ) and $email = $get_user->user_email;
		                    
		    elseif ( !empty($comment_id->comment_author_email) ) :
		        
		        $email = $comment_id->comment_author_email;
		    
		    endif;

		else :

			$email = $comment_id;

		endif; 
		
		return md5( strtolower( trim($email) ) );
	}
}

?>		