<?php 

/**
* A select generator
*/
class generate_font extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>

		<!-- The select option, all the fonts are listed in the fonts.definition.php file and outputed as options -->
		<select id="<?php echo "$this->id-$name"; ?>" name="<?php echo $array ."[$name]"; ?>" class="<?php echo "$this->class";?>-select">
				
			<?php $font = ( include FRAMEWORK . '/Definitions/fonts.definition.php' ); ?>

			<?php foreach ($font as $single_font) : ?>
			
				<option <?php selected( $saved, $single_font ); ?> value="<?php echo $single_font; ?>">

					<?php echo ucwords(str_replace('-', ' ', $single_font)); ?>

				</option>

			<?php endforeach;?>
				
		</select>

		<!-- The test textarea -->
		<textarea id="<?php echo "$this->id-$name"; ?>_font_box" class="<?php echo $this->class;?>-font">Grumpy Wizards and Cats and Stuff</textarea>

		<script>
			type.font({
				select: '<?php echo "$this->id-$name"; ?>',
				box   : '<?php echo "$this->id-$name"; ?>_font_box'
			});
		</script>

<?php }
}

?>