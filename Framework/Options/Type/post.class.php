<?php 

/**
* A post list option generator
*/
class generate_post extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<?php $pos = get_posts(array('numberposts' => '-1' ) ); ?>

		<select id="<?php echo "$this->id-$name"; ?>" name="<?php echo $array ."[$name]"; ?>" class="<?php echo "$this->class";?>-select">
		
			<?php foreach ($pos as $p ) : ?>
				
				<option value="<?php echo $p->ID; ?>" <?php echo selected( $saved, $p->ID, false ); ?>>

					<?php echo $p->post_title; ?>

				</option>					

			<?php endforeach; ?>

		</select>

<?php }
}

?>