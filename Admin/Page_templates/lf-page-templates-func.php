<?php

function lf_page_generate_sidebars( $sidebar ) {

	if ( $sidebar == 'onesidebarleft' 
		|| $sidebar == 'onesidebarright' ) { 
			
			echo '<aside class="lf-core-content-aside">';
	
			dynamic_sidebar( 'lf-content-sidebar-first' );

			echo '</aside>';
			
		}
			
	elseif ( $sidebar == 'twosidebarleft' 
			|| $sidebar == 'twosidebarright' ) { 
			
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-first' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-second' );

				echo '</aside>';
			
			}
			
	elseif ( $sidebar == 'threesidebarleft' 
			|| $sidebar == 'threesidebarright' ) { 
			
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-first' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-second' );

				echo '</aside>';
				
				echo '<aside class="lf-core-content-aside">';
	
				dynamic_sidebar( 'lf-content-sidebar-third' );

				echo '</aside>';
			
			}
			
}

function lf_page_generate( $sidebar, $side ) { 

?>

<div class="contentwrap">

	<div id="homepage" class="loadpage">
	
<?php

	breadcrumbs('lf-main-navigation-style');
		
	if ( $sidebar == "onesidebarleft" 
		|| $sidebar == "twosidebarleft" 
		|| $sidebar == "threesidebarleft" ) { 
				
			lf_page_generate_sidebars( $sidebar );
				
		}
		
?>

		<div class="lf-core-content-<?php lf_content_state_class_echo(); echo "-page-$side" ?>">
										
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
								
									<?php the_content();?>
						
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
		
<?php 
				
	if ( $sidebar == "onesidebarright" 
		|| $sidebar == "twosidebarright" 
		|| $sidebar == "threesidebarright" ) { 
				
			lf_page_generate_sidebars( $sidebar );
				
		}	

?>
	
	</div>

</div>	
	
<?php

}

function lf_excerpt_more() {

	$main_opt = get_option( 'main_options' );
	
	$read_more = $main_opt['more_button_read_more_text'];
	
	if ( $read_more == null ) {
	
		the_content("<p class='lf-button'>Read More</p>");
	
	}
	
	else {

		the_content("<p class='lf-button'>$read_more</p>");
	
	}

}

function lf_excerpt_more_filter() { 

	$main_opt = get_option( 'main_options' );
	
	$read_more = $main_opt['more_button_read_more_text'];
	
	if ( $read_more == null ) {
	
		return '<p class="lf-button"><a href=' . get_permalink() . ' >Read More</a></p>';
		
	}
	
	else {
	
		return "<p class='lf-button'><a href=" . get_permalink() . " >$read_more</a></p>";
	
	}

}

add_filter( 'excerpt_more', 'lf_excerpt_more_filter' );
/*
function lf_portolfio_meta_content() {

	global $post;
	
	$main_meta = get_post_meta( $post->ID, 'main_meta', true );
	
		echo '<table class="lf-option-table">';
		
		echo '<tbody>';
		
		echo '<tr>';
		
		echo '<th>';
		
		echo 'Set Portfolio Sate';
		
		echo '</th>';
		
		echo '<td>';
		
		echo '<div id="lf_portfolio_state_opt" class="lf_admin_core_input_wrap">';
		
		echo '<select name="main_meta[portfolio_state]" class="lf_admin_core_input_select" >';
		
		echo '<option value="imageonly" '. selected( $main_meta[portfolio_state], 'imageonly', true ) .' > Stripped </option>';
		
		echo '<option value="posttitle" '. selected( $main_meta[portfolio_state], 'posttitle', true ) .' > With Post Title </option>';
		
		echo '<option value="text" '. selected( $main_meta[portfolio_state], 'text', true ) .' > With Excerpt </option>';
		
		echo '<option value="full" '. selected( $main_meta[portfolio_state], 'full', true ) .' > With Title & Excerpt </option>';
		
		echo '</select>';
		
		echo '</div>';
		
		echo '</td>';
		
		echo '</tr>';
		
		echo '<tr>';
		
		echo '<th>';
		
		echo 'Set Post Number';
		
		echo '</th>';
		
		echo '<td>';
		
		echo '<div id="lf_portfolio_post_number_opt" class="lf_admin_core_input_wrap">';
		
		echo '<input type="text" name="main_meta[portfolio_post_number]" class="lf_admin_core_input_select" value="'. $main_meta['portfolio_post_number'] .'" >';
		
		echo '</div>';
		
		echo '</td>';
		
		echo '</tr>';
		
		echo '<tr>';
		
		echo '<th>';
		
		echo 'Set Filter Sate';
		
		echo '</th>';
		
		echo '<td>';
		
		echo '<div id="lf_portfolio_filter_sate_opt" class="lf_admin_core_input_wrap">';
		
		echo '<select type="text" name="main_meta[filter_state]" class="lf_admin_core_input_select">';
		
		echo '<option value="on" '. selected( $main_meta['filter_state'], 'on', true ) .' >Filter Enabled</option>';
		
		echo '<option value="off" '. selected( $main_meta['filter_state'], 'off', true ) .' >Remove Filter</option>';
		
		echo '</select>';
		
		echo '</div>';
		
		echo '</td>';
		
		echo '</tr>';
		
		echo '<tr>';
		
		echo '<th>';
		
		echo '<p>Set Shown Categories</p><p><i>( Hold down "control" to multi select )</i></p> ';
		
		echo '</th>';
		
		echo '<td>';
		
		echo "<div id='lf_portfolio_category_select_opt' class='lf_admin_core_input_select_multiple-wrap'>";
							
		echo '<select name="main_meta[portfolio_show_categories][]" class="lf_admin_core_input_select_multiple" multiple>';
		
		foreach ( ( get_categories() ) as $category ) {
				
			echo '<option value="'. $category->cat_ID  .'"';
			
			if ( $main_meta['portfolio_show_categories'] != null ) {
			
				foreach ( $main_meta['portfolio_show_categories'] as $value ) {
				
					if ( $value == $category->cat_ID ) {
					
						echo ' selected="selected" ';
					
					}
				
				}
			
			}
			
			echo '>'. $category->name .'</option>';
		
		}
				
		echo '</select>';
		
		echo '<div>';
		
		echo '</td>';
		
		echo '</tr>';
		
		echo '</tbody>';
		
		echo '</table>';

}

function lf_save_portfolio_meta() {

	global $post; 	
									
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
								
			return;
						
		if ( !current_user_can('edit_post') )
									
			return;
			
		$main_meta = $_POST['main_meta'];
		
		update_post_meta( $post->ID, 'main_meta', $main_meta );

}

function lf_portfolio_meta_boxes() {

	global $post;
	
	$portfolio = get_post_meta( $post->ID, '_wp_page_template', true );
	
	if ( $portfolio == 'portfolio-full.php'
		|| $portfolio == 'portfolio-two.php' 
		|| $portfolio == 'portfolio-three.php' 
		|| $portfolio == 'portfolio-four.php' 
		|| $portfolio == 'portfolio-right-sidebar.php' 
		|| $portfolio == 'portfolio-left-sidebar.php' 
		) { 

		add_meta_box( 'lf_portfolio_meta_box',
					  __( 'Portfolio', 'liquidflux' ),
					  'lf_portolfio_meta_content',
					  'page',
					  'normal',
					  'high' );
				  
	}

}

add_action( 'add_meta_boxes', 'lf_portfolio_meta_boxes' );

add_action('save_post', 'lf_save_portfolio_meta' );

function lf_portfolio_filter( $name = null, $type = null, $count = null, $cat = null ) {

	$main_opt = get_option( 'main_options' );

	if ( $type == 'post' ) {
	
		foreach ( ( get_the_category() ) as $category ) {
		
			echo $name . $category->slug . '-category ';	
		
		}
		
		if ( has_tag() ) {
	
			foreach ( ( get_the_tags() ) as $tag ) {
		
				echo $name . $tag->slug . '-tag ';	
		
			}
		
		}
	
	}
	
	if ( $type == 'filter-bar' ) {
		
		$lf_query = new WP_Query( 
								array( 
									'post_type' => 'post', 
									'category__in' => $cat,
									'posts_per_page' => $count ) );
									
		$filters =array( 'values' => array(), 'names' => array()  );
										
		while ( $lf_query->have_posts() ) : $lf_query->the_post();
			
		foreach ( ( get_the_category() ) as $category ) {
		
			$filter = $name . $category->slug . '-category ';
			
			$filtername = $category->cat_name;
			
			$filters['values'][] = $filter;
			
			$filters['names'][] = $filtername;
		
		}
		
		if ( has_tag() ) {
		
			foreach ( ( get_the_tags() ) as $tag ) {
		
				$filter = $name . $tag->slug . '-tag ';	
				
				$tagname = $tag->name;
				
				$filters['values'][] = $filter;
				
				$filters['names'][] = $tagname;
		
			}
			
		}
		
		endwhile;
		
		
		$filters['values'] = array_unique( $filters['values'] );
		
		$filters['names'] = array_unique( $filters['names'] );
		
		
		echo '<div class="lf-portfolio-filter-bar lf-portfolio-filter-bar-hook">';
		
		echo '<div class="lf-portfolio-filter-text-info">';
		
		if ( $main_opt['portfolio_filter_text'] == null ) {
		
			echo 'Filter :';
		
		}
		
		else {
		
			echo $main_opt['portfolio_filter_text'];
		
		}
		
		echo '</div>';
		
		foreach ( $filters['values'] as $index => $value ) {
		
			echo '<div class="lf-portfolio-filter-text">';
			
			echo '<div class="lf-portfolio-filter-hidden">';
			
			echo $value;
			
			echo '</div>';
			
			echo $filters['names'][$index];
			
			echo '</div>';
		
		} 
		
		echo '</div>'; 
		
	}

}

function lf_portfolio_generate_post( $state = 'imgonly' ) { 

?>

	<div class="lf-portfolio-piece-wrap lf-portfolio-filter-piece <?php 
	
		lf_portfolio_filter( 'lf-portfolio-', 'post' );
		
	?>">
		
		<?php if ( $state == 'posttitle' || $state == 'full' ) : ?>
		
		<header>
						
			<h1 class="lf-portfolio-posttitle">
										
				<a 	href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'liquidflux' ), the_title_attribute( 'echo=0' ) ); ?>">							
										
					<?php the_title(); ?>
												
				</a>
											
			</h1>
									
		</header>
		
		<?php endif; ?>
								
		<div class="uptwo">
									
			<p class="lf-featured-image">
			
				<a href="<?php the_permalink(); ?>">
				
					<?php the_post_thumbnail(); ?>
				
				</a>
				
				<span class="lf-featured-image-opt">	
				
					<span class="lf-featured-image-opt-square-big">
					
						<span class="lf-featured-image-opt-square-small">
					
						</span>
					
					</span>
					
				</span>	
				
			</p>
										
<?php 

	if ( $state == 'text' || $state == 'full' ) {

		the_excerpt(); 
		
	}
	
?>
							
		</div>
		
<?php

	if ( $state == 'text' || $state == 'full' ) {
	
	echo '<div class="lf-meta-text-tags">';
												
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
		
	echo '</div>';
	
	}
		
?>
														
	</div>
	
<?php 

}

function lf_portfolio_generate( $width = null, $grids = null, $sidebar = null ) { 
	
	global $post;
	
	$main_meta = get_post_meta( $post->ID, 'main_meta', true );

	$count = $main_meta['portfolio_post_number'];
	
	$cats = $main_meta['portfolio_show_categories'];
	
	if ( $count == null ) {
		
		$count = 1;
	
	}

	$lf_query = new WP_Query( 
							array( 
								'post_type' => 'post',
								'category__in' => $cats,
								'posts_per_page' => $count / $grids ) );
								
	echo '<div class="contentwrap">';

	echo '<div id="homepage" class="loadpage">';
	
	breadcrumbs('lf-main-navigation-style');
	
	if ( $sidebar == 'left' ) {
	
		echo '<aside class="lf-core-content-aside">';
	
		dynamic_sidebar( 'lf-content-sidebar-first' );

		echo '</aside>';
	
	}
		
	echo "<div class='lf-core-content-$width'>";
	
	echo '<div class="leftinlineb">';
	
	echo '<div class="lf-portfolio-desc">';
	
	while ( have_posts()) : the_post(); 
	
		echo '<div class="lf-portfolio-desc-title">';
		
		echo '<header>';
		
		echo '<h1>';
		
		the_title();
		
		echo '</h1>';
		
		echo '</header>';
		
		echo '</div>';
	
		the_content();
		
		echo '<div class="lf-meta-text-tags">';
												
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
														
			edit_post_link( __('edit', 'liquidflux') );	
		
		echo '</div>';	
		
	endwhile;
	
	echo '</div>';
	
	if ( $main_meta['filter_state'] == 'on' ) {
	
		lf_portfolio_filter( 'lf-portfolio-', 'filter-bar', $count, $cats );
	
	}
	
	if ( $grids == 2 ) {
	
		$lf_query_one = new WP_Query( 
									array( 
										'post_type' => 'post', 
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) ) );
	
		echo '<div class="lf-portfolio-dimension-half">';
	
		while ( $lf_query->have_posts() ) : $lf_query->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-half">';
	
		while ( $lf_query_one->have_posts() ) : $lf_query_one->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
	
	}
	
	elseif ( $grids == 3 ) {
	
		$lf_query_one = new WP_Query( 
									array( 
										'post_type' => 'post',
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) ) );
										
		$lf_query_two = new WP_Query( 
									array( 
										'post_type' => 'post',
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) * ( $grids - 1 ) ) );
										
		
		echo '<div class="lf-portfolio-dimension-third">';
	
		while ( $lf_query->have_posts() ) : $lf_query->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-third">';
	
		while ( $lf_query_one->have_posts() ) : $lf_query_one->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-third">';
	
		while ( $lf_query_two->have_posts() ) : $lf_query_two->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
	
	}
	
	elseif ( $grids == 4 ) {
	
		$lf_query_one = new WP_Query( 
									array( 
										'post_type' => 'post', 
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) ) );
										
		$lf_query_two = new WP_Query( 
									array( 
										'post_type' => 'post', 
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) * ( $grids - 2 ) ) );
										
		$lf_query_three = new WP_Query( 
									array( 
										'post_type' => 'post', 
										'category__in' => $cats,
										'posts_per_page' => ( $count / $grids ), 
										'offset' => ( $count / $grids ) * ( $grids - 1 ) ) );
										
		
		echo '<div class="lf-portfolio-dimension-quarter">';
	
		while ( $lf_query->have_posts() ) : $lf_query->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-quarter">';
	
		while ( $lf_query_one->have_posts() ) : $lf_query_one->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-quarter">';
	
		while ( $lf_query_two->have_posts() ) : $lf_query_two->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
		
		echo '<div class="lf-portfolio-dimension-quarter">';
	
		while ( $lf_query_three->have_posts() ) : $lf_query_three->the_post();
	
			lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
		echo '</div>';
	
	}
	
	else {

		while ( $lf_query->have_posts() ) : $lf_query->the_post();
	
		lf_portfolio_generate_post( $main_meta['portfolio_state'] );
		
		endwhile;
	
	}
	
	echo '</div>';
	
	echo '</div>';
	
	if ( $sidebar == 'right' ) {
	
		echo '<aside class="lf-core-content-aside">';
	
		dynamic_sidebar( 'lf-content-sidebar-first' );

		echo '</aside>';
	
	}
	
	echo '</div>';
	
	echo '</div>';
	
}

function lf_portfolio_js() {

	wp_register_script( 'lf-portfolio-js', 
						ADMINURI . '/Page_templates/assets/portfolio-func.js', 
						array( 'jquery' ), 
						'1.0', 
						false );
								
	wp_enqueue_script ( 'lf-portfolio-js' );

}

add_action( 'wp_enqueue_scripts', 'lf_portfolio_js' );

function lf_portfolio_section_callback() {

	echo '<div class="form-table">';

	lf_create_option( 
		'slider',
		'main_options[portfolio_title_size]',
		'portfolio_title_size_opt',
		'main_options',
		'portfolio_title_size',
		'<p>Set the portfolio title text size by choosing any of the values from 12 pixels to 140 pixels.</p>',
		'Set Portfolio Title Text Size',
		' pixels' );
		
	lf_create_option( 
		'select',
		'main_options[portfolio_title_style]',
		'portfolio_title_style_opt',
		'main_options',
		'portfolio_title_style',
		'<p>Set your whole portfolio title text style to be :</p>
		<p> Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></p>',
		'Set Portfolio Title Text Style',
		array( 'normal', 'italic', 'bold', 'bolditalic' ),
		array( 'Normal', 'Italic', 'Bold', 'Bold & Italic' ) );
		
	lf_create_option( 
		'slider',
		'main_options[portfolio_post_title_size]',
		'portfolio_post_title_size_opt',
		'main_options',
		'portfolio_post_title_size',
		'<p>Set the text size of posts within a portfolio by choosing any of the values from 12 pixels to 72 pixels.</p>',
		'Set Portfolio Post Title Size',
		' pixels' );
		
	lf_create_option( 
		'select',
		'main_options[portfolio_post_title_style]',
		'portfolio_post_title_style_opt',
		'main_options',
		'portfolio_post_title_style',
		'<p>Set the titles of posts within a portfolio styled to be :</p>
		<p> Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></p>',
		'Set Portfolio Post Title Style',
		array( 'normal', 'italic', 'bold', 'bolditalic' ),
		array( 'Normal', 'Italic', 'Bold', 'Bold & Italic' ) );
		
	lf_create_option( 
		'slider',
		'main_options[portfolio_post_body_size]',
		'portfolio_post_body_size_opt',
		'main_options',
		'portfolio_post_body_size',
		'<p>Set the text size of your portfolio excerpts and filter text by choosing any of the values from 8 pixels to 48 pixels.</p>',
		'Set Portfolio Text Size',
		' pixels' );
		
	lf_create_option( 
		'select',
		'main_options[portfolio_post_body_style]',
		'portfolio_post_body_style_opt',
		'main_options',
		'portfolio_post_body_style',
		'<p>Set the content text within a portfolio post styled to be :</p>
		<p> Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></p>',
		'Set Portfolio Post Text Style',
		array( 'normal', 'italic', 'bold', 'bolditalic' ),
		array( 'Normal', 'Italic', 'Bold', 'Bold & Italic' ) );
		
	lf_create_option( 
		'text',
		'main_options[portfolio_filter_text]',
		'portfolio_filter_text_opt',
		'main_options',
		'portfolio_filter_text',
		'<p>Set the text of your filter.</p>
		<p>This text is the text at the beginning of your filter; ussaly used to say something about filter. ( e.g "filter posts" ) </p>',
		'Set Filter Text' );
		
	lf_create_option( 
		'color',
		'main_options[portfolio_filter_background]',
		'meta_text_color_opt',
		'main_options',
		'portfolio_filter_background',
		'<p>Set the color of your filter background. ( after saving the right hand box will display the chosen color )</p>',
		'Set Filter Background Color' );
		
	lf_create_option( 
		'color',
		'main_options[portfolio_text_color]',
		'portfolio_text_color_opt',
		'main_options',
		'portfolio_text_color',
		'<p>Set the color of your filter text. ( after saving the right hand box will display the chosen color )</p>',
		'Set Filter Text Color' );
		
	echo '</div>';

}

function lf_editable_style_portfolio() {

	$main_opt = get_option( 'main_options' );

	// Post Title 
	lf_style_change(
			'double',
			$main_opt['portfolio_title_size'],
			null,
			'.lf-portfolio-desc-title h1',
			'font-size',
			array( 
				'24px',
				$main_opt['portfolio_title_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_title_size'],
			null,
			'.lf-portfolio-desc-title h1',
			'line-height',
			array( 
				'36px',
				( $main_opt['portfolio_title_size'] / 2 ) + $main_opt['portfolio_title_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_title_size'],
			null,
			'.lf-portfolio-desc-title h1',
			'font-size',
			array( 
				'1.5rem',
				( $main_opt['portfolio_title_size'] / 16 ) . 'rem' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_title_size'],
			null,
			'.lf-portfolio-desc-title h1',
			'line-height',
			array( 
				'2.25rem',
				( ( $main_opt['portfolio_title_size'] / 2 ) + $main_opt['portfolio_title_size'] ) / 16 . 'rem' ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_title_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'.lf-portfolio-desc-title h1',
			'font-style',
			array( 
				'italic',
				'normal',
				'italic',
				'italic' ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_title_style'],
			array( 
				null,
				'normal',
				'bold',
				'bolditalic' ),
			'.lf-portfolio-desc-title h1',
			'font-weight',
			array( 
				'bold',
				'normal',
				'bold',
				'bold' ) );
				
	// Post Title 
	lf_style_change(
			'double',
			$main_opt['portfolio_post_title_size'],
			null,
			'.lf-portfolio-posttitle',
			'font-size',
			array( 
				'24px',
				$main_opt['portfolio_post_title_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_title_size'],
			null,
			'.lf-portfolio-posttitle',
			'line-height',
			array( 
				'36px',
				( $main_opt['portfolio_post_title_size'] / 2 ) + $main_opt['portfolio_post_title_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_title_size'],
			null,
			'.lf-portfolio-posttitle',
			'font-size',
			array( 
				'1.5rem',
				( $main_opt['portfolio_post_title_size'] / 16 ) . 'rem' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_title_size'],
			null,
			'.lf-portfolio-posttitle',
			'line-height',
			array( 
				'2.25rem',
				( ( $main_opt['portfolio_post_title_size'] / 2 ) + $main_opt['portfolio_post_title_size'] ) / 16 . 'rem' ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_post_title_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'.lf-portfolio-posttitle',
			'font-style',
			array( 
				'italic',
				'normal',
				'italic',
				'italic' ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_post_title_style'],
			array( 
				null,
				'normal',
				'bold',
				'bolditalic' ),
			'.lf-portfolio-posttitle',
			'font-weight',
			array( 
				'normal',
				'normal',
				'bold',
				'bold' ) );
				
	// Text Size 
	lf_style_change(
			'double',
			$main_opt['portfolio_post_body_size'],
			null,
			'.lf-portfolio-piece-wrap p,
			.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'font-size',
			array( 
				'16px',
				$main_opt['portfolio_post_body_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_body_size'],
			null,
			'.lf-portfolio-piece-wrap p,
			.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'line-height',
			array( 
				'24px',
				( $main_opt['portfolio_post_body_size'] / 2 ) + $main_opt['portfolio_post_body_size'] . 'px' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_body_size'],
			null,
			'.lf-portfolio-piece-wrap p,
			.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'font-size',
			array( 
				'1rem',
				( $main_opt['portfolio_post_body_size'] / 16 ) . 'rem' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_body_size'],
			null,
			'.lf-portfolio-piece-wrap p,
			.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'line-height',
			array( 
				'1.5rem',
				( ( $main_opt['portfolio_post_body_size'] / 2 ) + $main_opt['portfolio_post_body_size'] ) / 16 . 'rem' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_post_body_size'],
			null,
			'.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'font-family',
			array( 
				'"Georgia", Serif',
				$main_opt["body_font_choice"] ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_post_body_style'],
			array( 
				null,
				'normal',
				'italic',
				'bolditalic' ),
			'.lf-portfolio-piece-wrap p',
			'font-style',
			array( 
				'normal',
				'normal',
				'italic',
				'italic' ) );
				
	lf_style_change(
			'numerous',
			$main_opt['portfolio_post_body_style'],
			array( 
				null,
				'normal',
				'bold',
				'bolditalic' ),
			'.lf-portfolio-piece-wrap p',
			'font-weight',
			array( 
				'normal',
				'normal',
				'bold',
				'bold' ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_filter_background'], 
			null,
			'.lf-portfolio-filter-bar',
			'background-color',
			array( 
				'#fff',
				$main_opt['portfolio_filter_background'] ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_text_color'], 
			null,
			'.lf-portfolio-filter-text,
			.lf-portfolio-filter-text-info',
			'color',
			array( 
				'#444',
				$main_opt['portfolio_text_color'] ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_text_color'], 
			null,
			'.lf-portfolio-filter-text:hover',
			'background-color',
			array( 
				'#444',
				$main_opt['portfolio_text_color'] ) );
				
	lf_style_change(
			'double',
			$main_opt['portfolio_filter_background'], 
			null,
			'.lf-portfolio-filter-text:hover',
			'color',
			array( 
				'#fff',
				$main_opt['portfolio_filter_background'] ) );

}

add_action( 'lf_editable_style', 'lf_editable_style_portfolio' );
 */
include( ADMINPATH . '/Page_templates/lf-archives-func.php' );

include( ADMINPATH . '/Page_templates/lf-404-func.php' );

?> 