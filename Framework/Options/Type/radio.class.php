<?php 

/**
* A radio generator
*/
class generate_radio
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

			<?php foreach ( $values as $i => $v ) : ?>

			<label id="<?php echo "$this->id-$name"; ?>" class="<?php echo "$this->class";?>-radio-label">
		
				<input class="admin-radio" type="radio"  name="<?php echo $array ."[$name]"; ?>" <?php echo checked( $saved, $v, false ); ?> value="<?php echo $saved; ?>">
		
				<?php echo $options[$i]; ?>
		
			</label>

			<?php endforeach; ?>
		
		</select>

<?php }
}

?>