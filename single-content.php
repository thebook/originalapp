<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
	
*/ ?>


<div class="contentwrap">

	<div id="homepage" class="loadpage">
	
<?php 

	lf_core_sidebar_generate( 'left' );
			
?>
		
	<div class="lf-core-content-<?php lf_content_state_class_echo(); ?>">
										
		<div class="leftinlineb hunprec">
				
		<?php while (have_posts()) : the_post(); ?>
	
<?php 

	$format = get_post_format();
	
	if ( $format === false ) { 
	
		$format = 'standard';
		
	}
		
	get_template_part( 'content-format', $format );
		
?>
				
	<!-- Author Description -->							
	<footer class="lf-article-author-wrap">
	
		<?php if ( get_the_author_meta('description')) : ?>
		
		<div class="lf-article-author-inner-wrap-box">
								
			<div class="lf-article-author-text-wrap">
									
				<h3 class="lf-article-author-box-h3">
											
					<?php echo get_the_author_link(); ?>
										
				</h3>									
									
				<p class="lf-article-author-box-text" >
											
					<?php the_author_meta('description') ?>
												
				</p>

			</div>
									
			<div class="lf-article-author-img-wrap">
								
				<?php echo get_avatar( get_the_author_meta('user_email'));?>
									
			</div>
					
		</div>
		
		<?php endif; ?>
		
		<?php dynamic_sidebar( 'lf-content-default-single-widget-area' ); ?>
							
	</footer>
							
	
								
		<?php endwhile; ?>
						
			<!-- Comments -->
				
				<?php comments_template('', true); ?>												
					
			</div>
					
		</div>
		
<?php 
		
	lf_core_sidebar_generate( 'right' );

?>
	
	</div>

</div>	
	
			

