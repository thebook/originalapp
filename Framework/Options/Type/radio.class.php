<?php 

/**
* A radio generator
*/
class generate_radio extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
			<?php foreach ( $values as $i => $v ) : ?>

			<label id="<?php echo "$this->id-$name"; ?>" class="<?php echo "$this->class";?>-radio-label">
		
				<input class="admin-radio" type="radio"  name="<?php echo $array ."[$name]"; ?>" <?php echo checked( $saved, $v, false ); ?> value="<?php echo $v; ?>">
				
				<?php echo $options[$i]; ?>
		
			</label>

			<?php endforeach; ?>

<?php }
}

?>