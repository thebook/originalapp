<?php 

/**
* A text option generator
*/
class generate_text
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

		<input type="text" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

<?php }
}

?>