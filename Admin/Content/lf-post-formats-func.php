<?php 

function lf_video_format_embed( $video, $h ) { 

	if ( $h == '' ) { $h = '500px'; }

	if ( strpos( $h, 'px' ) === false ) { $h = $h . 'px'; }
	

	if ( $video != strip_tags( $video ) ) { 

		if ( strpos( $video, 'vimeo' ) !== false ) { 

			$video = explode( '<p>', $video );

			echo '<div style="height: '. $h .';" class="lf-shortcode-video-wrap">';

			echo stripslashes( htmlspecialchars_decode( $video[0] ) );

			echo '</div>';

		}

		elseif ( strpos( $video, 'youtube' ) !== false ) { 

			$video = str_replace( '<iframe', '<iframe style="height: '. $h .';" class="lf-youtube-video"', $video );

			echo stripslashes( htmlspecialchars_decode( $video ) );

		}

	}

	else { 

		echo do_shortcode('[embed link="'. $video .'" height="'. $h .'"]'); 

	}
}

function lf_video_format_host( $ogv, $m4v, $poster ) { 

	$eogv = ( !empty ( $ogv ) );
	$em4v = ( !empty ( $m4v ) ); 
	$epos = ( !empty ( $poster ) ); 

?>	
<script> 	
$(document).ready(function(){
	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", { 
		<?php 	if ( $eogv  ) { echo ' ogv : "'. $ogv .'", '; } 
				if ( $em4v  ) { echo  'm4v : "'. $m4v .'", '; } 
				if ( $epos  ) { echo  'poster : "'. $poster .'", '; } 
		?>			
			});
		},
		swfPath: "js",
		supplied: "<?php if ( $eogv ) { echo 'ogv,'; }  if ( $em4v ) { echo 'm4v'; } ?>",
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