<?php

function _lf_time_meta() { ?>

	<div class="sidesix">
								
		<span class="lf-meta-text" data-icon="1" aria-hidden="true">
										
			<?php the_author_link(); ?>
													
		</span>
												
		<span class="lf-meta-text-comp" data-icon="(" aria-hidden="true">
											
			<span class="lf-meta-highlight lf-next-to-icon" >
												
				<?php  printf( __('%1$s'), get_comments_number() ); ?> 
											
			</span>									
										
		</span>

		<span class="lf-meta-text-comp">
		
			<time datetime="<?php the_time('d m, Y'); ?>" pubdate><?php the_time('| d-m-Y'); ?></time>
			
		</span>
									
	</div>

<?php }


function _lf_category_meta() {	?>


	<div class="lf-meta-text-tags">
			
		<span data-icon="4" aria-hidden="true"></span>
		
	</div>
	
	<div class="lf-meta-text-tags">
	
		<?php $tag_list = get_the_tag_list('', ', '); ?>
		
		<span>
								
			<?php if ($tag_list) : ?>
														
				<?php echo $tag_list . ', '; ?>
					
			<?php endif; ?>

												
			<?php if ( is_object_in_taxonomy( get_post_type(), 'category') ) : ?>

				<?php echo get_the_category_list(', ') . ';'; ?>
						
			<?php endif; ?>

		</span>
																
			<?php edit_post_link( '', '<span class="lf-meta-edit">', '</span>' ); ?>
	
	</div>


<?php }

function lf_cat_single() {

	if ( is_single() ) {

		_lf_category_meta();

	}

}


function lf_content_meta( $type = 'cat' ) { 

	switch ($type) {

		case 'cat' :

		_lf_category_meta();

		break;

		case 'meta' : 

		_lf_time_meta();

		break;

	}

}

?>