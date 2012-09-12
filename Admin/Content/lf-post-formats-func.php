<?php 

function lf_generate_post_format( $id ) { 

	$format = get_post_format( $id );
	
	echo $format;
	
	if ( $format == 'aside' ) { 
	
?>
							
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
	
<?php

	}
	
	elseif ( $format == 'gallery' ) {
	
	
	}
	
	elseif ( $format == 'image' ) {
	
	
	}
	
	elseif ( $format == 'quote' ) {
	
	
	}
	
	elseif ( $format == 'status' ) { 
	
	
	}
	
	elseif ( $format == 'video' ) {
	
	
	}
	
	elseif ( $format == 'audio' ) {
	
	
	}
	
	else { 
	
	
	}
	
	
}

?>