<?php 

/**
* A upload generator
*/
class generate_upload
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

		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<?php if ( $saved != '' ) : ?>

			<img src="<?php echo $saved; ?>" class="<?php echo $this->class; ?>-image" />

		<?php endif; ?>
			
		<input id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="Upload Image">

		<script>load.upload( '#<?php echo "$this->id-$name"; ?>-button', '#<?php echo "$this->id-$name"; ?>' );</script>

<?php }
}

?>