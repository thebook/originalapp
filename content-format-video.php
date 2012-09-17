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

		else { ?>

	<div id="jp_container" class="jp-video ">
		<div class="jp-type-single">

		    <div id="jquery_jplayer_1" class="jp-jplayer"></div>

		    <div class="jp-gui">

		    	<div class="jp-video-play">
		          	<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
		        </div>

		        <div class="jp-interface">

		          	<div class="jp-progress">
		            	<div class="jp-seek-bar">
		              		<div class="jp-play-bar"></div>
		            	</div>
		         	</div>
			     
			        <ul class="jp-controls">
			            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
			            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
			            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
			            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
			            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>		         
			        </ul>

			        <div class="jp-volume-bar">
			            <div class="jp-volume-bar-value"></div>
			        </div>

		    	</div>
		    </div>

		    <div class="jp-no-solution">
		        <span>
		        		Update Required
		        </span>

		       		To play the media you will need to either update your browser to a recent version or update your 
		        	<a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
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