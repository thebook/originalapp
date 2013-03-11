<?php 
	
	/**
	 * Includes all the option input Types automaticly, allowing easy option type creation
	 * by simply extending the aplha class within and creating a new file.
	 *
	 * A option type class should be called "generate_"{your option type here}, 
	 * as all classes branched from the alpha_tree_options will generate options by appending a "type" name to the "generate_" string
	 *
	 * e.g(generate_slider, generate_radio )
	 *
	 * This allows easy option creationg though the definitions files by allowing you to just simply name the option type 
	 * for the 'type' key, which will be added to the "generate_"{your type here} and create an instance of the correct 
	 * branched class which you added
	 *
	 * There we have it how to create an option type, it is easier done than prescribed
	 * Happy Coding.
	 * 
	 */
	
	include 'alpha.tree.type.class.php';

	include_fol( FRAMEWORK . '/Options/Type/');
	
	include 'alpha.tree.options.class.php';

	include 'branch.page.options.class.php';

	include 'branch.meta.options.class.php';

	include 'meta.class.php';

	include 'leaf.slider.class.php';

	include 'admin.class.php';

	include 'book.class.php';


?>