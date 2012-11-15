<?php

class jplayer 
{ 

	public function play( $type, $class, $id, $s, $x = null ) 
	{ 
		$this->init( $class, $id, $s, $x );
		$this->body( $id, $type );
	}

	public function body( $id, $type = 'video' ) {  ?>

		<?php if ( $type == 'audio' ) { echo '<div id="jquery_jplayer_'.$id.'" class="jp-jplayer"></div>'; } ?>

		<div id="jp_container_1" class="<?php echo ( $type == 'video' ) ? 'jp-video' : 'jp-audio'; ?>">
		<div class="jp-type-single">	
		
			<?php if ( $type == 'video' ) { echo '<div id="jquery_jplayer_'.$id.'" class="jp-jplayer"></div>'; } ?>
			

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
			
			<!-- No solution -->
			<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
			</div>	
			
		</div>
		</div>

	<?php }


	public function init( $class, $id, $s, $x = null ) 
	{ ?>

		<?php $m = ( is_array( $x ) ) ? array_merge( $s, $x ) : $s; ?>

		<script> 	
			!function ($) { 
				$(document).ready(function(){
					$("#jquery_jplayer_<?php echo $id; ?>").jPlayer({
						ready: function () {
							$(this).jPlayer("setMedia", { <?php 	
							
								foreach ( $m as $key => $value ) { 
								
									if ( !empty( $m[$key] ) ) { echo $key . ' : "' . $value . '",'; }
								
							} ?>			
							});
						},
						swfPath: "<?php echo SCRIPTS .'/Jplayer.swf'; ?>",
						supplied: "<?php 
						
							foreach ( $s as $key => $value ) {
							
								echo $key . ', ';
								
							} ?>",
						size: { 
							width : "100%",
							height: "auto",
							cssClass: "<?php echo $class; ?>"		
						}
					});
				});
			}(jQuery);
		</script> 

	<?php }

}