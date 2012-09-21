<?php

$meta = get_post_meta( $post->ID, 'main_meta', true );

?>

<article id="post-<?php the_ID(); ?>" class="lf-core-content-<?php lf_content_state_class_echo(); ?>-article">

<?php 

		$embed = $meta['post_video_format_embed'];
		$h 	   = $meta['post_video_format_height'];
		
		if ( $embed !== '' ) { 
			lf_video_format_vid( $embed, $h );
		}

		else { 
		
?>

<script> 	
$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {

			<?php 

				$ogv = $meta['post_video_format_ogv_url'];
				$m4v = $meta['post_video_format_m4v_url']

				if ( $ogv != '' ) {

					echo "ogv: '$ogv',";

				} 

				if ( $m4v != '' ) {

					echo "m4v: '$m4v',";

				}

			?>
				m4v: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",
				ogv: "http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv",
				webmv: "http://www.jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm",
				poster : "http://localhost:35273/wp-content/themes/WhiteWhale/Core/Images/Player1.jpg"
				
			});
		},
		swfPath: "js",
		supplied: "ogv, m4v",
		size: { 
			width : "100%",
			height: "auto",
			cssClass: "jp-video"		
		}	
	});
});
</script> 


	<div id="jp_container_1" class="jp-video ">
			<div class="jp-type-single">
				<div id="jquery_jplayer_1" class="jp-jplayer"></div>
				<div class="jp-gui">
					
					<div class="jp-interface">
						
						
						<div class="jp-controls">
							<span class="jp-play-hold"><a href="javascript:;" class="jp-play" tabindex="1"></a></span>
							<span class="jp-pause-hold"><a href="javascript:;" class="jp-pause" tabindex="1"></a></span>																
						</div>
						
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-progress-shadow"></div>
								<div class="jp-play-bar"></div>
							</div>
						</div>
						
						
							<a href="javascript:;" class="jp-mute" tabindex="1" title="mute"></a>
							<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"></a>
							<div class="jp-volume-bar">
								<div class="jp-progress-shadow"></div>
								<div class="jp-volume-bar-value"></div>
							</div>
													
						
						
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>


		<?php } ?>
	
	<?php if ( $meta['post_video_format_text'] == 'text' )  : ?>
	
	<div class="lf-post-img-text-wrap">
		
	<div class="lf-core-content-body-text">
		
		<h3 class="lf-post-format-media-title"> 
				
			<?php the_title(); ?> 
					
		</h3>
				
		<?php the_content();?>
																																		
	</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if ( is_singular() ) : ?>
										
	<?php	lf_content_meta( 'cat' ); ?>
								
	
	<?php endif; ?>
	
	
</article>