<?php 

/**
* A select generator
*/
class generate_select
{
	var $id;
	var $class;
	
	function __construct( $a, $id, $class )
	{	
		$this->id    = $id;
		$this->class = $class;
		$this->put( $a['name'], $a['array'], $a['options'], $a['values'], $a['saved'] );
	}

	public function put($name, $array, $options, $values, $saved)
	{ ?>

		<select id="<?php echo "$this->id-$name"; ?>" name="<?php echo $array ."[$name]"; ?>" class="<?php echo "$this->class";?>-select">
		
			<?php foreach ( $values as $i => $v ) : ?>
			
				<option value="<?php echo $v; ?>" <?php echo selected( $saved, $v, false ); ?>>
				
					<?php echo $options[$i]; ?>
				
				</option>

			<?php endforeach; ?>
		
		</select>

<?php }
}

?>