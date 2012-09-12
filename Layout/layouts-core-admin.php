<?php 

function layout_finder( $opt, $metaopt, $post, $metaname, $getvalue ) {

	$layout = array();
	
	$main_opt = get_option( $opt );

	$meta_opt = get_post_meta( $post, $metaopt , true );
	
	if ( isset( $meta_opt[$metaname] ) ) {
	
		if ( $meta_opt[$metaname] == 'default' ) { 
		
			return $main_opt[$getvalue];
		
		}
		
		else { 
			
			$name = $meta_opt[$metaname];
		
			$layoutstring = $main_opt['test_saved_layouts']['value'][$name];

			parse_str( $layoutstring, $layout );
			
			return $layout[$opt][$getvalue];
		
		}

	}
	
	else { 
	
		return $main_opt[$getvalue];
	
	}
	
}

function main_options_layouts_callback() { 

	$main_opt = get_option('main_options');
	
	echo '<div class="form-table">';
	
	lf_create_option( "select", 
					  "main_options[preset_chosen]", 
					  "preset_chosen_opt", 
					  "main_options", 
					  "preset_chosen", 
					  "", 
					  "Chose Preset", 
					  array( 'custom', 'presetone' ),
					  array( 'Custom', 'Preset One' ) );
					  
	echo '<div class="lf_admin_core_option_wrap">';
		
	echo '<div class="lf_admin_core_option_text">Saved Layouts :</div>';

	echo '<div class="lf_admin_core_input_wrap">';
	
	echo '<div class="lf_admin_saved_layouts_list">';
	
	if ( isset( $main_opt['test_saved_layouts']['name'] ) ) {
	
		foreach ( $main_opt['test_saved_layouts']['name'] as $key => $value ) { 
			
			echo "<div>";
			
			echo "<span class='lf_admin_core_list_memeber'>$value</span><span title='Remove Layout' class='lf_admin_core_list_removal lf_layout_remove_hook'>-</span>";
			
			echo "<input type='hidden' name='main_options[test_saved_layouts][name][$key]' value='$value' />";
			
			echo '<input type="hidden" name="main_options[test_saved_layouts][value]['. $key .']" value="'. $main_opt['test_saved_layouts']['value'][$key] .'" />';
			
			echo "</div>";
			
		}
	
	}
	
	else {
	
		echo '<p style="text-align: center;" class="lf_no_saved_layouts_text_hook"><i>There are no saved layouts yet.</i></p>';
		
	}
	
	echo '</div>';
	
	echo '<div class="lf_admin_save_layout_button">Save Current Layout</div>';
	
	echo '<div class="LF-option-inv-desc"></div>';
	
	echo '</div>';

	echo '</div>';
					  

?>
	
		
		<div class="layout-sorting-desc-text">
				
			<p class="layout-sorting-desc-text-p">
				
				Set your layout :
					
			</p>
				
			<p class="layout-sorting-desc-text-p">
				
				Set the layout of your website by draggin and dropping : 
					
			</p>
				
			<p class="layout-sorting-desc-text-p">
				
				The states of the draggable parts can be changed by clicking the left and right arrows :
					
			</p>
				
			</div>
			<div class="layout-sorting-wrap">
				<ul class="layout-sortable">
				
<?php 
		global $layui, $the_one_array, $libary_array;	
		
		$mainoption = get_option("main_options");
		$order 		=  $mainoption["layouts"];
		$neworder = array();

		if ( $order != null ) {
		
			foreach ( $order as $value ) { 
			
				$trimvalue = trim( $value ); 
				
				array_push( $neworder, $trimvalue ); 
				
			}
		
		}
				
		$count 		= count($layui[0]);
		$count_one  = count( $the_one_array );
		$count_two 	= count( $order );
		
		$neworder = array_flip($neworder);
		
		ksort( $neworder );
		
		if ( $order != null && $count_one == $count_two ) {
		
			$layui[0] 	= array_combine( $neworder, $layui[0] );	
			$layui[1] 	= array_combine( $neworder, $layui[1] );	
			$layui[2]  	= array_combine( $neworder, $layui[2] ); 
		
		} 
				
		for ( $i = 0; $i <= $count -1; $i ++ ) { 
												echo "<input type='hidden'  class='inputs' name='main_options[layouts][input$i]' value='' />";	
											} 
			
		for ( $i = 0; $i <= $count -1; $i ++ ) { ?>	<li>
														<span class='sortable'>
																			<?php echo $layui[0]["$i"]; ?>
																	</span>
														<div class="LF-option-inv-desc">
																					<?php echo $layui[2]["$i"]; ?>
																				</div>
																					<?php echo  $layui[1]["$i"]; ?>
																</li><?php }  ?>	
																				</ul>
																					</div>																					
				<?php 	
														foreach ( $layui[3] as $value ) { call_user_func($value); }		 
				?>
	</div>
	
<?php }

function lf_layouts_admin_js() { 

	global $pagenow;
		
	if (  $pagenow == 'admin.php' ) {

		wp_enqueue_script( 'layouts-admin-ui', 
						   trailingslashit( get_template_directory_uri() ) . 'Layout/layouts-admin-ui.js', 
						   array( 'admin-js-ui'), 
						   '1.0', 
						   false );  
								
	}
	
} 

add_action( 'admin_enqueue_scripts', 'lf_layouts_admin_js');
?>