<?php 

function lf_not_found_pure() { 

	$main_opt = get_option( 'main_options' );

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">

<?php 

	if ( $main_opt['not_found_title_state'] != 'hide' ) {
	
		echo '<header>';
					
		echo '<h1 class="lf-posttitle">';
								 
	
		if ( $main_opt['not_found_title_text'] == null ) {
		
			_e('Nothing Found', 'liquidflux' );
		
		}
		
		else {
		
			echo $main_opt['not_found_title_text'];
		
		}
		
		echo '</h1>';
								
		echo '</header>';
	
	}
	
?>
																
	<div class="theexcerpt ">
							
		<div class="uptwo">
		
<?php 
	
	if ( $main_opt['not_found_image_state'] != 'hide' ) {
	
		echo '<p class="lf-featured-image">';
									
		echo '<img src="'.$main_opt['not_found_image'].'" />';
									
		echo '</p>';
	
	}
									
	if ( $main_opt['not_found_image_state'] != 'hide' ) {
	
			
		if( $main_opt['not_found_desc_text'] == null ) {
		
				_e('What you were searching for could not be found', 'liquidflux' );
		
		}
		
		else {
		
			echo $main_opt['not_found_desc_text']; 
			
		}
	
	}
	
	if ( $main_opt['not_found_search_form_state'] != 'hide' ) {
	
		echo '<p>';
		
		get_search_form();
		
		echo '</p>';
	
	}
	
	if ( $main_opt['not_found_categories_state'] != 'none' ) {
	
		echo '<div class="lf-meta-text-tags">';
		
		if ( $main_opt['not_found_categories_state'] == 'category'
			|| $main_opt['not_found_categories_state'] == 'cattag' ) {

		foreach ( ( get_categories() ) as $category ) {
		
			echo '<a href="'. get_category_link( $category->term_id ) . '" >';
			
			echo $category->name . ', ';
			
			echo '</a>';
		
		}
		
		}
		
		if ( $main_opt['not_found_categories_state'] == 'tag'
			|| $main_opt['not_found_categories_state'] == 'cattag' ) {
		
		foreach ( ( get_tags() ) as $tag ) {
		
			echo '<a href="'. get_tag_link( $tag->term_id ) . '" >';
			
			echo $tag->name . ', ';
			
			echo '</a>';
		
		}
		
		}

		echo '</div>';
	
	}

?>
				
		</div>																						
							
	</div>
	
</article>

<?php 	

}

function lf_not_found_generate( $type ) {

	$main_opt = get_option( 'main_options' );

	if ( $type == 'full' ) {
	
		echo '<div class="contentwrap">';

		echo '<div id="homepage" class="loadpage">';
			
		lf_core_sidebar_generate( 'left' );
		
		echo '<div class="lf-core-content-';
		
		lf_content_state_class_echo();
		
		echo '">';
										
		echo '<div class="leftinlineb hunprec">';
		
		lf_not_found_pure();
		
		echo '</div>';
		
		echo '</div>';
		
		lf_core_sidebar_generate( 'right' );
		
		echo '</div>';
		
		echo '</div>';
	
	}
	
	if ( $type == 'else' ) {
	
		if ( !have_posts() ) : 
		
		lf_not_found_pure();
		
		endif;
	
	}
	
}

function lf_not_found_section_callback() {

	echo '<div class="form-table">';
	
	lf_create_option( 
		'select',
		'main_options[not_found_title_state]',
		'not_found_title_state_opt',
		'main_options',
		'not_found_title_state',
		'<p>Set whether the not found title is <b>Shown,</b> or <b>Hidden</b></p>',
		'Set Not Found Title State',
		array( 'show', 'hide' ),
		array( 'Show Title', 'Hide Title' ) );
		
	lf_create_option( 
		'text',
		'main_options[not_found_title_text]',
		'not_found_title_text_opt',
		'main_options',
		'not_found_title_text',
		'<p>Set the text of your "Not Found" title.</p>',
		'Set Not Found Title' );
		
	lf_create_option( 
		'select',
		'main_options[not_found_text_state]',
		'not_found_text_state_opt',
		'main_options',
		'not_found_text_state',
		'<p>Set whether the not found description text is <b>Shown,</b> or <b>Hidden</b></p>',
		'Set Not Found Text State',
		array( 'show', 'hide' ),
		array( 'Show Description', 'Hide Description' ) );

	lf_create_option( 
		'text',
		'main_options[not_found_desc_text]',
		'not_found_desc_text_opt',
		'main_options',
		'not_found_desc_text',
		'<p>Set the text description of your not found page.</p>',
		'Set Not Found Text' );
		
	lf_create_option( 
		'select',
		'main_options[not_found_image_state]',
		'not_found_image_state_opt',
		'main_options',
		'not_found_image_state',
		'<p>Set whether the not found image is <b>Shown,</b> or <b>Hidden</b></p>
		<p> The not found image is the image you upload. </p>',
		'Set Not Found Text State',
		array( 'hide', 'show' ),
		array( 'Hide Image', 'Show Image' ) );

	lf_create_option( 
		'upload',
		'main_options[not_found_image]',
		'not_found_image_opt',
		'main_options',
		'not_found_image',
		'<p>Upload any image to use as "Not Found Image" of your website.</p>',
		'Upload Not Found Image' );
		
	lf_create_option( 
		'select',
		'main_options[not_found_search_form_state]',
		'not_found_search_form_state_opt',
		'main_options',
		'not_found_search_form_state',
		'<p>Set whether the search form is <b>Shown,</b> or <b>Hidden</b></p>
		<p>The search form is useful for allowing users to search again, if there is no search field in the sidebar.</p>',
		'Set Search Form State',
		array( 'show', 'hide' ),
		array( 'Show Search', 'Hide Search' ) );
		
	lf_create_option( 
		'select',
		'main_options[not_found_categories_state]',
		'not_found_categories_state_opt',
		'main_options',
		'not_found_categories_state',
		'<p>Set whether the a list of linked categories, or/and tags is shown. </p>
		<ul>
		<li><b>No Links</b> : Remove any category or tag links from the page. </li>
		<li><b>Category Links</b> : Show a list of category links, each which leads to a group of posts belonging to the linked category.</li>
		<li><b>Tag Links</b> : Show a list of tag links, each which will lead to a group of posts belonging to the linked tag.</li>
		<li><b>Category & Tag Links</b> : Show a list of both tag and category links.</li>
		</ul>',
		'Set Links State',
		array( 'none', 'category', 'tag', 'cattag' ),
		array( 'No Links', 'Category Links', 'Tag Links', 'Category & Tag Links' ) );
		
	echo '</div>';

}



?>
