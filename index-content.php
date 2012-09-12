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
										
			<div class="leftinlineb">

					<?php while (have_posts()) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">
						
							<!-- Title -->
							<header>
					
								<h1 class="lf-posttitle">
								
									<a 	href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'liquidflux' ), the_title_attribute( 'echo=0' ) ); ?>">							
								
										<?php the_title(); ?>
										
									</a>
									
								</h1>
								
							</header>	
							
							<!-- Meta -->
							<div class="sidesix">
					
								<span class="lf-meta-text">
									
									Posted By <?php the_author_link(); ?> on
						
										<time datetime="<?php the_time('d m, Y'); ?>" pubdate><?php the_time('j-F-Y'); ?></time>
							
								</span>
						
								<?php if ( get_comments_number() > 1 ) : ?>
								
									<span class="lf-meta-text-comp">
									
										<span class="lf-meta-highlight">
										
											<?php  printf( __('%1$s'), get_comments_number() ); ?> 
									
										</span>
									
											comments									
								
									</span>
							
								<?php else : ?>
								
									<span class="lf-meta-text-comp">
									
										<span class="lf-meta-highlight">
										
											<?php  printf( __('%1$s'), get_comments_number() ); ?> 
									
										</span>
									
											comment
								
									</span>
								
								<?php endif; ?>	
							
							</div>
							
							<!-- Body -->				
							<div class="theexcerpt ">
							
								<div class="uptwo">
								
									<p class="lf-featured-image">
									
										<?php the_post_thumbnail(); ?>
									
									</p>
								
									<?php lf_excerpt_more(); ?>
						
								</div>																						
							
							</div>
					
							<div class="lf-meta-text-tags">
						
								
								
<?php					

	$tag_list = get_the_tag_list('',', ');
						
		if ($tag_list) { 
										
			$postedunder_text = __('Posted Under<em>&nbsp;%1$s</em>; &nbsp;Tags:&nbsp;(%2$s); <a href="%3$s">&nbsp;Bookmark;&nbsp;</a>', 'liquidflux');
										
		}
									
		elseif( is_object_in_taxonomy(get_post_type(), 'category') ) { 
									
			$postedunder_text = __('Posted Under<em>&nbsp;%1$s</em>; <a href="%3$s">&nbsp;Bookmark;&nbsp;</a>', 'liquidflux');
										
		}
									
		else { 
									
			$postedunder_text = __('<a href="%3$s">&nbsp;Bookmark;&nbsp;</a>', 'liquidflux');
										
		}
													
		printf( 
			$postedunder_text,
			get_the_category_list(', '),
			$tag_list,
			get_permalink() );
													
		edit_post_link( __('edit', 'liquidflux'));	
		
?>
								
							</div>
					
							<div class="lf-article-bottom-border"> 
							
								&nbsp; 
								
							</div>
							
						</article>
				
					<?php endwhile; ?>
					
					<?php lf_not_found_generate( 'else' ); ?>
					
				<div class="lf-pagnation">
				
					<?php pagnation();?>
					
				</div>
			
			</div>
			
		</div>
<?php 
		
	lf_core_sidebar_generate( 'right' );	

?>

	</div><!-- loadpage-->
	
</div><!-- contentwrap -->
