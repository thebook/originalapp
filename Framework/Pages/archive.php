<?php ?>

<div class="contentwrap">

	<div id="homepage" class="loadpage">

		<div class="lf-core-content-full">
			
			<div class="leftinlineb hunprec">

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-full-article">
	
	<div class="lf-core-content-post-format-head-wrap">
	
		<div class="lf-core-content-post-format-head-holder-wrap">
	
			<header>
							
				<h1 class="lf-posttitle">
										
					<?php the_title(); ?>
											
				</h1>
										
			</header>									
				
		</div>
	
	</div>																			
	
	<div class="lf-post-img-text-wrap">
											
		<div class="lf-core-content-body-text">
											
			<?php the_content();?>

			<p></p>

			<h3>Last 30 Posts</h3>

			<ul><?php
				
				$r = wp_get_recent_posts( array( 'numberposts' => '30' ) );

				foreach ($r as $p ) {

					$rt = $p['post_title'];

					echo "<li><a href='".get_permalink( $p['ID'] )."' title='$rt'>$rt</a></li>";
				
				} ?></ul>

			<h3>Posts By Date</h3>

			<ul><?php wp_get_archives(); ?></ul>

			<h3>Posts By Subject</h3>

			<ul><?php wp_list_categories( array( 'title_li' => '' ) ); ?></ul>
														
		</div>
	
	</div>
	
</article>

<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>