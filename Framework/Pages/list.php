<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0	
*/ ?>

<?php $page = ( isset($_GET['paged']) ? $_GET['paged'] : 0 ); ?>

<div class="contentwrap">

	<div id="homepage" class="loadpage">

	<?php lf_sidebar( 'left' ); ?>
			
	<div class="lf-core-content-<?php lf_content_state_class_echo(); ?>">
										
		<div class="lf-core-content-wrap">
	
		<?php $q = new WP_Query( "posts_per_page=2&paged=$page" ); ?>
	
		<?php while( $q->have_posts() ) : $q->the_post(); ?>

			<?php $format = get_post_format(); ?>
			
			<?php ( $format === false ) and $format = 'standard'; ?>
				
			<?php get_template_part( 'content-format', $format ); ?>
												
		<?php endwhile; ?>
					
		</div>

		<?php $p = new pagnation($q->max_num_pages); ?> 

		<?php $p->pag(); ?>
					
	</div>
		
	<?php lf_sidebar( 'right' ); ?>
	
	</div>

</div>	