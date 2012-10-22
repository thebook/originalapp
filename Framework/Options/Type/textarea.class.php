<?php 

/**
* A textarea option generator
*/
class generate_textarea
{
	var $id;
	var $class;
	
	function __construct( $a, $id, $class )
	{	
		$this->id    = $id;
		$this->class = $class;
		$this->put( $a['name'], $a['array'], $a['saved'] );
	}

	public function put($name, $array, $saved)
	{ ?>

		<textarea id="<?php echo "$this->class-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>"><?php echo $saved; ?></textarea>

<?php }
}

?>