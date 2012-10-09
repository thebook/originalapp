<?php 
	
/**
* Fnction takes an array object, whose key is specified by the "popup" value passed with the plugin.js to the manifest.php
* based on this value options are created and event listeners for them by javascript
*/
class short
{
	var $val;
	/**
	 * Sets the $this->val variable and $this->key variable, so as to get the option array and the option to generate
	 * @param array $v The manifest array, this array holds all the shortcode option definitions
	 * @param string $k The key of the shortcode options to generate from the manifest array
	 */
	function __construct($v, $k)
	{			
		$this->val = $v[$k];
	}

	/**
	 * Generates option based on the $this->key['o'] array and gives it an id
	 * @param  string $type The type of option to create
	 * @param  string $text The option name as seen by user
	 * @param  string $desc The option description
	 * @param  string $id   The option element id,( this is used for the js )
	 * @param  array $val  If its a mutli opt option ( e.g "select" ) the $val array is used to give a name to each option
	 * @return HTML       Echos tr element with the option and td with the name and desc 
	 */
	public function options($type, $text, $desc, $id, $val = null)
	{	

		echo "<tr><th><strong>$text</strong><span>$desc</span></th>";

		echo '<td>';

		switch ( $type ) { 

			case 'text':
				
				echo "<input type='text' id='$id' />";		

				break;

			case 'textarea':
				
				echo "<textarea id='$id' ></textarea>";

				break;

			case 'select':
				
				echo "<select id='$id'>"; 

				foreach ($val as $l) {

					echo "<option>$l</option>";
				}

				echo '</select>';

				break; 		
		}	

		echo '</td></tr>';
	}

	/**
	 * Generates the script necesary to insert the shortcode into the editor, it takes the values of all the inputs and 
	 * fills in the appropriate shortcode variables with them upon insertion
	 * @param  array $j The array which holds all of the shortcode options
	 * @param  string $n The shorcode name, which would look like this ( [shortcodename ... ] );
	 * @param  string $c the 'content' key, if is not false the shortcode encloses content, the value of the key is the name of the content inputs id
	 * @return javascript    Class responsible for inserting the shortcode
	 */
	public function script( $j, $n, $c )
	{ ?>
		<script>

		var lfDialog = {
		
			local_ed : 'ed',
				init : function( ed ) {
					lfDialog.local_ed = ed;
					tinyMCEPopup.resizeToInnerSize();
				},

			opt : function literator( o ) {

			var o = '';

				$('table').each( function() {

				 	o += '[<?php echo $n; ?> ';

					<?php foreach ($j as $key => $v) : ?>

					<?php $v = $v['id']; ?> 

					<?php if ( isset( $v ) ) :?>

					o += '<?php echo $v; ?>="' + $('#<?php echo $v; ?>', this).val() + '" ' ;

					<?php endif; ?> 

					<?php endforeach; ?> 

					o += ']';
					
					<?php if ( $c !== false ) : ?>

					o +=  $('#<?php echo $c; ?>', this).val() + '[/<?php echo $n; ?>]';

					<?php endif; ?> 

				});

				return o;

			},

			insert : function insertButton( ed ) {

				tinyMCEPopup.execCommand('mceRemoveNode', false, null);

				var o = lfDialog.opt( o );
				
					tinyMCEPopup.execCommand('mceReplaceContent', false, o );
					
					tinyMCEPopup.close();	
			}
		};

		tinyMCEPopup.onInit.add( lfDialog.init, lfDialog );

		</script>

<?php }

	/**
	 * Generates the body of the manifest ( i.e the pop up box ), and calls all the functions which init everything
	 * @return html the body of the whole popup box
	 */
	public function body()
	{ ?>
		<html>
			<head>
				<meta charset="UTF-8" content="text/html" http-equiv="Content-Typse">
				<script><?php include('./scripts/tinyMCE-pop.js'); ?></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script><?php include('./scripts/clone.js'); ?></script>
				<?php $this->script( $this->val['o'], $this->val['shortcode'], $this->val['content'] ); ?>
				<style><?php include('./style.css'); ?></style>
			</head>
			<body>
				<div class="desc">
					<div class="title">
						<h1><?php echo $this->val['name']; ?></h1>
					</div>
					<div class="d">
						<p><?php echo $this->val['description']; ?></p>
					</div>
				</div>
				<table>
					<tbody>
						<?php $this->multi($this->val['o']); ?>
					</tbody>
				</table>
				<?php if ( $this->val['tabs'] !== false ) : ?>
					<a href="javascript:clone.clone('.add', '.rm', '<?php echo $this->val["tabs"]; ?>')" class="add" >Add</a>
					<a href="javascript:clone.remove('.add', '.rm')" class="rm" >Remove</a>  
				<?php endif; ?>
				<a href="javascript:lfDialog.insert(lfDialog.local_ed)" class="ins" >Insert</a>
			</body>
		</html>
<?php }
	
	/**
	 * Literates though an array of options uses the 'o' key to literate though arrays within it and calls the options() func
	 * @param  array $o An multi array
	 * @return function    calls the options function and passes arrays as paramaters
	 */
	public function multi($o)
	{
			
		if ( !is_array( $o ) ) return false;

		foreach ( $o as $op ) {

			call_user_func_array( array( $this, 'options' ), $op );	
		} 
	
	}
}

?>