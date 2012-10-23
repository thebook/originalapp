<?php 

/**
* An option generating class
*/
class options
{
	var $ic;
	var $hc;
	var $gi;
	var $w;

	function __construct($inputclass, $headclass, $id, $elements )
	{		
			// Input class
			$this->ic = $inputclass;
			// Head class
			$this->hc = $headclass;
			// General id prepend
			$this->gi = $id;
			// Wrap elements
			$this->w  = $elements;

	}

	public function put( $type, $t, $d, $a, $n, $s, $ov, $o, $h = null )
	{	?>

		<?php echo '<' . $this->w[0] .' id="'.$n.'-hook">'; ?>

		<?php echo '<' . $this->w[1] .'>'; ?>

			<?php 	$this->head( $t, $d, $n ); ?>

		<?php echo '</' . $this->w[1] .'>'; ?>

		
		<?php echo '<' . $this->w[2] .'>'; ?>

		<?php	$this->type( $type, 
						 array( 
						 	'name'    => $n, 
						 	'array'   => $a, 
						 	'options' => $o,
						 	'optvals' => $ov,
						 	'saved'   => $s  ) ); ?>
		
		<?php echo '</' . $this->w[2] .'>'; ?>

		<?php echo '</' . $this->w[0] .'>'; ?>

		<?php $this->hider( $h ); ?>


<?php }

	public function hider($hider)
	{
		if ( isset( $hider ) ) 
		{	
			echo "<script>reveal.reveal( \"$hider[0]\", \"$hider[1]\", $hider[2] );</script>";
		}
	}

	public function type($t, $b)
	{
		call_user_func_array(array($this, $t), array( $b ) ); 
	}

	public function head($title, $description, $name)
	{ ?>
		
		<label for="<?php echo $name; ?>">

			<strong class="<?php echo $this->hc; ?>-strong">
			
				<?php echo $title; ?>
			
			</strong>

			<span class="<?php echo $this->hc;?>-span">
			
				<?php echo $description; ?>
			
			</span>

		</label>		

<?php }

	public function gallery($a)
	{ ?>

		<?php if ( $saved != '' ) : ?>
			
			<?php foreach ( $saved as $key => $value ) : ?>
			
				<span class="<?php echo $this->ic; ?>-image-removeable">
				
				<input id="<?php echo "$this->gi-".$a['name']; ?>" type="hidden" name="<?php echo $a['array'] ."[".$a['name']."][$key]"; ?>" value="<?php echo $value; ?>">
				
				<img src=\"$value\" title=\"remove image\">
					
				</span>	

			<?php endforeach; ?>

		<?php endif; ?>
		
		<input id="<?php echo "$this->gi-". $a['name']; ?>-button" class="button <?php echo $this->ic; ?>-button" type="button" value="Upload Image">

		<script> load.gallery('#<?php echo "$this->gi-". $a["name"]; ?>-button', '<?php echo $a["name"]; ?>', '<?php echo $a["array"]; ?>' );</script>

<?php }


	public function upload($a)
	{ ?>

		<input id="<?php echo "$this->gi-".$a['name']; ?>" type="hidden" name="<?php echo $a['array'] ."[".$a['name']."]"; ?>" value="<?php echo $a['saved']; ?>">

		<?php if ( $a['saved'] != '' ) : ?>

			<img src="<?php echo $a['saved']; ?>" class="<?php echo $this->ic; ?>-img" />

		<?php endif; ?>
			
		<input id="<?php echo "$this->gi-". $a['name']; ?>-button" class="button <?php echo $this->ic; ?>-button" type="button" value="Upload Image">

		<script>load.upload( '#<?php echo "$this->gi-". $a["name"]; ?>-button', '#<?php echo "$this->gi-". $a["name"]; ?>' );</script>

<?php }


	public function textarea($a)
	{ ?>

		<textarea rows="5" id="<?php echo "$this->gi-".$a['name']; ?>" class="<?php echo $this->ic;?>-text" name="<?php echo $a['array'] ."[".$a['name']."]"; ?>"><?php echo $a['saved']; ?></textarea>

<?php }


	public function radio($a)
	{ ?>
		
		<?php foreach ( $a['options']  as $index => $value ) : ?>
			
			<label id="<?php echo "$this->gi-".$a['name']; ?>" class="<?php echo $this->ic;?>-radio-label">
		
				<input class="admin-radio" type="radio"  name="<?php echo $a['array'] ."[".$a['name']."]"; ?>" <?php echo checked( $saved, $value, false ); ?> value="<?php echo $a['saved']; ?>">
		
				<?php echo $a['optvals'][$index]; ?>
		
			</label>
	
		<?php endforeach; ?>

<?php }

	
	public function text($a)
	{ ?>	
	
		
		<input type="text" id="<?php echo "$this->gi-".$a['name']; ?>" class="<?php echo $this->ic;?>-text" name="<?php echo $a['array'] ."[".$a['name']."]"; ?>" value="<?php echo $a['saved']; ?>">


<?php }


	public function select( $a )
	{ ?>
		
		<select id="<?php echo "$this->gi-".$a['name']; ?>" name="<?php echo $a['array'] ."[".$a['name']."]"; ?>" class="<?php echo "$this->ic-select";?>">
		
			<?php foreach ( $a['optvals'] as $index => $value ) : ?>
			
				<option value="<?php echo $value; ?>" <?php echo selected( $a['saved'], $value, false ); ?>>
				
					<?php echo $a['options'][$index]; ?>
				
				</option>

			<?php endforeach; ?>
		
		</select>

<?php }

	public function post($a)
	{ ?>		
		
		<?php $ppp = get_posts(array('numberposts' => '-1' ) ); ?>

		<select id="<?php echo "$this->gi-".$a['name']; ?>" class="<?php echo "$this->ic-select"; ?>" name="<?php echo $a['array'].'['.$a['name'].']'; ?>">
		
			<?php foreach ($ppp as $p ) : ?>
				
				<option value="<?php echo $p->ID; ?>" <?php echo selected( $a['saved'], $p->ID, false ); ?>>

					<?php echo $p->post_title; ?>

				</option>					

			<?php endforeach; ?>

		</select>

<?php }

}
