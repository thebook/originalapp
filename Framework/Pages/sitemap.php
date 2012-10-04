<?php ?>

<div class="contentwrap">

	<div id="homepage" class="loadpage">

		<div class="lf-core-content-full">
			
			<div class="leftinlineb hunprec">

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-full-article">																				
	
	<div class="lf-post-img-text-wrap">
											
		<div class="lf-core-content-body-text">

			<h3 class="lf-post-format-media-title"> 
				
				<?php the_title(); ?> 
					
			</h3>
								
			<?php the_content();?>

			<?php endwhile; ?>
			
			<p></p>

			<h3>Pages</h3>

			<ul><?php wp_list_pages( array( 'title_li' => '' ) ); ?></ul>

			<h3>Categories</h3>

			<ul><?php wp_list_categories( array( 'title_li' => '' ) ); ?></ul>

			<h3>Posts By Category</h3>

			<?php lf_cat_posts(); ?>

		</div>
	
	</div>
	
</article>

			</div>
		</div>
	</div>
</div>