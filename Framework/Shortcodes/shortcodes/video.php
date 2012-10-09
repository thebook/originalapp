<?php 


/**
 * Takes an embeded video and displays it [video video="" height="" ]
 * @param  array     An array of all the attributes that can be passed to the shortcode
 * @param  string  The content that would be inbetween the optening and closing tags of a shortcode ( e.g [s]"c"[/s] )
 * @return html 		   The embeded video ( youtube or vimeo )
 */
function lf_embed_vid($atts, $content = null) {

	extract(
		shortcode_atts(
			array( 
				'video'   => '',
				'height' => '500px';
				), 
			$atts 
		) 
	);

	if ( $height == '' ) { $height = '500px'; }

	if ( strpos( $height, 'px' ) === false ) { $height = $height . 'px'; }
	

	if ( $video != strip_tags( $video ) ) { 

		if ( strpos( $video, 'vimeo' ) !== false ) { 

			$video = explode( '<p>', $video );

			echo '<div style="height: '. $height .';" class="lf-shortcode-video-wrap">';

			echo stripslashes( htmlspecialchars_decode( $video[0] ) );

			echo '</div>';

		}

		elseif ( strpos( $video, 'youtube' ) !== false ) { 

			$video = str_replace( '<iframe', '<iframe style="height: '. $height .';" class="lf-youtube-video"', $video );

			echo stripslashes( htmlspecialchars_decode( $video ) );

		}
	}
	else { 
				
		// If "youtu.be" is found inside the string
		if ( strpos( $video, 'youtu.be' ) !== false ) { 

			$url = str_replace( 'http://youtu.be/', '', $video );
				
			return '<iframe style="display:none;"></iframe><iframe style="height: '. $height .';" class="lf-youtube-video" src="http://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen></iframe>';
			
		}
		// If "vimeo.com" is found inside the string
		else if( strpos( $video, 'vimeo.com' ) !== false ) {

			$url = str_replace('http://vimeo.com/', '', $video );
			
			return '<div style="height: '. $height .';" class="lf-shortcode-video-wrap"><iframe style="height: '. $height .';" src="http://player.vimeo.com/video/'. $url .'" frameborder="0" ></iframe></div>';
		} 
	}
}

add_shortcode( 'video', 'lf_embed_vid' );


?>