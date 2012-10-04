<article id="post-<?php the_ID(); ?>" >
	
	<div class="lf-core-content-post-format-head-wrap">
	
		<div class="lf-core-content-post-format-head-holder-wrap">
	
			<header>
							
				<h1 class="lf-posttitle">
										
					<?php the_title(); ?>
											
				</h1>
										
			</header>	
									
			<?php lf_content_meta( 'meta' ); ?>
				
		</div>
	
		<!--<div class="lf-core-content-post-format-icon-wrap"><div class="lf-core-content-post-format-icon-hold"></div></div> -->
	
	</div>
												
	<?php lf_cat_single(); ?>
								
	<?php lf_featured_img(); ?>
	
	<div class="lf-post-img-text-wrap">
											
		<div class="lf-core-content-body-text">
											
			<?php lf_content();?>
														
		</div>
	
	</div>
	
</article>