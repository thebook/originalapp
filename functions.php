<?php 

define('FRAMEWORK',    TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('SCRIPTS', get_template_directory_uri() . '/Framework/scripts');


include FRAMEWORK . '/include.php'; 

include FRAMEWORK . '/Helpers/include.php';

include FRAMEWORK . '/Shortcodes/include.php';

include FRAMEWORK . '/Options/include.php';

include FRAMEWORK . '/Templates/include.php';

new register_scripts;
	
new admin( 
	array(
		'id' => 'lf-admin',
		'class' => 'lf-admin-td', 
		'default_type' => 'option',
		'definition' => FRAMEWORK .'/Definitions/admin.definition.php'
		));

new meta(
	array( 
		'id' => 'lf-post-meta',
		'class' => 'lf-admin-post-meta-td',
		'default_type' => 'meta', 
		'definition' => FRAMEWORK .'/Definitions/meta_boxes.definition.php'
		));

new leaf_slide(
	array(
		'id' => 'lf-post-meta',
		'class' => 'lf-admin-post-meta-td',
		'default_type' => 'meta', 
		'definition' => FRAMEWORK .'/Definitions/slider.definition.php'
		));


function liquidflux_comments ($comment, $args, $depth) {	
	
	$GLOBALS['comment'] = $comment; 
	
	extract( $args, EXTR_SKIP ); ?>
   			
	<li class="lf-comment-article-wrap <?php echo $depth; ?>">	
			
		<div class="lf-comment-article-inner" id="comment-wrap<?php comment_ID() ?>">
		
			<div class="lf-comment-article-inner-wrap"> 
			
			<div id="comment-<?php comment_ID(); ?>" class="lf-comment-article-avatar-wrap">
										
					<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
																										
			</div>	
	
			<div class="lf-comment-article-text">
			
				<address class="lf-comment-article-author-link"> 
											
					<?php echo comment_author_link(); ?> 
												
				</address>
														
				<time class="lf-comment-article-time-meta" datetime="<?php printf( __('%1$s | %2$s'), get_comment_date('d m Y'), get_comment_time() ) ?>" pubdate>
													
					<?php printf( __('%1$s at %2$s'), get_comment_date(), get_comment_time() ) ?>
													
				</time>
				
				<span class="lf-comment-links-wrap">
					&#183; 
				
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => $args['reply_text'] ))); ?>
					
				<?php edit_comment_link( __('c'),'  ',''); ?>
	
				</span>
							
				<div class="lf-comment-article-comment">
																						
					<?php comment_text(); ?>
																												
				</div>
																	
			</div>
		
		</div>
		
	</div>
	
<?php	}	

?>