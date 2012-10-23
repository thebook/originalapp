<?php 

/**
* A post list option generator
*/
class generate_post
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