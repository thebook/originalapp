<?php 

function lf_style_change ( $type = 'single', $option = null, $condition = null, $element = null, $property = null, $value = null ) { 

	if 	( $type == "single" ) {
	
		if ( $option == $condition ) {
		
			echo "$element { $property : $value }"; 
		
		}
	
	}
	
	if ( $type == "double" ) {

		$valueo = $value[0];
		$valuet = $value[1];
	
		if ( $option == $condition ) {
		
			echo "$element { $property : $valueo ; }";
		
		}
		
		else { 
		
			echo "$element { $property : $valuet ; }";
		
		}
	
	}
	
	if ( $type == "nested" ) { 
	
		$valueo = $value[0];
		$valuet = $value[1];
	
		if ( $option[0] == $condition[0] ) {
		
			if ( $option[1] == $condition[1] ) {
			
				echo "$element { $property : $valueo ; }";
			
			}
			
			else { 
			
				echo "$element { $property : $valuet ; }";
			
			}
			
		}
	
	} 
	
	if ( $type == "double-single" ) { 
	
		if ( $option[0] == $condition[0] ) {
		
			if ( $option[1] == $condition[1] ) {
			
				if ( isset($option[2]) ) { 
				
					if ( $option[2] == $condition[2] ) {
				
						echo "$element { $property : $value ; }";
						
					}
								
				}
				
				else {
			
					echo "$element { $property : $value ; }";
					
				}
			
			}
		
		}
		
	}

	if ( $type == "numerous" ) { 

		foreach ( $value as $index => $value ) {
		
			if ( $option == $condition[$index] ) {
		
				echo "$element { $property : $value ; }";
		
			}
		
		}
	
	}
	
	if ( $type == "numerous-property" ) { 

		$thevalues = $value;
		
		foreach ( $thevalues[0] as $index => $value ) {
		
			$oldindex = $index; 
			
			if ( $option == $condition[$index] ) {
			
				echo "$element { ";
			
				foreach ( $property as $index => $value ) { 
							
					echo "$value : "; 
					echo $thevalues[$index][$oldindex];
					echo " ; ";
					
				}
				
				echo " } "; 
		
			}
		
		}
	
	}
	
}

function lf_font_style( $type = null, $name = null, $theid = null, $optionarray = null, $option = null, $description = null, $optiontext = null ) { 

$main_opt = get_option( $optionarray );

if ( isset( $main_opt[$option] ) ) {
	
	$the_font = $main_opt[$option];
	
}

else {

	$the_font = '"Georgia", serif';
	
}

$lf_fonts = array(
	
	'"Georgia", serif' => '',
	'"Emblema One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Emblema+One' rel='stylesheet' type='text/css'>",
	'"Average", serif' => "<link href='http://fonts.googleapis.com/css?family=Average' rel='stylesheet' type='text/css'>",
	'"Simonetta", cursive' => "<link href='http://fonts.googleapis.com/css?family=Simonetta:400,400italic' rel='stylesheet' type='text/css'>",
	'"Squada One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Squada+One' rel='stylesheet' type='text/css'>",
	'"Dr Sugiyama", cursive' => "<link href='http://fonts.googleapis.com/css?family=Dr+Sugiyama' rel='stylesheet' type='text/css'>",
	'"Crete Round", serif' => "<link href='http://fonts.googleapis.com/css?family=Crete+Round:400,400italic' rel='stylesheet' type='text/css'>",
	'"The Girl Next Door", cursive' => "<link href='http://fonts.googleapis.com/css?family=The+Girl+Next+Door' rel='stylesheet' type='text/css'>",
	'"Merienda One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>",
	'"Oleo Script", cursive' => "<link href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>",
	'"Berkshire Swash", cursive' => "<link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>",
	'"Press Start 2P", cursive' => "<link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>",
	'"Rokkitt", serif' => "<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>",
	'"Overlock", cursive' => "<link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,700italic' rel='stylesheet' type='text/css'>",
	'"Engagement", cursive' => "<link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>",
	'"Karla", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>",
	'"Ewert", cursive' => "<link href='http://fonts.googleapis.com/css?family=Ewert' rel='stylesheet' type='text/css'>",
	'"Miniver", cursive' => "<link href='http://fonts.googleapis.com/css?family=Miniver' rel='stylesheet' type='text/css'>",
	'"Montserrat", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>",
	'"Stint Ultra Expanded", cursive' => "<link href='http://fonts.googleapis.com/css?family=Stint+Ultra+Expanded' rel='stylesheet' type='text/css'>",
	'"Monoton", cursive' => "<link href='http://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css'>",
	'"Aguafina Script", cursive' => "<link href='http://fonts.googleapis.com/css?family=Aguafina+Script' rel='stylesheet' type='text/css'>",
	'"Bilbo", cursive' => " <link href='http://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet' type='text/css'>",
	'"Nothing You Could Do", cursive' => "<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>",
	'"Italiana", serif' => "<link href='http://fonts.googleapis.com/css?family=Italiana' rel='stylesheet' type='text/css'>",
	'"Sancreek", cursive' => "<link href='http://fonts.googleapis.com/css?family=Sancreek' rel='stylesheet' type='text/css'>",
	'"Belleza", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Belleza' rel='stylesheet' type='text/css'>",
	'"Fredoka One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>",
	'"Port Lligat Sans", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Port+Lligat+Sans' rel='stylesheet' type='text/css'>",
	'"Wellfleet", cursive' => "<link href='http://fonts.googleapis.com/css?family=Wellfleet' rel='stylesheet' type='text/css'>",
	'"Pontano Sans", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>",
	'"Devonshire", cursive' => "<link href='http://fonts.googleapis.com/css?family=Devonshire' rel='stylesheet' type='text/css'>",
	'"Swanky and Moo Moo", cursive' => "<link href='http://fonts.googleapis.com/css?family=Swanky+and+Moo+Moo' rel='stylesheet' type='text/css'>",
	'"Italianno", cursive' => "<link href='http://fonts.googleapis.com/css?family=Italianno' rel='stylesheet' type='text/css'>",
	'"Mr Bedfort", cursive' => "<link href='http://fonts.googleapis.com/css?family=Mr+Bedfort' rel='stylesheet' type='text/css'>",
	'"Belgrano", serif' => "<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>",
	'"Convergence", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Convergence' rel='stylesheet' type='text/css'>",
	'"Aldrich", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>",
	'"Happy Monkey", cursive' => "<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>",
	'"Patua One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>",
	'"Fredericka the Great", cursive' => "<link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>",
	'"Caesar Dressing", cursive' => "<link href='http://fonts.googleapis.com/css?family=Caesar+Dressing' rel='stylesheet' type='text/css'>",
	'"Cantata One", serif' => "<link href='http://fonts.googleapis.com/css?family=Cantata+One' rel='stylesheet' type='text/css'>",
	'"Alike", serif' => "<link href='http://fonts.googleapis.com/css?family=Alike' rel='stylesheet' type='text/css'>",
	'"Codystar", cursive' => "<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>",
	'"Kotta One", serif' => "<link href='http://fonts.googleapis.com/css?family=Kotta+One' rel='stylesheet' type='text/css'>",
	'"Lusitana", serif' => "<link href='http://fonts.googleapis.com/css?family=Lusitana:400,700' rel='stylesheet' type='text/css'>",
	'"Shanti", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Shanti' rel='stylesheet' type='text/css'>",
	'"Averia Gruesa Libre", cursive' => "<link href='http://fonts.googleapis.com/css?family=Averia+Gruesa+Libre' rel='stylesheet' type='text/css'>",
	'"Advent Pro", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:400,700' rel='stylesheet' type='text/css'>",
	'"Homenaje", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Homenaje' rel='stylesheet' type='text/css'>",
	'"Meddon", cursive' => "<link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>",
	'"Cutive", serif' => "<link href='http://fonts.googleapis.com/css?family=Cutive' rel='stylesheet' type='text/css'>",
	'"Megrim", cursive' => "<link href='http://fonts.googleapis.com/css?family=Megrim' rel='stylesheet' type='text/css'>",
	'"Oldenburg", cursive' => "<link href='http://fonts.googleapis.com/css?family=Oldenburg' rel='stylesheet' type='text/css'>",
	'"Voces", cursive' => "<link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>",
	'"Bilbo Swash Caps", cursive' => "<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps' rel='stylesheet' type='text/css'>",
	'"Signika", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Signika:400,700' rel='stylesheet' type='text/css'>",
	'"Playball", cursive' => "<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>",
	'"Balthazar", serif' => "<link href='http://fonts.googleapis.com/css?family=Balthazar' rel='stylesheet' type='text/css'>",
	'"Lobster", cursive' => "<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>",
	'"Fanwood Text", serif' => "<link href='http://fonts.googleapis.com/css?family=Fanwood+Text:400,400italic' rel='stylesheet' type='text/css'>",
	'"Marmelad", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Marmelad' rel='stylesheet' type='text/css'>",
	'"Mrs Saint Delafield", cursive' => "<link href='http://fonts.googleapis.com/css?family=Mrs+Saint+Delafield' rel='stylesheet' type='text/css'>",
	'"Metamorphous", cursive' => "<link href='http://fonts.googleapis.com/css?family=Metamorphous' rel='stylesheet' type='text/css'>",
	'"Kaushan Script", cursive' => "<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>",
	'"Alex Brush", cursive' => "<link href='http://fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>",
	'"Telex", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>",
	'"Kenia", cursive' => "<link href='http://fonts.googleapis.com/css?family=Kenia' rel='stylesheet' type='text/css'>",
	'"Iceberg", cursive' => "<link href='http://fonts.googleapis.com/css?family=Iceberg' rel='stylesheet' type='text/css'>",
	'"Exo", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Exo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>",
	'"Abril Fatface", cursive' => "<link href='http://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>",
	'"Acme", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Acme' rel='stylesheet' type='text/css'>",
	'"Della Respira", serif' => "<link href='http://fonts.googleapis.com/css?family=Della+Respira' rel='stylesheet' type='text/css'>",
	'"Rouge Script", cursive' => "<link href='http://fonts.googleapis.com/css?family=Rouge+Script' rel='stylesheet' type='text/css'>",
	'"Handlee", cursive' => "<link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>",
	'"Felipa", cursive' => "<link href='http://fonts.googleapis.com/css?family=Felipa' rel='stylesheet' type='text/css'>",
	'"Unna", serif' => "<link href='http://fonts.googleapis.com/css?family=Unna' rel='stylesheet' type='text/css'>",
	'"Quattrocento", serif' => "<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>",
	'"Montaga", serif' => "<link href='http://fonts.googleapis.com/css?family=Montaga' rel='stylesheet' type='text/css'>",
	'"Metrophobic", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css'>",
	'"Goudy Bookletter 1911", serif' => "<link href='http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911' rel='stylesheet' type='text/css'>",
	'"Salsa", cursive' => "<link href='http://fonts.googleapis.com/css?family=Salsa' rel='stylesheet' type='text/css'>",
	'"Antic Didone", serif' => "<link href='http://fonts.googleapis.com/css?family=Antic+Didone' rel='stylesheet' type='text/css'>",
	'"Special Elite", cursive' => "<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>",
	'"Niconne", cursive' => "<link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>",
	'"Smythe", cursive' => "<link href='http://fonts.googleapis.com/css?family=Smythe' rel='stylesheet' type='text/css'>",
	'"Prosto One", cursive' => "<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>",
	'"Uncial Antiqua", cursive' => "<link href='http://fonts.googleapis.com/css?family=Uncial+Antiqua' rel='stylesheet' type='text/css'>",
	'"Caudex", serif' => "<link href='http://fonts.googleapis.com/css?family=Caudex:400,700,700italic,400italic' rel='stylesheet' type='text/css'>",
	'"Ruda", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Ruda:400,700,900' rel='stylesheet' type='text/css'>",
	'"Anonymous Pro", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro:400,400italic,700,700italic' rel='stylesheet' type='text/css'>",
	'"Asap", sans-serif' => "<link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic' rel='stylesheet' type='text/css'>",
	'"Port Lligat Slab", serif' => "<link href='http://fonts.googleapis.com/css?family=Port+Lligat+Slab' rel='stylesheet' type='text/css'>",
	'"Macondo", cursive' => " <link href='http://fonts.googleapis.com/css?family=Macondo' rel='stylesheet' type='text/css'>",
	'"Almendra", serif' => "<link href='http://fonts.googleapis.com/css?family=Almendra:400,400italic,700' rel='stylesheet' type='text/css'>",
	'"Revalia", cursive' => "<link href='http://fonts.googleapis.com/css?family=Revalia' rel='stylesheet' type='text/css'>",
	'"Glass Antiqua", cursive' => "<link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css'>",
	'"Amatic SC", cursive' => "<link href='http://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>",
	'"Great Vibes", cursive' => "<link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>",
	'"Stint Ultra Condensed", cursive' => "<link href='http://fonts.googleapis.com/css?family=Stint+Ultra+Condensed' rel='stylesheet' type='text/css'>",
	'"Courier New", Courier, monospace' => '',
	'"Lucida Console", Monaco, monospace' => '',
	'"Arial", sans-serif' => '',
	'"Trebuchet MS", Helvetica, sans-serif' => ''
	
	);
	
	if ( $type == "option" ) { 
	
		echo '<div class="lf_admin_core_option_wrap">';
			
		echo '<div class="lf_admin_core_option_text">'. $optiontext .' :</div>';
			
		echo '<div class="lf_admin_core_input_wrap" >'; 
		
		echo '<div class="lf_admin_core_input_select_multiple-wrap">';
		
		echo '<select name="'. $name .'" id="'. $theid .'" class="lf_admin_core_input_select_multiple" multiple>';
		
		foreach ( $lf_fonts as $key => $value ) {
			
			echo "<option style='font-family : $key ;' value='$key'";
			
			echo selected( $the_font, $key, false ); 
			
			echo ">$key</option>";
				
		}
			
		echo '</select>';
		
		echo '</div>';
		
		echo '</div>';
			
		echo '<div class="LF-option-inv-desc">'. $description .'</div>';
			
		echo '</div>';	
		
	}
	
	elseif ( $type == "print" ) {
	
		foreach ( $lf_fonts as $key => $value ) {
		
			if ( $key == $the_font ) {
			
				echo $value;
			
			}
		
		}
	
	}
	
	elseif ( $type == "admin-head" ) {
	
		echo "<link href='http://fonts.googleapis.com/css?family=Emblema+One|Average|Simonetta|Squada+One|Dr+Sugiyama|Crete+Round|The+Girl+Next+Door|Merienda+One|Oleo+Script|Berkshire+Swash|Press+Start+2P|Rokkitt|Overlock|Engagement|Karla|Ewert|Miniver|Montserrat|Stint+Ultra+Expanded|Monoton|Aguafina+Script|Bilbo|Nothing+You+Could+Do|Italiana|Sancreek|Belleza|Fredoka+One|Port+Lligat+Sans|Wellfleet|Pontano+Sans|Devonshire|Swanky+and+Moo+Moo|Italianno|Mr+Bedfort|Belgrano|Convergence|Aldrich|Happy+Monkey|Patua+One|Fredericka+the+Great|Caesar+Dressing|Cantata+One|Alike|Codystar|Kotta+One|Lusitana|Shanti|Averia+Gruesa+Libre|Advent+Pro|Homenaje|Meddon|Cutive|Megrim|Oldenburg|Voces|Bilbo+Swash+Caps|Signika|Playball|Balthazar|Lobster|Fanwood+Text|Marmelad|Mrs+Saint+Delafield|Metamorphous|Kaushan+Script|Alex+Brush|Telex|Kenia|Iceberg|Exo|Abril+Fatface|Acme|Della+Respira|Rouge+Script|Handlee|Felipa|Unna|Quattrocento|Montaga|Metrophobic|Goudy+Bookletter+1911|Salsa|Antic+Didone|Special+Elite|Niconne|Smythe|Prosto+One|Uncial+Antiqua|Caudex|Ruda|Anonymous+Pro|Asap|Port+Lligat+Slab|Macondo|Almendra|Revalia|Glass+Antiqua|Amatic+SC:400,700|Great+Vibes|Stint+Ultra+Condensed' rel='stylesheet' type='text/css'>";
	
	}

}

function lf_editable_style() { 

	echo '<style>'; 
		
	do_action('lf_editable_style');
	
 	echo '</style>';
	
}

add_action( "wp_head", "lf_editable_style" ); 

function lf_editable_style_tablet() { 

	echo '<style>';

	echo '@media screen and (max-width: 900px) {';
	
	do_action( 'lf_editable_style_tablet' );
	
	echo '}';

	echo '</style>';

}

add_action( "wp_head", "lf_editable_style_tablet" );


function lf_editable_style_small() { 

	echo '<style>';

	echo '@media screen and (max-width: 600px) {';
	
	do_action( 'lf_editable_style_small' );
	
	echo '}';

	echo '</style>';

}

add_action( "wp_head", "lf_editable_style_small" );



?>