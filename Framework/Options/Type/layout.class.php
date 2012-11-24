<?php 

/**
* A javascript button generator ( when button pressed it calls a js script to do something )
*/
class generate_layout_button extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">
			
		<input id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="<?php echo $button_name; ?>">

		<div id="<?php echo "$this->id-$name"; ?>-layout" class="layout-builder"></div>

		<div id="<?php echo "$this->id-$name"; ?>-layout-close" class="close-layout-button button">Close</div>

		<script>

			layout_builder.portal({
					id            : '<?php echo "$this->id-$name"; ?>',
					ajax_path     : '<?php echo FRAMEWORKURI; ?>/ajax_loads/template.load.php',
					template_name : { "name":"layout_creator"}
				});

			layout_builder.close_layout_builder_window({
				id : '<?php echo "$this->id-$name"; ?>-layout-close',
				box_to_close : '<?php echo "$this->id-$name"; ?>-layout'
			});

		</script>

<?php }
}

?>