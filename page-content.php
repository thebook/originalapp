<?php 
/*	
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
	
*/ ?>

<?php breadcrumbs('lf-main-navigation-style'); ?>

<div class="contentwrap">

	<div id="homepage" class="loadpage">
	
		<div class="lf-core-content-<?php lf_content_state_class_echo(); ?>">
										
			<div class="leftinlineb hunprec">
				
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
								
									<?php the_content(' <p class="lf-button">Read More</p>' );?>
						
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
				
							<!-- Author Description -->	
							<?php if ( get_the_author_meta('description')) : ?>
							
							<footer class="lf-article-author-box ">							
							
							<?php echo get_avatar( get_the_author_meta('user_email'));?>
								
								<h3 class="lf-article-author-box-h3">
									
									<?php echo get_the_author_link(); ?>
								
								</h3>									
							
								<p class="lf-article-author-box-text" >
								
									<?php the_author_meta('description') ?>
									
								</p>																			
							
							</footer>
							
							<?php endif; ?>
							
							<div class="lf-comment-border">
							
							</div>
					
						</article>	
						
					<?php endwhile; ?>
						
						<!-- Comments -->
						<?php comments_template('', true); ?>												
					
			</div>
					
		</div>
	
	</div>

</div>	
	
			

