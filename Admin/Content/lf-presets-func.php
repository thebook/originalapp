<?php 

function lf_presets_func( /*$array = null, $defaultopt = null, $newopt = null, */ $defpre = null ) {

	//$opt = get_option($array);
	
	$new_opt = get_option('main_options');
	
	$opt = array( 
		'default_presets' => '',
		'user_presets' => array('user_opt_one' => $new_opt ) );
	
	foreach ( $defpre as $key => $value ) {
	
		$opt['default_presets'][$key] = $value;
	
	} 
	
	$new_opt_js = json_encode( $new_opt );
	
	
	
?>	
<script>
//var arr = '';
	//console.log(arr);
//$('.thetesthook').click( function() { 
		//alert('clocked');
//	for ( var index in arr ) {
		//console.log('this be key : ' + index + '; and value : ' + arr[index] + '; ' );
		
//	}
//});	
</script>
	

<?php 

}

function lf_presets_section_callback() {

	echo '<div class="form-table">';
	
	//lf_presets_func( array('stuff' => 'some other stuff', 'stuff2' => 'other stuff' ) );
	
	echo '<div class="preset-click">Clicokos</div>';
	
	echo '</div>';
	
}



?>