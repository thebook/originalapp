<?php 

/**
 * Note: It is called alpha for the purposes of being included first by the "DirectoryIterator" in the include.php file a level up
 * Always extend the alpha classes to provide working branches of the options and class
 * 
* A base class for all generate_{option} classes from all of them are extended
* It is called the aplha tree, because it is the tree from which all of the branches for option types extend
*/
class alpha_tree_generate_type
{
	/**
	* The element id prefix
	*/
	var $id;
	/**
	* The element class prefix
	*/
	var $class;
	
	/**
	 * Set the general element "id" prefix and "class" prefix, and pass the options
	 */
	function __construct( $options, $id, $class )
	{	
		$this->id    = $id;
		$this->class = $class;
		$this->create( $options );
	}
}

?>