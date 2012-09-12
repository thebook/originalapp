<?php 

	/* Layouts Api */
	$layui 			= array( array(), array(), array(), array() ); 
	$the_one_array 	= array(); 
	$libary_array 	= array();

	/* One function to rule them all, one function to find them; one functioin to take them all, and in the darkness bind them */
	
	function the_one_function() { 
		
		global $the_one_array,$post; 
		
		lf_arragment( $post->ID );
		
		$thecount = count($the_one_array);
		
		for ( $i=0; $i <= $thecount -1; $i++ ) { call_user_func($the_one_array["$i"] ); }
		
	}
	
	function lf_create_level( $levelnum ) { 
	
		global $libary_array;
	
		$thelevel = $libary_array[$levelnum];

		$thecount = count($thelevel);
				
		for ( $i= 0; $i <= $thecount -1; $i++ ) {   call_user_func( $thelevel["$i"] ); }

	}
		
	function lf_register_level( $thearray, $levelfunction ) {
	
			global $the_one_array, $libary_array; 
			
			array_push($libary_array, $thearray );
			
			array_push($the_one_array, $levelfunction ); 
			
	}
				
	function lf_register_level_func( $thelevel, $thefunction ) {  
	
		global $libary_array;

		array_push( $libary_array[$thelevel], $thefunction );
	
	}
	
	function lf_register_level_ui( $thelevel, $theelements, $desc, $multiopt = false , $thefunc = null, $multisortid = null ) { 

			global $layui;
			
			array_push( $layui[0], $thelevel );
			array_push( $layui[2], $desc );
			
			if ( $multiopt == false ) { 
			
				$uni_opt_wrap = "<div class='lf-singlesort-wrap'>" . $theelements . "</div>";
			
				array_push( $layui[1], $uni_opt_wrap );
			
			}
			
			if ( $multiopt == true ) { 
			
				$multi_opt_wrap = "<div id='". $multisortid ."' class='sort-multilev-wrap'>
									<div class='sort-multilev-control-left multilev-control'></div>
										<div class='sort-multilev-inner-wrap'>	
											<div class='sort-multilev-box'>" . $theelements . "
											</div>
										</div>
										<div class='sort-multilev-control-right multilev-control'></div>
										<div class='sort-multilev-desc'><div class='sort-multilev-desc-part'></div></div>
									</div>";
									
				array_push( $layui[1], $multi_opt_wrap );
			
				array_push( $layui[3], $thefunc ); 
			
			}
	}
	
	// Hook registration functions here
	function lf_all_your_levels() {	do_action("lf_all_your_levels");	}	
	add_action("after_setup_theme", "lf_all_your_levels" );

	// Hook all registration funcition for ui here 
	function lf_all_your_levels_ui() { 	do_action("lf_all_your_levels_ui"); }
	add_action( "admin_menu", "lf_all_your_levels_ui", 9 );
	
	
	
	/*  //how to reg level 
	function wholenewfunkiososo() {
		function newlevelio() {  lf_create_level( 0 ); }
		$levelzero = array();
		lf_register_level( $levelzero, "newlevelio" );	
		lf_register_level_func( 0, "levelcontents" );  }
		
	function reguifunkio() { 	
		lf_register_level_ui( 0, "contents of ui", "This be a description", true, "the funk for multi opt input" );  }
	
	add_action("lf_all_your_levels", "reguifunkio", 9 ); //reg ui for the level
	add_action("lf_level_api", "wholenewfunkiososo", 9 ); //register the entire level */

	
?>