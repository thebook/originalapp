
<?php $main_opt = get_option( 'main_options' ); ?>

	<?php if ( post_password_required() ) : ?>
	
		<div class="psidetwo tborlight leftblock">
			
			<p>
				
				<?php _e('Password Required To See Comments', 'liquidflux');?>
												
			</p>
		
		</div>
	
		<?php return; ?> 

	<?php endif; ?>
	
	<?php if ( have_comments()) : ?>
	
		<div class="lf-comments-wrap">			
			
			<div class="lf-comments-header-wrap">
								
				<header>
										
					<h3 class="lf-comment-header-counter">
											
						<?php comments_number( __('% Comments, liquidflux'), __('% Comments, liquidflux'), __('% Comments, liquidflux') ); ?>
										
					</h3>
					
					<h3 class="lf-comment-header-disclaimer"> 
					
						<?php if ( isset( $main_opt['comments_disclaimer'] ) ) : ?>
						
							<?php echo $main_opt['comments_disclaimer']; ?>
						
						<?php else : ?>
	
							Comments are optional and this piece of text is editable. :3
	
						<? endif; ?>
					
					</h3>
								
				</header>
							
			</div>
			
			<!-- Comments Section -->
			<?php wp_list_comments('type=comment&callback=liquidflux_comments&max_depth=8&avatar_size=40&reply_text=Reply'); ?>
		
		</div>
																																							
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	
		<div class="tborlight leftblock blogwidth puptwo centertext">
			
			<p> 
				
				<?php _e('So sorry but comments are closed', 'liquidflux');?> 
			
			</p>
				
		</div>
		
	<?php endif; ?>									
				
	<!-- Comment Form -->
	<div class="lf-comment-form-wrap">
	
		<?php 	

			comment_form( 
				array( 
					'fields' => 
						apply_filters( 'comment_form_default_fields', 
							array( 
								'author' => '<div>' . '<input id="author" class="lf-comment-form-input-text" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="Your Name" required /></div>',
								'email'  => '<div><label for="email">' . '<input id="email" class="lf-comment-form-input-text" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="Your e-mail" required /></div>',
								'url'    => '<div><label for="url">' . '<input id="url" class="lf-comment-form-input-text" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Your Website " /></div>' ) ),
					'comment_notes_after' => '',
					'comment_notes_before' => '',
					'title_reply' => 'Leave A Comment.',
					'comment_field' => '<textarea id="comment" class="lf-comment-form-textarea" name="comment" aria-required="true" rows="10" cols="50"></textarea>' ) ); 
			
		?>
	</div>