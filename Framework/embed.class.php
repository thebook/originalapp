<?php 

/**
* 	A class which takes care of getting the video id from from vimeo and youtube embeds in order to call embeded content
*/
class helper_video
{
	/**
	 * We take the embed string for a video determine whether its a youtube or vimeo video, then extract the id from that sting 
	 * and embeded it as an responsive iframe of the set height
	 * @param string $string_with_video_id 
	 * @param string $video_height         
	 */
	function __construct($string_with_video_id, $video_height = '500')
	{
		$this->_check_whether_embeded_video_is_you_tube_or_vimeo_and_embed_it($string_with_video_id, $video_height);
	}

	/**
	 * * We extract the vimeo video if from a piece of html code vimeo gives for embeding, ( you never know when a user might paste that in, or maybe you do either way)
	 * We basicly cut the html string in half at 'vimeo.com/video/' this part comes just before the id so it ussaly looks like 
	 * 'vimeo.com/video/53044322?badge=0' the eight numbers after are the video it, 
	 * when we have it split we just split the other half of this new array into tow again at the '?' character 
	 * f there is no '?badge' paramater then we simply split it at the '"' double quote and get the same result
	 * @param  string $html_embeded_string 
	 * @return string                      The video id
	 */
	protected function _get_the_video_id_from_html_embeded_vimeo ($html_embeded_string)
	{
		$get_the_video_id = explode( 'vimeo.com/video/', $html_embeded_string );
		
		if ( strpos( $get_the_video_id[1], '?badge' ) === false ) :

			$get_the_video_id = explode( '"', $get_the_video_id[1] );

		else : 

			$get_the_video_id = explode( '?', $get_the_video_id[1] );

		endif;

		return $get_the_video_id[0];	
	}

	/**
	 *  A regular viemo video url which is in the bar, we just cut out the 'http://vimeo.com/' and we are left with the video id
	 * @param  string $video_url 
	 * @return string            Video id
	 */
	protected function _get_the_video_id_from_vimeo_url ($video_url)
	{
		return $vimeo_video_id = str_replace('http://vimeo.com/', '', $video_url );
	}

	/**
	 * method checks wether the inputed string is a html embed or a simple url and calls the coresponding method to deal with it
	 * @param  string $embed_or_url_string 
	 * @return return             Video id
	 */
	protected function _get_the_vimeo_video_id ($embed_or_url_string)
	{ 
 		if ( $embed_or_url_string !== strip_tags($embed_or_url_string) ) : 

 			return $this->_get_the_video_id_from_html_embeded_vimeo($embed_or_url_string);
 			
 		else :
 		
 			return $this->_get_the_video_id_from_vimeo_url($embed_or_url_string);

 		endif;
 	}

 	/**
 	 * We retrieve the video id from a regular you tube url, copied form the url bar the video id is sandwiched between the 
 	 * 'v=' string and '&feature' so we just pop the first one and then the second one, and what we seclude the id in the 
 	 * first key of the last array;
 	 * @param  stirng $video_url 
 	 * @return string            Video id
 	 */
 	protected function _get_the_video_id_from_you_tube_url ($video_url)
 	{
 		$get_the_video_id = explode( 'v=', $video_url );

 		$get_the_video_id = explode( '&feature', $get_the_video_id[1] );

 		return $get_the_video_id[0];
 	}

 	/**
 	 * Gets the video id form a url you would get when you click the "Share" button at the bottom of a youtube video 
 	 * this url is much cleaner and as such we just pop out the 'http://youtu.be/' and were left with the id
 	 * @param  string $video_url 
 	 * @return string            Video id
 	 */
 	protected function _get_the_video_id_from_you_tube_share_bar ($video_share_url)
 	{
 		return str_replace( 'http://youtu.be/', '', $video_share_url );
 	}

 	/**
 	 * We extract the id from a html string (iframe) you get when you click the embed link on a youtube video and it gives you ( again you never know if a user will put this in or maybe you do)
 	 * We cut the html string just at the '/embed/' point, this piece comse just before the video id
 	 * then we just take this new array and cut the second piece at the '"' double quote point, because thats what ends the src 
 	 * attribute and as such when this new string is split wwe have isolated the id into the first member of the new array.
 	 * @param  string $html_embeded_string 
 	 * @return string                      Video id
 	 */
 	protected function _get_the_video_id_from_html_embeded_you_tube ($html_embeded_string)
 	{
 		$get_the_video_id = explode( '/embed/', $html_embeded_string );

 		$get_the_video_id = explode( '"', $get_the_video_id[1] );

 		return $get_the_video_id[0];
 	}

 	/**
 	 * Method checks whether the given string is embeded html (iframe) whether its a url gooten from the share button 
 	 * of a video ( will have 'youtu.be' in it ) or is a url gotten form the adress bar, and then calls the 
 	 * correct method to extract the id 
 	 * @param  string $embeded_or_url_string 
 	 * @return string                        Video id
 	 */
 	protected function _get_the_you_tube_video_id ($embeded_or_url_string)
 	{
 		if ( $embeded_or_url_string !== strip_tags($embeded_or_url_string) ) : 

 			return $this->_get_the_video_id_from_html_embeded_you_tube($embeded_or_url_string);

 		elseif ( strpos( $embeded_or_url_string, 'youtu.be' ) !== false ) : 

 			return $this->_get_the_video_id_from_you_tube_share_bar($embeded_or_url_string);

 		else : 

 			return $this->_get_the_video_id_from_you_tube_url($embeded_or_url_string);

 		endif;
 	}

 	/**
 	 * Takes an embed or url string and spits out a iframe of the viemo video and sets its height, this wrap makes it responsive aswell
 	 * @param  string $embed_or_url_string 
 	 * @param  string $video_height        
 	 * @return html                      Embeded vimeo video
 	 */
 	protected function _get_video_id_and_display_vimeo_video ($embed_or_url_string, $video_height = '500')
 	{ ?>
 		
 		<?php $vimeo_video_id = $this->_get_the_vimeo_video_id($embed_or_url_string); ?>

 		<div style="height: <?php echo $video_height; ?>px" class="lf-shortcode-video-wrap">

 			<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?badge=0" height="<?php echo $video_height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

 		</div>
 		
 <?php }

 	/**
 	 * Takes a embed or url string Spits an iframe containting a youtube video, and sets its height
 	 * @param  string $embed_or_url_string 
 	 * @param  string $video_height        
 	 * @return html                      Embeded youtube video
 	 */
 	protected function _get_video_id_and_display_you_tube_video ($embed_or_url_string, $video_height)
 	{ ?>

 		<?php $you_tube_video_id = $this->_get_the_you_tube_video_id($embed_or_url_string); ?>

 		<iframe style="height:<?php echo $video_height; ?>;" class="lf-youtube-video" src="http://www.youtube.com/embed/<?php echo $you_tube_video_id; ?>" frameborder="0" allowfullscreen></iframe>

<?php }

	protected function _check_whether_embeded_video_is_you_tube_or_vimeo_and_embed_it ($embed_or_url_string, $video_height)
	{
		if ( strpos( $embed_or_url_string, 'youtube' ) or strpos( $embed_or_url_string, 'youtu.be' ) ) : 

			$this->_get_video_id_and_display_you_tube_video($embed_or_url_string, $video_height);

		elseif ( strpos( $embed_or_url_string, 'vimeo' ) ) : 

			$this->_get_video_id_and_display_vimeo_video($embed_or_url_string, $video_height);
		
		endif;
	}
}

?>