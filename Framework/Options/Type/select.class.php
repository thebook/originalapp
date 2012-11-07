<?php 

/**
* A select generator
*/
class generate_select extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>

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