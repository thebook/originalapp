<?php 

/**
* A texture option generator
*/
class generate_texture extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>

		<?php $textures = new DirectoryIterator( FRAMEWORK .'/CSS/Includes/Textures/' ); ?>

		<?php $ajax_array = array( 'name' => $name, 'id' => $this->id, 'class' => $this->class, 'saved' => $saved, 'array' => $array, 'move_forward' => $textures_to_show ); ?>

			<label id="<?php echo "$this->id-$name"; ?>" class="<?php echo "$this->class";?>-texture-radio" title="No Texture">

				<input class="admin-radio" type="radio" name="<?php echo $array ."[$name]"; ?>" <?php checked( $saved, 'none' ); ?> value="none">
					
				<div class="<?php echo "$this->class";?>-texture-image" style="background: none"></div>
					
			</label>

		<?php while ( $textures->valid() ) : ?>
		
			<?php if ( !$textures->isDot() && $textures_to_show > 0 ) : ?>

				<?php $css = "url( ". FRAMEWORKURI ."/CSS/Includes/Textures/". $textures->current() ." ) repeat;"; ?>

				<label id="<?php echo "$this->id-$name"; ?>" class="<?php echo "$this->class";?>-texture-radio">

					<input class="admin-radio" type="radio" name="<?php echo $array ."[$name]"; ?>" <?php checked( $saved, $css ); ?> value="<?php echo $css; ?>">
					
					<div class="<?php echo "$this->class";?>-texture-image" style="background: <?php echo $css; ?>"></div>
			
				</label>

				<?php $textures_to_show--; ?>

			<?php endif; ?>
		
			<?php $textures->next(); ?>	
			
		<?php endwhile; ?>

		<div id="<?php echo "$this->id-$name"; ?>-more" class="<?php echo "$this->class";?>-load-more">[ Load More ]</div>


		<script>
			ajax.loadmore({
				button : '<?php echo "$this->id-$name"; ?>-more',
				link   : "<?php echo FRAMEWORKURI .'/ajax_loads/texture.load.php'; ?>",
				data   : <?php echo json_encode($ajax_array); ?>,
				hide   : true,
				message: { 
							text   : "All textures have been loaded",
							header : "Textures Load", 
						}
			});
		</script>

<?php }
}

?>