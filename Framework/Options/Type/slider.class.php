<?php 

/**
* A slider option generator
*/
class generate_slider extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
			<!-- The min value display -->
		<span class="<?php echo $this->class;?>-slider-min"><?php echo $min; ?> |</span>
		<!-- Slider is hooked onto this -->
		<div id="<?php echo "$this->id-$name";?>-hook" class="<?php echo $this->class;?>-slider"></div>
		<!-- Equals display -->
		<span class="<?php echo $this->class;?>-slider-equal">  =</span>
		<!-- The display value -->
		<span class="<?php echo $this->class;?>-slider-value"></span>
		<!-- Value stored  -->
		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<!-- Create slider with javascript -->
		<script>
			slider.slider({
				slider: '<?php echo "$this->id-$name"; ?>-hook', 
				input:  '<?php echo "$this->id-$name"; ?>', 
				min: <?php echo $min; ?>, 
				max: <?php echo $max; ?>
			});
		</script>

<?php }
}

?>