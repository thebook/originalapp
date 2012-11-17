<?php 

/**
* 	A class which takes care of getting the video id from from vimeo and youtube embeds in order to call embeded content
*/
class helper_video
{
	
	function __construct($string_with_video_id)
	{
		$this->get_video_id_and_display_vimeo_video($string_with_video_id);
	}

	protected function _get_the_video_id_from_html_embeded_vimeo ($html_embeded_string)
	{
		$get_the_video_id = explode( 'vimeo.com/video/', $html_embeded_string );

		$get_the_video_id = explode( '?', $get_the_video_id[1] );

		return $get_the_video_id[0];
	}

	protected function _get_the_video_id_from_vimeo_url ($video_url)
	{
		return $vimeo_video_id = str_replace('http://vimeo.com/', '', $video_url );
	}

	protected function _get_the_vimeo_video_id ($embed_or_url_string)
	{ 
 		if ( $embed_or_url_string !== strip_tags($embed_or_url_string) ) : 

 			return $this->_get_the_video_id_from_html_embeded_vimeo($embed_or_url_string);
 			
 		else :
 		
 			return $this->_get_the_video_id_from_vimeo_url($embed_or_url_string);

 		endif;
 	}

 	public function get_video_id_and_display_vimeo_video ($embed_or_url_string, $video_height = '500px')
 	{ ?>
 		
 		<?php $vimeo_video_id = $this->_get_the_vimeo_video_id($embed_or_url_string); ?>

 		<div style="height: <?php echo $video_height; ?>" class="lf-shortcode-video-wrap">

 			<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?badge=0" height="<?php echo $video_height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

 		</div>
 		
 <?php }
}

?>