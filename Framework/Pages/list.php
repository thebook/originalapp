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
	
		<?php $q = new WP_Query( 'posts_per_page=-1' ); ?>

		<?php while( $q->have_posts() ) : $q->the_post(); ?>

			<?php $format = get_post_format(); ?>
			
			<?php ( $format === false ) and $format = 'standard'; ?>
				
			<?php get_template_part( 'content-format', $format ); ?>
												
		<?php endwhile; ?>
					
		</div>
					
	</div>
		
	<?php lf_sidebar( 'right' ); ?>
	
	</div>

</div>	