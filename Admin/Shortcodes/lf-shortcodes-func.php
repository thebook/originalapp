<?php 

function lf_info_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 'color' => '#4a92e8',
				   'textcolor' => '#fff',
				   'style' => 'normal' ), $atts ) );

	return "<div class='lf-info-box-wrap'><span style='background-color: " . esc_attr( $color ) . "; color: ". esc_attr( $textcolor )  ."; font-style: italic; ' class='lf-box-side-text '>i</span><p style='border-color: ". esc_attr( $color ) ."; font-style: ". esc_attr( $style ) ."; ' class='lf-info-box' > ". strip_tags( $content ) ."</p></div>";

}

add_shortcode( 'infobox', 'lf_info_box_shortcode' );

function lf_question_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#ffb642',
				'textcolor' => '#fff',
				'style' => 'normal'  ), 
				$atts ) );

	return "<div class='lf-info-box-wrap'> <span style='background-color: " . esc_attr( $color ) . ";  color: ". esc_attr( $textcolor )  ."; ' class='lf-box-side-text '>?</span><p style='border-color: ". esc_attr( $color ) ."; font-style: ". esc_attr( $style ) ."; ' class='lf-info-box' > ". strip_tags( $content ) ."</p></div>";

}

add_shortcode( 'qbox', 'lf_question_box_shortcode' );

function lf_warn_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#ff8642',
				'textcolor' => '#fff',
				'style' => 'normal' ), 
				$atts ) );

	return "<div class='lf-info-box-wrap'> <span style='background-color: " . esc_attr( $color ) . ";  color: ". esc_attr( $textcolor )  ."; ' class='lf-box-side-text '>!</span> <p style='border-color: ". esc_attr( $color ) ."; font-style: ". esc_attr( $style) ."; ' class='lf-info-box' >". strip_tags( $content ) ."</p> </div>";

}

add_shortcode( 'warnbox', 'lf_warn_box_shortcode' );

function lf_quote_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#fff',
				'textcolor' => '#444',
				'style' => 'italic' ), 
				$atts ) );

	return "<div class='lf-info-box-wrap'> <span style='background-color: " . esc_attr( $color ) . ";  color: ". esc_attr( $textcolor )  ."; ' class='lf-box-side-text '>&quot;</span> <p style='border-color: ". esc_attr( $color ) ."; font-style: ". esc_attr( $style) ."; ' class='lf-info-box' >". strip_tags( $content ) ."</p> </div>";

}

add_shortcode( 'quotebox', 'lf_quote_box_shortcode' );

// Underlines

function lf_underline_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#fff' ), 
				$atts ) );
				
	return '<div style="width: 100%; border-bottom: 3px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 0 24px; display: block; float: left;" ><p>'. strip_tags( $content ) .'</p></div>';

}

add_shortcode( 'underline', 'lf_underline_shortcode' );



function lf_underline_medium_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#fff' ), 
				$atts ) );
				
	return '<div style="width: 100%; border-bottom: 6px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 0 24px; display: block; float: left;" ><p>'. strip_tags( $content ) .'</p></div>';

}

add_shortcode( 'underline_medium', 'lf_underline_medium_shortcode' );

function lf_underline_tall_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#fff' ), 
				$atts ) );
				
	return '<div style="width: 100%; border-bottom: 12px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 0 24px; display: block; float: left;" ><p>'. strip_tags( $content ) .'</p></div>';

}

add_shortcode( 'underline_tall', 'lf_underline_tall_shortcode' );



function lf_underline_custom_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'height' => 6,
				'color' => '#fff' ), 
				$atts ) );
				
	return '<div style="width: 100%; border-bottom: '. esc_attr( $height ) .'px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 0 24px; display: block; float: left;" ><p>'. strip_tags( $content ) .'</p></div>';

}

add_shortcode( 'underline_custom', 'lf_underline_custom_shortcode' );



function lf_underline_text_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#444' ), 
				$atts ) );
				
	return '<div style="width: 87%; border-bottom: 3px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 0 24px; display: block; float: left; padding: 0 0 12px; " ></div><span style=" color: '. esc_attr( $color ) .'; "class="lf-underline-text">'. strip_tags( $content ) .'</span>';

}

add_shortcode( 'underline_text', 'lf_underline_text_shortcode' );



function lf_underline_short_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#fff' ), 
				$atts ) );
				
	return '<div style="width: 74.5%; border-bottom: 3px solid '. esc_attr( $color ) .'; height: 6px; margin: 0 12.5% 24px; display: block; float: left;" ><p>'. strip_tags( $content ) .'</p></div>';

}

add_shortcode( 'underline_short', 'lf_underline_short_shortcode' );



function lf_divider_shortcode() {
				
	return '<div style="width: 100%; min-height: 12px; margin: 0 0 12px; display: block; float: left; " ></div>';

}

add_shortcode( 'divider', 'lf_divider_shortcode' );


// Buttons

function lf_button_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '',
				'background' => '',
				'link' => '',
				'name' => 'Button' ), 
				$atts ) );
				
	if ( $color != null && $background != null ) {
	
		return '<a href="'. esc_attr($link) .'" ><p class="lf-button" style="background-color: '. esc_attr( $background ) .'; color: '. esc_attr( $color ) .'; margin: 0 12px 12px 0; " >'. esc_attr( $name ) .'</p></a>';
	
	}
	
	else {
	
		return '<a href="'. esc_attr($link) .'" ><p class="lf-button" style="margin: 0 12px 12px 0;" >'. esc_attr( $name ) .'</p></a>';
	
	}

}

add_shortcode( 'button', 'lf_button_shortcode' );


function lf_button_wide_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '',
				'background' => '',
				'link' => '',
				'width' => '',
				'name' => 'Button' ), 
				$atts ) );
				
	$length_calc = '';
	
	if ( $width == 'full' ) {
	
		$length_calc = 'width: 96%; padding: 5px 1.5%; margin: 0 1% 12px 0 ; ';
	
	}
	
	if ( $width == 'third' ) {
	
		$length_calc = 'width: 29.25%; padding: 5px 1.5%; margin: 0 1% 12px 0; ';
	
	}
	
	if ( $width == 'half' ) {
	
		$length_calc = 'width: 46%; padding: 5px 1.5%; margin: 0 1% 12px  0;';
	
	}
	
	if ( $width == 'quarter' ) {
	
		$length_calc = 'width: 21%; padding: 5px 1.5%; margin: 0 1% 12px  0; ';
	
	}
			
	if ( $color != null && $background != null ) {
	
		return '<p class="lf-button" style=" '. $length_calc .' background-color: '. esc_attr( $background ) .'; color: '. esc_attr( $color ) .'; margin: 0 12px 12px; " ><a href="'. esc_attr($link) .'" >'. esc_attr( $name ) .'</a></p>';
	
	}
	
	else {
	
		return '<p class="lf-button" style="'. $length_calc .'" ><a href="'. esc_attr($link) .'" >'. esc_attr( $name ) .'</a></p>';
	
	}

}

add_shortcode( 'button_wide', 'lf_button_wide_shortcode' );



function lf_highlight_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'color' => '#ffb642' ), 
				$atts ) );
				
	return '<span style="background-color: '. esc_attr( $color ) .'; ">'. $content .'</span>'; 

}

add_shortcode( 'highlight', 'lf_highlight_shortcode' );


// Boxes 

function lf_toggle_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'id' => '',
				'head_name' => 'Toggle Box',
				'state' => 'open',
				'header' => '#444',
				'contentcol' => '#fff',
				'htext' => '#fff',
				'ctext' => '#444' ), 
				$atts ) );
				
	return '<div id="'. esc_attr( $id ) .'" class="lf-toggle-box-wrap">
			<div class="lf-toggle-box-inner-wrap">
			<div style="background-color : '. esc_attr( $header ) .'; color: '. esc_attr( $htext ) .';" class="lf-toggle-box-head">'. esc_attr( $head_name ) .'
			<div style="border-color : '. esc_attr( $htext ) .';" class="lf-action-opt-square-small">
			</div>
			</div>
			<div style="background-color : '. esc_attr( $contentcol ) .'; color: '. esc_attr( $ctext ) .';" class="lf-toggle-box-content">'. strip_tags( $content ) .'
			</div>
			</div>
			</div>
			<script>behave_funcs.toggle("#'. esc_attr( $id ) .'", "'. esc_attr( $state ) .'");</script>';

}

add_shortcode( 'toggle_box', 'lf_toggle_box_shortcode' );



function lf_display_box_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'head_name' => 'Toggle Box',
				'header' => '#444',
				'contentcol' => '#fff',
				'htext' => '#fff',
				'ctext' => '#444' ), 
				$atts ) );
				
	return '<div id="'. esc_attr( $id ) .'" class="lf-toggle-box-wrap">
			<div class="lf-toggle-box-inner-wrap">
			<div style="background-color : '. esc_attr( $header ) .'; color: '. esc_attr( $htext ) .';" class="lf-toggle-box-head">'. esc_attr( $head_name ) .'
			</div>
			<div style="background-color : '. esc_attr( $contentcol ) .'; color: '. esc_attr( $ctext ) .';" class="lf-toggle-box-content">'. strip_tags( $content ) .'
			</div>
			</div>
			</div>';

}

add_shortcode( 'display_box', 'lf_display_box_shortcode' );



function lf_toggle_box_wrap_shortcode( $atts, $content = null ) {
	
	extract(
		shortcode_atts(
			array( 
				'id' => '',
				'state' => 'open' ), 
				$atts ) );
				
	$strip_cont = strip_tags( $content );
				
	return '<div id="'. esc_attr( $id ) .'" class="lf-toggle-box-wrap">'. do_shortcode( $strip_cont ) .'</div>
			<script>behave_funcs.toggle("#'. esc_attr( $id ) .'", "'. esc_attr( $state ) .'");</script>';

}

add_shortcode( 'toggle_many', 'lf_toggle_box_wrap_shortcode' );



function lf_toggle_box_part_shortcode( $atts, $content = null ) {
	
	extract(
		shortcode_atts(
			array( 
				'head_name' => 'Toggle Box',
				'header' => '#444',
				'contentcol' => '#fff',
				'htext' => '#fff',
				'ctext' => '#444' ), 
				$atts ) );
				
	return '<div class="lf-toggle-box-inner-wrap">
			<div style="background-color : '. esc_attr( $header ) .'; color: '. esc_attr( $htext ) .';" class="lf-toggle-box-head">'. esc_attr( $head_name ) .'
			<div style="border-color : '. esc_attr( $htext ) .';" class="lf-action-opt-square-small">
			</div>
			</div>
			<div style="background-color : '. esc_attr( $contentcol ) .'; color: '. esc_attr( $ctext ) .';" class="lf-toggle-box-content">'. strip_tags( $content ) .'
			</div>
			</div>';

}

add_shortcode( 'toggle', 'lf_toggle_box_part_shortcode' );


// Widths 

function lf_half_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );
	
	return '<div style="width : 45%; margin: 0 2.5%; display: inline-block; float: left;" ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'half_col', 'lf_half_width_shortcode' );


function lf_quarter_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );
	
	return '<div style="width : 20%; margin: 0 2.5%; display: inline-block; float: left;" ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'quarter_col', 'lf_quarter_width_shortcode' );


function lf_third_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );

	return '<div style="width : 28%; margin: 0 2.5%; display: inline-block; float: left; " ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'one_third_col', 'lf_third_width_shortcode' );


function lf_two_third_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );

	return '<div style="width : 61%; margin: 0 2.5%; display: inline-block; float: left; " ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'two_third_col', 'lf_two_third_width_shortcode' );



function lf_sixth_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );

	return '<div class="lf-shortcode-six-width-col" ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'six_col', 'lf_sixth_width_shortcode' );



function lf_eight_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
				
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );

	return '<div class="lf-shortcode-eight-width-col" ><p>'. do_shortcode( $strip_cont ) .'</p></div>';

}

add_shortcode( 'eight_col', 'lf_eight_width_shortcode' );



function lf_column_wrap_width_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
	
	$strip_cont = strip_tags( $content, '<img><h1><h2><h3><h4><h5><h6>' );

	return '<div style="width : 100%; display: block; float: left; " >'. do_shortcode( $strip_cont ) .' </div>';

}

add_shortcode( 'col_wrap', 'lf_column_wrap_width_shortcode' );

include( ADMINPATH . '/Shortcodes/editor/editor-func.php' );


function lf_img_align_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array( 
				'side' => 'left' ), 
				$atts ) );
	
	return '<div style="display: inline; float: '. esc_attr( $side ) .'; margin: 12px;" >'. strip_tags( $content, '<img>' ) .' </div>';

}

add_shortcode( 'img_align', 'lf_img_align_shortcode' );


function lf_img_wrap_shortcode( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(), 
				$atts ) );
	
	return '<div class="lf-shortcode-img-wrap" >'. strip_tags( $content, '<img>' ) .' </div>';

}

add_shortcode( 'img_wrap', 'lf_img_wrap_shortcode' );


// Video

function lf_video_shortcode( $atts, $content = null ) { 
	extract(
		shortcode_atts(
			array(
				'type' => '', 
				'link' => '' ), 
				$atts ) );
						
		if ( $type == 'youtube' ) {
		
			$link = str_replace('http://youtu.be/', '', $link );
			
			return '<iframe class="lf-youtube-video" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe>';
	
		}
		
		elseif ( $type == 'vimeo' ) {
		
			$link = str_replace('http://vimeo.com/', '', $link );
			
			return '<div class="lf-shortcode-video-wrap"><iframe src="http://player.vimeo.com/video/'. $link .'" frameborder="0" ></iframe></div>';
		
		}
	
}

add_shortcode( 'video', 'lf_video_shortcode' );


?>