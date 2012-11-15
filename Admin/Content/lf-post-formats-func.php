<?php 

function lf_meta_opt(
			$type ='text', 
			$realname = null, 
			$desc = null, 
			$optarray = null, 
			$name = null, 
			$default = null, 
			$options = null, 
			$optvals = null, 
			$hider = null ) { 
	
	global $post;
	
	$meta = get_post_meta( $post->ID, $optarray, true );
	
	$the_opt = ( isset( $meta[$name] )? $meta[$name] : $default );

	echo "<tr id='$name-hook'>";
		
		echo '<th>';
			
		echo '<label for="'. $name .'">';
		
		echo '<strong class="lf-admin-post-meta-th-strong">';
			
		echo $realname;
			
		echo '</strong>';
			
		echo '<span class="lf-admin-post-meta-th-span">';
		
		echo $desc;
			
		echo '</span>';
			
		echo '</label>';
		
		echo '</th>';
	
	switch ( $type ) {
		
		case 'select' : 
		
			echo '<td>';
			
			echo '<select id="lf-post-meta-'. $name .'" class="lf-admin-post-meta-td-select" name="main_meta['.$name.']">';
			
			foreach ( $options as $index => $value ) { 
			
				echo '<option value="'. $value .'" '. selected( $the_opt, $value, false ) .'>';
				
				echo $optvals[$index];
				
				echo '</option>';
				
			}
			
			echo '</select>';
			
			echo '</td>';
		
		break;
		
		case 'radio' : 
		
			echo '<td>';
			
			foreach ( $options  as $index => $value ) { 
			
				echo '<label id="lf-post-meta-'. $name .'" class="lf-admin-post-meta-td-radio-label">';
			
				echo '<input class="admin-radio" type="radio" name="main_meta['.$name.']" '. checked( $the_opt, $value, false ) .' value="'. $value .'" />';
			
				echo $optvals[$index];
			
				echo '</label>';
	
			}
				
			echo '</td>';
			
		break;
		
		case 'text' : 
		
			echo '<td>';
		
			echo '<input id="lf-post-meta-'. $name .'" type="text" class="lf-admin-post-meta-td-text" name="'. $optarray .'['.$name.']" value="'. $the_opt .'" />';
		
			echo '</td>';
		
		break;
		
		case 'upload' : 
		
			echo '<td>';
		
			echo '<input id="lf-post-meta-'. $name .'" type="hidden" class="lf-admin-post-meta-td-text" name="'. $optarray .'['.$name.']" value="'. $the_opt .'" />';

			if ( $the_opt != '' ) {
			
				echo '<img src="'. $the_opt .'" class="lf-admin-post-meta-td-image" title="lightbox image" />';
			
			}
			
			echo '<input id="lf-post-meta-'. $name .'-button" class="button lf-admin-post-meta-td-button" type="button" value="Upload Image" />';
		
			echo '</td>';


		break;
		
		case 'gallery' : 
		
			echo '<td>';
			
			if ( $the_opt != '' ) {
			
				foreach ( $the_opt as $key => $value ) { 
				
					echo '<span class="lf-admin-post-meta-td-image-removeable" >'; 
					
					echo '<input id="lf-post-meta-'. $name .'" type="hidden" name="'. $optarray .'['.$name.']['.$key.']" value="'. $value .'" />';
					
					echo '<img src="'. $value .'" title="remove gallery image" />';
						
					echo '</span>';	
						
				}
			
			}
			
			echo '<input id="lf-post-meta-'. $name .'-button" class="button lf-admin-post-meta-td-button" type="button" value="Upload Image" />';
		
			echo '</td>';
		
		break;
		
		case 'textarea' : 
		
			echo '<td>';
		
			echo '<textarea id="lf-post-meta-'. $name .'" type="text" class="lf-admin-post-meta-td-text" rows="5" name="'. $optarray .'['.$name.']" />'. $the_opt .'</textarea>';
		
			echo '</td>';
		
		break;

		case 'post' : ?>

			<td>
				
				<?php $ppp = get_posts(array('numberposts' => '-1' ) ); ?>

				<select id="lf-post-meta-<?php echo $name; ?>" class="lf-admin-post-meta-td-select" name="main_meta[<?php echo $name; ?>]">
				
				<?php foreach ($ppp as $p ) : ?>
					
					<option value="<?php echo $p->ID; ?>" <?php echo selected( $the_opt, $p->ID, false ); ?>>

						<?php echo $p->post_title; ?>

					</option>					

				<?php endforeach; ?>

				</select>

			</td>

<?php	break;
		
	}
		
	echo '</tr>';
	
	if ( isset( $hider ) ) {
	
		echo '<script>reveal.reveal("'. $hider[0] .'","'. $hider[1] .'",'. $hider[2] .' );</script>';
	
	}
	
	if ( $type == 'upload' ) { 
	
		echo '<script> load.upload( "#lf-post-meta-'. $name .'-button", "#lf-post-meta-'. $name .'" );</script>';
	
	}
	
	if ( $type == 'gallery' ) { 
	
		echo '<script> load.gallery( "#lf-post-meta-'. $name .'-button", "'.$name.'", "'.$optarray.'" );</script>';
	
	}
	
}

// Multi
// function multi( $o ) { 

// 	if ( !is_array( $o ) ) return false;

// 	foreach ( $o['opt'] as $a ) {

// 		call_user_func_array( $a['f'], $a['o'] ); 
		
// 	} 
	
// 	if ( array_key_exists( 'c', $o ) ) {
	
// 		foreach ( $o['c'] as $c ) {
		
// 			( array_key_exists( 'p', $c ) ? call_user_func_array( $c['c'], $c['p'] ) : call_user_func( $c['c'] ) );
		
// 		}

// 	}
	
// }


function wrap_ite( $post, $o ) { 
		
	echo '<table class="form-table lf-admin-post-meta-table">';
	
	echo '<tbody>';
	
	echo '<p>'.$o['desc'].'</p>';
	
	multi( $o['options'] );
	
	echo '</tbody>';
	
	echo '</table>';

}

// Meta Step 3
function pop( $a ) { 
	
	$call = 'wrap_ite( $post, $a["args"] );';
	
	$callback = create_function( '$post, $a', $call );

	add_meta_box( $a['id'], $a['title'], $callback, $a['post_type'], $a['context'], $a['priority'], $a  );

}



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

?>