<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0	
*/ ?>


<div class="contentwrap">

	<div id="homepage" class="loadpage">

	<?php lf_sidebar( 'left' ); ?>
			
	<div class="lf-core-content-<?php lf_content_state_class_echo(); ?>">
										
		<div class="leftinlineb hunprec">
				
		<?php while (have_posts()) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">																				
			<div class="lf-post-img-text-wrap">
													
				<div class="lf-core-content-body-text">

					<h3 class="lf-post-format-media-title"> 
						
						<?php the_title(); ?> 
							
					</h3>
													
					<?php the_content();?>

				</div>

			</div>

		</article>
														
		<?php endwhile; ?>
						
			<?php comments_template('', true); ?>												
					
		</div>
					
	</div>
		
	<?php lf_sidebar( 'right' ); ?>
	
	</div>

</div>	